
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto; overflow: hidden; width: auto;">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        
        <li class="<?= @$content=="index" ? "active" : "" ?>">
          <a href="<?= base_url()."dashboard"?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container">
             
            </span>
          </a>
        </li>

         <li class="treeview <?= @$content=="request"||@$content=="approved"||@$content=="declined" ? "active" : "" ?>">
          <a href="#">
            <i class="fa fa-book"></i> <span>Leave Management</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?php echo @array_count_values(array_column($leaves, 'status'))["Pending"]; ?></span>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= @$content=="request" ? "active" : "" ?>">
              <a href="<?= base_url()."dashboard/request"?>">Requests
                <span class="label label-primary pull-right"><?php echo @array_count_values(array_column($leaves, 'status'))["Pending"]; ?></span>
              </a>
            </li>
            <li class="<?= @$content=="approved" ? "active" : "" ?>"><a href="<?= base_url()."dashboard/approved"?>">Approved</a></li>
            <li class="<?= @$content=="declined" ? "active" : "" ?>"><a href="<?= base_url()."dashboard/declined"?>">Declined</a></li>
          </ul>
        </li>

        
        <li class="<?= @$content=="users" ? "active" : "" ?>">
          <a href="<?= base_url()."dashboard/users"?>">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>