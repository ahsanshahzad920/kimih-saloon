@props([
    'salon',
    'badgeType' => null,
    'cardIndex' => 0
])

@php
    $biz = $salon->businessUser ?? null;
    $slug = $biz ? $biz->slug : ($salon->id ?? '');
    $bizName = $biz ? $biz->business_name : ($salon->name ?? 'Salon & Spa');
    $bizCity = $biz && $biz->city ? $biz->city : ($salon->city ?? 'Riyadh');
    $bizAddr = $biz && $biz->address ? $biz->address : ($bizCity . ', Saudi Arabia');

    $fallbackImages = [
        'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1600948836101-f9ffda59d250?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=800&q=80',
    ];
    $idx = abs(($salon->id ?? rand(0, 7))) % count($fallbackImages);
    $defaultImg = $fallbackImages[$idx];

    $imagePath = null;
    if ($biz && $biz->images && $biz->images->count() > 0) {
        $imgModel = $biz->images->first();
        if ($imgModel && !empty($imgModel->image)) {
            $imgPathStr = $imgModel->image;
            if (str_starts_with($imgPathStr, 'http://') || str_starts_with($imgPathStr, 'https://')) {
                $imagePath = $imgPathStr;
            } elseif (file_exists(public_path($imgPathStr))) {
                $imagePath = asset($imgPathStr);
            } elseif (file_exists(public_path('storage/' . $imgPathStr))) {
                $imagePath = asset('storage/' . $imgPathStr);
            }
        }
    }

    $imgUrl = $imagePath ?: $defaultImg;
    $rating = number_format(($salon->feedback_avg_rating ?? ($salon->feedback()->avg('rating') ?: 4.9)), 1);
    $reviewsCount = $salon->feedback_count ?? ($salon->feedback()->count() ?: (100 + (($salon->id * 157) % 1800)));
    $firstService = ($salon->services && $salon->services->count() > 0) ? $salon->services->first()->service_name : null;
    $firstService = $firstService ?: 'Barber';
    $detailUrl = route('shop.details', $slug);

    // Determine overlay badge text
    $badgeText = $badgeType;
    if ($badgeType === 'auto_new_deals') {
        $badgeText = ($cardIndex < 2) ? 'Deals' : 'New';
    }
@endphp

<div class="fresha-card-wrap">
    <div class="fresha-card fresha-card-flat" onclick="window.location.href='{{ $detailUrl }}'">
        {{-- Cover Image Container --}}
        <div class="fresha-card-thumb">
            {{-- Top Left Featured / Deals / New Badge --}}
            @if($badgeText)
                <span class="fresha-badge-featured">{{ $badgeText }}</span>
            @endif

            {{-- Top Right Wishlist Heart Button --}}
            <button type="button" 
                    class="fresha-heart-btn-dark js-fav-btn" 
                    data-salon-id="{{ $salon->id }}" 
                    onclick="event.stopPropagation();" 
                    aria-label="Add to wishlist">
                <i class="fa-regular fa-heart heart-icon"></i>
            </button>

            {{-- Cover Image --}}
            <a href="{{ $detailUrl }}" class="fresha-card-img-link" onclick="event.stopPropagation();">
                <img src="{{ $imgUrl }}" 
                     alt="{{ $bizName }}" 
                     loading="lazy" 
                     class="fresha-card-img" 
                     onerror="this.onerror=null;this.src='{{ $defaultImg }}';">
            </a>
        </div>

        {{-- Card Details Below Image --}}
        <div class="fresha-card-info">
            {{-- Line 1: Title & Rating --}}
            <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                <h3 class="fresha-card-title-screenshot text-truncate mb-0" title="{{ $bizName }}">
                    <a href="{{ $detailUrl }}" onclick="event.stopPropagation();">{{ $bizName }}</a>
                </h3>
                <div class="fresha-rating-screenshot flex-shrink-0">
                    <span class="star-ic-gold">★</span>
                    <span class="fw-bold">{{ $rating }}</span>
                </div>
            </div>

            {{-- Line 2: Plain Location Text --}}
            <div class="fresha-location-screenshot text-truncate mb-1">
                {{ $bizAddr }}
            </div>

            {{-- Line 3: Category · Review Count --}}
            <div class="fresha-meta-screenshot text-truncate">
                {{ $firstService }} <span class="dot-sep">·</span> {{ $reviewsCount }} reviews
            </div>
        </div>
    </div>
</div>




