<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'hsl(215 27.9% 16.9%)',
                        'primary-foreground': 'hsl(0 0% 100%)',
                        'muted': 'hsl(210 40% 96.1%)',
                        'muted-foreground': 'hsl(210 4.6% 76.5%)',
                        'foreground': 'hsl(222.2 47.4% 11.2%)',
                        'background': 'hsl(0 0% 100%)',
                        'destructive': 'hsl(0 84.2% 60.2%)',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Merriweather', 'serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .card {
            background-color: white;
            border: 1px solid hsl(214.3 31.8% 91.4%);
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .bg-muted\/30 {
            background-color: rgba(243, 244, 246, 0.3);
        }

        .label {
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1.5rem;
        }
    </style>
</head>

<body class="font-sans">
    <div id="admin-destinations" class="min-h-screen bg-muted/30">
        <header class="sticky top-0 z-50 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
            <div class="container mx-auto flex h-16 items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.index') }}" class="flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('destinations.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-10 px-4 py-2 hover:bg-primary/90">Add Destination</a>
                </div>
            </div>
        </header>

        <main class="container mx-auto px-4 py-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="font-serif text-3xl font-bold text-foreground">Destinations</h1>
                    <p class="mt-1 text-muted-foreground">Manage all destinations</p>
                </div>
                <a href="{{ route('destinations.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">New Destination</a>
            </div>

            @if($destinations->count() === 0)
                <div class="card p-6 text-center text-muted-foreground">No destinations yet. Create your first one.</div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($destinations as $d)
                        <div class="card overflow-hidden">
                            <div class="aspect-video bg-gray-100">
                                @if(!empty($d->path))
                                    <img src="{{ asset('storage/'.$d->path) }}" alt="{{ $d->destination_name }}" class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-sm text-muted-foreground">No Image</div>
                                @endif
                            </div>
                            <div class="p-4 space-y-1">
                                <div class="text-xs text-muted-foreground">{{ $d->region }}</div>
                                <div class="font-semibold">{{ $d->destination_name }}</div>
                                @if($d->tagline)
                                    <div class="text-sm text-muted-foreground">{{ $d->tagline }}</div>
                                @endif
                                <div class="mt-2 flex flex-wrap gap-2 text-xs">
                                    @if($d->elevation)
                                        <span class="px-2 py-1 rounded bg-gray-100">🏔 {{ $d->elevation }}</span>
                                    @endif
                                    @if($d->best_season)
                                        <span class="px-2 py-1 rounded bg-gray-100">📅 {{ $d->best_season }}</span>
                                    @endif
                                    @if($d->treks_available)
                                        <span class="px-2 py-1 rounded bg-gray-100">🥾 {{ $d->treks_available }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                
            @endif
        </main>
    </div>
</body>

</html>
