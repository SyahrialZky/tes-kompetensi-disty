<!-- Modal -->
<div class="modal fade" id="modalChangePass" tabindex="-1" aria-labelledby="modalChangePassLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalChangePassLabel">Ubah Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('change_pass') }}" method="POST" id="formChangePass">
          @csrf
          <!-- Error Alert -->
          <div class="alert alert-danger d-none alert-message" role="alert">
            <!-- Error message will go here -->
          </div>

          <!-- Old Password -->
          <div class="mb-3">
            <label for="old_password" class="form-label">Password Lama</label>
            <div class="input-group">
              <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Masukkan password lama" autocomplete="off">
              <button class="btn btn-outline-secondary" type="button" id="btn-old-password"><i class="fas fa-regular fa-eye"></i></button>
            </div>
            <div class="invalid-feedback">
              <!-- Error message for old password -->
            </div>
          </div>

          <!-- New Password -->
          <div class="mb-3">
            <label for="new_password" class="form-label">Password Baru</label>
            <div class="input-group">
              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" autocomplete="off">
              <button class="btn btn-outline-secondary" type="button" id="btn-new-password"><i class="fas fa-regular fa-eye"></i></button>
            </div>
            <div class="invalid-feedback">
              <!-- Error message for new password -->
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password baru" autocomplete="off">
              <button class="btn btn-outline-secondary" type="button" id="btn-confirm-password"><i class="fas fa-regular fa-eye"></i></button>
            </div>
            <div class="invalid-feedback">
              <!-- Error message for confirm password -->
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- END MODAL CHANGE PASS --}}


<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
  <div class="container-fluid">
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
            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
          </div>
        </form>

        <!-- Right side content -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
         

          <!-- User dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://picsum.photos/200/300" class="rounded-circle me-2" alt="User" width="30" height="30">
              <span>{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal"
                data-bs-target="#modalChangePass">Ubah Password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
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

<script>
  document.getElementById('btn-old-password').addEventListener('click', function () {
    togglePasswordVisibility('old_password', this);
  });
  
  document.getElementById('btn-new-password').addEventListener('click', function () {
    togglePasswordVisibility('new_password', this);
  });
  
  document.getElementById('btn-confirm-password').addEventListener('click', function () {
    togglePasswordVisibility('confirm_password', this);
  });

  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
      input.type = "text";
      btn.innerHTML = '<i class="fas fa-regular fa-eye-slash"></i>';
    } else {
      input.type = "password";
      btn.innerHTML = '<i class="fas fa-regular fa-eye"></i>';
    }
  }
</script>
