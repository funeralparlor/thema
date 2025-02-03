<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bulacan State University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    /* Navbar styling */
    .navbar {
        padding: 1rem 0;
       
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
    }

    /* Landing page content */
    .landing-page {
        height: calc(100% - 56px); /* Account for navbar height */
        background-image: url('/images/test.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 2rem;
    }

    .main-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        margin: 1rem 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .subtitle {
        font-size: 1.2rem;
        text-align: center;
        margin-bottom: 3rem;
        max-width: 600px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Oval container */
    .oval-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 1.5rem 3rem;
        backdrop-filter: blur(5px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        display: flex;
        gap: 2rem;
    }

    .oval-container a {
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .oval-container a:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #004080;
        transform: translateY(-2px);
    }
</style>
</head>
<body>
    @yield('content')
</body>
</html>