@extends('layout.index')
@section('content')
    <div class="container">
        @include('layout.nav')
        @if(\Illuminate\Support\Facades\Auth::check())
            <p>Name:{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
            <p>Email:{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
            <img src="{{\Illuminate\Support\Facades\Auth::user()->img}}" alt="">
        @endif
    </div>
@endsection


