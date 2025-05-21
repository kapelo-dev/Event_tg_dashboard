<?php

namespace App\Traits;

use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;

trait FileUploadTrait
{
    protected function uploadFile(UploadedFile $file, string $folder = ''): string
    {
        $uploadService = app(FileUploadService::class);
        return $uploadService->uploadFile($file, $folder);
    }

    protected function deleteFile(string $path): bool
    {
        $uploadService = app(FileUploadService::class);
        return $uploadService->deleteFile($path);
    }
} 