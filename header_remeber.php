<?php 
if (!isset($_SESSION['remember'])||empty($_SESSION['remember'])) {
    
    $rowrem = get_row_col_remember("tbl_rememberes","*","user_id",0);
    if ($rowrem!="") {
        //     error_log("header-remember");
        //     error_log($rowrem);
        //     error_log($rowrem['date']);
        //     error_log($rowrem['time']);
        $customer_name_rem = get_row_col_single1("tbl_customer", "*", "id", $rowrem['customer_id']);
        $rowremdate=-1;
        if ($rowrem['date']!="") {
            $rowremdate=$rowrem['date'];
        }
        $rowremtime=-1;
        if ($rowrem['time']!="") {
            $rowremtime=$rowrem['time'];
        }
        $_SESSION['remember_customer'] = $customer_name_rem['name'];
        $_SESSION['remember_customer_email'] = $customer_name_rem['email'];
        $_SESSION['remember_customer_phone'] = $customer_name_rem['phone'];
        $_SESSION['remember_content'] = $rowrem['content'];
        $_SESSION['remember_date'] = $rowremdate;
        $_SESSION['remember_time'] = $rowremtime;
        $_SESSION['remember_id'] = $rowrem['id'];
        $_SESSION['remember'] = "have_remember";
        //     error_log("the session in haeder after session full");
        //     error_log(print_r($_SESSION,true));
    }
}
?>
<!--/*******************************************************/-->
<div class="modal fade" id="myModalremember" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%">
        <div class="modal-dialog ">
          <div class="modal-content">
           <div  id="modal-header-remember" class="modal-header label-info" >
            <h4 id="edit_credit_form_title" class="modal-title">תזכורת</h4>
         </div>
         <div class="modal-body" id="remcontent"> 
           
                
            </div>
            <div class="modal-footer">
            	<input type="hidden" id="idrem" name="idrem">
               <label class="control-label">הזכר לי בעוד: </label>
                <select  onchange="nudnick_rem()" id="nudnick_selected">
                 	<option value=0></option>
                 	<option value=1>1</option>
                 	<option value=5>5</option>
			 		<option value=10>10</option>
			  		<option value=15>15</option>
			   		<option value=20>20</option>
			    	<option value=30>30</option>
				</select>
                <label class="control-label">דקות</label>
                <button type="button" class="btn btn-default" style="color: green;" onClick="sucsses_rem(<?php echo $_SESSION['remember_id'];?>)">בוצע</button>
                <button type="button" class="btn btn-default" style="color: red;" onClick="close_rem(<?php echo $_SESSION['remember_id'];?>)">סגור\מחק</button>
              </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
<?php if(!empty($_SESSION['remember'])&&$_SESSION['remember']=="have_remember"){ ?>
new_show_remmember();
<?php }?>

function new_show_remmember(){
var daterem = <?php if(isset($_SESSION['remember_date'])){echo $_SESSION['remember_date'];}else{echo -1;} ?>;
var timerem = <?php if(isset($_SESSION['remember_time'])){echo $_SESSION['remember_time'];}else{echo -1;} ?>;
console.log(timerem);
var customerrem = "<?php if(isset($_SESSION['remember_customer'])){echo $_SESSION['remember_customer'];}else{echo -1;} ?>";
var customerrememail = "<?php if(isset($_SESSION['remember_customer_email'])){echo $_SESSION['remember_customer_email'];}else{echo -1;} ?>";
var customerremphone = "<?php if(isset($_SESSION['remember_customer_phone'])){echo $_SESSION['remember_customer_phone'];}else{echo -1;} ?>";
var contentrem = "<?php if(isset($_SESSION['remember_content'])){echo $_SESSION['remember_content'];}else{echo -1;} ?>";
var idrem = "<?php if(isset($_SESSION['remember_id'])){echo $_SESSION['remember_id'];}else{echo -1;} ?>";

var date_remember =new Date(daterem*1000);
var day = date_remember.getDate();
var muonth = date_remember.getMonth()+1; //January is 0!
var yaer = date_remember.getFullYear();

var time_remember =new Date(timerem*1000);
var minutes = time_remember.getMinutes();
var huower = time_remember.getHours();

if(day<10){
	day='0'+day;
} 
if(muonth<10){
	muonth='0'+muonth;
} 

var new_date_remember = day+'/'+muonth+'/'+yaer;
var new_time_remember =  huower+':'+minutes;
// console.log("thedaressssssssssssssssssssssssssssss");
// console.log(new_date_remember);
// console.log(new_time_remember);

var now = new Date();
var nowtime = now.getTime();
var date_remember2 =daterem*1000;
if(nowtime>=date_remember2){
	var time_remember2 =timerem*1000;
	var timemillisecend =time_remember2 - nowtime;
	console.log(timemillisecend);
	//alert("the time millisecend is "+timemillisecend);
	setTimeout(function(){
		 //alert("you have remmeber now");
		 var tabledCustomerDitalis = '<div  style="max-width: 250px !important;">'+
            ' <table class="table-ditalis" style="padding: 2px;width: 100%;max-width:20px !important;">'+
        ' <tbody>'+
        ' <tr >'+
         '<th style=" text-align: right;"><strong>שם</strong></th>'+
        ' <td ><strong>'+customerrem+'</strong></td>'+
        ' </tr>'+
        ' <tr >'+
        ' <th style=" text-align: right;"><strong>אימייל</strong></th>'+
        ' <td ><strong>'+customerrememail+'</strong></td>'+
        ' </tr>'+
        ' <tr >'+
        ' <th style=" text-align: right;"><strong>פלאפון</strong></th>'+
        ' <td ><a href ="tel:'+customerremphone+'"><strong>'+customerremphone+'</strong></a></td>'+
        ' </tr>'+
         '</tbody></table></div>';
		$('#modal-header-remember').append('<p>'+new_date_remember+'&emsp;&emsp;&emsp;'+new_time_remember+' </p>');   
		$('#remcontent').html('<p><strong>'+ contentrem +'</strong></p>'+'<p>תזכורת משוייכת ללקוח:</p>'+tabledCustomerDitalis); 
		$('#idrem').val(idrem);
		$('#myModalremember').modal('show');
		
		 }, timemillisecend);
}
// else{
// 	alert('no have remeber today');
// }
}

function close_rem(idrem){
	var dataremclose ={
			'idrem' : idrem	
		}
	$.ajax({ 
		type: "POST",
		url: 'api/rememberes.php?action=delete',
		data: dataremclose,
		success: successFuncremclose,
		error: errorFuncrem
	});
	function successFuncremclose(data, status) {
		//setTimeout(function(){
	      	  //$("#myModalLion").modal("hide");
	  			//$("#loadingLion").hide();
	          //   }, 2000);
		//$('#example1').DataTable().ajax.reload(null,false);
		
		$.notify("נמחק בהצלחה!",'success');
		$('#myModalremember').modal('hide');
		window.location.reload();
		//alert("נוצר בהצלחה");
	}
	
	function errorFuncrem() {
		alert('error');
		//setTimeout(function(){
  	      	  //$("#myModalLion").modal("hide");
  	  			//$("#loadingLion").hide();
  	            // }, 2000);
			
	}
}
function sucsses_rem(idrem){
	var dataremsucsses ={
			'idrem' : idrem	
		}
	$.ajax({ 
		type: "POST",
		url: 'api/rememberes.php?action=sucsses',
		data: dataremsucsses,
		success: successFuncremsucsses,
		error: errorFuncrem
	});
	function successFuncremsucsses(data, status) {
		$.notify("בוצע בהצלחה!",'success');
		$('#myModalremember').modal('hide');
		window.location.reload();
		//new_show_remmember();
		//alert("נוצר בהצלחה");
	}
	
	function errorFuncrem() {
		alert('error');			
	}
}
function nudnick_rem(){
	var dataremnudnick ={
			'idrem' : $('#idrem').val(),
			'timer' : $('#nudnick_selected').val()	
		}
	$.ajax({ 
		type: "POST",
		url: 'api/rememberes.php?action=nudnick',
		data: dataremnudnick,
		success: successFuncremnudnick,
		error: errorFuncrem
	});
	function successFuncremnudnick(data, status) {
		$.notify("בוצע בהצלחה!",'success');
		$('#myModalremember').modal('hide');
		window.location.reload();
		//new_show_remmember();
		//alert("נוצר בהצלחה");
	}
	
	function errorFuncrem() {
		alert('error');
	}
}
</script>
<!--/*******************************************************/-->