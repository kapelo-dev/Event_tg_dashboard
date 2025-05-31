<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Agents') }}
            </h2>
            <button type="button" 
                x-data=""
                x-on:click="$dispatch('open-modal', 'create-agent')" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Ajouter un agent') }}
            </button>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Téléphone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($agents as $agent)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $agent->first_name }} {{ $agent->last_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $agent->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $agent->phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $agent->status === 'ACTIVE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $agent->status === 'ACTIVE' ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button type="button" 
                                                        x-data="" 
                                                        x-on:click="$dispatch('open-modal', 'edit-agent-{{ $agent->id }}')" 
                                                        class="relative group">
                                                    <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center transition-all duration-200 group-hover:bg-indigo-100">
                                                        <svg class="w-4 h-4 text-indigo-500 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <button type="button" 
                                                        x-data="" 
                                                        x-on:click="$dispatch('open-modal', 'delete-agent-{{ $agent->id }}')" 
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
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Aucun agent trouvé
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($agents->hasPages())
                        <div class="mt-4">
                            {{ $agents->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de création d'agent -->
    <x-modal name="create-agent" :show="$errors->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('agents.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Ajouter un agent') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-6">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="mt-6">
                <x-input-label for="phone" :value="__('Téléphone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div class="mt-6">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>

            <div class="mt-6">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Ajouter') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    @foreach($agents as $agent)
        <!-- Modal de modification -->
        <x-modal name="edit-agent-{{ $agent->id }}" focusable>
            <form method="POST" action="{{ route('agents.update', $agent) }}" class="p-6">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Modifier l\'agent') }}
                </h2>

                <div class="mt-6">
                    <x-input-label for="name-{{ $agent->id }}" :value="__('Nom')" />
                    <x-text-input id="name-{{ $agent->id }}" name="name" type="text" class="mt-1 block w-full" :value="old('name', $agent->first_name . ' ' . $agent->last_name)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-6">
                    <x-input-label for="email-{{ $agent->id }}" :value="__('Email')" />
                    <x-text-input id="email-{{ $agent->id }}" name="email" type="email" class="mt-1 block w-full" :value="old('email', $agent->email)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div class="mt-6">
                    <x-input-label for="phone-{{ $agent->id }}" :value="__('Téléphone')" />
                    <x-text-input id="phone-{{ $agent->id }}" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $agent->phone)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <div class="mt-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ $agent->status === 'ACTIVE' ? 'checked' : '' }}>
                        <span class="ms-2 text-sm text-gray-600">{{ __('Actif') }}</span>
                    </label>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Annuler') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Mettre à jour') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Modal de suppression -->
        <x-modal name="delete-agent-{{ $agent->id }}" focusable>
            <form method="POST" action="{{ route('agents.destroy', $agent) }}" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Êtes-vous sûr de vouloir supprimer cet agent ?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Cette action est irréversible.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Annuler') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Supprimer l\'agent') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout> 