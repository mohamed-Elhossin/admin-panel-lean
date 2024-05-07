  <?php


  include_once 'C:\xampp\htdocs\learn\admin\App\functions.php';


  ?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= URL("index.php") ?>">
          <i class="bi bi-grid"></i>
          <span>My Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php if ($_SESSION['admin']['rule'] == 1) : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= URL("admins/index.php") ?>">
            <i class='bx bx-category'></i>
            <span>Admins</span>
          </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("teachers/index.php") ?>">
          <i class='bx bx-category'></i>
          <span>Teachers</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <?php endif; ?>
      <?php if ($_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule'] == 2) :  ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= URL("categories/index.php") ?>">
            <i class='bx bx-category'></i>
            <span>Category</span>
          </a>
        </li><!-- End Profile Page Nav -->
      <?php endif; ?>

      <?php if ($_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule'] == 3) : ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?= URL("courses/index.php") ?>">
            <i class='bx bx-category'></i>
            <span>Courses</span>
          </a>
        </li><!-- End Profile Page Nav -->
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= URL("tables-general.php") ?>">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="<?= URL("tables-data.php") ?>">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->



      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("users-profile.php") ?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("pages-contact.php") ?>">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("pages-register.php") ?>">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("pages-login.php") ?>">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("pages-error-404.php") ?>">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= URL("pages-blank.php") ?>">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->