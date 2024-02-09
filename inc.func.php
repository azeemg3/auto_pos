<?php
require_once'php_classes/dashboardClass.php';
class crm {

    function db() {
        $servername = 'localhost';
        $username = "root";
        $password = "";
        $db = "auto";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
        //$conn->close();
    }

    var $css_files;
    var $js_files;
	function sessionStart()
	{
		session_start();
		ob_start();
		ob_clean();
		if(!isset($_SESSION['session_crmuserName'])){
			header('Location:login');
		}else{
			$userSessionName=$_SESSION['session_crmuserName'];
			$userSessionFullname=$_SESSION['fullname'];
			$userSessionId=$_SESSION['sessionId'];
			$user_branch=$_SESSION['branch_id'];
			//mysql_query("UPDATE user SET online='yes' WHERE id=".$userSessionId."");
			}
	}
    function add_css($root="", $fileName="", $media="") {
        echo $this->css_files = '<link href="' . $root . $fileName . '" rel="stylesheet" media="' . $media . '" />';
        echo "\n";
    }

    function load_css($root="") {
        $this->add_css($root, "bootstrap/css/bootstrap.min.css", "all");
        $this->add_css($root, "bootstrap/css/font-awesome.min.css", "all");
        $this->add_css($root, "bootstrap/css/ionicons.min.css", "all");
        $this->add_css($root, "dist/css/AdminLTE.min.css", "all");
        $this->add_css($root, "dist/css/skins/_all-skins.min.css", "all");
        $this->add_css($root, "plugins/iCheck/flat/blue.css", "all");
        $this->add_css($root, "plugins/morris/morris.css", "all");
        $this->add_css($root, "plugins/jvectormap/jquery-jvectormap-1.2.2.css", "all");
        $this->add_css($root, "plugins/datepicker/datepicker3.css", "all");
        $this->add_css($root, "plugins/daterangepicker/daterangepicker-bs3.css", "all");
        $this->add_css($root, "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css", "all");
    		$this->add_css($root, "plugins/select2/select2.min.css", "all");
    		$this->add_css($root, "plugins/timepicker/bootstrap-timepicker.min.css", "all");
    		$this->add_css($root, "bootstrap/css/myStyle.css", "all");
        $this->add_css($root, "bootstrap/css/media-query.css", "all");
    }

    function add_js($root="", $fileName="") {
        echo $this->js_files = '<script type="text/javascript" src="' . $root . $fileName . '"></script>';
        //echo "\n";
    }

    function load_js($root) {
        echo ' <script src="' . $root . 'plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="' . $root . 'bootstrap/js/jquery-ui.min.js"></script>
    <script src="' . $root . 'bootstrap/js/bootstrap.min.js"></script>
    <script src="' . $root . 'bootstrap/js/raphael-min.js"></script>
    <script src="' . $root . 'plugins/morris/morris.min.js"></script>
    <script src="' . $root . 'plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="' . $root . 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="' . $root . 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="' . $root . 'plugins/knob/jquery.knob.js"></script>
	   <script src="'.$root.'plugins/select2/select2.full.min.js"></script>
    <script src="' . $root . 'bootstrap/js/moment.min.js"></script>
    <script src="' . $root . 'plugins/daterangepicker/daterangepicker.js"></script>
    <script src="' . $root . 'plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="' . $root . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="' . $root . 'plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="' . $root . 'plugins/fastclick/fastclick.min.js"></script>
    <script src="' . $root . 'dist/js/app.min.js"></script>
    <script src="' . $root . 'dist/js/pages/dashboard.js"></script>
    <script src="' . $root . 'dist/js/demo.js"></script>
	<script src="' . $root . 'js/inc.func.js"></script>
	<script src="'.$root.'plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="'.$root.'plugins/input-mask/jquery.inputmask.js"></script>
    <script src="'.$root.'plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
  </body>
</html>
	';
    }

    function foot($root="") {
        echo '<script src="'.$root.'plugins/jQuery/jQuery-2.1.4.min.js"></script>';
        echo '<script >
        $(function() 
			{ $(".date" ).datepicker({
                format:"dd-mm-yyyy" 
        	});
        });
		 $(function () {
        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });				
		</script>';
		echo '
		<script>
		function update_desk_alert(id, desk_alert)
		{
			$(".alert-rec-app").load("'.$root.'accounts/ajax_call/update_desk_alert?id="+id+"&desk_alert="+desk_alert);
		
		}	
		</script>
		';
		echo '<div class="get_desk_notification"></div>';
        echo '<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Beta Version</b>
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="#" target="_blank">Deu Tech </a>.</strong>Design & Developed By Leopardsoft Technologies
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdons Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebars background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->';
    }

    function get_footer($root="") {
        $this->foot($root);
        $this->load_js($root);
    }

    function head($root="") {
        echo '<!DOCTYPE html>
				<html><head>
    				<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<link rel="icon" href="' . $root . 'branch_logo/logo.png" />
					<title>Customer Relationship Managent System</title>
					<!-- Tell the browser to be responsive to screen width -->
					<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
					<!-- Bootstrap 3.3.5 -->';
    }

    function main_nav($root="") {
        $fileName = basename($_SERVER['SCRIPT_FILENAME'], ".php");
        $cur_dir = explode('\\', getcwd());
        $dirName=$cur_dir[count($cur_dir)-1];
        echo '
			 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
   <!--[if lt IE 9]> 
        <script src="bootstrap/js/html5shiv.min.js"></script>
        
        <script src="bootstrap/js/respond.min.js"></script>
        
    <![endif]-->
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="' . $root . 'index" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>RM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="font-size:13px !important;"><b><i>Customer Relation Management</i></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="load_msg()">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success count-msg">0</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <span class="count-msg">0</span> messages</li>
                  <li class="load-msg"></li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="pending_noti()">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning uCountNoti">0</span>
                </a>	
                <ul class="dropdown-menu">
                  <li class="header">You have <span class="uCountNoti">0</span> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu" id="pending_noti">
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">0</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 0 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="'.$root.'images/deutech.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">'.$this->u_value("user", "name", "id=".$_SESSION['sessionId']."").'</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="'.$root.'images/deutech.png" class="img-circle" alt="User Image">
                    <p>
                      <small>Member since<br>
					  ('.$this->mem_sicne($this->u_value("user", "date_created", "id=".$_SESSION['sessionId']."")).')
					  </small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a  href="'.$root.'logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="'.$root.'images/deutech.png" alt="User Image">
            </div>
            <div class="pull-left info">
              <p></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="' . (($fileName == 'index') ? "active" : "") . ' treeview">
              <a href="' . $root . 'index">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="' . (($fileName == 'purchase') ? "active" : "") . ' ' . (($fileName == 'sale_invoice') ? "active" : "") . '
             ' . (($fileName == 'opening_stock') ? "active" : "") . ' ' . (($fileName == 'stockList') ? "active" : "") . ' 
			 '.(($fileName == 'invList') ? "active" : "").' ' . (($fileName == 'purchaseList') ? "active" : "") . '  treeview">
              <a href="#">
                <i class="fa fa-fw fa-briefcase"></i> <span>Sale & Purchase</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'sale_invoice') ? "active" : "") . '"><a href="' . $root . 'sale_invoice">
                <i class="fa fa-angle-double-right"></i>Create Sale Invoice</a></li>
                <li class="' . (($fileName == 'purchase') ? "active" : "") . '"><a href="' . $root . 'purchase">
                <i class="fa fa-angle-double-right"></i>Create Purchase Invoice</a></li>
                <li class="' . (($fileName == 'opening_stock') ? "active" : "") . '"><a href="' . $root . 'opening_stock">
                <i class="fa fa-angle-double-right"></i>Opening Stock</a></li>
                <li class="' . (($fileName == 'stockList') ? "active" : "") . '"><a href="' . $root . 'stockList">
                <i class="fa fa-angle-double-right"></i>Stock List</a></li>
				<li class="' . (($fileName == 'invList') ? "active" : "") . '"><a href="' . $root . 'invList">
                <i class="fa fa-angle-double-right"></i>Sale Invoices List</a></li>
				<li class="' . (($fileName == 'purchaseList') ? "active" : "") . '"><a href="' . $root . 'purchaseList">
                <i class="fa fa-angle-double-right"></i>Purchased List</a></li>
              </ul>
            </li>
			<li class="'.(($fileName=='transactions') ? "active" : "").' '.(($fileName=='ledger') ? "active" : "").' treeview">
              <a href="#">
                <i class="fa fa-fw fa-briefcase"></i> <span>Accounts</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'transactions') ? "active" : "") . '"><a href="'.$root.'accounts/transactions">
                <i class="fa fa-angle-double-right"></i>Transactions</a></li>
				<li class="' . (($fileName == 'ledger') ? "active" : "") . '"><a href="'.$root.'accounts/ledger">
                <i class="fa fa-angle-double-right"></i>Ledger</a></li>
              </ul>
            </li>	
            <li class="'.(($fileName == 'sale_rep') ? "active" : "").' '.(($fileName == 'purchase_rep') ? "active" : "").' 
			'.(($fileName == 'profitLoss') ? "active" : "").' '.(($fileName == 'netincome') ? "active" : "").'
			 '.(($fileName == 'topProduct') ? "active" : "").' '.(($fileName == 'area_pro_rep') ? "active" : "").' treeview">
              <a href="#">
                <i class="fa fa-fw fa-bar-chart-o"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'sale_rep') ? "active" : "") . '"><a href="' . $root . 'reports/sale_rep">
                <i class="fa fa-angle-double-right"></i>Sale Reports</a></li>
                <li class="' . (($fileName == 'purchase_rep') ? "active" : "") . '"><a href="' . $root . 'reports/purchase_rep">
                <i class="fa fa-angle-double-right"></i>Purchase Reports</a></li>
				<li class="' . (($fileName == 'profitLoss') ? "active" : "") . '"><a href="' . $root . 'reports/profitLoss">
                <i class="fa fa-angle-double-right"></i>Profit & Loss Reports</a></li>
				<li class="' . (($fileName == 'netincome') ? "active" : "") . '"><a href="' . $root . 'reports/netincome">
                <i class="fa fa-angle-double-right"></i>Income & Expense</a></li>
				<li class="' . (($fileName == 'topProduct') ? "active" : "") . '"><a href="' . $root . 'reports/topProduct">
                <i class="fa fa-angle-double-right"></i>Top Saled Items</a></li>
				<li class="' . (($fileName == 'area_pro_rep') ? "active" : "") . '"><a href="' . $root . 'reports/area_pro_rep">
                <i class="fa fa-angle-double-right"></i>Areas Wise Product Reports</a></li>
              </ul>
            </li>			    
                <li class="' . (($fileName == 'transacc') ? "active" : "") . ' ' . (($fileName == 'brands') ? "active" : "") . ' 
                ' . (($fileName == 'products') ? "active" : "") . ' ' . (($fileName == 'cityList') ? "active" : "") . '
				' . (($fileName == 'areas') ? "active" : "") . ' treeview">
              <a href="#">
                <i class="fa fa-fw fa-briefcase"></i> <span>Administrtor</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'transacc') ? "active" : "") . '"><a href="' . $root . 'accounts/transacc">
				<i class="fa fa-angle-double-right"></i>Set Up A/C</a></li>
                <li class="' . (($fileName == 'brands') ? "active" : "") . '"><a href="' . $root . 'brands">
        <i class="fa fa-angle-double-right"></i>Brands</a></li>
                <li class="' . (($fileName == 'products') ? "active" : "") . '"><a href="' . $root . 'products">
        <i class="fa fa-angle-double-right"></i>Products</a></li>
				<li class="'.(($fileName =='cityList')? "active" : "") . '"><a href="'.$root.'cityList">
				<i class="fa fa-angle-double-right"></i>Cities</a></li>
				<li class="'.(($fileName =='areas')? "active" : "") . '"><a href="'.$root.'areas">
				<i class="fa fa-angle-double-right"></i>Areas</a></li>
              </ul>
            </li>
             <li class="' . (($fileName == 'register') ? "active" : "") . ' ' . (($fileName == 'userlist') ? "active" : "") . '
			   treeview">
              <a href="#">
                <i class="fa fa-group"></i> <span>Management</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="' . (($fileName == 'register') ? "active" : "") . '"><a href="' . $root . 'register">
        <i class="fa fa-angle-double-right"></i>Create New User</a></li>
                <li class="' . (($fileName == 'userlist') ? "active" : "") . '"><a href="' . $root . 'userlist">
        <i class="fa fa-angle-double-right"></i>All Users</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>


		';
    }

    function get_header($root="") {
		$this->sessionStart();
		//ob_start("ob_gzhandler");
        $this->head($root);
        $this->load_css($root);
        $this->main_nav($root);
    }
	function show_bal_format($bal)
	{
		return number_format(abs($bal), 2);
	}
	function dr_balance($bal)
	{
		return "Dr. ". number_format(abs($bal), 2);
	}
	function cr_balance($bal)
	{
		return "Cr. ". number_format(abs($bal), 2);
	}
	function show_bal($bal)
	{
		if ($bal>0)
		{
			return "Dr. ". number_format(abs($bal), 2);
			//return "Dr. ".abs($bal);
		}
		elseif($bal<0)
		{
			return "Cr. ". number_format(abs($bal), 2);
			//return "Cr. ".abs($bal);
		}
		elseif($bal==0)
		{
			return "Nil";
		}
	}
//***************************Previous func file*************************************************************

    function current_dt() {
        if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
        $date_time = date("d-m-Y G:i:s");
        return $date_time;
    }

    function today() {
        if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
        $date_time = date("d-m-Y");
        return $date_time;
    }

    function insertData($TtableName, $colum, $value) {
        $db =$this->db();
        $columns = implode(",", $colum);
        $values = "'" . implode("','", $value) . "'";
        $sql = ("INSERT INTO $TtableName ($columns) VALUES($values)");
        $result = $db->query($sql);
        return $result;
    }

    function insertData_multi($sTable, $columns, $values) {
        $db = $this->db();
       	$sql = "INSERT INTO $sTable ($columns) VALUES($values)";
        $result = $db->query($sql);
		if($result==true)
		{
        	return $result;
		}
		elseif ($db->error) 
		{
			return $db->errno;
		}
    }

// user this funciton when both of colmuns and values same
    function insert_array($sTable, $data, $add_col="", $add_val="") {
        $columns = "";
        $values = "";
        foreach ($data as $col =>$val) {
            $columns .= $col . ",";			
            	$values .= "'" .$val. "'" . ",";
        }
        $columns = rtrim($columns . $add_col, ",");
        $values = rtrim($values . $add_val, ",");
        $result = $this->insertData_multi("$sTable", $columns, $values);
        return $result;
    }

    function selectData($sTable, $sWhere) {
        $db = $this->db();
        $sql = "SELECT $sTable.* FROM $sTable WHERE $sWhere";
        $result = $db->query($sql);
        return $result;
    }

    function selectMultiData($data, $sTable, $sWhere) {
		$db=$this->db();
        $sql = " SELECT $data FROM $sTable WHERE $sWhere ";
        $result = $db->query($sql);
        return $result;
    }

    function update($sTable, $value, $sWhere) {
		$db=$this->db();
       $sql = "UPDATE $sTable SET $value WHERE $sWhere ";
        $result = $db->query($sql);
		if($result==true)
		{
        	return $result;
		}
		else
		{
			return $db->errno;
		}
    }

    function update_array($sTable, $values, $sWhere) {
        $query = "";
        foreach ($values as $values => $columns) {
            $query .= $values . "='" . $columns . "',";
        }
        $query = rtrim($query, ",");
        $result = $this->update("$sTable", $query, "$sWhere");
        return $result;
    }

    function delete($sTable, $sWhere) {
		$db=$this->db();
        $sql = "Delete FROM $sTable WHERE $sWhere";
        $dlt_query = $db->query($sql);
        return $dlt_query;
    }

    function u_total($sTable, $col, $sWhere) {
		$total=0;
		$db=$this->db();
        $sql = "SELECT sum($col) AS val FROM $sTable WHERE $sWhere";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['val'];
        return $total;
    }

    function u_value($sTable, $col, $sWhere) {
		$db=$this->db();
        $sql = "SELECT $col AS val FROM $sTable WHERE $sWhere";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
		if($row){
        $data = $row['val'];
        return $data;
		}
    }

    function count_val($sTable, $col, $sWhere) {
		$db=$this->db();
        $sql = "SELECT count($col) AS val FROM $sTable WHERE $sWhere";
        $result =$db->query($sql);
        $row = $result->fetch_assoc();
        $total_val = $row['val'];
        return $total_val;
	}

    function login($userName, $password) {
        $result = $this->selectData("user", "email='" . $userName . "' AND status='active' ");
        $row = $result->fetch_assoc();
        if ($userName == $row['email'] && md5($password) == $row['password']) {
            $_SESSION['session_crmuserName'] = $userName;
            $_SESSION['sessionId'] = $row['id'];
            $_SESSION['fullname'] = $row['name'];
            $_SESSION['branch_id'] = $row['branch_id'];
			$_SESSION['login_his_id']=
            $this->update("user", "online='yes', online_date='" . $this->current_dt() . "'", "id=" . $row['id'] . "");
            //mysql_query("INSERT INTO login_history (lat, longi, user_id, date_time, branch_id, ip_address) VALUES('$lat', '$long', '".$row['id']."',
            //'".$this->current_dt()."', '".$row['branch_id']."', '".$_SERVER['REMOTE_ADDR']."' )");
            header("location:index");
        } else {
            header("location:login?error=error");
        }
    }
	function password_app($userSessionId)
	{
		$query=$this->selectData("user", "id=".$userSessionId."");
		$row=$query->fetch_assoc();
		return $row['password'];
	}
    function get_cc() {
        $c_c_array = array("PAK 92" => "92", "UAE 971" => "971", "SAU 966" => "966", " Kuwait 965" => "965");
        foreach ($c_c_array as $c_codes => $c_codes_value) {
            echo '<option value="' . $c_codes_value . '">' . $c_codes . '</option>';
        }
    }
	// Branch users accesss
	function user_access($access, $userSessionId) {
        $query = $this->selectData("action", "user_id=" . $userSessionId . "");
        while ($row = $query->fetch_assoc()) {
            $action[] = $row['action'];
        }
        if (in_array($access, $action)) {
            return true;
        } else {
            return false;
        }
    }
	function branches($userSessionId,$branch_id)
	{
			$list="";
			if($this->user_access('adminstrator', $userSessionId)){
			$query=$this->selectData("branches", "status='active'");
			}
			else
			{
				$query=$this->selectData("branches", "branch_id=".$branch_id."");
			}
			while($row=$query->fetch_assoc())
			{
				$list.= '
						<option value="'.$row['branch_id'].'" '.(($row['branch_id']==$branch_id)? 'selected' :"").'>'.$row['branch_name'].'</option>
					';
			}
			return $list;
		}
    function get($val) {
        $get = mysqli_real_escape_string($_POST[$val][0]);
        return $get;
    }

    function post($val) {
        $post = mysqli_real_escape_string($_POST[$val][0]);
        return $post;
    }

    function show_rec() {
        echo'
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                ';
    }
	// fetch other vendors list 
	function vendors($vendor="")
	{
		$list="";
		$result=$this->selectData("trans_acc","trans_acc_type='Vendor' AND branch_id=".$_SESSION['branch_id']."");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['trans_acc_id'].'" '.(($row['trans_acc_id']==$vendor)?'selected="selected"':"").'>'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	function pagination($total_rec, $cur_page, $per_page)
	{
		$no_ofPage=ceil($total_rec/$per_page);
		if ($cur_page >= 5) 
			{
		   		$start_loop = $cur_page -3;
			  	$end_loop = $cur_page + 2;
				if($no_ofPage-1==$cur_page)
				   {
					   $end_loop=$no_ofPage;
				   }
				   if($cur_page==$no_ofPage)
				   {
					   $end_loop=$no_ofPage;
				   }
			}
		else 
		{
			$start_loop = 1;
			if ($no_ofPage > 5)
				$end_loop=5;
			else
				$end_loop =$no_ofPage;
		}
		$ul="";
		$ul.='<ul class="pagination pull-right">';
		if($cur_page==1) 
		{
			$ul.='<li p="1"  class="active"><a>First</a></li>';
		}
		else
		{
			$ul.='<li p="1"><a>First</a></li>';
		}
		for ($i = $start_loop; $i <= $end_loop; $i++) {
			if ($cur_page == $i)
				$ul .= "<li class='active' p='$i'><a>{$i}</a></li><li>";
			else
				$ul .= "<li p='$i'><a>{$i}</a></li>";
			}
		if($cur_page==$no_ofPage && $cur_page!=1)
		{
			$ul.='<li p="'.$no_ofPage.'" class="active"><a>Last</a></li>';
		}
		else
		{
			$ul.='<li p="'.$no_ofPage.'"><a>Last</a></li>'; 
		}
		$ul.="</ul>";
			return $ul;
	}
	function nothing_found($id, $colspan)
	{
		if(empty($id)){
		echo'
			<tr>
				<td colspan="'.$colspan.'" align="center">No Record Found</td>
			</tr>
		';
		}
		else
		{
			echo"";
		}
	}
	// form of payment to FOP (pt=Payment type)
	function fop($pt="")
	{
		$values="";
		$fop=array("cash"=>"Cash","online"=>"Online","cheque"=>"Cheque","pay_order"=>"Pay Order","demand_draft"=>"Demand Draft",
		"card"=>"Credit/Debit Card");
		foreach($fop as $key=>$val)
		{
			$values.='<option value="'.$key.'">'.$val.'</option>';
		}
		return $values;
	}
	// fop return 
	function fop_return($pt)
	{
		$values="";
		$fop=array("cash"=>"Cash","online"=>"Online","cheque"=>"Cheque","pay_order"=>"Pay Order","demand_draft"=>"Demand Draft",
		"card"=>"Credit/Debit Card");
		foreach($fop as $key=>$val)
		{
			if($pt==$key){return $val;}
		}
	}
	// data decode
	function encodeData($val)
	{
		$value=base64_encode($val);
		return $value;
	}
	// data encode
	function decodeData($val)
	{
		$value=base64_decode($val);
		return $value;
	}
	function serial($number)
	{
		if($number<10){$no="00".$number;}
		else{$no=$number;}
		return $no;
	}
	function rvc()
	{
	$a = rand(65,90);
	$b = rand(65,90);
	$c = rand(0,99);
	$c = str_pad($c, 2, '0', STR_PAD_LEFT);
	$d = rand(65,90);
	$key = chr($a).chr($b).$c.chr($d);
	return $key;
	}
	function uniqueId()
	{
		return $this->rvc();
	}
	// user Lead Taken over
	function ltu($leadId)
	{
		$ltu=$this->u_value("lead", "userId", "id=".$leadId." ORDER BY id DESC");
		return $ltu;
	}
	//amount format
	function amount_format($amount)
	{
		if($amount>0){return number_format($amount); }
		else{return "0.00";}
	}
	function go_back()
	{
		return '<a onClick="history.go(-1)" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a><br><br>';
	}
	function message_api($mobile, $message)
		{
			if(substr($mobile,0,2)==92)
			{
			$type = "xml"; 
			$id =""; 
			$pass =""; 
			$mask ="";
			$lang = "English"; 
		 	//text Message Code
			$to =$mobile;
			$message =$message;
 			$message = urlencode($message);   
 			// Prepare data for POST request 
			 $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;   
			 // Send the POST request with cURL 
			 $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url'); 
			 curl_setopt($ch, CURLOPT_POST, true); 
			 curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			 $result = curl_exec($ch); //This is the result from SMS4CONNECT cu
			 $xml=simplexml_load_string($result) or die("Error: Cannot create object");
			 $columns=array("code, mobile, message, date, userId, branch");
			 $values=array($xml->code, $to, $message, $this->current_dt(), $_SESSION['sessionId'], $_SESSION['branch_id'] );
			 $this->insertData("sms_status", $columns, $values);
			}
		}
	function mem_sicne($date)
	{
		if(date_default_timezone_set("Asia/karachi")==true)
		{
			date_default_timezone_set("Asia/karachi");
		}
		else
		{
			date_default_timezone_set("Asia/Dubai");
		}
		$currDAte=date("d-m-Y h:i:s");
		$datetime1 = new DateTime($date);
		$datetime2 = new DateTime($currDAte);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%y years %m months %d days');

	}
	function emptyWord($word)
	{
		if(!empty($word))
		{
			return $word;
		}
		else
		{
			return "N/A";
		}
	}
	function gender($value="")
	{
		$array=array('Male'=>'male', 'Female'=>'female');
		$list='';
		foreach($array as $key=>$val)
		{
			$list.='<option '.(($value==$val)?'selected':"").' value="'.$val.'">'.$key.'</option>';
		}
		return $list;
	}
	function martial_status($value="")
	{
		$array=array('Single'=>'single', 'Married'=>'married');
		$list='';
		foreach($array as $key=>$val)
		{
			$list.='<option '.(($value==$val)?'selected':"").' value="'.$val.'">'.$key.'</option>';
		}
		return $list;
	}
	function countryList($cid="")
	{
		$country="";
		$result=$this->selectData("countries", "1");
		while($row=$result->fetch_assoc())
		{
			$country.='<option '.(($row['country_code']==$cid)?'selected':''.(($row['country_code']==92)?'selected':"").'').' value="'.$row['country_code'].'">
		 '.$row['country_name'].'</option>';
		}
		return $country;
	}
	function cities($cid="")
	{
		$province="";
		$result=$this->selectData("cities", "1 GROUP BY city_name");
		while($row=$result->fetch_assoc())
		{
			$province.='<option '.(($row['city_id']==$cid)?'selected':"").'  value="'.$row['city_id'].'">
		 '.$row['city_name'].'</option>';
		}
		return $province;
	}
	function areas($area_id="")
	{
		$province="";
		$result=$this->selectData("areas", "1 GROUP BY area_name");
		while($row=$result->fetch_assoc())
		{
			$province.='<option '.(($row['area_id']==$area_id)?'selected':"").'  value="'.$row['area_name'].'">
		 '.$row['area_name'].'</option>';
		}
		return $province;
	}
	function institute($uni="")
	{
		$list="";
		$result=$this->selectData("institute", '1');
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['ins_id'].'" '.(($uni==$row['ins_id'])?'selected':"").'>'.$row['ins_name'].'</option>';
		}
		return $list;
	}
	//Qualifications
	function qualification($qid="")
	{
		$list="";
		$array=array('Non-Matriculation','Matriculation/O-Level','Intermediate/A-Level','Bachelors','Masters','MPhil/MS','PHD/Doctorate','Certification','Diploma','Short Course');
		foreach($array as $qualif)
		{
			$list.='<option value="'.$qualif.'" '.(($qid==$qualif)?'selected':"").'>'.$qualif.'</option>';
		}
		return $list;
	}
	function loader($path="")
	{
		echo'
			<div class="modal loader" id="loader" role="dialog">
				<div class="modal-dialog" style="margin-top:30%; width:15%;">
				  <!-- Modal content-->
				  <div class="">
					<div class="">
					  <div class="overlay">
                  		<i class="fa fa-refresh fa-spin fa-5x"></i>
                	</div>
					</div>
					<!--modal-body-->
				  </div>
				  <!--model-content-->
				</div>
			</div>
			<!-- loader-->
			';
	}
	function user_auth($auth, $userId, $root)
	{
		if($this->user_access("".$auth."", $userId)){}
		else {return header("location:".$root."index"); }
	}
	function brands($brand_id="")
	{
		$list="";
		$result=$this->selectData("brands", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option value="'.$row['brand_id'].'" '.(($row['brand_id']==$brand_id)?'selected':"").'>
			'.$row['brand_name'].'</option>';
		}
		return $list;
	}
	public function dr_cr($type="")
	{
		$list="";
		$array=array("dr", "cr");
		foreach($array as $arr)
		{
			$list.='<option value="'.$arr.'">'.strtoupper($arr).'</option>';
		}
		return $list;
	}
	function trans_acc_type($type="")
	{
		$list="";
		$array=array("Client","Vendor","Bank","Expense", "Cash", "Staff");
		foreach($array as $val)
		{
			$list.='<option value="'.$val.'">'.$val.'</option>';
		}
		return $list;
	}
	public function all_clients($client_id="")
	{
		$list="";
		$result=$this->selectData("trans_acc", "status='active' AND trans_acc_type='Client'");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($client_id==$row['trans_acc_id'])?'selected':'').' value="'.$row['trans_acc_id'].'">
			'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	public function all_vendors($vendor_id="")
	{
		$list="";
		$result=$this->selectData("trans_acc", "status='active' AND trans_acc_type='Vendor'");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($vendor_id==$row['trans_acc_id'])?'selected':'').' value="'.$row['trans_acc_id'].'">
			'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	public function all_products($pId="")
	{
		$list="";
		$result=$this->selectData("products", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($pId==$row['product_id'])?'selected':'').' value="'.$row['product_id'].'">'.$row['product_name'].'</option>';
		}
		return $list;
	}
	// banks and cash accounts
	public function cashBank_acc($accId="")
	{
		$list="";
		$result=$this->selectData("trans_acc", "status='active' AND trans_acc_type='Cash' OR trans_acc_type='Bank'");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($client_id==$row['trans_acc_id'])?'selected':'').' value="'.$row['trans_acc_id'].'">
			'.$row['trans_acc_name'].'</option>';
		}
		return $list;
	}
	public function trans_code()
	{
		$code=0;
		$code=$this->u_value("trans","trans_code", "1 ORDER BY trans_id DESC LIMIT 1 ");
		$codeVal=$code+1;
		return $codeVal;
	}
	public function ob($dt_frm, $dt_to, $transacc)
	{
		date_default_timezone_set("Asia/Karachi");
		$ob="";
		if($this->u_value("trans_acc", "dr_cr", "trans_acc_id=".$transacc."")=='dr')
		{
			$ob=$this->u_value("trans_acc", "amount", "trans_acc_id=".$transacc."");
		}
		if($this->u_value("trans_acc", "dr_cr", "trans_acc_id=".$transacc."")=='cr')
		{
			$ob='-'.$this->u_value("trans_acc", "amount", "trans_acc_id=".$transacc."");
		}
		$old_date =$dt_frm;
		$new_date = date("d-m-Y", strtotime($old_date) );
		$prev_date = date("d-m-Y", strtotime('-1 days', strtotime($new_date)) );
		$date1=$this->u_value("trans", "trans_date", "trans_acc_id='$transacc' AND status='approved' ORDER BY trans_date ASC LIMIT 1");
		$cr=$this->u_total("trans", "amount", "STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		trans_acc_id='$transacc' AND dr_cr='cr' AND status='approved'");
		$dr=$this->u_total("trans", "amount", "STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  
		STR_TO_DATE('".$date1."', '%d-%m-%Y') AND STR_TO_DATE('".$prev_date."', '%d-%m-%Y') AND 
		trans_acc_id='$transacc' AND dr_cr='dr' AND status='approved'");
		$bal=$ob+($dr)-($cr);
		return $bal;
		//return $this->show_bal_format($ob);
	}
	public function vt($vt="")
	{
		$list="";
		$array=array("RV","PV","CD","JV");
		foreach($array as $val)
		{
			$list.='<option '.(($vt==$val)?'selected':"").' value="'.$val.'">'.$val.'</option>';
		}
		return $list;
	}
	// transaction accounts list
	public function trans_acc($trans_id="")
		{
			$list="";
			if(!empty($trans_id) && $trans_id!=0)
			{
				$where="trans_acc_id!=".$trans_id."";
			}
			else
			{
				$where="1";
			}
			$result=$this->selectData("trans_acc","{$where}");
			while ($row=$result->fetch_assoc()) 
			{
				$list.='<option  value="'.$row['trans_acc_id'].'">'.$row['trans_acc_name'].'</option>';
			}
			return $list;
		}
		public function trans_acc_e($trans_id="")
		{
			$list="";
			$result=$this->selectData("trans_acc","1");
			while ($row=$result->fetch_assoc()) 
			{
				$list.='<option '.(($trans_id==$row['trans_acc_id'])?'selected':"").' value="'.$row['trans_acc_id'].'">'.$row['trans_acc_name'].'</option>';
			}
			return $list;
		}
	// calcualte the total gross profit gp=gross profit	
	public function gp($df, $dt)
	{
		$result=$this->selectData("sale_invoice","STR_TO_DATE(sale_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ')");
		$net_sale=0; $stp=0; $sts=0; $tpl=0;
		while($row=$result->fetch_assoc())
		{
			//total purchase of invoice
			$tp=0; $tb=0;
			$query=$this->selectMultiData("p_rate, qty, bonus_qty", "stock_details", "si_id=".$row['s_id']." AND type='s'");
			while($pRow=$query->fetch_assoc())
			{
				$tp+=$pRow['p_rate']*$pRow['qty'];
				$tb+=$pRow['p_rate']*$pRow['bonus_qty'];
			}
			$net_sale=($row['net_total'])-($row['bonus']);
				$stp+=$tp;
				$sts+=$net_sale;
				$tpl+=$net_sale-$tp;
		}
		return $tpl;
	}
	//calculate expense texp=total expense
	public function texp($df, $dt)
	{
		$total=0;
		$result=$this->selectData("trans_acc", "trans_acc_type='Expense' AND status='active'");
		while($row=$result->fetch_assoc())
		{
			$total+=$this->u_total("trans", "amount", "STR_TO_DATE(trans_date, '%d-%m-%Y') BETWEEN  STR_TO_DATE('$df', '%d-%m-%Y') AND STR_TO_DATE('$dt', '%d-%m-%Y ') AND status='approved' AND trans_acc_id=".$row['trans_acc_id']."");
		}
		return $total;
	}
	//=================================CMS=============================================
	function main_menu($menu_id="")
		{
			$list="";
			$query=$this->selectData("menu", "1");
			while($row=$query->fetch_assoc())
			{
				$list.='<option '.(($row['menu_id']==$menu_id)?'selected':"").' value="'.$row['menu_id'].'">'.$row['menu_name'].'</option>';
			}
			return $list;
		}
	function cat_name($cat_id)
	{
		$list="";
		$result=$this->selectData("menu_cat", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($cat_id==$row['cat_id'])?'selected':"").' value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
		}
		return $list;
	}
	function sub_cat($sub_cat_id)
	{
		$list="";
		$result=$this->selectData("sub_cat", "1");
		while($row=$result->fetch_assoc())
		{
			$list.='<option '.(($row['sub_cat_id']==$sub_cat_id)?'selected':"").' value="'.$row['sub_cat_id'].'">'.$row['sub_cat_name'].'</option>';
		}
		return $list;
	}
}

class validation extends crm {

    function empty_field() {
        echo '<div class="alert alert-danger alert-dismissable col-md-4 col-md-offset-3 empty-field" style="margin-top:10px; display:none;
		background-color: #f2dede !important;">
            <a class="close" onclick="$(\'.empty-field\').hide()">×</a>
            <strong>Error!</strong> Please Fill your Fields Properly.
        </div>';
    }
	function loader($path="")
	{
		echo'
			<div class="modal loader" id="loader" role="dialog">
				<div class="modal-dialog" style="margin-top:30%; width:11%;">
				  <!-- Modal content-->
				  <div class="">
					<div class="">
					  <img src="'.$path.'images/l_ajax_loader.gif" />
					</div>
					<!--modal-body-->
				  </div>
				  <!--model-content-->
				</div>
			</div>
			<!-- loader-->
			';
	}
}
$cm=new crm();
$dashboard=new dashBoard();
?>