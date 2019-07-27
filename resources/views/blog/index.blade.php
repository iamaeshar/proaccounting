@extends('layouts.app')

@section('meta-info')
<title>QuickBooks Blog | QuickBooks Services | Pro Accounting Support</title>
<meta name="keywords" content="quickbooks blog, quickbooks online blog, intuit quickbooks blog, tech blog, accounting software blog, Blog">
<meta name="description" content="Pro Accounting Support tells you about QuickBooks Blog. We also share the Tech Blog, Accounting Blog & all blogs related to QuickBooks Software.">
@endsection

@section('content')
<section id="blogs-banner">
    <img class="img-fluid" src="/images/blogs.jpg" alt="Blogs - Pro Accounting QuickBooks Support" />
</section>

<section id="blogs-content" class="section-padding">
    <div class="container-fluid">

        <h2>Blogs</h2>
        <hr class="heading-underline" />

        @if (count($blogs) > 0)

        <div class="card mat-box-shadow">
            <div class="card-body">
                <h5 class="card-title">Search Blog</h5>
                <form action="{{ route('blog.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input list="blogs" class="form-control" placeholder="Enter blog title"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="title">
                        <datalist id="blogs">
                            @foreach ($blogs as $blog)
                            <option value="{{ $blog->title }}"></option>
                            @endforeach
                        </datalist>
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary text-white" id="basic-addon2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br />

        @foreach ($blogs as $blog)
        <div class="card border-0 mb-4 mat-box-shadow">
            <div class="row no-gutters">
                <div class="col-md-4 border-right cover_img">
                    <img src="/storage/app/public/cover_images/{{ $blog->blog_img }}" class="card-img"
                        alt="{{ $blog->title }}">
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
                        <div class="col-sm-6 text-right"><a href="blog/{{ $blog->url }}"
                                class="btn bg-primary text-white">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">{!! $blogs->render() !!}</div>
        @else
        <div class="alert alert-danger">
            No Blogs Yet !!
        </div>
        @endif
    </div>
</section>
@endsection