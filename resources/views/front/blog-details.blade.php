@extends('user.layouts.app')

@section('content')
    <div class="inner-banner">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-12">
                    <div class="inner-title">
                        <h3>Blog Details </h3>
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>Blog Details </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @php
        $tags = explode(',', $blog->tags);
    @endphp

    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- Blog Details --}}
                    <div class="blog-details-content">
                        <h2 class="title">{{ $blog->title ?? '' }}</h2>
                        <div class="blog-preview-img">
                            <img src="{{ asset(Storage::url($blog->image ?? '')) }}" alt="Blog Details">
                        </div>
                        <ul class="tag-list">
                            <li class="active"><a href="author.html"> <i class="flaticon-user"></i>
                                    {{ $blog->user->name ?? '' }} </a>
                            </li>
                            <li><i class="flaticon-clock"></i>
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }} </li>
                        </ul>
                        <div>
                            {!! $blog->body ?? '' !!}
                        </div>

                        {{-- Comment and Reply Module --}}
                        <div class="blog-comments-area mt-5">
                            <div class="comments-wrap">
                                <div class="comment-title">
                                    <h4>{{ count($blog->comments ?? '') }} Comments</h4>
                                </div>
                                <ul class="comment-form">

                                    <!-- Display Comments -->
                                    @foreach ($blog->comments as $comment)
                                        <li>
                                            <img src="{{ asset(Storage::url($comment->user->image ?? '')) }}" alt="Image"
                                                width="50" height="50" />
                                            <h3>{{ $comment->user->name ?? '' }}</h3>
                                            <span>{{ \Carbon\Carbon::parse($comment->created_at)->format('F d, Y \A\T h:i A') }}</span>
                                            <p>
                                                {{ $comment->content ?? '' }}
                                            </p>
                                        </li>
                                        <!-- Display Replies -->
                                        @foreach ($comment->replies as $reply)
                                            <li class="ms-5 shadow-sm p-2 px-3">
                                                <img src="{{ asset(Storage::url($reply->user->image ?? '')) }}"
                                                    alt="Image" width="50" height="50" />
                                                <h3>{{ $reply->user->name ?? '' }}</h3>
                                                <span>{{ \Carbon\Carbon::parse($reply->created_at)->format('F d, Y \A\T h:i A') }}</span>
                                                <p>
                                                    {{ $reply->content ?? '' }}
                                                </p>
                                            </li>
                                        @endforeach
                                        <div class="my-3">
                                            <!-- Reply Form -->
                                            <form action="{{ route('replies.store', $comment->id) }}" method="POST">
                                                @csrf
                                                <textarea name="content" class="form-control" placeholder="Give reply to comment" required></textarea>
                                                <button type="submit" class="default-btn mt-2">Reply</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="comments-form">
                                <div class="contact-form">
                                    <h3>Leave A Comment</h3>
                                    <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <textarea name="content" class="form-control" id="message" cols="30" rows="8" required=""
                                                        data-error="Write your message" placeholder="Your Message.."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="default-btn">
                                                    Post A Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="side-bar-area pl-20">

                        {{-- Search --}}
                        <div class="search-widget">
                            <form class="search-form" action="{{ route('blog.search') }}" method="GET">
                                <input type="search" name="keyword" class="form-control" placeholder="Search By Keywords">
                                <button type="submit">
                                    <i class="flaticon-search"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Popular Categories --}}
                        <div class="side-bar-widget">
                            <h3 class="title">Popular Categories</h3>
                            <div class="side-bar-categories">
                                <ul>
                                    @forelse ($typesWithCount as $type)
                                        <li>
                                            <a href="{{ route('blogs.by.type', $type?->name) }}" target="_blank">
                                                <i class="ri-arrow-right-s-line"></i>
                                                {{ $type->name ?? '' }} <span>({{ $type->blogs_count ?? '' }})</span>
                                            </a>
                                        </li>
                                    @empty
                                        No record found
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        {{-- Recent Post --}}
                        <div class="side-bar-widget">
                            <h3 class="title">Recent Post</h3>
                            <div class="widget-popular-post">
                                @forelse ($recentBlogs as $recentBlog)
                                    <article class="item">
                                        <a href="blog-details.html" class="thumb">
                                            <span class="full-image cover bg1" role="img"
                                                style="background-image: url({{ asset(Storage::url($recentBlog->image ?? '')) }});"></span>
                                        </a>
                                        <div class="info">
                                            <p>{{ \Carbon\Carbon::parse($recentBlog->created_at)->format('M d, Y') }}</p>
                                            <h4 class="title-text">
                                                <a href="{{ route('blog.details', $recentBlog?->slug) }}">
                                                    {{ $recentBlog->title ?? '' }}
                                                </a>
                                            </h4>
                                        </div>
                                    </article>
                                @empty
                                    No record found
                                @endforelse
                            </div>
                        </div>

                        {{-- Popular Tags --}}
                        <div class="side-bar-widget">
                            <h3 class="title">Popular Tags</h3>
                            <ul class="side-bar-widget-tag">
                                @forelse ($tags as $tag)
                                    <li>
                                        <a href="{{ route('blogs.by.tags', $tag) }}" target="_blank">
                                            {{ $tag }}
                                        </a>
                                    </li>
                                @empty
                                    No record found
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
