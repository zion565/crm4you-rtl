<?php include('../header.php');


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 dir="rtl">
        ניהול לקוחות
        <small>טבלת ניהול לקוחות ופרטים מטבלאות אחרות</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" style="width:100%" class="table direction table-bordered table-striped">
                <thead id="Thide">
                <tr>
                  <th>טוען...</th>
                  
                </tr>
                </thead>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table direction table-bordered table-striped">
                <thead>
                <tr>
                  <th>מס' סידורי</th>
                  <th>תאריך </th>
                  <th>שם</th>
                  <th>אימייל</th>
                  <th>פלאפון</th>
                  <th>סטאטוס</th>
                </tr>
                </thead>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('../footer.php');?>
<!-- page script -->
<!-- /*******************************reload_table*******************************************/ -->
<?php include('relode_tabel_script.php'); ?>
<!-- /*******************************reload_table*******************************************/ -->
<script>
reloadTable();
</script>
<!-- /************************show_models_functions_script**************************/ -->
<?php include('models.php'); ?>
<!-- /********************end show_models_functions_script**************************/ -->

<!-- /************************show_models_functions_script**************************/ -->
<?php include('show_models_functions_script.php'); ?>
<!-- /********************end show_models_functions_script**************************/ -->

<!-- /************************action_function_script**************************/ -->
<?php include('action_function_script.php'); ?>
<!-- /********************end action_function_script**************************/ -->
