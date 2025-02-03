<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BulSU Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        .sidebar-menu li {
            margin: 10px 0;
        }
        .sidebar-menu a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar-menu a:hover {
            background: #34495e;
        }
        .sidebar-menu .active {
            background: #3498db;
        }

        .pagination {
            margin: 20px 0;
        }
        .page-item.active .page-link {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }
        .page-link {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="mb-4">BulSU Dashboard</h3>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}"
                        class="{{ request()->routeIs('students.index') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i>Students List</a>
                </li>
                <li>
                    <a href="{{ route('students.create') }}" class="{{ request()->routeIs('students.create') ? 'active' :'' }}">
                            <i class="fas fa-user-plus me-2"></i> Add Students
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fas fa-user me-2"></i> Profile
                    </a>
                </li>
                <li>
                <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit">Logout</button>
</form>
    
                </li>
    
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>