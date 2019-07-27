@extends('admin.layouts.app')

@section('page-title')
<h2>Queries</h2>
@endsection

@section('content')
<div class="container-fluid">

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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Query</th>
                    <th>Queried On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($queries) > 0)
                @foreach ($queries as $key => $query)
                <tr>
                    <td class="align-middle">{{ ++$key }}</td>
                    <td class="align-middle">{{ $query->name }}</td>
                    <td class="align-middle">{{ $query->email }}</td>
                    <td class="align-middle">
                        {{ Str::words($query->message, 5) }}
                        <a href="#" data-toggle="modal" data-target="#readMoreModal" data-name="{{ $query->name }}"
                            data-query="{{ $query->message }}">Read More</a>
                    </td>
                    <td class="align-middle"> {{ $query->created_at->format('d-M-Y') }} </td>
                    <td class="align-middle">
                        <form action="{{ route('query.destroy', $query->id) }}" method="POST"
                            onsubmit="return confirm('Are You Sure ?')">
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
                            No Queries Found !!
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $queries->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="readMoreModal" tabindex="-1" role="dialog" aria-labelledby="readMoreModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p style="word-wrap: break-word;" id="query"></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
            $(function() {
                $('#readMoreModal').on("show.bs.modal", function (e) {
                    $(".modal-title").html($(e.relatedTarget).data('name'));
                    $("#query").html($(e.relatedTarget).data('query'));
                });
            });
        })
</script>
@endsection