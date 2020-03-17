<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Approved Leave
        <br>
        </h1>
        <br>
        <?php
        $error = @$this->session->flashdata('success');
        if($error){
        ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?= $error ?>
        </div>
        <?php } ?>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List</h3>
                    </div>
                    <div class="box-body">
                        <table id="leaveTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $leaves as &$leave ) { 
                                if( $leave->status != "Approved"){
                                    continue;
                                }
                                $from = new DateTime( $leave->start );
                                $to = $from->add(new DateInterval('P'.($leave->amt-1).'D'));

                                $date = new DateTime($leave->start);
                                $date->modify("+1 day");
                                $now = new DateTime();
                                $class = "";
                                
                                if($date >= $now) {
                                    $class = "danger";
                                }
                            ?>
                                <tr>
                                    <th><?= $leave->start ?></th>
                                    <th><?= $to->format('m/d/Y') ?></th>
                                  
                                </tr>


                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <script>
        $(function () {
            $('#leaveTable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : false,
            'autoWidth'   : true
            })
        })
    </script>
</div>