<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;">🗂 Categories</h2>
    </x-slot>

    <div style="padding:2.5rem 0;">
        <div style="max-width:900px;margin:0 auto;padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- Add Category --}}
            <div class="card" style="padding:1.5rem;margin-bottom:1.5rem;">
                <h3 style="font-size:0.9rem;font-weight:600;color:var(--text-dark);margin-bottom:1rem;">Add New Category</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" style="display:flex;gap:0.75rem;">
                    @csrf
                    <input type="text" name="name" placeholder="Category name..." class="form-input" style="flex:1;">
                    @error('name')<p style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;">{{ $message }}</p>@enderror
                    <button type="submit" class="btn-gold" style="padding:0.6rem 1.2rem;white-space:nowrap;">Add</button>
                </form>
            </div>

            {{-- Categories List --}}
            <div class="card" style="overflow:hidden;">
                <table style="width:100%;border-collapse:collapse;font-size:0.875rem;">
                    <thead>
                        <tr style="background:var(--offwhite);border-bottom:2px solid var(--border);">
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Name</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Products</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="padding:0.8rem 1rem;font-weight:600;color:var(--text-dark);">{{ $cat->name }}</td>
                                <td style="padding:0.8rem 1rem;color:var(--text-muted);">{{ $cat->products_count }}</td>
                                <td style="padding:0.8rem 1rem;">
                                    <form action="{{ route('admin.categories.destroy',$cat) }}" method="POST" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="font-size:0.8rem;font-weight:600;color:#ef4444;background:none;border:none;cursor:pointer;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" style="padding:3rem;text-align:center;color:var(--text-muted);">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
