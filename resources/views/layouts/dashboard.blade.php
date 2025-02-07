<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title') - BulSU Dashboard</title>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body class="bg-gray-50">





    <!-- Navbar -->
    <nav class="fixed w-full bg-black backdrop-blur-sm shadow-sm z-50">
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
    <span class="text-2xl font-bold text-white">
        <a href="/" class="text-black-600 hover:text-red-700 transition-colors font-medium">
            BulSU | Scholarship Office
        </a>
    </span>
</div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-blue-700 transition-colors font-medium">
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

    <div class="min-h-screen pt-16"> <!-- Added pt-16 to account for navbar height -->
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg border-r border-gray-200 z-30 mt-16"> <!-- Added mt-16 -->
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="px-6 py-8">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 space-y-1">
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <i class="fas fa-home w-5 h-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>

                    <a href="{{ route('students.index') }}"
                       class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 {{ request()->routeIs('students.index') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <i class="fas fa-users w-5 h-5"></i>
                        <span class="ml-3">Students List</span>
                    </a>

                    <a href="{{ route('students.create') }}"
                       class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 {{ request()->routeIs('students.create') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <i class="fas fa-user-plus w-5 h-5"></i>
                        <span class="ml-3">Add Students</span>
                    </a>

                    <a href="{{ route('profile') }}"
                       class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 {{ request()->routeIs('profile') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <i class="fas fa-user w-5 h-5"></i>
                        <span class="ml-3">Profile</span>
                    </a>
                </nav>

                <!-- Removed duplicate logout button since it's now in the navbar -->
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 min-h-screen">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Pagination Styles -->
    <style>
        .pagination {
            @apply flex justify-center space-x-1;
        }
        .page-item {
            @apply inline-flex;
        }
        .page-item.active .page-link {
            @apply bg-blue-600 text-white border-blue-600;
        }
        .page-link {
            @apply px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200;
        }
        .page-item.disabled .page-link {
            @apply opacity-50 cursor-not-allowed;
        }
    </style>
    <!-- AdminLTE JS -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>