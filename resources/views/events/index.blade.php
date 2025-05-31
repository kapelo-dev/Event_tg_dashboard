<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Événements') }}
            </h2>
            <div class="flex items-center space-x-4">
                <form method="GET" action="{{ route('events.index') }}" class="flex items-center space-x-2">
                    <select name="category" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach($statuses as $statusOption)
                            <option value="{{ $statusOption }}" {{ request('status', 'À venir') == $statusOption ? 'selected' : '' }}>
                                {{ $statusOption }}
                            </option>
                        @endforeach
                    </select>
                    @if(request()->has('category') || request()->has('status'))
                        <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-gray-900">
                            Réinitialiser
                        </a>
                    @endif
                </form>
                <button type="button" 
                    x-data=""
                    x-on:click="$dispatch('open-modal', 'create-event')" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Créer un événement') }}
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-blue-500">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Cover</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Titre</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Lieu</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Catégorie</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Tickets</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Revenus</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($events as $event)
                                    <tr>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="flex-shrink-0 h-16 w-16">
                                                @if($event->image_url)
                                                    <img class="h-16 w-16 object-cover rounded" src="{{ str_contains($event->image_url, 'cloudinary.com') ? $event->image_url : Storage::url($event->image_url) }}" alt="{{ $event->title }}">
                                                @else
                                                    <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $event->title }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($event->start_date);
                                                    $endDate = \Carbon\Carbon::parse($event->end_date);
                                                @endphp
                                                @if(!$startDate->isSameDay($endDate))
                                                    <div>Du {{ $startDate->format('d/m/Y') }}</div>
                                                    <div>Au {{ $endDate->format('d/m/Y') }}</div>
                                                    @if($event->has_specific_time && $event->start_time && $event->end_time)
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{ $event->start_time }} - {{ $event->end_time }}
                                                        </div>
                                                    @endif
                                                @else
                                                    <div>{{ $startDate->format('d/m/Y') }}</div>
                                                    @if($event->has_specific_time && $event->start_time && $event->end_time)
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{ $event->start_time }} - {{ $event->end_time }}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="text-sm text-gray-900 max-w-[200px] truncate" title="{{ $event->location }}">
                                                {{ $event->location }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $event->category->name }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $event->status_color }}-100 text-{{ $event->status_color }}-800">
                                                {{ $event->status }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <div class="flex flex-col space-y-1">
                                                    <div class="font-medium">Types de billets :</div>
                                                    @foreach($event->ticketTypes as $type)
                                                        <div class="flex justify-between items-center text-sm">
                                                            <span class="capitalize">{{ $type->name }}</span>
                                                            <div class="flex space-x-2">
                                                                <span>{{ number_format($type->price, 0, ',', ' ') }} FCFA</span>
                                                                <span class="text-gray-500">({{ $type->quantity }} places)</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ number_format($event->total_revenue, 0, ',', ' ') }} FCFA
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button type="button"
                                                        x-data=""
                                                        x-on:click="$dispatch('open-modal', 'manage-tickets-{{ $event->id }}')" 
                                                        class="text-blue-600 hover:text-blue-900"
                                                        title="Gérer les tickets">
                                                    <i class="fas fa-ticket-alt"></i>
                                                </button>
                                                <button type="button" 
                                                        x-data="" 
                                                        x-on:click="$dispatch('open-modal', 'show-event-{{ $event->id }}')" 
                                                        class="relative group">
                                                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center transition-all duration-200 group-hover:bg-blue-100">
                                                        <svg class="w-4 h-4 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <button type="button" 
                                                        x-data="" 
                                                        x-on:click="$dispatch('open-modal', 'edit-event-{{ $event->id }}')" 
                                                        class="relative group">
                                                    <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center transition-all duration-200 group-hover:bg-indigo-100">
                                                        <svg class="w-4 h-4 text-indigo-500 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <button type="button" 
                                                        x-data="" 
                                                        x-on:click="$dispatch('open-modal', 'delete-event-{{ $event->id }}')" 
                                                        class="relative group">
                                                    <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center transition-all duration-200 group-hover:bg-red-100">
                                                        <svg class="w-4 h-4 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Aucun événement trouvé
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure les fichiers CSS et JS de Leaflet au début du fichier -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Modal de création d'événement -->
    <x-modal name="create-event" :show="$errors->isNotEmpty()" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('events.store') }}" class="p-6" enctype="multipart/form-data" 
            x-data="{ 
                isMultipleDays: false,
                createMap: null,
                createMarker: null,
                initCreateMap() {
                    if (this.createMap) {
                        this.createMap.remove();
                        this.createMap = null;
                    }
                    
                    this.$nextTick(() => {
                        setTimeout(() => {
                            const mapElement = document.getElementById('create-map');
                            if (!mapElement) return;

                            this.createMap = L.map(mapElement).setView([6.1319, 1.2228], 13);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(this.createMap);

                            this.createMarker = L.marker([6.1319, 1.2228]).addTo(this.createMap);

                            const searchControl = L.Control.geocoder({
                                defaultMarkGeocode: false
                            }).addTo(this.createMap);

                            searchControl.on('markgeocode', (e) => {
                                const { center, name } = e.geocode;
                                this.createMarker.setLatLng(center);
                                this.createMap.setView(center, 16);
                                document.getElementById('create-latitude').value = center.lat.toFixed(6);
                                document.getElementById('create-longitude').value = center.lng.toFixed(6);
                                document.getElementById('create-location').value = name;
                            });

                            this.createMap.on('click', (e) => {
                                this.createMarker.setLatLng(e.latlng);
                                document.getElementById('create-latitude').value = e.latlng.lat.toFixed(6);
                                document.getElementById('create-longitude').value = e.latlng.lng.toFixed(6);
                            });

                            this.createMap.invalidateSize();
                        }, 300);
                    });
                }
            }"
            x-init="$watch('$store.modal.isOpen', value => { if (value) { initCreateMap() } })"
        >
            @csrf

            <div class="space-y-6 max-h-[80vh] overflow-y-auto pr-4">
                <!-- Informations de base -->
                <div>
                    <x-input-label for="title" :value="__('Titre *')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description *')" />
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4" required>{{ old('description') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div>
                    <x-input-label for="category_id" :value="__('Sélectionner une catégorie')" />
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                </div>

                <!-- Image Upload Zone -->
                <div x-data="imageUpload()" class="space-y-4">
                    <div 
                        x-on:dragover.prevent="dragOver = true"
                        x-on:dragleave.prevent="dragOver = false"
                        x-on:drop.prevent="handleDrop($event)"
                        class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition-all"
                        :class="{'border-blue-500 bg-blue-50': dragOver}"
                    >
                        <input 
                            type="file" 
                            name="image_url" 
                            id="image_url" 
                            class="hidden" 
                            accept="image/*"
                            x-ref="fileInput"
                            x-on:change="handleFileSelect"
                        >
                        <div x-show="!imageUrl">
                            <button 
                                type="button" 
                                x-on:click="$refs.fileInput.click()" 
                                class="w-full py-3 text-blue-600 hover:text-blue-800"
                            >
                                {{ __('AJOUTER UNE IMAGE') }}
                            </button>
                            <p class="mt-2 text-sm text-gray-500">ou glissez et déposez</p>
                        </div>
                        <div x-show="imageUrl" class="mt-4">
                            <img :src="imageUrl" class="mx-auto max-h-48 rounded-lg shadow-lg" />
                            <button 
                                type="button" 
                                x-on:click="removeImage" 
                                class="mt-4 text-red-600 hover:text-red-800"
                            >
                                Supprimer l'image
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div class="space-y-4" x-data="{ 
                    isMultipleDays: false,
                    startDate: '{{ old('start_date') }}',
                    endDate: '{{ old('end_date') }}',
                    startTime: '{{ old('start_time') }}',
                    endTime: '{{ old('end_time') }}'
                }">
                    <div class="flex space-x-4">
                        <button 
                            type="button" 
                            x-on:click="isMultipleDays = false"
                            :class="!isMultipleDays ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border-gray-300'"
                            class="flex-1 py-2 px-4 border rounded-lg hover:bg-blue-700 hover:text-white transition-colors"
                        >
                            {{ __('UN JOUR') }}
                        </button>
                        <button 
                            type="button" 
                            x-on:click="isMultipleDays = true"
                            :class="isMultipleDays ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border-gray-300'"
                            class="flex-1 py-2 px-4 border rounded-lg hover:bg-blue-700 hover:text-white transition-colors"
                        >
                            {{ __('PLUSIEURS JOURS') }}
                        </button>
                    </div>

                    <div x-show="!isMultipleDays">
                        <div>
                            <x-input-label for="start_date" :value="__('Date *')" />
                            <input 
                                id="start_date" 
                                name="start_date" 
                                type="date" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                value="{{ old('start_date') }}"
                                x-model="startDate"
                                required 
                                x-on:input="endDate = $event.target.value"
                            />
                        </div>
                        <input 
                            type="hidden" 
                            name="end_date" 
                            x-model="endDate"
                        />
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="start_time" :value="__('Heure de début *')" />
                                <input 
                                    id="start_time" 
                                    name="start_time" 
                                    type="time" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('start_time') }}"
                                    x-model="startTime"
                                    required 
                                />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('Heure de fin *')" />
                                <input 
                                    id="end_time" 
                                    name="end_time" 
                                    type="time" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('end_time') }}"
                                    x-model="endTime"
                                    required 
                                />
                            </div>
                        </div>
                    </div>

                    <div x-show="isMultipleDays" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_date_multi" :value="__('Date de début *')" />
                                <input 
                                    id="start_date_multi" 
                                    name="start_date" 
                                    type="date" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('start_date') }}"
                                    x-model="startDate"
                                    x-bind:required="isMultipleDays"
                                />
                            </div>
                            <div>
                                <x-input-label for="end_date_multi" :value="__('Date de fin *')" />
                                <input 
                                    id="end_date_multi" 
                                    name="end_date" 
                                    type="date" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('end_date') }}"
                                    x-model="endDate"
                                    x-bind:required="isMultipleDays"
                                />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_time_multi" :value="__('Heure de début *')" />
                                <input 
                                    id="start_time_multi" 
                                    name="start_time" 
                                    type="time" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('start_time') }}"
                                    x-model="startTime"
                                    x-bind:required="isMultipleDays"
                                />
                            </div>
                            <div>
                                <x-input-label for="end_time_multi" :value="__('Heure de fin *')" />
                                <input 
                                    id="end_time_multi" 
                                    name="end_time" 
                                    type="time" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    value="{{ old('end_time') }}"
                                    x-model="endTime"
                                    x-bind:required="isMultipleDays"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Types de billets -->
                <div x-data="{ 
                    tickets: [{ type: '', price: '', quantity: '', description: '', custom_name: '' }],
                    addTicket() {
                        this.tickets.push({ type: '', price: '', quantity: '', description: '', custom_name: '' });
                    },
                    removeTicket(index) {
                        if (this.tickets.length > 1) {
                            this.tickets.splice(index, 1);
                        }
                    }
                }" class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Types de billets') }}</h3>
                    
                    <template x-for="(ticket, index) in tickets" :key="index">
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">
                                            {{ __('Type de billet *') }}
                                        </label>
                                        <div class="relative">
                                            <select 
                                                x-model="ticket.type"
                                                :name="`tickets[${index}][type]`"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                required
                                            >
                                                <option value="">Sélectionner un type</option>
                                                <option value="simple">Simple</option>
                                                <option value="standard">Standard</option>
                                                <option value="vip">VIP</option>
                                                <option value="custom">Personnalisé</option>
                                            </select>
                                            <input 
                                                x-show="ticket.type === 'custom'"
                                                type="text" 
                                                :name="`tickets[${index}][custom_name]`"
                                                x-model="ticket.custom_name"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Nom personnalisé"
                                                :required="ticket.type === 'custom'"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">
                                            {{ __('Description') }}
                                        </label>
                                        <input 
                                            type="text" 
                                            :name="`tickets[${index}][description]`"
                                            x-model="ticket.description"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                        />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">
                                            {{ __('Prix *') }}
                                        </label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                                FCFA
                                            </span>
                                            <input 
                                                type="number" 
                                                :name="`tickets[${index}][price]`"
                                                x-model="ticket.price"
                                                class="mt-1 block w-full pl-16 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                                placeholder="0"
                                                required 
                                                min="0"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">
                                            {{ __('Quantité disponible *') }}
                                        </label>
                                        <input 
                                            type="number" 
                                            :name="`tickets[${index}][quantity]`"
                                            x-model="ticket.quantity"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                            placeholder="0"
                                            required 
                                            min="1"
                                        />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button 
                                        type="button" 
                                        class="text-red-600 hover:text-red-800"
                                        x-show="tickets.length > 1"
                                        x-on:click="removeTicket(index)"
                                    >
                                        Supprimer ce type de billet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <button 
                        type="button" 
                        class="w-full py-3 border-2 border-dashed border-gray-300 rounded-lg text-center text-blue-600 hover:bg-gray-50 mt-4"
                        x-on:click="addTicket()"
                    >
                        {{ __('AJOUTER UN TYPE DE BILLET') }}
                    </button>
                </div>

                <!-- Lieu et carte pour la création -->
                <div class="space-y-4">
                    <div>
                        <x-input-label for="create-location" :value="__('Lieu *')" />
                        <x-text-input id="create-location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div class="border rounded-lg p-4">
                        <div id="create-map" class="h-64 w-full rounded-lg mb-4"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="create-latitude" :value="__('Latitude')" />
                                <x-text-input id="create-latitude" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude', '6.1319')" readonly />
                            </div>
                            <div>
                                <x-input-label for="create-longitude" :value="__('Longitude')" />
                                <x-text-input id="create-longitude" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude', '1.2228')" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                    {{ __('ANNULER') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('CRÉER') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    @foreach($events as $event)
        <!-- Modal de visualisation -->
        <x-modal name="show-event-{{ $event->id }}" maxWidth="2xl">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    {{ $event->title }}
                </h2>

                @if($event->image_url)
                    <div class="mb-4">
                        <img src="{{ str_contains($event->image_url, 'cloudinary.com') ? $event->image_url : Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded">
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Description</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $event->description }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Date et heure</h3>
                        <p class="mt-1 text-sm text-gray-900">
                            @php
                                $startDate = \Carbon\Carbon::parse($event->start_date);
                                $endDate = \Carbon\Carbon::parse($event->end_date);
                            @endphp
                            @if(!$startDate->isSameDay($endDate))
                                <span class="block">Du {{ $startDate->format('d/m/Y') }}</span>
                                <span class="block">Au {{ $endDate->format('d/m/Y') }}</span>
                                @if($event->has_specific_time && $event->start_time && $event->end_time)
                                    <span class="block text-gray-500 mt-1">{{ $event->start_time }} - {{ $event->end_time }}</span>
                                @endif
                            @else
                                <span class="block">{{ $startDate->format('d/m/Y') }}</span>
                                @if($event->has_specific_time && $event->start_time && $event->end_time)
                                    <span class="block text-gray-500 mt-1">{{ $event->start_time }} - {{ $event->end_time }}</span>
                                @endif
                            @endif
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Lieu</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $event->location }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $event->category->name }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Fermer') }}
                    </x-secondary-button>
                </div>
            </div>
        </x-modal>

        <!-- Modal de modification -->
        <x-modal name="edit-event-{{ $event->id }}" maxWidth="2xl">
            <form method="POST" action="{{ route('events.update', $event) }}" class="p-6" enctype="multipart/form-data" 
                x-data="{ 
                    isMultipleDays: {{ $event->is_multi_day ? 'true' : 'false' }},
                    editMap: null,
                    editMarker: null,
                    initEditMap() {
                        if (this.editMap) {
                            this.editMap.remove();
                            this.editMap = null;
                        }
                        
                        this.$nextTick(() => {
                            setTimeout(() => {
                                const mapElement = document.getElementById('edit-map-{{ $event->id }}');
                                if (!mapElement) return;

                                const lat = {{ $event->latitude ?? 6.1319 }};
                                const lng = {{ $event->longitude ?? 1.2228 }};
                                
                                this.editMap = L.map(mapElement).setView([lat, lng], 13);
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '© OpenStreetMap contributors'
                                }).addTo(this.editMap);

                                this.editMarker = L.marker([lat, lng]).addTo(this.editMap);

                                const searchControl = L.Control.geocoder({
                                    defaultMarkGeocode: false
                                }).addTo(this.editMap);

                                searchControl.on('markgeocode', (e) => {
                                    const { center, name } = e.geocode;
                                    this.editMarker.setLatLng(center);
                                    this.editMap.setView(center, 16);
                                    document.getElementById('edit-latitude-{{ $event->id }}').value = center.lat.toFixed(6);
                                    document.getElementById('edit-longitude-{{ $event->id }}').value = center.lng.toFixed(6);
                                    document.getElementById('edit-location-{{ $event->id }}').value = name;
                                });

                                this.editMap.on('click', (e) => {
                                    this.editMarker.setLatLng(e.latlng);
                                    document.getElementById('edit-latitude-{{ $event->id }}').value = e.latlng.lat.toFixed(6);
                                    document.getElementById('edit-longitude-{{ $event->id }}').value = e.latlng.lng.toFixed(6);
                                });

                                this.editMap.invalidateSize();
                            }, 300);
                        });
                    }
                }"
                x-init="$watch('$store.modal.isOpen', value => { if (value) { initEditMap() } })"
            >
                @csrf
                @method('PUT')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Modifier l\'événement') }}
                </h2>

                <div class="mt-6">
                    <x-input-label for="image_url-{{ $event->id }}" :value="__('Image de couverture')" />
                    @if($event->image_url)
                        <div class="mt-2 mb-2">
                            <img src="{{ str_contains($event->image_url, 'cloudinary.com') ? $event->image_url : Storage::url($event->image_url) }}" alt="{{ $event->title }}" class="h-32 w-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" id="image_url-{{ $event->id }}" name="image_url" class="mt-1 block w-full" accept="image/*" />
                    <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                </div>

                <div class="mt-6">
                    <x-input-label for="title-{{ $event->id }}" :value="__('Titre')" />
                    <x-text-input id="title-{{ $event->id }}" name="title" type="text" class="mt-1 block w-full" :value="old('title', $event->title)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div class="mt-6">
                    <x-input-label for="description-{{ $event->id }}" :value="__('Description')" />
                    <textarea id="description-{{ $event->id }}" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4" required>{{ old('description', $event->description) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <!-- Dates -->
                <div class="space-y-4 mt-6">
                    <div class="flex space-x-4">
                        <button 
                            type="button" 
                            x-on:click="isMultipleDays = false"
                            :class="!isMultipleDays ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border-gray-300'"
                            class="flex-1 py-2 px-4 border rounded-lg hover:bg-blue-700 hover:text-white transition-colors"
                        >
                            {{ __('UN JOUR') }}
                        </button>
                        <button 
                            type="button" 
                            x-on:click="isMultipleDays = true"
                            :class="isMultipleDays ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border-gray-300'"
                            class="flex-1 py-2 px-4 border rounded-lg hover:bg-blue-700 hover:text-white transition-colors"
                        >
                            {{ __('PLUSIEURS JOURS') }}
                        </button>
                    </div>

                    <div x-show="!isMultipleDays">
                        <x-input-label for="start_date-{{ $event->id }}" :value="__('Date *')" />
                        <x-text-input id="start_date-{{ $event->id }}" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') : '')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                    </div>

                    <div x-show="isMultipleDays" class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_date_multi-{{ $event->id }}" :value="__('Date de début *')" />
                            <x-text-input id="start_date_multi-{{ $event->id }}" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') : '')" x-bind:required="isMultipleDays" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        <div>
                            <x-input-label for="end_date_multi-{{ $event->id }}" :value="__('Date de fin *')" />
                            <x-text-input id="end_date_multi-{{ $event->id }}" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') : '')" x-bind:required="isMultipleDays" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="start_time-{{ $event->id }}" :value="__('Heure de début')" />
                            <x-text-input id="start_time-{{ $event->id }}" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time', $event->start_time)" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                        </div>
                        <div>
                            <x-input-label for="end_time-{{ $event->id }}" :value="__('Heure de fin')" />
                            <x-text-input id="end_time-{{ $event->id }}" name="end_time" type="time" class="mt-1 block w-full" :value="old('end_time', $event->end_time)" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                        </div>
                    </div>
                </div>

                <!-- Lieu et carte pour la modification -->
                <div class="space-y-4">
                    <div>
                        <x-input-label for="edit-location-{{ $event->id }}" :value="__('Lieu')" />
                        <x-text-input id="edit-location-{{ $event->id }}" name="location" type="text" class="mt-1 block w-full" :value="old('location', $event->location)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div class="border rounded-lg p-4">
                        <div id="edit-map-{{ $event->id }}" class="h-64 w-full rounded-lg mb-4"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="edit-latitude-{{ $event->id }}" :value="__('Latitude')" />
                                <x-text-input id="edit-latitude-{{ $event->id }}" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude', $event->latitude ?? '6.1319')" readonly />
                            </div>
                            <div>
                                <x-input-label for="edit-longitude-{{ $event->id }}" :value="__('Longitude')" />
                                <x-text-input id="edit-longitude-{{ $event->id }}" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude', $event->longitude ?? '1.2228')" readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label for="category_id-{{ $event->id }}" :value="__('Catégorie')" />
                    <select id="category_id-{{ $event->id }}" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $event->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                        {{ __('Annuler') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('Mettre à jour') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Modal de suppression -->
        <x-modal name="delete-event-{{ $event->id }}" maxWidth="md">
            <form method="POST" action="{{ route('events.destroy', $event) }}" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Êtes-vous sûr de vouloir supprimer cet événement ?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Cette action est irréversible. Toutes les données associées à cet événement seront définitivement supprimées.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                        {{ __('Annuler') }}
                    </x-secondary-button>
                    <x-danger-button>
                        {{ __('Supprimer l\'événement') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endforeach

    <!-- Modals de gestion des tickets -->
    @foreach($events as $event)
        <x-modal name="manage-tickets-{{ $event->id }}" focusable maxWidth="2xl">
            <div class="p-6" x-data="{ showNewTicketForm: false, newTicket: { type: '', custom_name: '', price: '', quantity: '', description: '' } }">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Gérer les tickets - {{ $event->title }}</h2>
                
                <div class="space-y-4">
                    <!-- Formulaire d'ajout d'un nouveau type -->
                    <button 
                        x-show="!showNewTicketForm"
                        type="button"
                        x-on:click="showNewTicketForm = true"
                        class="w-full py-3 border-2 border-dashed border-gray-300 rounded-lg text-center text-blue-600 hover:bg-gray-50">
                        <i class="fas fa-plus mr-2"></i> Ajouter un nouveau type de ticket
                    </button>

                    <div x-show="showNewTicketForm" class="bg-blue-50 p-4 rounded-lg mb-4">
                        <form method="POST" 
                            action="{{ route('ticket-types.store', $event->id) }}" 
                            class="space-y-4"
                            x-data="{}"
                            x-on:submit.prevent="
                                let form = $el;
                                let formData = new FormData(form);
                                if (formData.get('type') !== 'custom') {
                                    formData.delete('custom_name');
                                }
                                fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json'
                                    }
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        window.location.reload();
                                    } else {
                                        alert(data.message || 'Une erreur est survenue');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Une erreur est survenue');
                                });
                            ">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Type de billet *</label>
                                    <div class="relative">
                                        <select 
                                            x-model="newTicket.type"
                                            name="type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            required
                                        >
                                            <option value="">Sélectionner un type</option>
                                            @php
                                                $existingTypes = $event->ticketTypes->pluck('name')->toArray();
                                                $availableTypes = array_diff(['simple', 'standard', 'vip'], array_map('strtolower', $existingTypes));
                                            @endphp
                                            @foreach($availableTypes as $type)
                                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                            @endforeach
                                            <option value="custom">Personnalisé</option>
                                        </select>
                                        <input 
                                            x-show="newTicket.type === 'custom'"
                                            type="text" 
                                            name="custom_name"
                                            x-model="newTicket.custom_name"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Nom personnalisé"
                                            x-bind:required="newTicket.type === 'custom'"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Prix *</label>
                                    <input 
                                        type="number" 
                                        name="price"
                                        x-model="newTicket.price"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                        min="0"
                                    />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Quantité *</label>
                                    <input 
                                        type="number" 
                                        name="quantity"
                                        x-model="newTicket.quantity"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                        min="1"
                                    />
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Description</label>
                                    <textarea 
                                        name="description"
                                        x-model="newTicket.description"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        rows="2"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button 
                                    type="button"
                                    x-on:click="showNewTicketForm = false; newTicket = { type: '', custom_name: '', price: '', quantity: '', description: '' }"
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                    Annuler
                                </button>
                                <button 
                                    type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Ajouter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Liste des types de tickets existants -->
                    @foreach($event->ticketTypes as $type)
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium">{{ $type->name }}</h3>
                                    <p class="text-sm text-gray-600">Prix : {{ number_format($type->price, 0, ',', ' ') }} FCFA</p>
                                    
                                    @php
                                        $stats = app(App\Services\ActivityLogService::class)->getTicketTypeStats($type);
                                        $logs = App\Models\ActivityLog::where('entityType', 'App\\Models\\TicketType')
                                            ->where('entityId', $type->id)
                                            ->orderBy('created_at', 'desc')
                                            ->take(5)
                                            ->get();
                                    @endphp

                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm font-medium text-gray-600">Statistiques :</p>
                                        <p class="text-sm text-gray-600">Quantité initiale : {{ $stats['initial_quantity'] }}</p>
                                        <p class="text-sm text-gray-600">Total ajouté : <span class="text-green-600">+{{ $stats['total_added'] }}</span></p>
                                        <p class="text-sm text-gray-600">Total retiré : <span class="text-red-600">-{{ $stats['total_removed'] }}</span></p>
                                        <p class="text-sm font-medium text-gray-600">Total mis en vente : {{ $stats['total_put_on_sale'] }}</p>
                                        <p class="text-sm text-gray-600">Tickets vendus : {{ $stats['sold_tickets'] }}</p>
                                        <p class="text-sm text-gray-600">Tickets disponibles : {{ $stats['available_tickets'] }}</p>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm font-medium text-gray-600 mb-2">Derniers mouvements :</p>
                                        <div class="space-y-2">
                                            @foreach($logs as $log)
                                                <div class="text-xs {{ $log->action === 'add_quantity' ? 'text-green-600' : ($log->action === 'remove_quantity' ? 'text-red-600' : 'text-gray-600') }}">
                                                    @php
                                                        $quantity = $log->details['quantity'] ?? 0;
                                                    @endphp
                                                    @if($log->action === 'create_ticket_type')
                                                        Création initiale : {{ $quantity }} tickets
                                                    @elseif($log->action === 'add_quantity')
                                                        +{{ $quantity }} tickets ajoutés
                                                    @elseif($log->action === 'remove_quantity')
                                                        -{{ $quantity }} tickets retirés
                                                    @endif
                                                    <span class="text-gray-400 ml-1">({{ $log->created_at->format('d/m/Y H:i') }})</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div x-data="{ quantity: 1 }" class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-2">
                                            <input type="number" x-model="quantity" min="1" class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Qté">
                                            <form method="POST" action="{{ route('ticket-types.add-quantity', $type->id) }}" 
                                                class="inline"
                                                x-data="{}"
                                                x-on:submit.prevent="
                                                    $el.submit();
                                                    $dispatch('close');
                                                ">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" :value="quantity">
                                                <button 
                                                    type="submit" 
                                                    class="text-green-600 hover:text-green-800"
                                                >
                                                    <i class="fas fa-plus text-xl"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('ticket-types.remove-quantity', $type->id) }}" 
                                                class="inline"
                                                x-data="{}"
                                                x-on:submit.prevent="
                                                    $el.submit();
                                                    $dispatch('close');
                                                ">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" :value="quantity">
                                                <button 
                                                    type="submit" 
                                                    class="text-red-600 hover:text-red-800"
                                                >
                                                    <i class="fas fa-minus text-xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal d'ajout de quantité -->
                                    <x-modal name="add-quantity-{{ $type->id }}" maxWidth="md">
                                        <form method="POST" action="{{ route('ticket-types.add-quantity', $type->id) }}" class="p-6">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" x-model="quantity">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Confirmer l\'ajout de tickets') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Voulez-vous ajouter ') }} <span x-text="quantity"></span> {{ __(' tickets de type ') }} {{ $type->name }} ?
                                            </p>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                                                    {{ __('Annuler') }}
                                                </x-secondary-button>
                                                <x-primary-button>
                                                    {{ __('Ajouter') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>

                                    <!-- Modal de retrait de quantité -->
                                    <x-modal name="remove-quantity-{{ $type->id }}" maxWidth="md">
                                        <form method="POST" 
                                            action="{{ route('ticket-types.remove-quantity', $type->id) }}" 
                                            class="p-6"
                                            x-data="{}"
                                            x-on:submit.prevent="
                                                $el.submit();
                                                $dispatch('close');
                                            ">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" x-model="quantity">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Confirmer le retrait de tickets') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Voulez-vous retirer ') }} <span x-text="quantity"></span> {{ __(' tickets de type ') }} {{ $type->name }} ?
                                            </p>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                                                    {{ __('Annuler') }}
                                                </x-secondary-button>
                                                <x-danger-button>
                                                    {{ __('Retirer') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Fermer') }}
                    </x-secondary-button>
                </div>
            </div>
        </x-modal>
    @endforeach

    <script>
        function imageUpload() {
            return {
                dragOver: false,
                imageUrl: null,
                handleDrop(e) {
                    this.dragOver = false;
                    const file = e.dataTransfer.files[0];
                    this.handleFile(file);
                },
                handleFileSelect(e) {
                    const file = e.target.files[0];
                    this.handleFile(file);
                },
                handleFile(file) {
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imageUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
                removeImage() {
                    this.imageUrl = null;
                    document.getElementById('image_url').value = '';
                }
            }
        }
    </script>
</x-app-layout> 