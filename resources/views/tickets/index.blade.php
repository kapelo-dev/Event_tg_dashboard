<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center space-x-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                <span>{{ __('Gestion des Tickets') }}</span>
            </h2>
            <div class="flex items-center space-x-4">
                <div class="bg-white rounded-xl shadow-sm p-3 flex items-center space-x-3">
                    <div class="text-sm">
                        <p class="text-gray-500">Total des tickets</p>
                        <p class="text-lg font-semibold text-indigo-600">{{ $tickets->flatten()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded-r-xl animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4 rounded-r-xl animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @forelse($tickets as $eventTitle => $eventTickets)
                <div class="bg-white overflow-hidden shadow-lg rounded-xl mb-4 transition-all duration-300 hover:shadow-xl">
                    <div class="relative">
                        <div class="p-4 relative">
                            <button type="button" 
                                    class="event-dropdown-trigger w-full flex justify-between items-start text-left hover:bg-gray-50/80 rounded-xl p-3 transition-all duration-300"
                                    onclick="toggleDropdown(this)"
                                    aria-expanded="false">
                                <div class="flex-grow">
                                    <div class="flex items-center space-x-3">
                                        @if($eventStats[$eventTitle]['image_url'])
                                            <div class="h-10 w-10 rounded-full overflow-hidden flex-shrink-0 border border-gray-100">
                                                <img src="{{ str_contains($eventStats[$eventTitle]['image_url'], 'cloudinary.com') ? $eventStats[$eventTitle]['image_url'] : asset('storage/' . $eventStats[$eventTitle]['image_url']) }}" 
                                                     alt="Couverture de {{ $eventTitle }}"
                                                     class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-grow">
                                            <h3 class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                                {{ $eventTitle }}
                                            </h3>
                                            @php
                                                $totalSold = collect($eventStats[$eventTitle]['types'])->sum('sold');
                                                $totalQuantity = collect($eventStats[$eventTitle]['types'])->sum('quantity');
                                                $totalPercentage = $totalQuantity > 0 ? ($totalSold / $totalQuantity) * 100 : 0;
                                            @endphp
                                            <div class="mt-1 flex items-center space-x-2">
                                                <div class="flex-1">
                                                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                                                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-1.5 rounded-full" 
                                                             style="width: {{ $totalPercentage }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-xs font-medium text-gray-500">
                                                    {{ $totalSold }}/{{ $totalQuantity }} vendus
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                                        @php
                                            $colors = [
                                                ['bg-emerald-500', 'bg-emerald-50'],
                                                ['bg-blue-500', 'bg-blue-50'],
                                                ['bg-amber-500', 'bg-amber-50'],
                                                ['bg-rose-500', 'bg-rose-50'],
                                                ['bg-violet-500', 'bg-violet-50'],
                                                ['bg-cyan-500', 'bg-cyan-50'],
                                                ['bg-fuchsia-500', 'bg-fuchsia-50'],
                                                ['bg-lime-500', 'bg-lime-50'],
                                                ['bg-sky-500', 'bg-sky-50'],
                                                ['bg-orange-500', 'bg-orange-50'],
                                                ['bg-pink-500', 'bg-pink-50'],
                                                ['bg-teal-500', 'bg-teal-50']
                                            ];
                                            shuffle($colors);
                                        @endphp
                                        @foreach($eventStats[$eventTitle]['types'] as $index => $typeStats)
                                            <div class="{{ $colors[$index % count($colors)][1] }} rounded-lg border-0 flex items-center p-2 space-x-2 transition-all duration-200 hover:shadow-sm">
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex justify-between items-center mb-1">
                                                        <p class="text-xs font-medium text-gray-700 truncate">{{ $typeStats['name'] }}</p>
                                                        <span class="text-xs font-medium {{ str_replace('bg-', 'text-', $colors[$index % count($colors)][0]) }}">
                                                            {{ $typeStats['sold'] }}/{{ $typeStats['quantity'] }}
                                                        </span>
                                                    </div>
                                                    <div class="w-full bg-white/50 rounded-full h-1">
                                                        <div class="{{ $colors[$index % count($colors)][0] }} h-1 rounded-full" 
                                                             style="width: {{ ($typeStats['sold'] / $typeStats['quantity']) * 100 }}%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="transform transition-transform duration-300 ml-4">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </button>

                            <div class="event-content hidden mt-6">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                        <thead class="bg-blue-500">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Code</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Type</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Prix</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Utilisateur</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Paiement</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Référence</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Créé le</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Validé le</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Agent</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($eventTickets as $ticket)
                                                @if($loop->first && $eventTickets->isEmpty())
                                                    <tr>
                                                        <td colspan="11" class="px-4 py-8 text-center">
                                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                                <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                                </svg>
                                                                <p class="text-lg font-medium">Aucun ticket vendu</p>
                                                                <p class="text-sm text-gray-400">Les tickets vendus apparaîtront ici</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="h-8 w-8 flex-shrink-0 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                                                    </svg>
                                                                </div>
                                                                <span class="text-sm font-medium text-gray-900">{{ $ticket->code }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                                {{ $ticket->ticketType->name ?? 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="text-sm font-semibold text-gray-900">
                                                                {{ number_format($ticket->ticketType->price ?? 0, 0, ',', ' ') }} FCFA
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                                    <span class="text-sm font-medium text-gray-600">
                                                                        {{ substr($ticket->user->first_name ?? 'N', 0, 1) }}
                                                                    </span>
                                                                </div>
                                                                <div class="ml-3">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $ticket->user ? $ticket->user->first_name . ' ' . $ticket->user->last_name : 'N/A' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            @if($ticket->status === 'valid')
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    <svg class="w-4 h-4 mr-1.5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                    </svg>
                                                                    Valide
                                                                </span>
                                                            @elseif($ticket->status === 'cancelled')
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                    <svg class="w-4 h-4 mr-1.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                    Annulé
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                    <svg class="w-4 h-4 mr-1.5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                    </svg>
                                                                    En attente
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $ticket->transaction->provider ?? 'N/A' }}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="text-sm text-gray-500 truncate max-w-[200px]" title="{{ $ticket->transaction->transactionReference ?? 'N/A' }}">
                                                                {{ $ticket->transaction->transactionReference ?? 'N/A' }}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="text-sm text-gray-500">
                                                                {{ $ticket->createdAt ? $ticket->createdAt->format('d/m/Y H:i') : '-' }}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <div class="text-sm text-gray-500">
                                                                {{ $ticket->validationDate ? $ticket->validationDate->format('d/m/Y H:i') : '-' }}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            @if($ticket->validator)
                                                                <div class="flex items-center">
                                                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                                        <span class="text-sm font-medium text-blue-600">
                                                                            {{ substr($ticket->validator->first_name, 0, 1) }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="ml-3">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $ticket->validator->first_name }} {{ $ticket->validator->last_name }}
                                                                        </div>
                                                                        <div class="text-xs text-blue-600">Agent</div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                            <div class="flex items-center space-x-3">
                                                                <a href="{{ route('tickets.show', $ticket) }}" 
                                                                   class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                    </svg>
                                                                    Voir
                                                                </a>
                                                                @if($ticket->status !== 'cancelled')
                                                                    <form action="{{ route('tickets.cancel', $ticket) }}" method="POST" class="inline">
                                                                        @csrf
                                                                        <button type="submit" 
                                                                                class="text-red-600 hover:text-red-900 flex items-center"
                                                                                onclick="return confirm('Êtes-vous sûr de vouloir annuler ce ticket ?')">
                                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                            </svg>
                                                                            Annuler
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun ticket</h3>
                        <p class="mt-1 text-sm text-gray-500">Commencez par créer un événement pour vendre des tickets.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @push('styles')
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        tr {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        tr:nth-child(1) { animation-delay: 0.1s; }
        tr:nth-child(2) { animation-delay: 0.15s; }
        tr:nth-child(3) { animation-delay: 0.2s; }
        tr:nth-child(4) { animation-delay: 0.25s; }
        tr:nth-child(5) { animation-delay: 0.3s; }

        .event-dropdown-trigger:hover svg {
            transform: translateY(2px);
        }

        .event-content {
            transition: all 0.3s ease-in-out;
        }
    </style>
    @endpush

    <script>
        function toggleDropdown(button) {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', !isExpanded);
            
            const content = button.nextElementSibling;
            content.classList.toggle('hidden');
            
            const arrow = button.querySelector('svg');
            arrow.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        document.querySelectorAll('.event-dropdown-trigger').forEach(button => {
            button.addEventListener('mouseover', () => {
                button.classList.add('bg-gray-50');
            });
            button.addEventListener('mouseout', () => {
                button.classList.remove('bg-gray-50');
            });
        });
    </script>
</x-app-layout> 