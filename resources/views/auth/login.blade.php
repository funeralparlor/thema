@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div>
    <div class="relative w-full max-w-md px-4">
        <!-- Glassmorphism Card -->
        <div class="bg-white/30 backdrop-blur-lg rounded-2xl shadow-xl p-8 border border-white/20">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
            <img 
        src="{{ asset('images/bulsu.png') }}"
        alt="BulSU Logo" 
        class="h-30 w-30"
    />
            </div>

            <!-- Form -->
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

<!--DUMMY-->



                <!-- Email Field -->
                <div class="group relative">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required
                        
                        class="block w-full px-4 pt-5 pb-1 rounded-lg bg-white/50 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                    />
                    <label 
                        for="email" 
                        class="absolute left-4 top-2 text-sm text-gray-500 transition-all transform origin-[0]"
                    >
                        Email address
                    </label>
                </div>

                <!-- Password Field -->
                <div class="group relative">
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required
                        class="block w-full px-4 pt-5 pb-1 rounded-lg bg-white/50 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                    />
                    <label 
                        for="password" 
                        class="absolute left-4 top-2 text-sm text-gray-500 transition-all transform origin-[0]"
                    >
                        Password
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg 
                           shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5
                           flex items-center justify-center space-x-2"
                >
                    <span>Continue</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mt-6 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Invalid credentials
                </div>
            @endif
        </div>
    </div>
</div>
@endsection