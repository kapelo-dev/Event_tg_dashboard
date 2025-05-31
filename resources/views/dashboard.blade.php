<x-app-layout>
    <div class="p-6">
        <!-- Header with Date and Actions -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Vue d'ensemble</h1>
                <p class="text-gray-600">{{ now()->format('l, d F Y') }}</p>
            </div>
            <!-- <div class="flex gap-4">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Exporter CSV
                </button>
                <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Ajouter un événement
                </a>
            </div> -->
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Events Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xl font-bold">{{ $totalEvents }}</p>
                        <h3 class="text-gray-500 text-sm">Total Événements</h3>
                    </div>
                    <span class="px-2 py-1 text-sm rounded-full {{ $eventsTrend > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $eventsTrend }}%
                    </span>
                </div>
                <div class="mt-4">
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: {{ min($eventsTrend, 100) }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Total Orders/Tickets Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xl font-bold">{{ $totalTickets }}</p>
                        <h3 class="text-gray-500 text-sm">Billets Vendus</h3>
                    </div>
                    <span class="px-2 py-1 text-sm rounded-full {{ $ticketsTrend > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $ticketsTrend }}%
                    </span>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between space-x-2">
                        @foreach($ticketsChart as $bar)
                        <div class="flex-1">
                            <div class="h-8 bg-blue-100 rounded-md relative">
                                <div class="absolute bottom-0 w-full bg-blue-500 rounded-md" style="height: {{ $maxTickets > 0 ? ($bar / $maxTickets) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xl font-bold">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</p>
                        <h3 class="text-gray-500 text-sm">Revenus Totaux</h3>
                    </div>
                    <span class="px-2 py-1 text-sm rounded-full {{ $revenueTrend > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $revenueTrend }}%
                    </span>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between space-x-2">
                        @foreach($revenueChart as $bar)
                        <div class="flex-1">
                            <div class="h-8 bg-cyan-100 rounded-md relative">
                                <div class="absolute bottom-0 w-full bg-cyan-500 rounded-md" style="height: {{ $maxRevenue > 0 ? ($bar / $maxRevenue) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Conversion Rate Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xl font-bold">{{ $conversionRate }}%</p>
                        <h3 class="text-gray-500 text-sm">Taux de Conversion</h3>
                    </div>
                    <span class="px-2 py-1 text-sm rounded-full {{ $conversionTrend > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $conversionTrend }}%
                    </span>
                </div>
                <div class="mt-4 relative h-16">
                    <!-- Conversion Rate Graph -->
                    <svg class="w-full h-full" viewBox="0 0 100 30">
                        <path d="M0,15 Q25,5 50,20 T100,15" fill="none" stroke="#3B82F6" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Events Table Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Événements à venir</h2>
                <div class="flex items-center gap-4">
                    <select class="rounded-lg border-gray-300 text-sm" id="category-filter">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-500">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Cover</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Lieu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tickets</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Revenus</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($upcomingEvents as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex-shrink-0 h-20 w-20">
                                        @if($event->image_url)
                                            <img class="h-20 w-20 object-cover rounded" src="{{ str_contains($event->image_url, 'cloudinary.com') ? $event->image_url : Storage::url($event->image_url) }}" alt="{{ $event->title }}">
                                        @else
                                            <div class="h-20 w-20 bg-gray-200 rounded flex items-center justify-center">
                                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @php
                                            $startDate = \Carbon\Carbon::parse($event->start_date);
                                            $endDate = \Carbon\Carbon::parse($event->end_date);
                                        @endphp
                                        @if(!$startDate->isSameDay($endDate))
                                            <div>Du {{ $startDate->format('d/m/Y') }}</div>
                                            <div>Au {{ $endDate->format('d/m/Y') }}</div>
                                            @if($event->has_specific_time && $event->start_time && $event->end_time)
                                                <div class="text-xs text-gray-500 mt-1">{{ $event->start_time }} - {{ $event->end_time }}</div>
                                            @endif
                                        @else
                                            <div>{{ $startDate->format('d/m/Y') }}</div>
                                            @if($event->has_specific_time && $event->start_time && $event->end_time)
                                                <div class="text-xs text-gray-500 mt-1">{{ $event->start_time }} - {{ $event->end_time }}</div>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $event->location }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $event->category->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $event->status_color }}-100 text-{{ $event->status_color }}-800">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <div class="flex flex-col space-y-1">
                                            <div class="font-medium">Types de billets :</div>
                                            @foreach($event->ticketTypes as $type)
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="capitalize">{{ $type->name }}</span>
                                                    <div class="flex items-center">
                                                        <span class="mr-2">{{ number_format($type->price, 0, ',', ' ') }} FCFA</span>
                                                        @php
                                                            $ticketsSold = $type->tickets()->where('status', '!=', 'cancelled')->count();
                                                            $available = $type->quantity - $ticketsSold;
                                                        @endphp
                                                        <span class="text-gray-500">{{ $ticketsSold }}/{{ $type->quantity }} ({{ $available }} disponibles)</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($event->total_revenue, 0, ',', ' ') }} FCFA
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    Aucun événement à venir trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sales by Region -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Ventes par Région</h2>
                <button class="text-blue-600 text-sm hover:text-blue-800">Voir le rapport complet</button>
            </div>

            <div class="space-y-4">
                @foreach($salesByRegion as $region)
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">{{ $region['name'] }}</span>
                        <span class="text-sm font-medium">{{ $region['percentage'] }}%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: {{ $region['percentage'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
