<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo @array_count_values(array_column($leaves, 'status'))["Pending"] ? :0; ?></h3>
              <p>Request Leaves</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="dashboard/request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= count($users) ?></h3>
              <p>Employee</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="dashboard/request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?= count($leaves) ?></h3>
              <p>Total Leaves</p>
            </div>
            <div class="icon">
              <i class="fa fa-tag"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
            
          </div>
        </div>


      </section>
</div>