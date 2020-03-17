<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Users Module
        <br>
        </h1>
    </section>
    <section class="content">
        <div class="row">
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

            <?php if(@$userid) { ?>
                <div class="modal fade" id="modal-delete">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <?= form_open_multipart('dashboard_func/DeleteUser','class="form-horizontal" id="addcarform"');?>
                            <div class="form-group">
                                <center>
                                <label for="recipient-name" class="col-form-label">Are you sure you want to delete <?= @$user[0]->EMP_NAME ?></label>
                                <input type="hidden" id="EMP_ID" name="EMP_ID" value="<?= @$user[0]->EMP_ID ?>">
                                <label class="col-form-label" id="recipient-name" name="recipient-name"></label>
                                </center>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>


            <div class="col-md-4">
                <div class="box info">
                    <div class="box-header callout callout-info">
                        <h3 class="box-title ">Edit User - ID : <?= $userid?></h3>
                        <button type="submit" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-delete">Delete</button>
                    </div>
                    <div class="box-body ">
                        <?= form_open_multipart('dashboard_func/UpdateUser','class="form-horizontal" id="addcarform"');?>

                            <div class="box-body">
                                <input type="hidden" class="form-control" name="EMP_ID" value="<?= @$user[0]->EMP_ID ?>">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <span>EMPLOYEE NAME</span>
                                        <input type="text" class="form-control" name="EMP_NAME" value="<?= @$user[0]->EMP_NAME ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>DEPARTMENT</span>
                                    <br>
                                        <label for="DEPARTMENT"></label>
                                            <select name="DEPARTMENT" id="DEPARTMENT">
                                              <option value="PLDT Home">Administration</option>
                                              <option value="IT Service Delivery">Pre school</option>
                                              <option value="Workforce Mgnt">Elementary</option>
                                              <option value="Facilities">Junior Highschool</option>
                                              <option value="Executive Services">Senior Highschool</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>HIRING DATE</span>
                                        <input type="text" class="form-control" name="HIRING_DATE" value="<?= @$user[0]->HIRING_DATE ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>LEAVE TYPE</span>
                                        <input type="text" class="form-control" name="LEAVE_TYPE" value="<?= @$user[0]->LEAVE_TYPE ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>LEAVE COUNT</span>
                                        <input type="text" class="form-control" name="LEAVE_COUNT" value="<?= @$user[0]->LEAVE_COUNT ?>">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="box-footer">
                            
                                <button type="button" class="btn btn-default" onclick='window.location.replace(" <?= base_url(). 'dashboard/users' ?>");'>Back</button>
                                
                                <button type="submit" class="btn btn-info pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php }else{ ?> 
                
            <?php } ?>
            <div class="col-md-12">
            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-adduser">Add User</button>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FULL NAME</th>
                                    <th>DEPARTMENT</th>
                                    <th>HIRING DATE</th>
                                    <th>EMPLOYMENT STATUS</th>
                                    <th>LEAVE COUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $users as &$user ) { 
                                    
                                    $now = time(); // or your date as well
                                    $your_date = strtotime($user->HIRING_DATE);
                                    $datediff = $now - $your_date;
                                    $datediff = round($datediff / (60 * 60 * 12));
                                    //echo $user->LEAVE_COUNT;
                                    $totalLeave = floor($datediff/15);
                                    if( $totalLeave < $user->LEAVE_COUNT ){
                                        $totalLeave = floor($datediff/15);
                                    }else{
                                        $totalLeave = $user->LEAVE_COUNT;
                                    }

                                    $approvedLeaveCount = 0 ;
                                    foreach ($ApprovedLeaves as $key => $value) {
                                        if($value->EMP_ID == $user->EMP_ID){
                                            $approvedLeaveCount += $value->amt;
                                        }
                                    }
                                    
                                    $totalLeave = $totalLeave - $approvedLeaveCount;
                                    

                                    
                                ?>
                                
                                <tr onclick='window.location.replace(" <?= base_url(). 'dashboard/users/'.$user->EMP_ID ?> ");' >
                                    <th><?= $user->EMP_ID ?></th>
                                    <th><?= $user->EMP_NAME ?></th>
                                    <th><?= $user->DEPARTMENT ?></th>
                                    <th><?= $user->HIRING_DATE ?></th>
                                    <th><?= $user->EMPLOYMENT_STATUS ?></th>
                                    <th><?= $totalLeave //$user->LEAVE_COUNT - (@array_count_values(array_column($ApprovedLeaves, 'EMP_ID'))[$user->EMP_ID] ? : 0 ) ?></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-adduser">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add User</h4>
                        </div>
                        <div class="modal-body">
                            <dl class="dl-horizontal">
                               
                                <?= form_open_multipart('dashboard_func/AddUser','class="form-horizontal"');?>
                                <div class="box-body">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <span>EMPLOYEE ID</span>
                                        <input type="text" class="form-control" name="EMP_ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <span>EMPLOYEE NAME</span>
                                        <input type="text" class="form-control" name="EMP_NAME">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>DEPARTMENT</span>
                                        <br>
                                        <label for="DEPARTMENT"></label>
                                            <select name="DEPARTMENT" id="DEPARTMENT">
                                              <option value="Administration">Administration</option>
                                              <option value="Pre school">Pre school</option>
                                              <option value="Elementary">Elementary</option>
                                              <option value="Junior Highschool">Junior Highschool</option>
                                              <option value="Senior Highschool">Senior Highschool</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>HIRING DATE</span>
                                        <input type="text" class="form-control" name="HIRING_DATE">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>EMPLOYMENT STATUS</span>
                                        <br>
                                        <label for="EMPLOYMENT_STATUS"></label>
                                            <select name="EMPLOYMENT_STATUS" id="EMPLOYMENT_STATUS">
                                              <option value="REGULAR">REGULAR</option>
                                              <option value="TRAINEE">TRAINEE</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <span>LEAVE COUNT</span>
                                        <input type="text" class="form-control" name="LEAVE_COUNT">
                                    </div>
                                </div>
                                </div>
                                
                                
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </form>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </section>
    <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })
        $(function () {
            $('#example2').DataTable({
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
