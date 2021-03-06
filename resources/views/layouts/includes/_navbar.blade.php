<header class="topbar">
  <!-- ============================================================== -->
  <!-- Navbar scss in header.scss -->
  <!-- ============================================================== -->
  <nav>
      <div class="nav-wrapper">
          <!-- ============================================================== -->
          <!-- Logo you can find that scss in header.scss -->
          <!-- ============================================================== -->
          <a href="javascript:void(0)" class="brand-logo">
              <span class="icon">
                  <img class="light-logo" width="35" height="35" src="{{asset('admin/img/logo-unpad.png')}}">
              </span>
              <span class="text">
                  <img class="light-logo" width="140" height="23" src="{{asset('admin/img/logo-dep.png')}}">
              </span>
          </a>
          <!-- ============================================================== -->
          <!-- Logo you can find that scss in header.scss -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Left topbar icon scss in header.scss -->
          <!-- ============================================================== -->
          <ul class="left">
              <li class="hide-on-med-and-down">
                  <a href="javascript: void(0);" class="nav-toggle">
                      <span class="bars bar1"></span>
                      <span class="bars bar2"></span>
                      <span class="bars bar3"></span>
                  </a>
              </li>
              <li class="hide-on-large-only">
                  <a href="javascript: void(0);" class="sidebar-toggle">
                      <span class="bars bar1"></span>
                      <span class="bars bar2"></span>
                      <span class="bars bar3"></span>
                  </a>
              </li>
              {{-- <li class="search-box">
                  <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                  <form class="app-search">
                      <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                  </form>
              </li> --}}
          </ul>
          <!-- ============================================================== -->
          <!-- Left topbar icon scss in header.scss -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right topbar icon scss in header.scss -->
          <!-- ============================================================== -->
          <ul class="right">
              <!-- ============================================================== -->
              <!-- Profile icon scss in header.scss -->
              <!-- ============================================================== -->
              <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown">
                @if(auth()->user()->avatar!=NULL)
                  @if(file_exists(public_path(auth()->user()->avatar)))
                  <img src="{{ auth()->user()->avatar }}" alt="user" class="circle profile-pic" width="27" height="27">
                  @else
                  <img src="{{ asset('admin/img/profile-default.png')}}" alt="user" class="circle profile-pic">
                  @endif
                @else
                <img src="{{ asset('admin/img/profile-default.png')}}" alt="user" class="circle profile-pic">
                @endif
              </a>
                  <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                      <li>
                          <div class="dw-user-box">
                              @if(auth()->user()->avatar!=NULL)
                                @if(file_exists(public_path(auth()->user()->avatar)))
                                <div class="u-img" style="padding-left:10px;"><img src="{{ auth()->user()->avatar }}" width="80" height="80" alt="user"></div>
                                @else
                                <div class="u-img" style="padding-left:10px;"><img src="{{ asset('admin/img/profile-default.png')}}" alt="user"></div>
                                @endif
                              @else
                              <div class="u-img" style="padding-left:10px;"><img src="{{ asset('admin/img/profile-default.png')}}" alt="user"></div>
                              @endif
                              <div class="u-text">
                                  <h4>{{auth()->user()->name}}</h4>
                                  <p>{{auth()->user()->email}}</p>
                                  @if(auth()->user()->role=='Super Admin')
                                    <span class="label label-info">Super Admin</span>
                                  @elseif(auth()->user()->role =='Student')
                                    <span class="label label-warning">Mahasiswa</span>
                                  @elseif(auth()->user()->role =='Lecturer')
                                    <span class="label label-primary">Dosen</span>
                                  @else
                                    <span class="label cyan">Admin</span>
                                  @endif
                              </div>
                          </div>
                      </li>
                      <li role="separator" class="divider"></li>
                      @if(auth()->user()->role == 'Super Admin')
                        <li><a href="/super_admin/dashboard/profile"><i class="material-icons">account_circle</i> Profil Saya</a></li>
                      @endif
                      @if(auth()->user()->role == 'Admin')
                        <li><a href="/admin/dashboard/admin_profile"><i class="material-icons">account_circle</i> Profil Saya</a></li>
                      @endif
                      @if(auth()->user()->role == 'Lecturer')
                        <li><a href="/lecturer/dashboard/lecturer_profile"><i class="material-icons">account_circle</i> Profil Saya</a></li>
                      @endif
                      @if(auth()->user()->role == 'Student')
                        <li><a href="/student/dashboard/student_profile"><i class="material-icons">account_circle</i> Profil Saya</a></li>
                      @endif
                      <li role="separator" class="divider"></li>
                      <li><a href="/logout"><i class="material-icons">power_settings_new</i> Logout</a></li>
                  </ul>
              </li>
          </ul>
          <!-- ============================================================== -->
          <!-- Right topbar icon scss in header.scss -->
          <!-- ============================================================== -->
      </div>
  </nav>
  <!-- ============================================================== -->
  <!-- Navbar scss in header.scss -->
  <!-- ============================================================== -->
</header>