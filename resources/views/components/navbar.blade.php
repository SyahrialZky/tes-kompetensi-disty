<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
  <div class="container-fluid">
    <!-- Brand -->
    

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <div class="d-flex justify-content-between w-100 align-items-center">

        <!-- Search bar -->
        <form class="d-none d-lg-block me-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
            <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
          </div>
        </form>

        <!-- Right side content -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <!-- Dark mode toggle -->
          <li class="nav-item">
            <button class="btn btn-light-dark-mode" id="darkModeToggle" type="button">
              <i class="bi bi-moon"></i>
            </button>
          </li>

         

          <!-- User dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://picsum.photos/200/300" class="rounded-circle me-2" alt="User" width="30" height="30">
              {{-- <span>{{ auth()->user()->name }}</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="#">Ubah Password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                {{-- <form action="{{ route('logout') }}" method="POST"> --}}
                  @csrf
                  <button class="dropdown-item" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
