<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #0f2547 0%, #1a3c6e 60%, #2557a7 100%); min-height: 100vh; }
        .auth-card { border-radius: 1rem; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        .auth-brand { background: linear-gradient(135deg, #0f2547, #1a3c6e); color: #fff; border-radius: 1rem 1rem 0 0; padding: 2rem; text-align: center; }
        .auth-brand h4 { font-weight: 700; color: #e8b84b; margin: 0; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">
    <div style="width:100%;max-width:420px;" class="px-3">
        <div class="card auth-card border-0">
            <div class="auth-brand">
                <i class="bi bi-mortarboard-fill" style="font-size:2.5rem;"></i>
                <h4 class="mt-2">CV Universitario</h4>
                <p class="mb-0 opacity-75" style="font-size:.85rem;">{{ config('app.name') }}</p>
            </div>
            <div class="card-body p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
