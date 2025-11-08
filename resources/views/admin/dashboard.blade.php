@extends('layouts.admin')
@section('content')
<div class="container">
    <h1 style="font-weigt:bold; font-size:30px;">Bienvenue Administrateur {{ Auth::user()->name }}</h1>

</div>
@endsection