@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        <p>Name: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
    </div>
@endsection
