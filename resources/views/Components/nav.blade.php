<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
      <img src="assets/img/icons8-injection-67.png" alt="docter" class="my-nav-logo">
        <h3 class="navbar-brand pt-2 text-white bold">VAX MANAGER</h3>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarText"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-1 mb-lg-0">
            <li class="nav-item">
            </li>
          </ul>
          
          <?php if ($_SESSION['user'] ?? false) : ?>
                <div class="ml-3 mt-2 d-flex">
                  <?php if($_SESSION['user']['userRole'] == 2){ ?>
                  <img src="assets/img/doctors/doctors-3.jpg" alt="docter" class="my-nav-img">
                  <?php } elseif ($_SESSION['user']['userRole'] == 1 || $_SESSION['user']['userRole'] == 3) { ?>
                    <img src="assets/img/testimonials/testimonials-5.jpg" alt="docter" class="my-nav-img">
                    <?php } ?>
                <form action="session" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bg-transparent text-white rounded">Log Out</button>
                  </form>
            </div>
              <?php else: ?>
                <ul class="navbar-nav ml-5 mb-1 mb-lg-0">
          <li class="nav-item">
          <a class="bg-transparent mx-3 rounded nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/pro_vax_track/session') ? 'active': ''; ?>" href="session">Sign In</a>
          </li>
          <li class="nav-item">
          <a class="bg-transparent rounded nav-link <?php echo ($_SERVER['REQUEST_URI'] === '/pro_vax_track/register') ? 'active': ''; ?>" href="register">Register</a>
          </li>
          </ul>
                  <?php endif; ?>
          
          
        </div>
      </div>
    </nav>