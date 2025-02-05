@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center px-4">
    <!-- Main Title -->
    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg">
        Bulacan State University
    </h1>

    <!-- Subtitle -->
    <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-2xl mx-auto drop-shadow-md">
        Student Scholarship Profiling System
    </p>

    <!-- Action Buttons -->
    <div class="flex flex-col md:flex-row items-center justify-center gap-6">
        <a href="{{ route('login') }}" 
           class="bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-all 
                  text-white px-8 py-4 rounded-full font-medium
                  border-2 border-white/30 hover:border-white/50">
            Get Started
        </a>
        
        <a href="#features" 
           class="text-white hover:text-blue-200 transition-colors
                  font-medium underline underline-offset-4">
            Learn More
        </a>
    </div>
</div>
@endsection