<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Admin</title>
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
        .bg-muted\/30 { background-color: rgba(243, 244, 246, 0.3); }
    </style>
</head>
<body class="font-sans">
    <div id="admin-payments" class="min-h-screen bg-muted/30">
        <header class="sticky top-0 z-50 border-b bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
            <div class="container mx-auto flex h-16 items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>
                    </div>
                    <span class="font-serif text-xl font-bold text-foreground">Trek Admin</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-muted/60 h-9 px-3">
                        Dashboard
                    </a>
                    <a href="{{ route('bookings.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-muted/60 h-9 px-3">
                        Bookings
                    </a>
                    <a href="{{ route('admin.payments') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-9 px-3 hover:bg-primary/90">
                        Payments
                    </a>
                </div>
            </div>
        </header>

        <main class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <h1 class="font-serif text-3xl font-bold text-foreground">Payments</h1>
                <p class="mt-1 text-muted-foreground">Payments by trek and customer</p>
            </div>

            <div class="mb-8 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
                <div class="card p-4">
                    <div class="text-sm text-muted-foreground">This Month Total</div>
                    <div class="mt-2 text-2xl font-bold">Rs. {{ number_format($monthTotal ?? 0, 2) }}</div>
                </div>
                <div class="card p-4">
                    <div class="text-sm text-muted-foreground">Payments This Month</div>
                    <div class="mt-2 text-2xl font-bold">{{ $monthCount ?? 0 }}</div>
                </div>
                <div class="card p-4">
                    <div class="text-sm text-muted-foreground">Complete</div>
                    <div class="mt-2 text-2xl font-bold text-green-700">{{ $monthComplete ?? 0 }}</div>
                </div>
                <div class="card p-4">
                    <div class="text-sm text-muted-foreground">Pending</div>
                    <div class="mt-2 text-2xl font-bold text-yellow-700">{{ $monthPending ?? 0 }}</div>
                </div>
                <div class="card p-4">
                    <div class="text-sm text-muted-foreground">Failed</div>
                    <div class="mt-2 text-2xl font-bold text-red-700">{{ $monthFailed ?? 0 }}</div>
                </div>
            </div>

            <div class="mb-8 grid gap-4 lg:grid-cols-3">
                <div class="card p-6 lg:col-span-2">
                    <h2 class="font-serif text-xl font-bold">Last 6 Months</h2>
                    <p class="text-sm text-muted-foreground">Total amount and payment count</p>
                    <div class="mt-4">
                        <canvas id="paymentsChart" height="120"></canvas>
                    </div>
                </div>
                <div class="card p-6">
                    <h2 class="font-serif text-xl font-bold">This Month Details</h2>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground">Complete</span>
                            <span class="font-semibold">{{ $monthComplete ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground">Pending</span>
                            <span class="font-semibold">{{ $monthPending ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground">Failed</span>
                            <span class="font-semibold">{{ $monthFailed ?? 0 }}</span>
                        </div>
                        <div class="border-t pt-3 flex items-center justify-between">
                            <span class="text-muted-foreground">Total</span>
                            <span class="font-semibold">Rs. {{ number_format($monthTotal ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="p-6">
                    <div class="overflow-x-auto rounded-md border">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b bg-muted/50">
                                <tr class="border-b transition-colors hover:bg-muted/50">
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Transaction</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Trek</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Customer</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Email</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Amount</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                    <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Date</th>
                                    <th class="h-12 px-4 text-right align-middle font-medium text-muted-foreground">Details</th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @forelse($payments as $payment)
                                <tr class="border-b transition-colors hover:bg-muted/50">
                                    <td class="p-4 align-middle font-medium text-foreground">
                                        {{ $payment->transaction_uuid }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        {{ $payment->booking->trek->trekname ?? '—' }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        {{ $payment->booking->name ?? '—' }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        {{ $payment->booking->email ?? '—' }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        Rs. {{ number_format($payment->amount ?? 0, 2) }}
                                    </td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ ($payment->status ?? '') === 'COMPLETE' ? 'bg-green-100 text-green-800' : (($payment->status ?? '') === 'FAILED' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $payment->status ?? 'PENDING' }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-muted-foreground">
                                        {{ optional($payment->created_at)->format('M d, Y') }}
                                    </td>
                                    <td class="p-4 align-middle text-right">
                                        @if($payment->booking)
                                            <a href="{{ route('bookings.show', $payment->booking->id) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground shadow h-9 px-3 hover:bg-primary/90">
                                                View
                                            </a>
                                        @else
                                            <span class="text-muted-foreground">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="p-4 text-center text-muted-foreground">No payments found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($chartLabels ?? []);
        const totals = @json($chartTotals ?? []);
        const counts = @json($chartCounts ?? []);

        const ctx = document.getElementById('paymentsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [
                        {
                            label: 'Total Amount (Rs.)',
                            data: totals,
                            backgroundColor: 'rgba(34, 197, 94, 0.6)',
                            borderColor: 'rgba(22, 163, 74, 1)',
                            borderWidth: 1,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Payments Count',
                            data: counts,
                            type: 'line',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            tension: 0.3,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount (Rs.)'
                            }
                        },
                        y1: {
                            beginAtZero: true,
                            position: 'right',
                            grid: { drawOnChartArea: false },
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
