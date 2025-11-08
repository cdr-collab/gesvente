@extends('layouts.vendeur')
@section('content')
<div class="container">
<h1>Bienvenue Vendeur {{ Auth::user()->name }}</h1>
                <div class="p-6 text-gray-900">
                    {{ __("Tu es connecté!") }}
                    
                </div>
</div>
@endsection