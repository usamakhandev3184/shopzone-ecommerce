<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;">📦 Products</h2>
            <a href="{{ route('admin.products.create') }}" class="btn-gold" style="padding:0.5rem 1.2rem;font-size:0.85rem;">+ Add Product</a>
        </div>
    </x-slot>

    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="card" style="overflow:hidden;">
                <table style="width:100%;border-collapse:collapse;font-size:0.875rem;">
                    <thead>
                        <tr style="background:var(--offwhite);border-bottom:2px solid var(--border);">
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Image</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Name</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Category</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Price</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Stock</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="padding:0.8rem 1rem;">
                                    <div style="width:52px;height:52px;border-radius:8px;overflow:hidden;background:var(--offwhite);">
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;color:#9ca3af;">No img</div>
                                        @endif
                                    </div>
                                </td>
                                <td style="padding:0.8rem 1rem;font-weight:600;color:var(--text-dark);">{{ $product->name }}</td>
                                <td style="padding:0.8rem 1rem;color:var(--gold-dark);font-size:0.82rem;">{{ $product->category->name ?? '-' }}</td>
                                <td style="padding:0.8rem 1rem;font-weight:600;color:var(--navy);">Rs. {{ number_format($product->price,0) }}</td>
                                <td style="padding:0.8rem 1rem;color:var(--text-muted);">{{ $product->stock }}</td>
                                <td style="padding:0.8rem 1rem;">
                                    <div style="display:flex;gap:0.75rem;align-items:center;">
                                        <a href="{{ route('admin.products.edit',$product) }}" style="font-size:0.8rem;font-weight:600;color:var(--gold-dark);text-decoration:none;">Edit</a>
                                        <form action="{{ route('admin.products.destroy',$product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" style="font-size:0.8rem;font-weight:600;color:#ef4444;background:none;border:none;cursor:pointer;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" style="padding:3rem;text-align:center;color:var(--text-muted);">No products yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
