<?php
class dashBoard extends crm
{
	
	public function allLeads($userBranch)
	{
		$totalLeads='<div class="panel panel-default">
            <div class="panel-body">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <p>Pending Leads</p>
                </div>
                <a href="allLeads?status=pending" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue-gradient">
                <div class="inner">
                  <p>Take Over Leads</p>
                </div>
                <a href="allLeads?status=new" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal-gradient">
                <div class="inner">
                  <p>In Process Leads</p>
                </div>
                <a href="allLeads?status=process" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green-gradient">
                <div class="inner">
                  <p>Successfull Leads</p>
                </div>
                <a href="allLeads?status=successfull" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red-gradient">
                <div class="inner">
                  <p>UnSuccessfull Lead</p>
                </div>
                <a href="allLeads?status=unsuccessfull" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                  <p>Total Leads</p>
                </div>
                <a href="allLeads?status=" class="small-box-footer">0 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
    <!--panel-body-->
                </div>';
				return $totalLeads;
	}
	// calendar 
	function calendar()
	{
		$calendar='
					<div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendar</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                        <li><a href="#">View calendar</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div><!-- /.box-body -->
              </div>
			';
			return $calendar;
	}
}
?>