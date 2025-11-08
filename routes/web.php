<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\AchatController;


// Accès restreint : seul l’administrateur peut accéder à register
Route::middleware(['auth', 'role:administrateur'])->group(function () {
    Route::get('/admin/register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [RegisteredUserController::class, 'store'])->name('admin.register.store');
});

// Page login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Dashboard général (non utilisé si rôles spécifiques)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard administrateur
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:administrateur'])->name('admin.dashboard');
// CRUD catégories, produits, fournisseurs accessible uniquement aux administrateurs
Route::middleware(['auth', 'role:administrateur'])->group(function () {
    Route::resource('categories', CategorieController::class)->parameters([
    'categories' => 'categorie'
]);
    Route::resource('produits', \App\Http\Controllers\ProduitController::class);
    Route::resource('fournisseurs', \App\Http\Controllers\FournisseurController::class);
    //Route::resource('achats', \App\Http\Controllers\AchatController::class);
    Route::resource('achats', AchatController::class)->parameters([
    'achats' => 'achat']);
});


// Dashboard vendeur
Route::get('/vendeur/dashboard', function () {
    return view('vendeur.dashboard');
})->middleware(['auth', 'role:vendeur'])->name('vendeur.dashboard');


// Profile (auth obligatoire)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Vendeur : modifier uniquement ses infos
Route::middleware(['auth', 'role:vendeur'])->group(function () {
    Route::get('/vendeur/profile', [ProfileController::class, 'editVendeur'])->name('vendeur.profile.edit');
    Route::put('/vendeur/profile', [ProfileController::class, 'updateVendeur'])->name('vendeur.profile.update');
    Route::resource('vendeur/clients', ClientController::class)->names('vendeur.clients');
    Route::resource('vendeur/ventes', VenteController::class)->names('vendeur.ventes');
    Route::get('/vendeur/produits', [\App\Http\Controllers\ProduitController::class, 'indexVendeur'])
         ->name('vendeur.produits.index');
    //vente.pdf
Route::get('/ventes/{id}/pdf', [VenteController::class, 'exportPdf'])->name('ventes.pdf');

Route::get('vendeur/ventes-par-date', [App\Http\Controllers\VenteController::class, 'ventesParDate'])
    ->name('vendeur.ventes.parDate');

    Route::get('vendeur/ventes-par-date/pdf', [App\Http\Controllers\VenteController::class, 'ventesParDatePdf'])
    ->name('vendeur.ventes.parDate.pdf');




});

require __DIR__.'/auth.php';
