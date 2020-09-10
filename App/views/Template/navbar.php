<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <div class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['presensi_adminsession'])) : ?>
        <li class="nav-item dropdown">
            <a href="<?=BASEURL?>auth/__unsetAuthorize" class="nav-link text-danger">
              logout
            </a>
        </li>
        <!-- <li class="nav-item"></li> -->
        <!-- <li class="nav-item">
        </li> -->
        <?php endif; ?>
    </div>
  </nav>
  <!-- /.navbar -->