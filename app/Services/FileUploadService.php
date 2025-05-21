<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    private Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function uploadFile(UploadedFile $file, string $folder = ''): string
    {
        try {
            $cloudName = config('services.cloudinary.cloud_name');
            $apiKey = config('services.cloudinary.api_key');
            $apiSecret = config('services.cloudinary.api_secret');

            Log::info('Starting Cloudinary upload with configuration', [
                'cloud_name' => $cloudName,
                'has_api_key' => !empty($apiKey),
                'has_api_secret' => !empty($apiSecret),
                'file_info' => [
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'folder' => $folder
                ]
            ]);

            $options = [
                'folder' => $folder,
                'resource_type' => 'auto',
                'unsigned' => true,
                'upload_preset' => 'ml_default'
            ];

            Log::info('Uploading with options', [
                'options' => $options,
                'file_path' => $file->getRealPath()
            ]);

            $result = $this->cloudinary->uploadApi()->upload(
                $file->getRealPath(),
                $options
            );

            Log::info('Upload result from Cloudinary', [
                'result' => $result,
                'secure_url' => $result['secure_url'] ?? null
            ]);

            return $result['secure_url'];
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'file' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString(),
                'config' => [
                    'cloud_name' => $cloudName ?? null,
                    'has_api_key' => !empty($apiKey),
                    'has_api_secret' => !empty($apiSecret)
                ]
            ]);
            throw $e;
        }
    }

    private function uploadLocal(UploadedFile $file): string
    {
        try {
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $fileName, 'public');
            return Storage::disk('public')->url($path);
        } catch (\Exception $e) {
            Log::error('Local file upload failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function deleteFile(string $path): bool
    {
        try {
            if (str_contains($path, 'cloudinary.com')) {
                $publicId = $this->getPublicIdFromUrl($path);
                $this->cloudinary->uploadApi()->destroy($publicId);
                Log::info('File deleted from Cloudinary', ['path' => $path]);
                return true;
            } else {
                $localPath = public_path(ltrim($path, '/'));
                if (file_exists($localPath)) {
                    unlink($localPath);
                    Log::info('Local file deleted', ['path' => $localPath]);
                    return true;
                }
                Log::warning('File not found for deletion', ['path' => $path]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Error deleting file', [
                'error' => $e->getMessage(),
                'path' => $path
            ]);
            return false;
        }
    }

    private function getPublicIdFromUrl(string $url): string
    {
        try {
            // Extract the public ID from the Cloudinary URL
            // Example URL: https://res.cloudinary.com/cloud_name/image/upload/v1234567890/folder/filename.jpg
            $parts = parse_url($url);
            $path = $parts['path'];
            
            // Remove version if present (v1234567890)
            $path = preg_replace('/\/v\d+\//', '/', $path);
            
            // Remove the /image/upload/ part
            $path = str_replace('/image/upload/', '', $path);
            
            // Remove file extension
            $path = preg_replace('/\.[^.]+$/', '', $path);
            
            return $path;
        } catch (\Exception $e) {
            Log::error('Error extracting public ID from Cloudinary URL', [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
} 