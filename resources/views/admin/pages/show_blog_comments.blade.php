@extends('admin.layouts.app')

@section('page-title')
<h2>Comments</h2>
@endsection

@section('content')
<div class="container-fluid">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <form action="{{ route('blog.deleteComment') }}" onsubmit="return confirm('Are You Sure ?')">
        @csrf
        @method('DELETE')
        <div class="tool-bar mb-1">
            <button class="btn btn-danger" type="submit">Delete Selected</button>
        </div>

        <div class="table-responsive-lg">
            <table class="table table-bordered table-hover bg-white text-center align-items-center">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="globalCheckbox" /></th>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comments</th>
                        <th>Blog</th>
                        <th>Commented_on</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($blogComments) > 0)
                    @foreach ($blogComments as $key => $blogComment)
                    <tr>
                        <td class="align-middle"><input type="checkbox" name="c_id[]" value="{{ $blogComment->id }}"
                                class="d-block" /></td>
                        <td class="align-middle">{{ ++$key }}</td>
                        <td class="align-middle">{{ $blogComment->name }}</td>
                        <td class="align-middle">{{ $blogComment->email }}</td>

                        <td class="align-middle">
                            {{ Str::words($blogComment->comment, 5) }}
                            <a href="#" data-toggle="modal" data-target="#readMoreModal"
                                data-name="{{ $blogComment->name }}" data-comment="{{ $blogComment->comment }}"
                                data-blog-title="{{ $blogComment->blog->title }}">Read More</a>
                        </td>

                        <td class="align-middle">{{ $blogComment->blog->title }}</td>
                        <td class="align-middle">{{ $blogComment->created_at->format('d-M-Y') }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-danger">
                                No Comments Yet !!
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{!! $blogComments->render() !!}</div>
        </div>
    </form>
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
                <p><b>Blog Title: </b><span id="blog-title"></span></p>
                <p style="word-wrap: break-word;" id="comment"></p>
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
                $("#blog-title").html($(e.relatedTarget).data('blog-title'));
                $("#comment").html($(e.relatedTarget).data('comment'));
            });
        });

       
        $('#globalCheckbox').click(function(){
            if($(this).prop("checked")) {
                $('td input[type="checkbox"]').prop("checked", true);           
                $('tbody tr').addClass('active-table-row');
                $('.tool-bar').show(100);
            } else {
                $('td input[type="checkbox"]').prop("checked", false);
                $('tbody tr').removeClass('active-table-row');
                $('.tool-bar').hide(100);
            }                
        });

        $('td input[type="checkbox"]').click(function(){
            /* === Table row Background */
            if($(this).is(":checked")){
                $(this).closest('tr').addClass('active-table-row');
            }
            else if($(this).is(":not(:checked)")){
                $(this).closest('tr').removeClass('active-table-row');
            }
        
            /* === Toolbar Toggle */
            if ($("td input:checkbox:checked").length > 0) {
                $('.tool-bar').show(100);
            }else {
                $('.tool-bar').hide(100);
            }
        });
    });
</script>
@endsection