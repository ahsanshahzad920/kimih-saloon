@props([
    'title' => 'Recommended',
    'subtitle' => null,
    'eyebrow' => null,
    'salons' => [],
    'viewAllUrl' => null,
    'isLoading' => false,
    'badgeType' => null,
    'carouselId' => 'freshaCarousel' . rand(100, 999)
])

<section class="sec fresha-carousel-section fresha-section-glow">
    <div class="container position-relative">
        {{-- Section Header --}}
        <div class="fresha-carousel-header align-items-center mb-3">
            <div>
                @if($eyebrow)
                    <span class="eyebrow d-block mb-1">{{ $eyebrow }}</span>
                @endif
                <h2 class="fresha-screenshot-heading mb-0">{{ $title }}</h2>
                @if($subtitle)
                    <p class="text-muted mb-0 mt-1" style="font-size:0.95rem;">{{ $subtitle }}</p>
                @endif
            </div>

            @if($viewAllUrl)
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ $viewAllUrl }}" class="btn-k btn-outline-k btn-sm py-2 px-3 text-nowrap">
                        View all <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- Floating Circular Arrow Navigation Buttons --}}
        <button type="button" class="fresha-floating-btn fresha-floating-prev js-carousel-prev" data-target="#{{ $carouselId }}" aria-label="Scroll left">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="fresha-floating-btn fresha-floating-next js-carousel-next" data-target="#{{ $carouselId }}" aria-label="Scroll right">
            <i class="fa-solid fa-arrow-right"></i>
        </button>

        {{-- Outer Clipped Container (Prevents horizontal overflow) --}}
        <div class="fresha-carousel-outer">
            {{-- Horizontal Scrollable Track --}}
            <div class="fresha-carousel-track-wrap" id="{{ $carouselId }}">
                <div class="fresha-carousel-rail">
                    @if($isLoading)
                        {{-- Loading Skeleton State --}}
                        @for ($i = 0; $i < 4; $i++)
                            @include('user.components.salon-card-skeleton')
                        @endfor
                    @else
                        @forelse ($salons as $salon)
                            @include('user.components.salon-card', [
                                'salon' => $salon,
                                'badgeType' => $badgeType,
                                'cardIndex' => $loop->index
                            ])

                        @empty
                            {{-- Empty State --}}
                            <div class="fresha-empty-state w-100 py-5 text-center">
                                <div class="empty-icon-wrap mb-3">
                                    <i class="fa-solid fa-store-slash text-muted" style="font-size:2.5rem;"></i>
                                </div>
                                <h4 class="h5 fw-bold text-dark mb-1">No salons available right now</h4>
                                <p class="text-muted small mb-3">Check back soon or explore other popular categories near you.</p>
                                <a href="{{ route('shop.search') }}" class="btn-k btn-hero btn-sm">
                                    Explore all venues <i class="fa-solid fa-compass ms-1"></i>
                                </a>
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



