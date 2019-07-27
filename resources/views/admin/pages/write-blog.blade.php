@extends('admin.layouts.app')

@section('meta-info')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-title')
<h2>Write Blog</h2>    
@endsection

@section('content')
<div class="container-fluid">
    <div class="alert alert-danger d-none" id="show-error">
        <ul class="errorList"></ul>
    </div>
    <form class="bg-white border p-4" action="{{ route('blog.store') }}" method="POST"
        id="create_blog_form" enctype="multipart/form-data">
        @csrf
        <div class="action-btns float-right">
            {{-- <button type="submit" value="0" class="btn btn-outline-secondary mr-2"> <i
                    class="far fa-save"></i> Save
                as
                Draft</button> --}}
            <button type="submit" value="1" class="btn bg-primary text-white"> <i
                    class="far fa-paper-plane"></i>
                Publish</button>
        </div>
        <div class="clearfix"></div>
        <br />

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Enter blog title" />
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label for="cover_img">Cover Image:</label>
                    <input type="file" class="form-control" id="cover_img" name="cover_img"
                        placeholder="Choose cover image" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="keywords">Keywords:</label>
            <input type="text" class="form-control" id="keywords" name="keywords"
                placeholder="Enter comma separated focussed keywords" />
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"
                placeholder="Enter Short Description" cols="20" rows="5"></textarea>
        </div>
        <!-- Added by R. Raza (8/5/19) -->
        <div class="form-group">
            <label for="description">Permalink:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">{{URL::to("/")}}/blog/</div>
                </div>
                <input type="text" pattern="^[a-zA-Z0-9-_]+$" class="form-control" id="url" name="url"
                    placeholder="Enter URL slug" />
            </div>
        </div>
        <!-- ------------------------- -->

        <div class="form-group">
            <label for="blog_content">Blog Content</label>
            <input type="hidden" name="blog_content" />
            <div id="blog_content"></div>
        </div>

        <div class="form-group action-btns float-right">
            {{-- <button type="submit" value="0" class="btn btn-outline-secondary mr-2"> <i
                    class="far fa-save"></i> Save
                as
                Draft</button> --}}
            <button type="submit" value="1" class="btn bg-primary text-white"> <i
                    class="far fa-paper-plane"></i>
                Publish</button>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, false] }],

        ['link', 'image'],

        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];

    $(document).ready(function() {
        var quill = new Quill('#blog_content', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow',
            placeholder:'Write your blog here'
        });

        // Added by R. Raza (8/5/19)
        $("#title").blur(e => {
            $("#url").val($("#title").val().trim().toLowerCase().replace(/ | /g, "-").replace(/ /g, "-"));
        });
        ////////////////////////////

        quill.getModule("toolbar").addHandler("image", imgHandler);

        function imgHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('name', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();
            input.onchange = async function() {
                const file = input.files[0];

                var fileFD = new FormData();
                fileFD.append('file', file);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"/editorFileUpload",
                    type: "post",
                    data: fileFD,
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        $('.loader-container').removeClass('d-none');
                    },
                    success: function(result) { 
                        var fileName = result.fileName;   

                        let range = quill.getSelection(true);
                        let index = range.index + range.length;
                        quill.insertEmbed(range.index, 'image', '/storage/cover_images/' + fileName);  
                    },
                    complete: function() {
                        $('.loader-container').addClass('d-none');
                    }
                }); 
            }
        }

        var form = document.querySelector('#create_blog_form');
        form.onsubmit = function() {
            event.preventDefault();

            // Populate hidden form on submit
            var about = document.querySelector('input[name=blog_content]');
            about.value = quill.root.innerHTML;
            // about.value = JSON.stringify(quill.root.innerHTML);
            
            var url = $(form).attr('action');

            $.ajax({
                url: url, 
                type: "POST",             
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
				processData: false,
                cache:false,
                success: function(result) {
                    if(result.status){
                        alert('Blog Published Successfully');
                        quill.root.innerHTML = "";
                        $(form)[0].reset();
                    }else {
                        $('.errorList').empty();
                        $.each( result.errors, function( index, value ){
                            $('<li>').text(value).appendTo($('.errorList'));
                        })
                        $('#show-error').removeClass('d-none');
                        $('html, body').animate({
                            scrollTop: $("#show-error").offset().top - 100
                        });
                    }
                }
            });
        };
    });
</script>
@endsection