<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?= base_url()."dashboard"?>" class="logo">
      <span class="logo-mini"><b>E</b>PNL</span>
      <span class="logo-lg"><b>Employee Panel</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li>
                <a><?= @$this->session->userdata('info')->EMP_NAME ?></a>
            </li>
            <li>
                <a href="<?= base_url()?>login/logout" >Sign out</a>
            </li>
        </ul>
      </div>

    </nav>
  </header>