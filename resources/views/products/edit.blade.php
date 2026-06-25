<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Image — {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Success message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Current image preview --}}
                @if ($product->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="h-40 w-full object-cover rounded">
                    </div>
                @else
                    <p class="text-sm text-gray-400 mb-4">No image uploaded yet.</p>
                @endif

                {{-- Upload form --}}
                <form action="{{ route('products.update', $product) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Choose Image (JPG, PNG, WEBP — max 2MB)
                        </label>
                        <input type="file"
                               name="image"
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-cyan-50 file:text-cyan-700
                                      hover:file:bg-cyan-100">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700 transition">
                            Upload Image
                        </button>
                        <a href="{{ route('products.index') }}"
                           class="text-sm text-gray-500 hover:underline">
                            Back to Products
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>