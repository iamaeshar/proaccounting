@extends('layouts.app')

@section('content')

<section id="blogs-content" class="section-padding">
    <div class="container-fluid">

        <h2>Search Result</h2>
        <hr class="heading-underline" />
    <small class="d-block">{{ count($blogs) }} blogs Found by  " {{ $keywords }} "</small>
        <br />

        @if (count($blogs) > 0)

        @foreach ($blogs as $blog)
        <div class="card border-0 mb-4 mat-box-shadow">
            <div class="row no-gutters">
                <div class="col-md-4 border-right cover_img">
                    <img src="/storage/app/public/cover_images/{{ $blog->blog_img }}" class="card-img" alt="{{ $blog->title }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{!! substr(strip_tags(str_replace( ' ', ' ', strip_tags( str_replace( '
                            <', ' <' ,$blog->blog_content ) ) )), 0, 450)
                                !!}{{ strlen($blog->blog_content) > 450 ? "..." : ""}}</p>
                    </div>
                    <div class="card-footer text-muted d-flex align-items-center">
                        <div class="col-sm-6">
                            <i class="far fa-calendar-alt"></i>&nbsp;{{ $blog->created_at->format('d F Y') }}
                        </div>
                        <div class="col-sm-6 text-right"><a href="/blog/{{ $blog->url }}"
                                class="btn bg-primary text-white">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="alert alert-danger">
            No Result.
        </div>
        @endif
    </div>
</section>
@endsection