<body class="login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url() ?>/assets/img/logo.jpg" height='150'>
    <br>
   <b>Online tracking and control of leave</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
    <?php
      $error = @$this->session->flashdata('error');
      if($error){
    ?>
        <?= $error."<br>" ?>
    <?php } ?>
    Sign in to start your session</p>

      <?php 
        echo form_open('login/validate_credentials');
      ?>
      <div class="form-group has-feedback">
        <?= form_input('username', '','placeholder="username"  class="form-control"'); ?> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= form_password('password', '','placeholder="Password" class="form-control"'); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
        <?= form_submit('submit','login',' class="btn btn-primary btn-block btn-flat"'); ?> 
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->