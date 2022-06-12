<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/guru') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Kelompok Tahfidz</span></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('guru/group/') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">
                            Kelompok Halaqoh Saya
                        </span></a>
                </li>
               
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Laporan Mutabaah Santri</span></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('guru/mutabaah/report') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">
                            Laporan Mutaba'ah
                        </span></a>
                </li>
             

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Streaming MP3</span></li>

                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('guru/mp3/') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">Streaming MP3
                        </span></a>
                </li>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{url('guru/profile')}}"
                    aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                        class="hide-menu">Edit Profile</span></a></li>





                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                        aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                            class="hide-menu">Documentation</span></a></li>
                {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i data-feather="power" class="svg-icon mr-2 ml-1"></i>Logout</a> --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
