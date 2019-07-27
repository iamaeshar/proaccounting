@extends('admin.layouts.app')

@section('page-title')
<h2>Blogs</h2>    
@endsection

@section('content')
<div class="container-fluid">
    <a href="{{ url('admin/write-blog') }}" class="btn bg-primary text-white float-right"> <i
            class="far fa-edit"></i> Write Blog</a>
    <div class="clearfix"></div>

    <br />

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    <br />
    @endif
    <div class="table-responsive-lg">
        <table class="table table-bordered table-hover bg-white text-center align-items-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (count($blogs) > 0)
                @foreach ($blogs as $key => $blog)
                <tr>
                    <td class="align-middle">{{ ++$key }}</td>
                    <td class="align-middle">{{ $blog->title }}</td>
                    <td class="align-middle">{{ $blog->keywords }}</td>
                    <td class="align-middle">{{ $blog->description }}</td>
                    <td class="align-middle">
                        <a href="/blog/{{ $blog->id }}/edit" class="btn btn-info text-white mb-1">Edit</a>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">
                        <div class="alert alert-danger">
                            No Blogs Found !!
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">{!! $blogs->render() !!}</div>
</div>
@endsection