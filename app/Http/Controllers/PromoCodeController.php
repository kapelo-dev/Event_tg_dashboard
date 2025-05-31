<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PromoCode;
use App\Models\PromoCodeUse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::with(['event'])->latest()->paginate(10);
        return view('promo-codes.index', compact('promoCodes'));
    }

    public function create()
    {
        $events = Event::where('start_date', '>', now())->get();
        return view('promo-codes.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|min:3|max:50',
            'eventId' => 'required|exists:events,id',
            'discount' => 'required|numeric|min:0',
            'discountType' => 'required|in:PERCENTAGE,FIXED',
            'maxUses' => 'nullable|integer|min:1',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
        ]);

        $promoCode = new PromoCode();
        $promoCode->code = strtoupper($request->code);
        $promoCode->eventId = $request->eventId;
        $promoCode->discount = $request->discount;
        $promoCode->discountType = $request->discountType;
        $promoCode->maxUses = $request->maxUses;
        $promoCode->startDate = $request->startDate;
        $promoCode->endDate = $request->endDate;
        $promoCode->save();

        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo créé avec succès');
    }

    public function edit(PromoCode $promoCode)
    {
        $events = Event::where('start_date', '>', now())->get();
        return view('promo-codes.edit', compact('promoCode', 'events'));
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $request->validate([
            'code' => 'required|string|min:3|max:50',
            'eventId' => 'required|exists:events,id',
            'discount' => 'required|numeric|min:0',
            'discountType' => 'required|in:PERCENTAGE,FIXED',
            'maxUses' => 'nullable|integer|min:1',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
            'isActive' => 'boolean'
        ]);

        $promoCode->code = strtoupper($request->code);
        $promoCode->eventId = $request->eventId;
        $promoCode->discount = $request->discount;
        $promoCode->discountType = $request->discountType;
        $promoCode->maxUses = $request->maxUses;
        $promoCode->startDate = $request->startDate;
        $promoCode->endDate = $request->endDate;
        $promoCode->isActive = $request->isActive ?? false;
        $promoCode->save();

        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo mis à jour avec succès');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return redirect()->route('promo-codes.index')
            ->with('success', 'Code promo supprimé avec succès');
    }

    public function validateCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'eventId' => 'required|exists:events,id',
        ]);

        $promoCode = PromoCode::where('code', strtoupper($request->code))
            ->where('eventId', $request->eventId)
            ->where('isActive', true)
            ->first();

        if (!$promoCode) {
            return response()->json([
                'valid' => false,
                'message' => 'Code promo invalide'
            ]);
        }

        if ($promoCode->startDate && now() < $promoCode->startDate) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code promo n\'est pas encore actif'
            ]);
        }

        if ($promoCode->endDate && now() > $promoCode->endDate) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code promo a expiré'
            ]);
        }

        if ($promoCode->maxUses && $promoCode->usedCount >= $promoCode->maxUses) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code promo a atteint son nombre maximum d\'utilisations'
            ]);
        }

        return response()->json([
            'valid' => true,
            'promoCode' => $promoCode
        ]);
    }
} 