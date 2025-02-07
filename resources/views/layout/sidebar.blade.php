@include('layout.header')
<body class="sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
         
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            @if(is_null(Auth::user()->name))
            <script>window.location.href = "{{ route('home') }}";</script>
        @endif
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
          
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            {{-- <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li> --}}
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                
                <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
              
                <!--end::User Image-->
                <!--begin::Menu Body-->
           
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                  <a href="{{route('logout')}}" class="btn btn-danger ">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      @if (Auth::user()->role =="admin")
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" style="background: #d81b60!important ">
      @else
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      @endif
    
        <!--begin::Sidebar Brand-->
       
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
            @if (Auth::user()->role =="agent")
            <li class="nav-item">
              <a href="{{route('user.lead.all')}}" class="nav-link">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>
                 Pending leads
                </p>
              </a>
             
            </li>
            <li class="nav-item">
              <a href="{{route('user.leads.all')}}" class="nav-link">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>
                   Sales Leads
                </p>
              </a>
             
            </li>
            <li class="nav-item">
              <a href="{{route('user.leada.all')}}" class="nav-link">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>
                  Approved Leads
                </p>
              </a>
             
            </li>
                  
              @else

              <li class="nav-item">
                <a href="{{route('user.all')}}" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>user</p>
                </a>
              </li>
                  
              



              <li class="nav-item">
                <a href="{{route('lead.all')}}" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    leads
                  </p>
                </a>
               
              </li>
              <li class="nav-item">
                <a href="{{route('sale.all')}}" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                  Sale
                  </p>
                </a>
               
              </li>
             
                  @endif
                
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>

      <main class="app-main">
        @yield('content')
       
      </main>
@include('layout.footer')