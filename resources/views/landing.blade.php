@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BulSU Scholarship Office</a>
            <div class="navbar-nav ms-auto">
                @auth

                    <form action=" {{ route('logout') }}" method="POST">

                                    @csrf
                                        <button type="submit" class="nav-link btn btn-link">Log out</button>"

                    </form>
                @else
                    <!---Log in--->
                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    @endauth
            </div>
        </div>
    </nav>

    <!-- Landing Page Content -->
    <div class="landing-page">
        <!-- Title -->
        <h1 class="main-title">Bulacan State University</h1>
        
        <!-- Subtitle/Text -->
        <p class="subtitle">Bulacan State University Student Profiling System</p>

        <!-- Options in a long circle 
        <div class="oval-container">
            <a href="{{ route('list') }}">List</a>
            <a href="{{ route('search') }}">Search</a>
            <a href="{{ route('reports') }}">Settings</a>
        </div>
        -->
    </div>

    @if(Auth::check())
    <div class="alert alert-info">
        Logged in as {{ Auth::user()->name }} but still seeing this page!
    </div>
@endif
@endsection