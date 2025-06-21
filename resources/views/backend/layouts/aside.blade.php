@section('aside')

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{route('dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-pages" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder-fill"></i><span>Pages</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-pages" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('manage-page.index')}}">
                            <i class="bi bi-circle"></i><span> Manage Page</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-testimonial.index')}}">
                            <i class="bi bi-circle"></i><span> Testimonial</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('manage-faqs.index')}}">
                            <i class="bi bi-circle"></i><span> Faqs</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('manage-member-type')}}">
                            <i class="bi bi-circle"></i><span> Member Types</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-team.index')}}">
                            <i class="bi bi-circle"></i><span> Our Teams</span>
                        </a>
                    </li>


                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-projects" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-building"></i><span>Project</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-projects" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{route('manage-projects.create')}}">
                            <i class="bi bi-circle"></i><span>Add project</span>
                        </a>
                        <a href="{{route('manage-projects.index')}}">
                            <i class="bi bi-circle"></i><span>Show Project</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{route('manage-gallery.index')}}">
                    <i class="bi bi-image"></i>
                    <span>Manage Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-posts" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Blog</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-posts" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('manage-blog-category.index')}}">
                            <i class="bi bi-circle"></i><span>Manage Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-blog.create')}}">
                            <i class="bi bi-circle"></i><span>Add Blog</span>
                        </a>
                        <a href="{{route('manage-blog.index')}}">
                            <i class="bi bi-circle"></i><span>Show Blogs</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-setting" data-bs-toggle="collapse"
                   href="#">
                    <i class="bi bi-gear"></i><span>Setting</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-setting" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('setting')}}">
                            <i class="bi bi-circle"></i><span>General</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('manage-social-media.index')}}">
                            <i class="bi bi-circle"></i><span>Social Media</span>
                        </a>
                    </li>


                </ul>
            </li>

        </ul>

    </aside><!-- End Sidebar-->
@endsection
