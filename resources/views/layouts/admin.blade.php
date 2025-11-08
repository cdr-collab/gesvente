<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center text-xl font-bold text-blue-600">
                            {{ config('app.name', 'Laravel') }}
                        </div>

                        <!-- Menu principal -->
                        <div class="hidden sm:-my-px sm:ml-10 sm:flex space-x-6">

                            <!-- Utilisateurs -->
                            <div class="relative group">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Utilisateurs ⬇
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md hidden group-hover:block">
                                    <a href="{{ route('admin.register') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">➕ Ajouter un utilisateur</a>
                                </div>
                            </div>

                            <!-- Catégories -->
                            <div class="relative group">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Catégories ⬇
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md hidden group-hover:block">
                                    <a href="{{ route('categories.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">➕ Ajouter une catégorie</a>
                                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">📋 Liste des catégories</a>
                                </div>
                            </div>

                            <!-- Produits -->
                            <div class="relative group">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Produits ⬇
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md hidden group-hover:block">
                                    <a href="{{ route('produits.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">➕ Ajouter un produit</a>
                                    <a href="{{ route('produits.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">📋 Liste des produits</a>
                                </div>
                            </div>

                            <!-- Fournisseurs -->
                            <div class="relative group">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Fournisseurs ⬇
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md hidden group-hover:block">
                                    <a href="{{ route('fournisseurs.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">➕ Ajouter un fournisseur</a>
                                    <a href="{{ route('fournisseurs.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">📋 Liste des fournisseurs</a>
                                </div>
                            </div>

                            <!-- Achats -->
                            <div class="relative group">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Entrées ⬇
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white shadow-lg rounded-md hidden group-hover:block">
                                    <a href="{{ route('achats.create') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">➕ Enregistrer des entrées</a>
                                    <a href="{{ route('achats.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">📋 Liste des entrées</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
