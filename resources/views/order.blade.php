<!DOCTYPE html>
<html lang="sw" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Oda Zote</title>
    <!-- Tailwind CSS Script -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-gray-100 antialiased font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="hidden md:flex flex-col w-64 bg-emerald-900 text-white flex-shrink-0">
            <div class="p-5 text-2xl font-bold border-b border-emerald-800 flex items-center space-x-2">
                <span>🐔</span>
                <span>KukuBora Admin</span>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-emerald-800 text-emerald-100 font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 00-1 1m-6 0h6"></path></svg>
                    <span>Rudi Dukani</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-emerald-800 text-white font-medium shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span>Oda Zilizowekwa</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Top Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800">Usimamizi wa Oda</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full border border-emerald-200">
                        Jumla ya Oda: {{ $orders->count() }}
                    </span>
                </div>
            </header>

            <!-- Table Section -->
            <main class="p-6 lg:p-10 max-w-7xl w-full mx-auto">

                @if(session('success'))
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl mb-6 shadow-sm text-sm font-bold flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h2 class="text-lg font-bold text-gray-800">Orodha ya Oda Kutoka kwa Wateja</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600 border-collapse">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-bold border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">#ID</th>
                                    <th class="px-6 py-4">Mteja</th>
                                    <th class="px-6 py-4">Namba ya Simu</th>
                                    <th class="px-6 py-4">Bidhaa</th>
                                    <th class="px-6 py-4">Idadi</th>
                                    <th class="px-6 py-4">Eneo</th>
                                    <th class="px-6 py-4">Hali (Status)</th>
                                    <th class="px-6 py-4">Badilisha Status</th>
                                    <th class="px-6 py-4">Tarehe</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $order->customer_name }}</td>
                                        <td class="px-6 py-4 text-emerald-700 font-medium whitespace-nowrap">{{ $order->phone_number }}</td>
                                        <td class="px-6 py-4">{{ $order->product_name }}</td>
                                        <td class="px-6 py-4 font-bold">{{ $order->quantity }}</td>
                                        <td class="px-6 py-4">{{ $order->location ?? 'Haijaandikwa' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status == 'Completed')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                    Completed
                                                </span>
                                            @elseif($order->status == 'Cancelled')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                    Cancelled
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs font-semibold border border-gray-300 rounded-lg px-2.5 py-1.5 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 cursor-pointer shadow-sm">
                                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-12 text-gray-400 font-medium">
                                            Hakuna oda iliyowekwa bado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>
    </div>

</body>
</html>
