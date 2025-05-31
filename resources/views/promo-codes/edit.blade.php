@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Modifier le Code Promo</h1>
            <a href="{{ route('promo-codes.index') }}" class="text-blue-600 hover:text-blue-900">
                Retour à la liste
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('promo-codes.update', $promoCode) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $promoCode->code) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Le code que les utilisateurs devront saisir (min. 3 caractères)</p>
                </div>

                <div>
                    <label for="eventId" class="block text-sm font-medium text-gray-700">Événement</label>
                    <select name="eventId" id="eventId" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Sélectionnez un événement</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('eventId', $promoCode->eventId) == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700">Réduction</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', $promoCode->discount) }}" required min="0" step="0.01"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="discountType" class="block text-sm font-medium text-gray-700">Type de réduction</label>
                        <select name="discountType" id="discountType" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="PERCENTAGE" {{ old('discountType', $promoCode->discountType) == 'PERCENTAGE' ? 'selected' : '' }}>Pourcentage (%)</option>
                            <option value="FIXED" {{ old('discountType', $promoCode->discountType) == 'FIXED' ? 'selected' : '' }}>Montant fixe (FCFA)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="maxUses" class="block text-sm font-medium text-gray-700">Nombre maximum d'utilisations</label>
                    <input type="number" name="maxUses" id="maxUses" value="{{ old('maxUses', $promoCode->maxUses) }}" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Laissez vide pour un nombre illimité d'utilisations</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="startDate" class="block text-sm font-medium text-gray-700">Date de début</label>
                        <input type="datetime-local" name="startDate" id="startDate" 
                            value="{{ old('startDate', $promoCode->startDate ? $promoCode->startDate->format('Y-m-d\TH:i') : '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="endDate" class="block text-sm font-medium text-gray-700">Date de fin</label>
                        <input type="datetime-local" name="endDate" id="endDate" 
                            value="{{ old('endDate', $promoCode->endDate ? $promoCode->endDate->format('Y-m-d\TH:i') : '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="isActive" value="1" {{ old('isActive', $promoCode->isActive) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Code promo actif</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Mettre à jour le code promo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 