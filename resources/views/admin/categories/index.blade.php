<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">🗂 Categories</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            {{-- Add Category Form --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Add New Category</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-3">
                    @csrf
                    <input type="text" name="name" placeholder="Category name..."
                           class="flex-grow border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    <button type="submit"
                            class="px-4 py-2 bg-cyan-600 text-white text-sm font-semibold rounded-lg hover:bg-cyan-700 transition">
                        Add
                    </button>
                </form>
            </div>

            {{-- Categories List --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-gray-600">Name</th>
                            <th class="px-4 py-3 text-left text-gray-600">Products</th>
                            <th class="px-4 py-3 text-left text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $cat)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $cat->name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $cat->products_count }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                          onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline text-xs font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-8 text-center text-gray-400">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>