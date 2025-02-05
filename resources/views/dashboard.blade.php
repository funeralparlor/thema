@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>Bulacan State University Student Profiling.</p>
@endsection