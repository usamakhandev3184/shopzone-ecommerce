<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;">🧾 Orders</h2>
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
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">ID</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Customer</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Phone</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Total</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Status</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Date</th>
                            <th style="padding:0.9rem 1rem;text-align:left;color:var(--text-muted);font-weight:600;font-size:0.78rem;text-transform:uppercase;">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            @php
                                $colors = [
                                    'pending'    => 'background:#fef3c7;color:#92400e;',
                                    'processing' => 'background:#dbeafe;color:#1e40af;',
                                    'completed'  => 'background:#d1fae5;color:#065f46;',
                                    'cancelled'  => 'background:#fee2e2;color:#991b1b;',
                                ];
                            @endphp
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="padding:0.8rem 1rem;color:var(--text-muted);">#{{ $order->id }}</td>
                                <td style="padding:0.8rem 1rem;font-weight:600;color:var(--text-dark);">{{ $order->full_name }}</td>
                                <td style="padding:0.8rem 1rem;color:var(--text-muted);">{{ $order->phone }}</td>
                                <td style="padding:0.8rem 1rem;font-weight:700;color:var(--navy);">Rs. {{ number_format($order->total_amount,0) }}</td>
                                <td style="padding:0.8rem 1rem;">
                                    <span style="padding:0.25rem 0.75rem;border-radius:999px;font-size:0.75rem;font-weight:700;{{ $colors[$order->status]??'' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td style="padding:0.8rem 1rem;color:var(--text-muted);font-size:0.8rem;">{{ $order->created_at->format('d M Y') }}</td>
                                <td style="padding:0.8rem 1rem;">
                                    <form action="{{ route('admin.orders.update',$order) }}" method="POST" style="display:flex;align-items:center;gap:0.5rem;">
                                        @csrf @method('PATCH')
                                        <select name="status" style="width:140px;border:1.5px solid var(--border);border-radius:8px;padding:0.35rem 0.6rem;font-size:0.8rem;background:white;outline:none;">
                                            <option value="pending"    {{ $order->status=='pending'   ?'selected':'' }}>Pending</option>
                                            <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                                            <option value="completed"  {{ $order->status=='completed' ?'selected':'' }}>Completed</option>
                                            <option value="cancelled"  {{ $order->status=='cancelled' ?'selected':'' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn-gold" style="padding:0.35rem 0.8rem;font-size:0.78rem;">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" style="padding:3rem;text-align:center;color:var(--text-muted);">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
