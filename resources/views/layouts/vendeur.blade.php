<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optionnel : vos styles personnalisés -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- Menu de navigation --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('vendeur.dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVendeur" aria-controls="navbarVendeur" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarVendeur">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendeur.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendeur.ventes.index') }}">Ventes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendeur.clients.index') }}">Clients</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendeur.produits.index') }}">Produits</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendeur.profile.edit') }}">Mon Profil</a>
                    </li>

                    <li class="nav-item">
                     <a class="nav-link" href="{{ route('vendeur.ventes.parDate') }}">
                         Produits vendus par date
                    </a>
                    </li>

                   
                </ul>

                {{-- Bouton de déconnexion --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Contenu principal --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
