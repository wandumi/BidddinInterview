<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin/dist/img/boxed-bg.png') }}" alt="bidding_site" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Bidding Site</span>
    </a>

             
        {{-- <span class="brand-text font-weight-light">
            Bidding Site
        </span>   --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
              
        <a href="#" class="d-block"></a>
        <span style="color:white;">
            {{-- {{ auth::user()->name ? anonymous : '' }} --}}
        </span> 
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library menu-open -->
          <li class="nav-item has-treeview  ">
          <a href="{{ url('home') }}" class="nav-link ">

                <i class="nav-icon fa fa-dashboard"></i>
                <p>Dashboard</p>

            </a>

          </li>

     

  
     

           
     

        <li class="nav-item has-treeview ">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                        Products
                        <i class="fa fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
            
                    <li class="nav-item">

                        <router-link to="/products" class="nav-link " >
                        <i class="fa fa-circle nav-icon"></i>
                        <p>Lists</p>
                        </router-link>     
                     </li>
                     
                
                  
                  

                </ul>

        </li>




          <li class="nav-item">
            <a href="" class="nav-link  }}">
                <i class="nav-icon fa fa-user"></i>
                <p>
                Profile
              
                </p>
            </a>
          </li>

          <li class="nav-item" style="padding-bottom: 400px;">
                <a class="nav-link" href="{{ route('logout') }}"
                            onclick="
                        if(confirm('Are you sure you want to Logout?')){
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        }else{
                            event.preventDefault();
                        }
                            ">
                    <i class="nav-icon fa fa-power-off"></i>
                    <p>
                        Logout
                      
                    </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
