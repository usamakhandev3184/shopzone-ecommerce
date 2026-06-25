<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">📦 Products</h2>
            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-cyan-600 text-white text-sm font-semibold rounded-lg hover:bg-cyan-700 transition">
                + Add Product
            </a>
        </div>
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
                            <th class="px-4 py-3 text-left text-gray-600">Image</th>
                            <th class="px-4 py-3 text-left text-gray-600">Name</th>
                            <th class="px-4 py-3 text-left text-gray-600">Category</th>
                            <th class="px-4 py-3 text-left text-gray-600">Price</th>
                            <th class="px-4 py-3 text-left text-gray-600">Stock</th>
                            <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No img</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-900">Rs. {{ number_format($product->price, 0) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $product->stock }}</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="text-cyan-600 hover:underline text-xs font-medium">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline text-xs font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">No products yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>