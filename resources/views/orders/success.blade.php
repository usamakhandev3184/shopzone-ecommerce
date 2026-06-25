<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">Order Confirmed</h2>
    </x-slot>
    <div style="padding:4rem 1.5rem;text-align:center;">
        <div class="card fade-in-up" style="max-width:520px;margin:0 auto;padding:3.5rem 2.5rem;">
            <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-dark));display:flex;align-items:center;justify-content:center;font-size:2.5rem;margin:0 auto 1.5rem;">🎉</div>
            <h2 style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;color:var(--navy);margin-bottom:0.75rem;">Order Placed Successfully!</h2>
            <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.6;margin-bottom:2rem;">Thank you for shopping with ShopZone. We will contact you shortly on your provided phone number.</p>
            <a href="{{ route('products.index') }}" class="btn-gold" style="display:inline-flex;padding:0.85rem 2rem;font-size:1rem;">Continue Shopping</a>
        </div>
    </div>
</x-app-layout>