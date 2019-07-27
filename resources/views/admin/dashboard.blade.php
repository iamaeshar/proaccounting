@extends('admin.layouts.app')

@section('page-title')
<h2>Dashboard</h2>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row align-items-center" style="min-height: calc(100vh - 120px)">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card mat-box-shadow">
                <div class="card-header">Blogs</div>
                <div class="card-body text-center">
                    <h3><b> {{ $blogCount }} </b></h3>
                </div>
                <div class="card-footer text-center"><a href="{{ url('admin/blogs') }}">Explore <i
                            class="fas fa-external-link-alt"></i></a></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card mat-box-shadow">
                <div class="card-header">Comments</div>
                <div class="card-body text-center">
                    <h3><b> {{ $commentCount }} </b></h3>
                </div>
                <div class="card-footer text-center"><a href="{{ url('admin/blog/comments') }}">Explore <i
                            class="fas fa-external-link-alt"></i></a></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card mat-box-shadow">
                <div class="card-header">Queries</div>
                <div class="card-body text-center">
                    <h3><b> {{ $queryCount }} </b></h3>
                </div>
                <div class="card-footer text-center"><a href="{{ url('query') }}">Explore <i
                            class="fas fa-external-link-alt"></i></a></div>
            </div>
        </div>
    </div>
</div>
@endsection