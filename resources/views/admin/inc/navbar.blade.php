<nav id="side-nav" class="mat-box-shadow bg-white open">
    <ul class="nav flex-column">
        <li class="nav-item bg-secondary d-flex align-items-center justify-content-center" id="cover">
            <a class="nav-link text-white" href="#"><img src="{{ asset('images/logo.png') }}" width="180px" /></a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="{{ url('admin/dashboard') }}"><i class="mr-2 fas fa-tachometer-alt"></i>
                &nbsp; Dashboaod</a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="{{ url('admin/blogs') }}"><i class="mr-2 fas fa-blog"></i> &nbsp;
                Blogs</a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="{{ url('admin/blog/comments') }}"><i
                    class="mr-2 far fa-comment-dots"></i> &nbsp; Comments</a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="{{ url('query') }}"><i class="mr-2 far fa-envelope"></i> &nbsp;
                Queries</a>
        </li>
        {{-- <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="#"><i class="mr-2 fas fa-users"></i> &nbsp; Subscribers</a>
        </li> --}}
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="https://www.proaccountingsupport.com/" target="_blank"><i
                    class="mr-2 fas fa-globe-americas"></i> &nbsp; Visit Website</a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="mr-2 fas fa-sign-out-alt"></i> &nbsp;
                Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>