    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu"><a href="#" class="dropdown-toggle"
			data-toggle="dropdown" aria-expanded="false"> <i
				class="fa fa-envelope-o"></i> 
				<?php
				$cuontMesseg= get_count_records_condition_and("tbl_messeg ", "reed", "send_to_admin", $aid,"reed",0);
				if($cuontMesseg!=0)
				{?>
				<span class="label label-success"><?php echo $cuontMesseg; ?></span>
				<?php }?>
		</a>
			<ul class="dropdown-menu">
				<li class="header"><?php echo "יש לך "; ?><?php echo get_count_records_condition("tbl_messeg ", "*", "send_to_admin", $aid);?><?php echo " הודעות"; ?></li>
				<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
					<?php    
   $requestData= $_REQUEST;
   $arr_search=array();
   $user_id=$user1['id']; 
    $query = "SELECT DISTINCT tbl_messeg.*,s.img,ads.img as img_admin,s.name as name_send,
                 ads.admin_name as admin_name_send,i.name as name_inbox,adi.admin_name as admin_name_inbox 
                FROM tbl_messeg 
                LEFT JOIN tbl_user as s ON s.id = tbl_messeg.user_id 
                LEFT JOIN tbl_user as i ON i.id = tbl_messeg.send_to 
                LEFT JOIN tbl_login as ads ON ads.id = tbl_messeg.admin_id 
                LEFT JOIN tbl_login as adi ON adi.id = tbl_messeg.send_to_admin
                WHERE tbl_messeg.send_to_admin='$user_id'";
	   $stmt=$db->query($query);
	   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	   {
	       if($row['admin_id']!=0){
	           
	           $path2 = $base_admin_path."/dist/img/crm/admin/" . $row['admin_id'] ;
	      
//     	       if (! is_dir($path2)) {
    	           
//     	           $path2 = $base_path_scripts."/dist/img/admin/user.jpg" ;
//     	       }else{
//     	           $path2 = $base_path_scripts."/dist/img/admin/" . $row['admin_id'] . "/" . $row['img_admin']."?".time();
//     	       }
    	       
    	       $name_send = $row['admin_name_send'];
	       
	       }else{
	           
	           $path2 = $base_admin_path."/dist/img/crm/user/" . $row['user_id'] ;
	           
// 	           if (! is_dir($path2)) {
	               
// 	               $path2 = $base_path_scripts."/dist/img/user/user.jpg" ;
// 	           }else{
// 	               $path2 = $base_path_scripts."/dist/img/user/" . $row['user_id'] . "/" . $row['img']."?".time();
// 	           }
	           
	           $name_send = $row['name_send'];
	           
	       }
	       
	       $row['content']=str_replace(array('"'), array('\''),$row['content']);
	       
	       if (date('Y-m-d') == date('Y-m-d',$row['time'])) {
	           $format_date=  "היום ב ".date('H:i', $row['time']);
	           $row['time']=$format_date;
	       }else{
	           $format_date=  date('d/m/y H:i', $row['time']);
	           $row['time']=$format_date;
	       }
	      ?>
						<li>
							<!-- start message --> <a href="#">
								<div class="pull-left">
									<img src="<?php echo $path2;?>" class="img-circle"
										alt="User Image">
								</div>
								<div class="pull-left">
								<small><i class="fa fa-clock-o"></i> <?php echo $row['time'];?></small>
								</div>
								<h4>
									<?php echo $name_send;?>
								</h4>
						</a>
						<?php echo $row['content'];?>
						</li>
						<!-- end message -->
						<?php }?>
					</ul>
				</li>
				<li class="footer"><a href="messeges.php">בדוק את כל ההודעות</a></li>
			</ul></li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <?php $cuontRemember= get_count_records_condition_return_in("tbl_rememberes ", "id", "status","(0,2)");
		
		$query="SELECT tbl_rememberes.id,
                    tbl_rememberes.date,
                    tbl_rememberes.date as date_edit,
                    tbl_rememberes.time,
                    tbl_rememberes.time as time_edit,
                    tbl_rememberes.content,
                    tbl_rememberes.status,
                    tbl_user.id as user_id,
                    tbl_user.name as user_name,
                    tbl_customer.id as customer_id,
                    tbl_customer.name as customer_name,
                    tbl_customer.email as customer_email,
                    tbl_customer.phone as customer_phone
                     FROM tbl_rememberes
                    LEFT JOIN tbl_user ON tbl_user.id = tbl_rememberes.user_id
                    INNER JOIN tbl_customer ON tbl_customer.id = tbl_rememberes.customer_id
                    ORDER BY tbl_rememberes.date DESC ,tbl_rememberes.time ASC ";
		$stmt=$db->query($query);
		
		?>
		
		<li class="dropdown notifications-menu"><a href="#"
			class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<i class="fa fa-bell-o"></i> <span class="label label-warning"><?php echo $cuontRemember; ?></span>
		</a>
			<ul class="dropdown-menu">
				<li class="header">יש לך <?php echo $cuontRemember;?> משימות\תזכורות חדשות </li>
				<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
					<?php while($rowremAction=$stmt->fetch(PDO::FETCH_ASSOC))
	                           	{
	                           	    switch ($rowremAction['status']) {
	                           	        case 0:
	                           	            $status_to_show="תזכורת פעילה";
	                           	            $row_credit_color="#ffbb008f";
	                           	            break;
	                           	        case 1:
	                           	            $status_to_show="בוצע";
	                           	            $row_credit_color="#14c40e73";
	                           	            break;
	                           	        case 2:
	                           	            $status_to_show="הושהה";
	                           	            $row_credit_color="#ff00008f";
	                           	            break;
	                           	            
	                           	            break;
	                           	    }
	                           	    
	                           	    $rowremAction['content']=str_replace(array('"'), array('\''),$rowremAction['content']);
	                           	    
	                           	    if (date('Y-m-d') == date('Y-m-d',$rowremAction['date'])) {
	                           	        $format_date_rem=  "היום ב ".date('H:i', $rowremAction['time']);
	                           	        $rowremAction['date']=$format_date_rem;
	                           	    }else{
	                           	        $format_date_rem=  date('d/m/y', $rowremAction['date']);
	                           	        $format_date_rem .=" ";
	                           	        $format_date_rem .=  date('H:i', $rowremAction['time']);
	                           	        $rowremAction['date']=$format_date_rem;
	                           	    }
	                           	    ?>
						<li>
							<!-- start message --> <a href="remember.php">
								<div class="pull-left" style="background-color: <?php echo $row_credit_color;?>;">
								<small><i class="fa fa-clock-o"></i> <?php echo $rowremAction['date'];?></small><br>
								<small><?php echo $status_to_show;?></small>
								</div>
								<h4>
									<?php echo $rowremAction['customer_name'];?>
								</h4>
								<?php echo $rowremAction['content'];?>
						</a>
						</li>
						
						<?php }?>
						<li><a href="#"> <i class="fa fa-warning text-yellow"></i> Very
								long description here that may not fit into the page and may
								cause design problems
						</a></li>
					</ul>
				</li>
				<li class="footer"><a href="remember.php">הצג הכל..</a></li>
			</ul></li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
            
            if ($user1['img']=="") {
                
                $path1 = $base_admin_path."/dist/img/crm/admin/user.jpg" ;
            }else{
                $path1 = $base_admin_path."/dist/img/crm/admin/" . $user1['id'] . "/" . $user1['img']."?".time();
            }
            ?>
              <img src=<?php echo $path1;?> class="user-image" alt="User Image"> 
              <span class="hidden-xs"><?php echo $user1['admin_name'];?></span>
		</a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" id="profilSow"><img
					src="<?php echo $path1;?>" class="img-circle"
					alt="User Image">

					<p><?php echo $user1['admin_name'];?> - מנהל</p>
					<p>
						<small class="pull-right"><?php if(!empty($admin_email)){ echo $admin_email;} ?></small>
						<small class="pull-left"><?php echo $user1['phone']; ?></small>
					</p></li>
					
					<li class="user-header hide" id="profilCustomerSow">
					<div class="row">
					&ensp;
						<i class="ion ion-android-contacts " style="font-size:90px;"></i>
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						<font style="weight:bold" color="#397047"size="60px"><?php get_count_records_condition_all("tbl_customer", "*");?> </font>
					&ensp;
					</div>
					<p>לקוחות בטיפול</p>
					</li>
					<li class="user-header hide" id="profilSelsSow">
					<div class="row">
					&ensp;
						<i class="ion ion-cash " style="font-size:90px;"></i>
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						<font style="weight:bold" color="#96714C"size="60px"><?php get_count_records_condition_all("tbl_history_items", "*");?> </font>
					&ensp;
					</div>
					<p>מוצרים שנמכרו</p>
					</li>
					<li class="user-header hide" id="profilContactSow">
					<div class="row">
					&ensp;
						<i class="ion ion-android-call " style="font-size:90px;"></i>
						&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
						<font style="weight:bold" color="#3D3D69"size="60px"><?php get_count_records_condition_all("tbl_contact", "*");?> </font>
					&ensp;
					</div>
					<p>שיחות שהתקיימו</p>
					</li>
				<!-- Menu Body -->
				<li class="user-body">
					<div class="row">
						<div class="col-xs-4 text-center">
							<a  id="profilCustomer">לקוחות </a>
						</div>
						<div class="col-xs-4 text-center">
							<a  id="profilSels">מכירות</a>
						</div>
						<div class="col-xs-4 text-center">
							<a  id="profilContact">שיחות</a>
						</div>
					</div> <!-- /.row -->
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<a href="#" data-toggle="control-sidebar"
							class="btn btn-default btn-flat">עריכת פרופיל</a>
					</div>
					<div class="pull-right">
						<a href="logout.php" class="btn btn-default btn-flat">יציאה</a>
					</div>
				</li>
			</ul></li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <script >
  var is_new_mail = false;
$( document ).ready(function() {
	
	$('#profilCustomer').hover(function(){
	   
	    	
	    	$("#profilCustomerSow").removeClass('hide');
	    	$("#profilSow").addClass('hide');
	    	$("#profilSelsSow").addClass('hide');
	    	$("#profilContactSow").addClass('hide');
	    	
	   
	});
	$('#profilSels').hover(function(){
		   
    	
    	$("#profilSelsSow").removeClass('hide');
    	$("#profilCustomerSow").addClass('hide');
    	$("#profilSow").addClass('hide');
    	$("#profilContactSow").addClass('hide');
    	
    	
   
});
	$('#profilContact').hover(function(){
		   
    	
		$("#profilContactSow").removeClass('hide');
    	$("#profilCustomerSow").addClass('hide');
    	$("#profilSow").addClass('hide');
    	$("#profilSelsSow").addClass('hide');
    	
   
});
$('.user-header').hover(function(){
		   
    	
		$("#profilSow").removeClass('hide');
    	$("#profilCustomerSow").addClass('hide');
    	$("#profilContactSow").addClass('hide');
    	$("#profilSelsSow").addClass('hide');
    	
   
});
});

</script>
    