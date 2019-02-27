<?php 
include('sys_vars.php');
include('email_functions.php');

require(BASE_PATH_DB.'/DBConnection.php');
use DB\DBConnection;

/***************************************************************************************************************/
/*WEBSITE CONSTANT*/
/***************************************************************************************************************/

date_default_timezone_set('Israel');
/***************************************************************************************************************/
/*DATABASE CONNECTIVITY CODE*/
/***************************************************************************************************************/

function get_db() {
    static $db;
    
    if ($db == null) {
        $config = get_system_config();
        $dbConfig = $config['database'];
        $db = new DBConnection($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);
    }
    
    return $db;
}
function get_system_config() {
    static $config;
    if ($config == null) {
        $configFile = __DIR__ . '/config.php';
        if (!file_exists($configFile)) {
            copy(__DIR__ . '/config.dist.php', $configFile);
        }
        $config = include $configFile;
    }
    
    return $config;
}
function get_path($path) {
    $config = get_system_config();
    
    return rtrim($config['paths'][$path], '/').'/';
}
/*************************************************************************************************************/
/*This Function Used For Get Base URL*/
/*************************************************************************************************************/
function get_base_url()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

/*************************************************************************************************************/
/*This Function Used For Executing Select Query On Condition Base*/
/*************************************************************************************************************/
function get_row_col_single( $table_name, $col_name, $cond_col_name, $cond_col_value)
{ 
  $db=get_db();
  if($table_name!=" " && $col_name!=" " && $cond_col_name!=" " && $cond_col_value!=" ")
  {
    $stmt=$db->query("SELECT $col_name FROM $table_name WHERE $cond_col_name=$cond_col_value");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
  }
}
/*************************************************************************************************************/
/*This Function Used For Executing Select Query On Condition Base*/
/*************************************************************************************************************/
function get_row_col_single1( $table_name, $col_name, $cond_col_name, $cond_col_value)
{ 
  $db=get_db();
  if($table_name!=" " && $col_name!=" " && $cond_col_name!=" " && $cond_col_value!=" ")
  {
    $stmt=$db->query("SELECT $col_name FROM $table_name WHERE $cond_col_name='$cond_col_value'");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
  }
}
/*************************************************************************************************************/
/*This Function Used For Executing Select Query On Condition Base*/
/*************************************************************************************************************/
function get_row_col_remember( $table_name, $col_name, $cond_col_name, $cond_col_value)
{
    
    $db=get_db();
    $stmt=$db->query("SELECT $col_name FROM $table_name WHERE $cond_col_name=$cond_col_value AND status != 1 order by date ASC, time ASC");
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
    return $row;
    
}
/*************************************************************************************************************/
/*This Function Used For Print The Array Made By Implode Function One By One*/
/*************************************************************************************************************/ 
function get_print_array( $table_name, $col_name, $cond_col_name, $cond_col_value )
{ 
  global $fuel_list;
  $db=get_db();
  if($table_name!=" " && $col_name!=" " && $cond_col_name!=" " && $cond_col_value!=" ")
  {
   for($i=0; $i<sizeof($cond_col_value); $i++)
   {
    $stmt=$db->query("SELECT $col_name FROM $table_name WHERE $cond_col_name=".$cond_col_value[$i]."");
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
	 $fuel_list=$row['fuel_type'].",";
	 echo $fuel_list;
	}
	}
  }
}
/*************************************************************************************************************/
/*This Function Used For Dropdown*/
/*************************************************************************************************************/ 
function get_select_list( $table_name, $col_name1, $col_name2, $selected_value='')
{
     $db=get_db(); 
	 if($table_name!=" " && $col_name1!=" " && $col_name2!=" ")
	 {
	  $stmt=$db->query("Select $col_name1,$col_name2 From $table_name"); 
	  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	  {
	   if(strcmp($row[$col_name1],$selected_value)==0)
	   {	
	    $sel="Selected";
	    echo $list="<option value=".$row[$col_name1]." $sel>".$row[$col_name2]."</option>";
	   }
	   else
	   {
	    echo $list="<option value=".$row[$col_name1].">".$row[$col_name2]."</option>";	 
	   }   
	  } 
	 }
}
/*************************************************************************************************************/
/*This Function Used For Upload Image File*/
/*************************************************************************************************************/ 
function get_upload_image_file( $path, $file_name, $sourcepath )
{
 global $file_rename;
 $valid_extensions = array("jpeg", "jpg", "png", "JPEG", "PNG", "JPG");
 $ext = pathinfo($file_name, PATHINFO_EXTENSION);
 if(in_array($ext,$valid_extensions))
 {  
  $file_rename=date('d-m-Y')."_".rand().".".$ext;
  move_uploaded_file($sourcepath,$path.$file_rename);
 }
 return $file_rename;
}
/*************************************************************************************************************/
/*This Function Used For Delete Table Row On Condition Based*/
/*************************************************************************************************************/ 
function row_update_delete_on_condition( $table_name, $cond_col_name, $cond_col_val, $message )
{
    $db=get_db();
    $stmt = $db->query("update $table_name set del = 1  where $cond_col_name = $cond_col_val");
    return $message;
}

function row_delete_on_condition( $table_name, $cond_col_name, $cond_col_val, $message )
{ 
 $db=get_db();  
 $stmt = $db->query("DELETE FROM $table_name WHERE $cond_col_name=".$cond_col_val);
 return $message;
}
/*************************************************************************************************************/
/*This Function Used For Delete Table Row On Condition Based*/
/*************************************************************************************************************/ 
function get_generated_buyer_id($table_name,$col_name)
{
 $db=get_db();  
 $stmt=$db->query("SELECT $col_name FROM $table_name ORDER BY $col_name DESC LIMIT 1");
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if($row[$col_name]=="")
 {
   $random_number="buyer_"."1001";
   return $random_number;
 }
 else if($row[$col_name]!="")
 {
  $random_number=substr($row[$col_name],6);
  $random_number=$random_number+1;
  $random_number="buyer_".$random_number;
  return $random_number;
 }
}
/*************************************************************************************************************/
/*This Function Used For Counting Records*/
/*************************************************************************************************************/
function get_count_records($table_name,$col_name)
{
   $db=get_db();  
   $stmt=$db->query("SELECT COUNT($col_name) AS labelcount FROM $table_name");
   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   echo $row['labelcount'];
}
/*************************************************************************************************************/
/*This Function Used For Downloading*/
/*************************************************************************************************************/ 
function download_file($filename)
{
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($filename).'"'); 
header('Content-Length: ' . filesize($filename));
ob_clean();
flush();
readfile($filename);
}
/*************************************************************************************************************/
/*This Function Used For Counting Records*/
/*************************************************************************************************************/
/* function get_count_records($table_name, $col_name, $wer, $werval)
{
    $db=get_db();
    if ($wer=="" && $werval==0){
        
        $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name ");
        
    }else{
        $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name WHERE $wer='$werval'");
        
    }
    
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['labelcount'];
} */
function get_count_records_wer($table_name, $col_name, $wer, $werval)
{
    $db=get_db();
    
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name WHERE $wer='$werval'");
    
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['labelcount'];
} 
function get_count_records_wer_return($table_name, $col_name, $wer, $werval)
{
    $db=get_db();
    
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name WHERE $wer='$werval'");
    
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row['labelcount'];
} 
/*************************************************************************************************************/
/*This Function Used For Counting Records*/
/*************************************************************************************************************/
function get_count_records_condition_all($table_name, $col_name)
{
    $db=get_db();
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name ");
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['labelcount'];
}
function get_count_records_condition_and($table_name, $col_name,$cond_column,$cond_val,$cond_column_and,$cond_val_and)
{
    $db=get_db();
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcountand FROM $table_name WHERE $cond_column='$cond_val' && $cond_column_and='$cond_val_and'");
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row['labelcountand'];
}
function get_count_records_condition_return_in($table_name, $col_name,$cond_column,$cond_val)
{
    $db=get_db();
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcountand FROM $table_name WHERE $cond_column IN $cond_val");
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row['labelcountand'];
}
function get_count_records_condition($table_name, $col_name,$cond_column,$cond_val)
{
    $db=get_db();
    $stmt=$db->query("SELECT COUNT('$col_name') AS labelcount FROM $table_name WHERE $cond_column='$cond_val'");
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['labelcount'];
}
/*************************************************************************************************************/
/*This Function Used For Downloading*/
/*************************************************************************************************************/ 
function send_email_to_buyer($to)
{
        $adminEmail = 'zioncrm@crm4you.com';
        $adminName = 'CRM';
        $to = $to;
        $subject = "You have received one mail";
        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= '<tr>';
        $message .= '<td colspan="2"><img src="http://crm4you.co.il/favicon.png" /></td>';
        $message .= '</tr>';
        $message .= '<tr style="background: #eee;">';
        $message .= '<td colspan="2"><strong>Your details have been seen.</strong></td>';
        $message .= '</tr>';
        $message .= '</body></html>';
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "From: " . $adminName . "<" . $adminEmail . ">" . "\r\n";
        $send = mail($to, $subject, $message, $headers);
}

?>