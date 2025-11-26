const navbar = `
<nav class="navbar navbar-expand-lg py-2 position-absolute w-100 top-0 start-0" style="z-index: 10;">
  <div class="container-fluid px-3">

    <a class="d-flex align-items-center ms-1 text-decoration-none" href="#">
      <img
        src="/assets/logo.png"
        alt="Waggy logo"
        style="height: 35px; margin-right: 8px;"
      />
      <div class="d-flex flex-column lh-1">
        <span class="fw-semibold text-dark" style="font-size: 1rem;">Waggy</span>
        <small class="text-muted" style="font-size: 0.65rem; margin-top: 1px;">Community</small>
      </div>
    </a>

    <div class="collapse navbar-collapse justify-content-center">
      <ul class="navbar-nav align-items-center gap-1">
        <li><a class="nav-link text-dark fw-medium" style="font-size: 0.9rem;" href="/">Home</a></li>
        <li><a class="nav-link text-dark fw-medium" style="font-size: 0.9rem;" href="/discover">Discover</a></li>
        <li><a class="nav-link text-dark fw-medium" style="font-size: 0.9rem;" href="/guidelines">Security Guidelines</a></li>
        <li><a class="nav-link text-dark fw-medium" style="font-size: 0.9rem;" href="/helpcenter">Help Center</a></li>
      </ul>
    </div>

    <div class="d-flex align-items-center gap-2 me-1">
      <a class="btn btn-primary px-3 py-1 text-white" style="font-size: 0.85rem; border-radius: 6px;" href="/login">Login</a>
    </div>

  </div>
</nav>
`;

export default navbar;
