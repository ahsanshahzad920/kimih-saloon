@extends('user.layouts.app')

@section('content')
    <div class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title mb-45 text-center">
                <span>News Feeds</span>
                <h2>Our Latest Blog Update</h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card box-shadow">
                            <a href="{{ route('blog.details', $blog?->slug) }}" class="img">
                                <img src="{{ asset(Storage::url($blog->image ?? '')) }}" alt="Blog">
                            </a>
                            <div class="content">
                                <ul>
                                    <li>
                                        <i class="flaticon-user"></i>
                                        <a href="#">{{ $blog->user->name ?? '' }}</a>
                                    </li>
                                    <li>
                                        <i class="flaticon-clock"></i>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                                    </li>
                                </ul>
                                <h3><a href="#">{{ $blog->title ?? '' }}</a></h3>
                                <a href="{{ route('blog.details', $blog?->slug) }}"
                                    class="default-btn two border-radius-5">Read More <i
                                        class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    No record found
                @endforelse

                <div class="col-lg-12 col-md-12 text-center">
                    {{-- <div class="pagination-area">
                        <a href="blog-1.html" class="prev page-numbers">
                            <i class="flaticon-arrow-pointing-to-left"></i>
                        </a>
                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="blog-1.html" class="page-numbers">2</a>
                        <a href="blog-1.html" class="page-numbers">3</a>
                        <a href="blog-1.html" class="next page-numbers">
                            <i class="flaticon-arrow-pointing-to-right"></i>
                        </a>
                    </div> --}}
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
