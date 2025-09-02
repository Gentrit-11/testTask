<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mini Issue Tracker</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root{--bg:#f6f7fb;--card:#fff;--muted:#6b7280;--line:#e5e7eb;--pri:#2563eb;--red:#b91c1c;--green:#15803d}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);font-family:ui-sans-serif,system-ui,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial}
        a{color:var(--pri);text-decoration:none}
        .container{max-width:920px;margin:32px auto;padding:0 16px}
        .nav{display:flex;gap:12px;align-items:center;justify-content:flex-start;margin-bottom:16px}
        .nav a{padding:8px 10px;border-radius:8px}
        .nav a.active{background:#eaf1ff}
        .card{background:var(--card);border:1px solid var(--line);border-radius:12px;padding:14px;margin:10px 0}
        .row{display:flex;gap:8px;align-items:center}
        .muted{color:var(--muted)}
        .btn{border:1px solid var(--line);background:#fff;border-radius:10px;padding:8px 12px;cursor:pointer}
        .btn.primary{background:var(--pri);color:#fff;border-color:var(--pri)}
        input,select,textarea{border:1px solid var(--line);border-radius:10px;padding:8px 10px;min-width:120px}
        textarea{min-height:110px;width:100%}
        .field{display:flex;flex-direction:column;gap:6px}
        .error{color:var(--red);font-size:13px;margin-top:2px}
        .alert{padding:10px 12px;border-radius:10px;margin:10px 0}
        .alert.success{background:#ecfdf5;border:1px solid #a7f3d0;color:var(--green)}
        .alert.error{background:#fef2f2;border:1px solid #fecaca;color:var(--red)}

        nav[role="navigation"] ul,
        nav[role="navigation"] li{list-style:none;margin:0;padding:0}

        .pager{display:flex;gap:6px;flex-wrap:wrap;margin-top:10px}
        .pager .page-link{
            border:1px solid var(--line);border-radius:8px;padding:6px 10px;
            background:#fff;text-decoration:none;color:inherit;display:block
        }
        .pager .page-link.active{background:#eef2ff;border-color:#c7d2fe}
        .pager .page-link.disabled{opacity:.5;pointer-events:none}

        nav[role="navigation"] > .small{display:none}
    </style>

</head>
<body>
<div class="container">
    <div class="nav">
        <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a>
        <a href="{{ route('issues.index') }}"   class="{{ request()->routeIs('issues.*')   ? 'active' : '' }}">Issues</a>
        <a href="{{ route('tags.index') }}"     class="{{ request()->routeIs('tags.*')     ? 'active' : '' }}">Tags</a>
    </div>

    @if(session('success')) <div class="alert success">{{ session('success') }}</div>@endif
    @if(session('error'))   <div class="alert error">{{ session('error') }}</div>@endif

    @yield('content')
</div>
@stack('scripts')
</body>
</html>
