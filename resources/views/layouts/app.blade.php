<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    
    <title>@yield('title') - Bulacan State University</title>

    <style>
        .hero-bg {
            background-image: url('/images/test.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        
        .backdrop-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-sm shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center space-x-3">
    <!-- Logo -->
    <img 
        src="{{ asset('images/bulsu.png') }}"
        alt="BulSU Logo" 
        class="h-10 w-10"
    />
    <span class="text-2xl font-bold text-black-800">
        <a href="/" class="text-black-600 hover:text-blue-700 transition-colors font-medium">
            BulSU | Scholarship Office
        </a>
    </span>
</div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-blue-700 transition-colors font-medium">
                            Log Out
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-700 transition-colors font-medium">
                        Log In
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="hero-bg min-h-screen flex items-center justify-center">
        <div class="backdrop-overlay w-full min-h-screen flex items-center justify-center">
            @yield('content')
        </div>
    </main>
</body>
</html>