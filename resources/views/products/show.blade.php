<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:var(--text-dark);">{{ $product->name }}</h2>
    </x-slot>

    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success fade-in-up">{{ session('success') }}</div>
            @endif

            {{-- Product Detail --}}
            <div class="card fade-in-up" style="overflow:hidden;margin-bottom:2.5rem;">
                <div style="display:flex;flex-wrap:wrap;">
                    {{-- Image --}}
                    <div style="flex:1;min-width:280px;background:var(--offwhite);display:flex;align-items:center;justify-content:center;padding:2.5rem;min-height:380px;">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 style="max-height:320px;width:100%;object-fit:contain;border-radius:12px;">
                        @else
                            <div style="color:var(--text-muted);text-align:center;font-size:0.9rem;">No Image</div>
                        @endif
                    </div>
                    {{-- Info --}}
                    <div style="flex:1;min-width:280px;padding:2.5rem;display:flex;flex-direction:column;justify-content:space-between;">
                        <div>
                            <span class="badge-gold" style="margin-bottom:1rem;display:inline-block;">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            <h1 style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;color:var(--text-dark);margin-bottom:0.5rem;">{{ $product->name }}</h1>

                            @if($reviews->count() > 0)
                                @php $avg = round($reviews->avg('rating'),1); @endphp
                                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem;">
                                    <div>@for($i=1;$i<=5;$i++)<span style="font-size:1.1rem;color:{{ $i<=$avg?'#C9A84C':'#e5e7eb' }};">★</span>@endfor</div>
                                    <span style="font-size:0.85rem;color:var(--text-muted);">{{ $avg }}/5 ({{ $reviews->count() }} reviews)</span>
                                </div>
                            @else
                                <p style="font-size:0.85rem;color:var(--text-muted);margin-bottom:1rem;">No reviews yet</p>
                            @endif

                            <div style="font-size:2rem;font-weight:800;color:var(--navy);margin-bottom:0.8rem;">Rs. {{ number_format($product->price,0) }}</div>

                            @if($product->stock > 0)
                                <p style="color:#059669;font-size:0.875rem;font-weight:600;margin-bottom:1rem;">✓ In Stock ({{ $product->stock }} available)</p>
                            @else
                                <p style="color:#dc2626;font-size:0.875rem;font-weight:600;margin-bottom:1rem;">✗ Out of Stock</p>
                            @endif

                            @if($product->description)
                                <div style="background:var(--offwhite);border-radius:10px;padding:1rem;margin-bottom:1.5rem;">
                                    <p style="font-size:0.85rem;font-weight:600;color:var(--text-dark);margin-bottom:0.3rem;">Description</p>
                                    <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.6;">{{ $product->description }}</p>
                                </div>
                            @endif
                        </div>

                        <div style="display:flex;flex-direction:column;gap:0.75rem;">
                            @auth
                                <div style="display:flex;gap:0.75rem;">
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add',$product) }}" method="POST" style="flex:1;">
                                            @csrf
                                            <button type="submit" class="btn-gold" style="width:100%;justify-content:center;padding:0.85rem;">
                                                🛒 {{ $inCart?'Add Again':'Add to Cart' }}
                                            </button>
                                        </form>
                                    @else
                                        <button disabled style="flex:1;padding:0.85rem;background:#f3f4f6;color:#9ca3af;border:none;border-radius:10px;font-weight:600;cursor:not-allowed;">Out of Stock</button>
                                    @endif
                                    <form action="{{ route('wishlist.toggle',$product) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="padding:0.85rem 1.2rem;border-radius:10px;border:1.5px solid {{ $inWishlist?'#fca5a5':'var(--border)' }};background:{{ $inWishlist?'#fff5f5':'var(--white)' }};font-size:1.3rem;cursor:pointer;transition:all 0.25s;">
                                            {{ $inWishlist?'❤️':'🤍' }}
                                        </button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="btn-gold" style="text-align:center;justify-content:center;padding:0.85rem;">Login to Add to Cart</a>
                            @endauth
                            <a href="{{ route('products.index') }}" class="btn-outline" style="text-align:center;justify-content:center;">← Back to Products</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if($relatedProducts->count() > 0)
                <div style="margin-bottom:2.5rem;">
                    <h2 class="section-title">Related Products</h2>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('products.show',$related) }}" class="product-card" style="text-decoration:none;">
                                <div class="product-img" style="height:160px;">
                                    @if($related->image)
                                        <img src="{{ asset('storage/'.$related->image) }}" alt="{{ $related->name }}">
                                    @else
                                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:0.8rem;">No Image</div>
                                    @endif
                                </div>
                                <div class="product-body" style="padding:0.8rem;">
                                    <p class="product-name" style="font-size:0.9rem;">{{ $related->name }}</p>
                                    <p class="product-price" style="font-size:1rem;padding-top:0.5rem;">Rs. {{ number_format($related->price,0) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Reviews --}}
            <div class="card" style="padding:2rem;">
                <h2 class="section-title">Customer Reviews</h2>

                @auth
                    @if(!$userReview)
                        <div style="background:var(--offwhite);border-radius:12px;padding:1.5rem;margin-bottom:2rem;">
                            <h3 style="font-size:0.95rem;font-weight:600;color:var(--text-dark);margin-bottom:1rem;">Write a Review</h3>
                            <form action="{{ route('reviews.store',$product) }}" method="POST">
                                @csrf
                                <div style="margin-bottom:1rem;">
                                    <label style="display:block;font-size:0.85rem;font-weight:500;color:var(--text-dark);margin-bottom:0.5rem;">Your Rating</label>
                                    <div style="display:flex;gap:4px;">
                                        @for($i=1;$i<=5;$i++)
                                            <button type="button" onclick="setRating({{ $i }})" class="star-btn" data-value="{{ $i }}"
                                                    style="font-size:2rem;color:#e5e7eb;background:none;border:none;cursor:pointer;transition:color 0.2s;">★</button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="ratingInput" value="0">
                                </div>
                                <div style="margin-bottom:1rem;">
                                    <textarea name="comment" rows="3" class="form-input" placeholder="Share your experience...">{{ old('comment') }}</textarea>
                                </div>
                                <button type="submit" class="btn-gold">Submit Review</button>
                            </form>
                        </div>
                    @endif
                @else
                    <p style="font-size:0.875rem;color:var(--text-muted);margin-bottom:1.5rem;">
                        <a href="{{ route('login') }}" style="color:var(--gold-dark);font-weight:600;">Login</a> to write a review.
                    </p>
                @endauth

                @forelse($reviews as $review)
                    <div style="border-bottom:1px solid var(--border);padding-bottom:1.25rem;margin-bottom:1.25rem;">
                        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:0.5rem;">
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--navy),var(--navy-light));color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.9rem;">
                                    {{ strtoupper(substr($review->user->name,0,1)) }}
                                </div>
                                <div>
                                    <p style="font-size:0.875rem;font-weight:600;color:var(--text-dark);">{{ $review->user->name }}</p>
                                    <p style="font-size:0.75rem;color:var(--text-muted);">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <div>@for($i=1;$i<=5;$i++)<span style="color:{{ $i<=$review->rating?'#C9A84C':'#e5e7eb' }};">★</span>@endfor</div>
                                @auth
                                    @if($review->user_id===Auth::id())
                                        <button onclick="toggleEditForm()" style="font-size:0.75rem;color:var(--gold-dark);background:none;border:none;cursor:pointer;font-weight:600;">Edit</button>
                                        <form action="{{ route('reviews.destroy',$review) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" style="font-size:0.75rem;color:#ef4444;background:none;border:none;cursor:pointer;font-weight:600;">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        @if($review->comment)
                            <p style="font-size:0.875rem;color:var(--text-muted);margin-left:48px;line-height:1.6;">{{ $review->comment }}</p>
                        @endif
                        @auth
                            @if($review->user_id===Auth::id())
                                <div id="editForm" class="hidden" style="margin-top:1rem;margin-left:48px;background:var(--offwhite);border-radius:10px;padding:1rem;">
                                    <form action="{{ route('reviews.store',$product) }}" method="POST">
                                        @csrf
                                        <div style="display:flex;gap:4px;margin-bottom:0.75rem;">
                                            @for($i=1;$i<=5;$i++)
                                                <button type="button" onclick="setEditRating({{ $i }})" class="edit-star" data-value="{{ $i }}"
                                                        style="font-size:1.5rem;color:{{ $i<=$review->rating?'#C9A84C':'#e5e7eb' }};background:none;border:none;cursor:pointer;">★</button>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="editRatingInput" value="{{ $review->rating }}">
                                        <textarea name="comment" rows="2" class="form-input" style="margin-bottom:0.75rem;">{{ $review->comment }}</textarea>
                                        <div style="display:flex;gap:0.5rem;">
                                            <button type="submit" class="btn-gold" style="padding:0.4rem 1rem;font-size:0.8rem;">Update</button>
                                            <button type="button" onclick="toggleEditForm()" class="btn-outline" style="padding:0.4rem 1rem;font-size:0.8rem;">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @empty
                    <p style="text-align:center;color:var(--text-muted);padding:2rem 0;">No reviews yet. Be the first to review!</p>
                @endforelse
            </div>
        </div>
    </div>
    <script>
        function setRating(v){document.getElementById('ratingInput').value=v;document.querySelectorAll('.star-btn').forEach((b,i)=>{b.style.color=i<v?'#C9A84C':'#e5e7eb';});}
        function setEditRating(v){document.getElementById('editRatingInput').value=v;document.querySelectorAll('.edit-star').forEach((b,i)=>{b.style.color=i<v?'#C9A84C':'#e5e7eb';});}
        function toggleEditForm(){document.getElementById('editForm').classList.toggle('hidden');}
    </script>
</x-app-layout>