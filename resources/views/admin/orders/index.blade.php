<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">🧾 Orders</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-gray-600">ID</th>
                            <th class="px-4 py-3 text-left text-gray-600">Customer</th>
                            <th class="px-4 py-3 text-left text-gray-600">Phone</th>
                            <th class="px-4 py-3 text-left text-gray-600">Total</th>
                            <th class="px-4 py-3 text-left text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-gray-600">Date</th>
                            <th class="px-4 py-3 text-left text-gray-600">Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-gray-500">#{{ $order->id }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $order->full_name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $order->phone }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-900">Rs. {{ number_format($order->total_amount, 0) }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $colors = [
                                            'pending'    => 'bg-yellow-100 text-yellow-700',
                                            'processing' => 'bg-blue-100 text-blue-700',
                                            'completed'  => 'bg-green-100 text-green-700',
                                            'cancelled'  => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$order->status] ?? '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-400 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status"
                                                style="width:140px; padding-right:24px;" class="border border-gray-200 rounded px-2 py-1 text-xs
                                                       focus:outline-none focus:ring-1 focus:ring-cyan-500 bg-white">
                                            <option value="pending"    {{ $order->status == 'pending'    ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed"  {{ $order->status == 'completed'  ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled"  {{ $order->status == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit"
                                                class="px-3 py-1 bg-cyan-600 text-white text-xs rounded
                                                       hover:bg-cyan-700 transition whitespace-nowrap">
                                            Save
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-400">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>