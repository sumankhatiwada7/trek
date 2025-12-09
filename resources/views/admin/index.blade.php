<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'hsl(215 27.9% 16.9%)', /* Approximate dark blue for primary */
                        'primary-foreground': 'hsl(0 0% 100%)',
                        'muted': 'hsl(210 40% 96.1%)',
                        'muted-foreground': 'hsl(210 4.6% 76.5%)',
                        'foreground': 'hsl(222.2 47.4% 11.2%)',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Merriweather', 'serif'], // Used for titles in the original
                    },
                }
            }
        }
    </script>
    <link href="https://unpkg.com/lucide@latest/css/lucide.css" rel="stylesheet">
    <style>
        /* Custom styles to mimic 'shadcn/ui' utility classes not in default Tailwind */
        .card {
            background-color: white;
            border: 1px solid hsl(214.3 31.8% 91.4%);
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .bg-muted\/30 { background-color: rgba(243, 244, 246, 0.3); }
    </style>
</head>
<body class="font-sans">
    <div id="admin-dashboard" class="min-h-screen bg-muted/30">
        <header class="sticky top-0 z-50 border-b bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
            <div class="container mx-auto flex h-16 items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                    </div>
                    <span class="font-serif text-xl font-bold text-foreground">Trek Admin</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-muted/60 h-9 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        View Site
                    </a>
                    <a href="{{ route('admin.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-9 px-3 hover:bg-primary/90">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Add Trek
                    </a>
                </div>
            </div>
        </header>

        <main class="container mx-auto px-4 py-8">
            <div class="mb-8">
                <h1 class="font-serif text-3xl font-bold text-foreground">Dashboard</h1>
                <p class="mt-1 text-muted-foreground">Manage your treks and bookings</p>
            </div>

            <div id="stats-grid" class="mb-8 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                </div>

            <div class="card">
                <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="font-serif text-xl font-bold">All Treks</h2>
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            <input
                                id="search-input"
                                type="text"
                                placeholder="Search treks..."
                                class="w-full pl-9 sm:w-64 flex h-10 rounded-md border border-input bg-white px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            />
                        </div>
                        <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors border border-input bg-white shadow-sm hover:bg-accent hover:text-accent-foreground h-10 w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        </button>
                    </div>
                </div>
                
                <div class="p-6 pt-0">
                    <div class="overflow-x-auto rounded-md border">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b bg-muted/50">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[20%]">Trek Name</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Location</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Duration</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Difficulty</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Price</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Status</th>
                                    <th class="h-12 px-4 text-right align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">Bookings</th>
                                    <th class="h-12 px-4 align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-12"></th>
                                </tr>
                            </thead>
                            <tbody id="treks-table-body" class="[&_tr:last-child]:border-0">
                                @forelse($treks as $trek)
                                <tr class="border-b transition-colors hover:bg-muted/50">
                                    <td class="p-4 align-middle font-medium text-foreground">{{ $trek->trekname }}</td>
                                    <td class="p-4 align-middle">{{ $trek->region }}</td>
                                    <td class="p-4 align-middle">{{ $trek->duration }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $trek->difficultylevel === 'Easy' ? 'bg-green-100 text-green-800' : ($trek->difficultylevel === 'Moderate' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $trek->difficultylevel }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-muted-foreground">-</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">Active</span>
                                    </td>
                                    <td class="p-4 align-middle text-right text-muted-foreground">0</td>
                                    <td class="p-4 align-middle text-right">
                                        <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-muted/60 h-8 w-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-muted-foreground">No treks found</td>
                                </tr>
                                @endforelse
                                </tbody>
                        </table>
                    </div>

                    <div id="no-results" class="py-12 text-center hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-muted-foreground/50"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                        <h3 class="mt-4 text-lg font-medium text-foreground">No treks found</h3>
                        <p class="mt-1 text-sm text-muted-foreground">
                            Try adjusting your search query
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>