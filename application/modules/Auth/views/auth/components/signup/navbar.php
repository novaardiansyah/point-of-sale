<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
  <div class="container">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="javascript:void(0)">
      Point of Sale
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link me-2" href="javacript:void(0)">
            <i class="fas fa-user-circle opacity-6 me-1"></i>
            Sign Up
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="<?= base_url('auth'); ?>">
            <i class="fas fa-key opacity-6 me-1"></i>
            Login
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>