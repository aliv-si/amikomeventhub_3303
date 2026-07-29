@extends('layout.app')

@section('title', 'Pembayaran Berhasil')
@section('hide_navbar', true)
@section('hide_footer', true)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-12 shadow-sm inline-block w-full max-w-md">
        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-black mb-4">Terima Kasih!</h2>
        <p class="text-slate-500 mb-8 leading-relaxed">
            Pembayaran untuk pesanan <strong>{{ $transaction->order_id }}</strong> sedang diproses atau telah berhasil.
            E-Ticket akan dikirim ke email Anda (<strong>{{ $transaction->customer_email }}</strong>) setelah pembayaran terkonfirmasi lunas.
        </p>

        {{-- Rating Section --}}
        <div id="rating-section" class="border-t border-slate-100 pt-8 mt-8">
            @if($transaction->rating)
                {{-- Sudah pernah rating --}}
                <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-3">Rating Anda</p>
                <div class="flex justify-center gap-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-8 h-8 {{ $i <= $transaction->rating ? 'text-yellow-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    @endfor
                </div>
                @if($transaction->review)
                    <div class="bg-slate-50 p-4 rounded-xl mt-4 text-left border border-slate-100">
                        <p class="text-sm text-slate-600 italic">"{{ $transaction->review }}"</p>
                    </div>
                @endif
                <p class="text-green-600 font-bold text-sm mt-4">✓ Terima kasih atas ulasan Anda!</p>
            @else
                {{-- Belum rating --}}
                <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-3">Beri Rating Event Ini</p>
                <div id="star-container" class="flex justify-center gap-1 mb-4 cursor-pointer">
                    @for($i = 1; $i <= 5; $i++)
                        <svg data-rating="{{ $i }}" class="star-icon w-10 h-10 text-slate-200 hover:text-yellow-400 transition-colors duration-150" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    @endfor
                </div>
                <div id="review-form-container" class="hidden">
                    <textarea id="review-text" rows="3" class="w-full mt-4 p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none text-sm" placeholder="Bagikan pengalaman Anda (Opsional)..."></textarea>
                </div>
                <p id="rating-hint" class="text-slate-400 text-xs mt-2">Klik bintang untuk memberikan rating</p>
                <div id="rating-feedback" class="hidden mt-4">
                    <p class="text-green-600 font-bold text-sm">✓ Terima kasih atas ulasan Anda!</p>
                </div>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-6">
            @if(!$transaction->rating)
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-100 text-slate-700 rounded-xl font-bold hover:bg-slate-200 transition text-center">
                    Kembali ke Beranda
                </a>
                <button id="submit-review-btn" class="hidden w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Kirim
                </button>
            @else
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition text-center">
                    Kembali ke Beranda
                </a>
            @endif
        </div>
    </div>
</main>

@if(!$transaction->rating)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-icon');
    const hint = document.getElementById('rating-hint');
    const feedback = document.getElementById('rating-feedback');
    const reviewFormContainer = document.getElementById('review-form-container');
    const submitBtn = document.getElementById('submit-review-btn');
    const reviewText = document.getElementById('review-text');
    let selectedRating = 0;
    let submitted = false;

    // Hover effect
    stars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            if (submitted) return;
            const rating = parseInt(this.dataset.rating);
            highlightStars(rating);
        });

        star.addEventListener('mouseleave', function() {
            if (submitted) return;
            highlightStars(selectedRating);
        });

        // Click to set rating and show review form
        star.addEventListener('click', function() {
            if (submitted) return;
            selectedRating = parseInt(this.dataset.rating);
            highlightStars(selectedRating);
            
            // Show review form
            reviewFormContainer.classList.remove('hidden');
            if (submitBtn) submitBtn.classList.remove('hidden');
            hint.classList.add('hidden');
        });
    });

    if (submitBtn) {
        submitBtn.addEventListener('click', function() {
            if(submitted || selectedRating === 0) return;
            submitRating(selectedRating, reviewText.value);
        });
    }

    function highlightStars(rating) {
        stars.forEach(star => {
            const starRating = parseInt(star.dataset.rating);
            if (starRating <= rating) {
                star.classList.remove('text-slate-200');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-slate-200');
            }
        });
    }

    function submitRating(rating, review) {
        submitted = true;
        reviewFormContainer.classList.add('hidden');
        if (submitBtn) submitBtn.classList.add('hidden');
        
        // Show loading state...
        hint.textContent = 'Mengirim ulasan...';
        hint.classList.remove('hidden');

        fetch("{{ route('rating.store', $transaction->order_id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ rating: rating, review: review })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                hint.classList.add('hidden');
                feedback.classList.remove('hidden');
                // Disable cursor
                document.getElementById('star-container').style.cursor = 'default';
            } else {
                hint.textContent = data.message;
                hint.classList.remove('hidden');
                hint.classList.add('text-rose-500');
                submitted = false;
                reviewFormContainer.classList.remove('hidden');
                if (submitBtn) submitBtn.classList.remove('hidden');
            }
        })
        .catch(() => {
            hint.textContent = 'Terjadi kesalahan, silakan coba lagi.';
            hint.classList.remove('hidden');
            hint.classList.add('text-rose-500');
            submitted = false;
            reviewFormContainer.classList.remove('hidden');
            if (submitBtn) submitBtn.classList.remove('hidden');
        });
    }
});
</script>
@endif
@endsection