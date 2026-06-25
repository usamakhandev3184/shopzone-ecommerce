<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">⚙ Admin Dashboard</h2>
    </x-slot>
    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
            @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
            {{-- Stats --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
                <div class="card" style="padding:1.5rem;border-left:4px solid var(--gold);">
                    <p style="font-size:2rem;font-weight:800;color:var(--navy);">{{ $totalProducts }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Total Products</p>
                </div>
                <div class="card" style="padding:1.5rem;border-left:4px solid #f59e0b;">
                    <p style="font-size:2rem;font-weight:800;color:#92400e;">{{ $pendingOrders }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Pending Orders</p>
                </div>
                <div class="card" style="padding:1.5rem;border-left:4px solid #10b981;">
                    <p style="font-size:2rem;font-weight:800;color:#065f46;">{{ $totalOrders }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Total Orders</p>
                </div>
                <div class="card" style="padding:1.5rem;border-left:4px solid var(--navy);">
                    <p style="font-size:2rem;font-weight:800;color:var(--navy);">Rs. {{ number_format($totalRevenue,0) }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Total Revenue</p>
                </div>
            </div>
            {{-- Quick Links --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.25rem;">
                <a href="{{ route('admin.products') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2.5rem;">📦</span>
                    <div><p style="font-weight:700;color:var(--navy);font-size:1rem;">Manage Products</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Add, edit, delete products</p></div>
                </a>
                <a href="{{ route('admin.categories') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2.5rem;">🗂</span>
                    <div><p style="font-weight:700;color:var(--navy);font-size:1rem;">Manage Categories</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Add or remove categories</p></div>
                </a>
                <a href="{{ route('admin.orders') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2.5rem;">🧾</span>
                    <div><p style="font-weight:700;color:var(--navy);font-size:1rem;">Manage Orders</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">View and update order status</p></div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>