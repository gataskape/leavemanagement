<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Approved Leave
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
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Department</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $leaves as &$leave ) { 
                                if( $leave->status != "Approved"){
                                    continue;
                                }
                                $from = new DateTime( $leave->start );
                                $now = new DateTime();
                                $class = "";
                                if($from <= $now) {
                                    $class = "danger";
                                }


                                $to = $from->add(new DateInterval('P'.($leave->amt-1).'D'));
                                
                                
                            ?>
                                <tr class="<?= $class ?>">
                                    <th><?= $class? "Past": "On Going" ?></th>
                                    <th><a href="<?= base_url(). 'dashboard/users/'.$leave->EMP_ID ?>"><?= $leave->EMP_NAME ?></a></th>
                                    <th><?= $leave->DEPARTMENT ?></th>
                                    <th><?= $leave->start ?></th>
                                    <th><?= $to->format('m/d/Y') ?></th>
                                    <th>
                                    <button type="button" <?= $class? "disabled=''": "" ?> class="btn btn-primary " data-toggle="modal" data-target="#SwapModal" data-id="<?= $leave->id ?>">
                                        Swap Schedule
                                    </button>
                                    </th>

                                  
                                </tr>


                            <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    <div class="modal fade" id="SwapModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Swap Leave Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <?= form_open_multipart('dashboard_func/SwapLeave','class="form-horizontal" id="addcarform"');?>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">From : </label>
                <input type="hidden" id="sid" name="sid" value="">
                <label class="col-form-label" id="recipient-name" name="recipient-name"></label>
            </div>
            <div class="form-group">
                <select class="form-control" id="selection-swap" name="selection-swap"> </select>                 
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Swap</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    </section>

    



    <script>
        var now = new Date();
        function tryParseDateFromString(dateStringCandidateValue, format = "ymd") {
        if (!dateStringCandidateValue) { return null; }
        let mapFormat = format
                .split("")
                .reduce(function (a, b, i) { a[b] = i; return a;}, {});
        const dateStr2Array = dateStringCandidateValue.split(/[ :\-\/]/g);
        const datePart = dateStr2Array.slice(0, 3);
        let datePartFormatted = [
                +datePart[mapFormat.y],
                +datePart[mapFormat.m]-1,
                +datePart[mapFormat.d] ];
        if (dateStr2Array.length > 3) {
            dateStr2Array.slice(3).forEach(t => datePartFormatted.push(+t));
        }
        // test date validity according to given [format]
        const dateTrial = new Date(Date.UTC.apply(null, datePartFormatted));
        return dateTrial && dateTrial.getFullYear() === datePartFormatted[0] &&
                dateTrial.getMonth() === datePartFormatted[1] &&
                dateTrial.getDate() === datePartFormatted[2]
                    ? dateTrial :
                    null;
        }
        var employee = <?php echo json_encode($leaves) ?>;
        
      
        $('#SwapModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var id = button.data('id') 
            var name = "";
            var department = "";
            var EMP_ID = "";
            $.each(employee, function(key, value) {
                if(id == value['id']){
                    department = value['DEPARTMENT'];
                    todate = tryParseDateFromString(value['start'], 'mdy');
                    amt = parseInt(value['amt'])-1;
                    todate.setDate( todate.getDate() + amt );
                    EMP_ID = value['EMP_ID'];
                    name = value['EMP_NAME'] + " ("+ value['start']+ " to " + (todate.getMonth() + 1) + '/' + todate.getDate() + '/' +  todate.getFullYear() + ")";
                }
            });

            var modal = $(this)
            modal.find('.modal-body #recipient-name').html(name);
            modal.find('.modal-body #sid').val(`${id}-${EMP_ID}`);
            var select = document.getElementById("selection-swap");
            select.options.length=0;
            $.each(employee, function(key, value) {
                fromdate = tryParseDateFromString(value['start'], 'mdy');
                todate = tryParseDateFromString(value['start'], 'mdy');
                amt = parseInt(value['amt'])-1;
                todate.setDate( todate.getDate() + amt );
                if(value['status'] == "Approved" && id != value['id'] && department == value['DEPARTMENT'] && fromdate >= now){
                    var v = value['EMP_NAME'] + " ("+ value['start']+ " to " + (todate.getMonth() + 1) + '/' + todate.getDate() + '/' +  todate.getFullYear() + ")";
                    select.options[select.options.length] = new Option(v, `${value['id']}-${value['EMP_ID']}`);
                }
            });
            
        })

        $(function () {
            $('#leaveTable').DataTable({
            "order": [[ 0, 'asc' ], [ 1, 'desc' ]],
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