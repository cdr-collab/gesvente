<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier mes informations') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('vendeur.profile.update') }}">
            @csrf

            <!-- Nom -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full"
                              type="text" name="name" value="{{ Auth::user()->name }}" required />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                              type="email" name="email" value="{{ Auth::user()->email }}" required />
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Nouveau mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password" name="password" autocomplete="new-password" />
            </div>

            <!-- Confirmation -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password" name="password_confirmation" autocomplete="new-password" />
            </div>

            <div class="mt-6">
                <x-primary-button>Mettre à jour</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
