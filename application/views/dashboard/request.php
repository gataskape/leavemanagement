<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Leave Request
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
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $leaves as &$leave ) { 
                                if( $leave->status != "Pending"){
                                    continue;
                                }
                                $from = new DateTime( $leave->start );
                                $to = $from->add(new DateInterval('P'.($leave->amt-1).'D'));
                                
                                //$diff = $to->diff($from)->format("%a")+1;
                            ?>
                                <tr>
                                    <th> <a href="<?= base_url(). 'dashboard/users/'.$leave->EMP_ID ?>"><?= $leave->EMP_NAME ?></a></th>
                                    <th><?= $leave->DEPARTMENT ?></th>
                                    <th><?= $leave->start ?></th>
                                    <th><?= $to->format('m/d/Y')  ?></th>
                                  
                                    <th>
                                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-approve<?= $leave->id ?>">Approve</button>
                                        <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-decline<?= $leave->id ?>">Decline</button>
                                    </th>
                                </tr>


                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ( $leaves as &$leave ) { 

                                if( $leave->status != "Pending"){
                                    continue;
                                }
                                $from = new DateTime( $leave->start );
                                $to = $from->add(new DateInterval('P'.($leave->amt-1).'D'));

                            ?>
            <div class="modal fade" id="modal-approve<?= $leave->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Approve Leave</h4>
                        </div>
                        <div class="modal-body">
                            <dl class="dl-horizontal">
                                <dt>User</dt>
                                <dd><?= $leave->EMP_NAME ?></dd>
                                <dt>Leave Period</dt>
                                <dd><?= $leave->start ?> to <?= $to->format('m/d/Y') ?></dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.replace(' <?= base_url(). 'dashboard_func/ApproveLeave/'.$leave->id.'/'.$leave->EMP_ID ?> ');" >Approve</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-decline<?= $leave->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Decline Leave</h4>
                        </div>
                        <div class="modal-body">
                            <dl class="dl-horizontal">
                                <dt>User</dt>
                                <dd><?= $leave->EMP_NAME ?></dd>
                                <dt>Leave Period</dt>
                                <dd><?= $leave->start ?> to <?= $to->format('m/d/Y')  ?></dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.replace(' <?= base_url(). 'dashboard_func/DeclineLeave/'.$leave->id ?> ');">Decline</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        <?php } ?>
    </section>
    <script>
        $(function () {
            $('#leaveTable').DataTable({
            "order": [[ 1, 'asc' ]],
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true
            })
        })
    </script>
</div>