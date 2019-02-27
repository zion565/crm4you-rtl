<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('functions-hs/error_header.php');
include('functions-hs/functions-hs.php');
include('customer/data/Controller.php');
$data_customer = new Controller;
$all_status = $data_customer->getAllStatus();
$base_path = get_base_url();
$base_admin_path = $base_path."/adminlte-rtl";
//$base_path_scripts = $base_path."/scripts";

if(empty($_SESSION['admin_email'])||!isset($_SESSION['aid'])||empty($_SESSION['aid']))
{
    echo "<script>window.location.href='".$base_admin_path."/index.php'</script>";
}else{
    $aid=$_SESSION['aid'];
    $admin_email=$_SESSION['admin_email'];
}
$db=get_db();
?>
<html>
<head>
<?php include('header_script.php');
$user1 = get_row_col_single1("tbl_login", "*", "id", $aid);?>  
</head>
<?php include('header_remeber.php');?> 
<body class="hold-transition fixed skin-purple-light sidebar-mini ">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?=$base_admin_path;?>/dashboard.php" class="logo"> 
    <span class="logo-mini"></span> 
    <span class="logo-lg"><img src="<?=$base_admin_path;?>/dist/img/crm/favicon.png" width="70px" height="40px"/><b>  LION </b></span> 
    </a>
    
    <!-- Header Navbar -->
    <?php include('header_navbar_action.php');?> 

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar direction">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-right image">
          <img src="<?php echo $path1;?>" class="img-circle" alt="User Image" width="60px !important" height="50px !important">
        </div>
        <div class="pull-left info">
          <p><?php if(!empty($admin_email)){ echo $admin_email;} ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> מחובר</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        
        <!-- Optionally, you can add icons to the links -->
        <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"dashboard.php")==0){echo "active";} ?>">
        <a href="dashboard.php">
        <i class="fa fa-dashboard"></i>
         <span>Dashboard</span>
         </a></li>
         <li class="header">CRM</li>
        <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"user.php")==0){echo "active";} ?>">
        <a href="user.php">
       <i class="ion ion-ios-people-outline" style="font-size:20px;"></i>
         <span>רשימת נציגים</span>
         </a></li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"customer/index.php")==0){echo "active";} ?>">
        <a href="customer/index.php">
        <i class="ion ion-android-contacts" style="font-size:20px;"></i>
         <span>ניהול לקוחות</span>
         	<?php
			 $cuontCustomer= get_count_records_condition_and("tbl_customer ", "reed", "reed", 0,"del",0);
			 if($cuontCustomer!=0)
				    {?>
         <span class="label label-primary pull-right"><?= $cuontCustomer; ?></span>
         	<?php     }?>
         </a></li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"new_customer.php")==0){echo "active";} ?>">
        <a href="new_customer.php">
        <i class="ion ion-android-contacts" style="font-size:20px;"></i>
         <span>מתעניינים</span>
         <?php
				$cuontNewCustomer= get_count_records_condition_and("tbl_history_new_customer ", "reed_admin", "reed_admin", 0,"reed_admin",0);
				if($cuontNewCustomer!=0)
				{?>
		<span class="label label-primary pull-right"><?= $cuontNewCustomer; ?></span>
		<?php     }?>
         </a></li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"history_contact.php")==0){echo "active";} ?>">
        <a href="history_contact.php">
        <i class="ion ion-android-call" style="font-size:20px;"></i>
         <span>קשרי לקוחות</span>
         </a></li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"history_buy_item.php")==0){echo "active";} ?>">
        <a href="history_buy_item.php">
        <i class="ion ion-cash" style="font-size:20px;"></i>
         <span>הזמנות לקוח</span>
         </a></li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"history_cancel_item.php")==0){echo "active";} ?>">
        <a href="history_cancel_item.php">
        <i class="ion-android-close" style="font-size:20px;"></i>
         <span>ביטולים והחזרים</span>
         </a></li>
         <li class="header">דוחות ונתונים</li>
         <li class="<?Php if(strcmp(basename($_SERVER['PHP_SELF']),"Pieces.php")==0){echo "active";} ?>">
        <a href="Pieces.php">
        <i class="fa fa-dashboard"></i>
         <span>דוח חודשי שנתי</span>
         </a></li>
         <li >
        <a href="https://docs.google.com/document/d/1fA6HpOX3yk6c3k8spBrqHZYifL4jWJHAJzJpZ3pdqgU/edit?usp=drivesdk" target="_blank">
        <i class="ion-ios-bookmarks-outline" style="font-size:20px;"></i>
         <span>מדריך למשתמש</span>
         </a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>