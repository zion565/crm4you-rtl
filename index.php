<?php 
session_start();

include('functions-hs/error_header.php');
include('functions-hs/functions-hs.php');

/* Get Base Folder Path */
$base_path = get_base_url();
$base_user_path = $base_path."/adminlte_rtl";

if(isset($_SESSION['admin_email'])&&isset($_SESSION['aid'])){
    header( 'Location: dashboard.php' ) ;
}

$db= get_db();
if(isset($_POST['user_email']) && isset($_POST['user_password']))
{
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    error_log("user-email= ".$user_email);
    error_log("user-pass= ".$user_password);
    
//extract($_POST);
$stmt=$db->query("SELECT * FROM tbl_login WHERE email_id='$user_email' && password='$user_password'"); 
$query_result=$stmt->fetch(PDO::FETCH_ASSOC);
error_log(print_r($query_result,true));
if($query_result>0)
  { 
     $_SESSION['admin_email']=$user_email;
     $_SESSION['aid'] = $query_result['id'];
     setcookie("cookie_admin_email",$user_email, time() + (10 * 365 * 24 * 60 * 60));
     setcookie("cookie_admin_password",$user_password, time() + (10 * 365 * 24 * 60 * 60));
     echo "<script>window.location.href='dashboard.php'</script>";
  } 
else
 {
     
      echo "<script>alert('בבקשה בדוק אם השם משתמש או הסיסמא נכונים.');</script>";
      unset($_POST);
      echo "<script>window.location.href='index.php'</script>";
 }
} 


?>
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo SITE_TITLE; ?></title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $base_path;?>/vendor-sb/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo $base_path;?>/vendor-sb/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo $base_path;?>/css/sb-admin.css" rel="stylesheet">
  <link rel="icon" href="<?php echo $base_path;?>/dist/img/favicon.ico" type="image/x-icon">
  
  <link rel="stylesheet" href="..<?= PLUGINS_DIR ?>/iCheck/square/blue.css">
</head>

<body class="bg-dark text-right" dir="rtl" >
  <div class="container">
    <div class="card card-login mx-auto mt-5 show">
      <div class="card-header">
   כניסה אדמין!
    <div class="pull-left"><span class="logo-mini"><b></b></span> <span class="logo-lg"><b>  LION </b><b><img src="<?php echo $base_path;?>/dist/img/favicon.ico" width="70px" height="40px" /></b></span> </div>
    </div>
      
      <div class="card-body">
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">דואר אלקטרוני</label>
            <input name="user_email" class="form-control" id="user_email" type="email" aria-describedby="emailHelp" placeholder="הכנס אימייל">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">סיסמא</label>
            <input name="user_password" class="form-control" id="user_password" type="password" placeholder="סיסמא">
          </div>
          <div class="form-group">
            <div class="form-check pull-left" >
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox">&nbsp;&nbsp;&nbsp; זכור סיסמא</label>
            </div>
          </div>
          <br>
          <br>
          <button class="btn btn-primary btn-block" type="submit">התחבר</button>
        </form>
        <div class="text-center">
          
          <div class="from-row mt-3">
          <div class="col-xs-4 "><a class="d-block small" id="resetpassword" href="#">אפס סיסמא</a></div>
          <div class="col-xs-4 "><a class="d-block small" id="forgetPassword" href="#">שחכת סיסמא?</a></div>
          </div>
         
        </div>
      </div>
    </div>
    <div class="card card-login mx-auto mt-5 hide hide1">
     <div class="card-header">
    שחזור סיסמא
    <div class="pull-left"><span class="logo-mini"><b></b></span> <span class="logo-lg"><b>  LION </b><b><img src="<?php echo $base_path;?>/dist/img/favicon.ico" width="70px" height="40px" /></b></span> </div>
    </div>
    <div class="card-body ">
      
        <form name="forgetPassword">
          <div class="form-group">
            <label for="exampleInputEmail1">דואר אלקטרוני</label>
            <div id="forgetMess" class=""> </div>
            <input name="frmEmail" id="frmEmail" class="form-control"  type="email" aria-describedby="emailHelp" placeholder="הכנס אימייל">
          </div>
          <br>
          <br>
          <div class="from-row">
         <div class="col-xs-6" style="float:center;"> <a class=" btn btn-primary btn-block" id="sendInformation">שחזר סיסמא</a></div>
          </div>
          </form>
        <div class="text-center mt-3"><a class="d-block small" href="index.php">חזרה לדף כניסה</a></div>
      </div>
      
      
    </div>
    <div class="card card-login mx-auto mt-5 repw">
      <div class="card-header">
    איפוס סיסמא
    <div class="pull-left"><span class="logo-mini"><b></b></span> <span class="logo-lg"><b>  LION </b><b><img src="<?php echo $base_path;?>/dist/img/favicon.ico" width="70px" height="40px" /></b></span> </div>
    </div>
      
      <div class="card-body">
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">דואר אלקטרוני</label>
            <input name="user_exist_email" id="user_exist_email" class="form-control"  type="email" aria-describedby="emailHelp" placeholder="הכנס אימייל">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">סיסמא</label>
            <input name="user_password" id="user_exist_password" class="form-control" type="password" placeholder="סיסמא">
          </div>
          <div class="from-row">
          <div class="form-group col-xs-4">
            <label for="exampleInputPassword1">סיסמא חדשה</label>
            <input name="user_new_password" id="user_new_password" class="form-control" type="password" placeholder="סיסמא">
          </div>
          <div class="form-group col-xs-4">
            <label for="exampleInputPassword1">אשר סיסמא חדשה</label>
            <input name="user_new_confirm_password" id="user_confirm_password" class="form-control" type="password" placeholder="סיסמא">
          </div>
          </div>
         <br>
          <br>
          <div class="from-row">
         <div class="col-xs-6" style="float:center;"> <a class=" btn btn-primary btn-block" id="reset_request">אפס סיסמא</a></div>
          </div>
          </form>
        <div class="text-center mt-3"><a class="d-block small" href="index.php">חזרה לדף כניסה</a></div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $base_path;?>/vendor-sb/jquery/jquery.min.js"></script>
  <script src="<?php echo $base_path;?>/vendor-sb/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo $base_path;?>/vendor-sb/jquery-easing/jquery.easing.min.js"></script>
  
  <script src="<?= PLUGINS_DIR ?>/iCheck/icheck.min.js"></script>
  <script src="<?= PLUGINS_DIR ?>/validatejs/jquery.validate.js"></script>
  
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
  <script type="text/javascript">
 $('#forgetPassword').click(function(){
	 $('#frmEmail').val( $('#user_email').val());
    $('.show').addClass('hide');
    $('.hide1').removeClass('hide');
    
 });
 $('#frmEmail').keyup(function() {
    $('#forgetMess').html('');
 });
  $('#backTo').click(function(){
    $('.hide1').addClass('hide');
    $('.show').removeClass('hide');
 });
 
 $('.repw').hide();

$(function () {
    
           $('#sendInformation').on('click', function () {
              var validate = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              var email = $('#frmEmail').val();
              if (email == '')
              {
                    alert("בבקשה הכנס אימייל");                
                   $('#forgetMess').html('<p class="text-danger"><strong>* שדה זה חובה !</strong></p>');
              } else if (!(validate.test(email)))
              {
                   $('#forgetMess').html('<p class="text-danger"><strong>* בבקשה הכנס כתובת מייל תקינה !</strong></p>');
              } else
              {
              $('#forgetMess').html('');
              $.ajax({
              url: 'functions-hs/pass_functions.php',
              type: 'POST',
              data: {action: 'fogetPassword', val: email},
              dataType: "json",
              success: function (data) {
              console.log(data);
              if (data['status'] == 'warning')
              {
                alert("אימייל לא קיים במערכת");
      		 $('#forgetMess').html('<p class="text-danger"><strong>* אימייל לא קיים !</strong></p>');
              }else if(data['status']=='error')
             {
                alert("error to send email");
             $('#forgetMess').html('<p class="text-danger"><strong>* ישנה בעיה בשליחת הסיסמה החדשה !</strong></p>');
             }else if(data['status']=='success')
            {
                alert("success to send email");
            $('#forgetMess').html('<p class="text-success"><strong>שחזור בוצע בהצלחה ! בבקשה בדוק את תיבת המייל שלך לאימות השחזור</strong></p>'); 
             }
            }
           });
       }
   });
   
    
    $("#resetpassword").on('click',function() {
        $('.repw').show();
        $('.show').addClass('hide');
    });   
    
    $("#reset_back").on('click',function(){
        $('.show').removeClass('hide');
        $('.repw').hide();
    });
    
    $("#reset_request").on('click',function(){
        var exist_email = $("#user_exist_email").val();
        var exist_pwd = $("#user_exist_password").val();
        var new_pwd = $("#user_new_password").val();
        var new_cfm_pwd = $("#user_confirm_password").val();
        
        if( new_pwd != new_cfm_pwd){
            alert("הסיסמאות לא תואמות");
            $("#user_new_password").val("");
            $("#user_confirm_password").val("");
            
            return ;
        }
        $.ajax({
            url : 'functions-hs/pass_functions.php',
            type : 'POST',
            data : {action: 'resetpassword', email: exist_email, exist_pwd: exist_pwd, new_pwd: new_pwd},
            dataType : "json",
            success : function(data){
                
                if(data == "0"){
                    alert("User name or Passord wrong");
                    $("#user_exist_email").val("");
                    $("#user_exist_password").val("");
                    $("#user_new_password").val("");
                    $("#user_confirm_password").val("");
                }else if(data == "1"){
                    alert("successfully updated");
                    $('.show').removeClass('hide');
                    $('.repw').hide();
                }else{
                    alert("error when update to database");
                }
                
            }  
            
            
        });
        
    });

});
</script>
  
</body>

</html>