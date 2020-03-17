<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Leave Request
        <br>
        </h1>
        
        <br>
        <?php
            $error = @$this->session->flashdata('error');
            if($error){
        ?>
            <div class="callout callout-danger">
            <p><?= $error ?></p>
            </div>
        <?php } ?>
        <?php
            $success = @$this->session->flashdata('success');
            if($success){
        ?>
            <div class="callout callout-success">
            <p><?= $success ?></p>
            </div>
        <?php } ?>
    </section>
    <section class="content">
    <?php
    if( $AvailableLeaves > 0 ){
    ?>
     <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-requestLeave">Request Leave</button>
    <?php } ?>
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
                                    
                                    <th><?= $leave->start ?></th>
                                    <th><?= $to->format('m/d/Y')  ?></th>
                                  
                                    <th>
                                        <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-decline<?= $leave->id ?>">Remove</button>
                                    </th>
                                </tr>


                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-requestLeave">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">File Leave</h4>
                        </div>
                        <div class="modal-body">
                            <dl class="dl-horizontal">
                               
                                <?= form_open_multipart('dashboard_func/requestLeave','class="form-horizontal" id="addcarform"');?>
                                <div class="box-body">
                                    <input type="hidden" class="form-control" name="EMP_ID" value="<?= $this->session->userdata('info')->EMP_ID ?>">
                                    <input type="hidden" class="form-control" name="LEAVE_COUNT" value="<?= $AvailableLeaves ?>">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <span>Date</span>
                                                <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-o"></i>
                                                </div>
                                                    <input type="text" class="form-control pull-right" name="STARTDATE" id="reservationtime">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


        <?php foreach ( $leaves as &$leave ) { 

                                if( $leave->status != "Pending"){
                                    continue;
                                }
                                $from = new DateTime( $leave->start );
                                $to = $from->add(new DateInterval('P'.($leave->amt-1).'D'));

                            ?>
            
            <div class="modal fade" id="modal-decline<?= $leave->id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete Leave</h4>
                        </div>
                        <div class="modal-body">
                            <dl class="dl-horizontal">
                               
                                <dt>Leave Period</dt>
                                <dd><?= $leave->start ?> to <?= $to->format('m/d/Y')  ?></dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.replace(' <?= base_url(). 'dashboard_func/DeleteLeave/'.$leave->id ?> ');">Delete</button>
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
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : false,
            'autoWidth'   : true
            })
        })

        $(function () {
            var dateToday = new Date();
        //Date range picker with time picker
            $('#reservationtime').daterangepicker({ autoApply: true, timePicker: false, minDate: dateToday, timePickerIncrement: 30, format: 'MM/DD/YYYY' });
            $('#reservationtime').val('');
            $('#reservationtime').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

           
        })
    </script>
</div>