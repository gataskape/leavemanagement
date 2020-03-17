<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="info">
        		<?php echo str_repeat('&nbsp;', 5);?>
        		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee ID: <a><?= @$this->session->userdata('info')->EMP_ID ?></a></p>
        		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee Name: <a><?= @$this->session->userdata('info')->EMP_NAME ?></a></p>
        		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department: <a><?= @$this->session->userdata('info')->DEPARTMENT ?></a></p>
        		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hiring Date: <a><?= @$this->session->userdata('info')->HIRING_DATE ?></a></p>
        		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employment Status: <a><?= @$this->session->userdata('info')->EMPLOYMENT_STATUS ?></a></p>
        		
        		
        	</div>
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
              <h3><?=  $AvailableLeaves ?></h3>
              <p>Available Leave</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="dashboard/request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </section>
</div>