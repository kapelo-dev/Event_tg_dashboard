<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Créer un Code Promo') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('promo-codes.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Code *</label>
                                <input type="text" name="code" id="code" value="{{ old('code') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="eventId" class="block text-sm font-medium text-gray-700">Événement *</label>
                                <select name="eventId" id="eventId" required
                                    class="form-select">
                                    <option value="" disabled selected>Sélectionnez un événement</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ old('eventId') == $event->id ? 'selected' : '' }}>
                                            {{ $event->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700">Réduction *</label>
                                <input type="number" name="discount" id="discount" value="{{ old('discount') }}" required min="0" step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="discountType" class="block text-sm font-medium text-gray-700">Type de réduction *</label>
                                <select name="discountType" id="discountType" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="PERCENTAGE" {{ old('discountType') == 'PERCENTAGE' ? 'selected' : '' }}>Pourcentage</option>
                                    <option value="FIXED" {{ old('discountType') == 'FIXED' ? 'selected' : '' }}>Montant fixe</option>
                                </select>
                            </div>

                            <div>
                                <label for="maxUses" class="block text-sm font-medium text-gray-700">Nombre maximum d'utilisations</label>
                                <input type="number" name="maxUses" id="maxUses" value="{{ old('maxUses') }}" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="startDate" class="block text-sm font-medium text-gray-700">Date de début</label>
                                <input type="datetime-local" name="startDate" id="startDate" value="{{ old('startDate') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="endDate" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <input type="datetime-local" name="endDate" id="endDate" value="{{ old('endDate') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('promo-codes.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Annuler</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Créer le code promo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 