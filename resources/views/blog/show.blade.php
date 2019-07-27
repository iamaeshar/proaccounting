@extends('layouts.app')
@section('meta-info')
<title> {{ $blog->title }} </title>
<meta name="keywords" content="{{ $blog->keywords }}" />
<meta name="description" content="{{ $blog->description }}" />
@endsection
@section('content')
<section id="show-blog-sec" class="pt-5">
    <div class="container">
        <h3 class="mb-3">{{ $blog->title }}</h3>
        <div class="cover_img">
            <img src="/storage/app/public/cover_images/{{ $blog->blog_img }}" />
            <div class="blog-info-bar bg-white p-3 border-bottom">
                <i class="far fa-calendar-alt"></i>&nbsp;{{ $blog->created_at->format('d F Y') }}
                &nbsp;&nbsp;&nbsp;
                <a href="#id_blog-comments" class="text-muted"><span class="far fa-comment-dots">&nbsp;{{ $blogCount }}
                        Comments</span></a>
            </div>
        </div>

        <br><br>

        <div class="blog-content bg-white p-4">

            {!! $blog->blog_content !!}

            <br />
            
            <h4>You may also like: </h4>
            <br />

            @if (isset($prev))
            <a href="{{ URL::to('blog/' . $prev->url ) }}" class="float-left mb-5"><i class="fas fa-arrow-left"></i> &nbsp;
                {{$prev->title}}</a>
            @endif
            @if (isset($next))
            <a href="{{ URL::to('blog/' . $next->url ) }}" class="float-right">{{$next->title}} &nbsp; <i
                    class="fas fa-arrow-right"></i></a>
            @endif

            <br clear="all" />
            <br />

            <h4>What people say about this blog</h4>
            <hr class="heading-underline" />
            <div class="blog-comments" id="id_blog-comments">
                @if (count($comments) > 0)
                @foreach ($comments as $comment)
                <div class="d-flex mb-4">
                    <div class="avatar mr-4">
                        <h4>{{ strtoupper(mb_substr($comment->name, 0, 1)) }}</h4>
                    </div>
                    <div class="content">
                        <h5>{{ $comment->name }} -
                            <small>{{ $comment->created_at->diffForHumans() }}</small><br /><small
                                class="text-muted">{{ $comment->website}}</small></h5>

                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-danger">
                    <p>No Comments yet.</p>
                </div>
                @endif
            </div>

            <br /><br />

            <h4>You can also write feedback of this blog</h4>
            <hr class="heading-underline" />

            @if (session()->has('success'))
            <div class="alert alert-success">
                <p>Thanks for your comment.</p>
            </div>
            @endif

            <form action="{{ route('blog.comment') }}" class="material" method="POST" id="comment-form">
                @csrf
                <div class="card-body">
                    <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Name"
                        required />
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="url" name="website" placeholder="Website" value="{{ old('website') }}" required>
                    @error('website')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <textarea name="comment" placeholder="Comment" required></textarea> @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" />

                    <button class="btn bg-primary text-white mt-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.material.form.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
		$('form.material').materialForm();
	});

</script>

@endsection