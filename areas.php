<?php
require_once'inc.func.php';
$cm->get_header("")
?>
<script>
    document.title = 'Area List';
</script>
<body onLoad="call_ajax('ajax_call/get_areas', '', 'get_areas')">
    <div class="content-wrapper" id="loadpage">

        <section class="content-header" style="border-bottom: 1px solid;padding-bottom: 14px;">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

 <!-- Modal -->
<div class="modal fade" id="area_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Area:</h4>
        </div>
         <form id="new-area">
        <div class="modal-body">
          <p><div class="panel panel-default">
            <div class="panel-body">
            	<div class="col-sm-6">
                	<div class="form-group">
                    	<select class="form-control input-sm" name="city_id">
                        	<option value="">Select City</option>
                            <?php echo $cm->cities(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group">
                    	<input type="text" name="area_name" class="form-control input-sm" placeholder="Area Name">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- panel-body-->
          </div>
          <!--panel-default-->
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success input-sm" onClick="areas()" >Submit</button>
          <button type="button" class="btn btn-warning input-sm" data-dismiss="modal" onClick="empty_fields('new-area')">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
</div>

        <h2 style="text-align:center;display:block;margin:0px;padding:10px 0px;font-style:italic;background:#cdcccc;"><span class="main-heading">Areas List</span></h2>
        <div class="panel panel-default">
            <div class="panel-body">
            	<button class="btn btn-sm btn-success pull-right" onClick="areas()">Add New Area</button>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable">
                        </thead>
                        <thead>
                            <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset;">
                                <th>#</th>
                                <th>Area Name</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="get_areas">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--panel panel-default-->
        </div>
        <!--panel-body-->
    </div>
    <!-- container-->
<?php $cm->get_footer("") ?>