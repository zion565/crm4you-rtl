<?php 
include('../../functions-hs/error_header.php');
include('../../functions-hs/functions-hs.php');
include('Controller.php');
error_log('in customer-json');

$data = new Controller;
$all_status = $data->getAllStatus();
$customer = $data->getCustomer();
while($row=$customer->fetch(PDO::FETCH_ASSOC))
    {
        $row['status_id']="";
        
        $row['chexbox'] = '<input  type="checkbox" class="oneCheck" name = "sport" value='.$row['id_customer'].' data-idcus='.$row['id_customer'].' data-namecus='.$row['name_customer'].' >
        '.$row['id_customer'];
        
        $row['created_at'] = date('d/m/Y H:i', $row['created_at']);
        $row['update_at'] = date('d/m/Y H:i', $row['update_at']);
        
        $row['phone_customer']='<a href ="tel:'.$row['phone_customer'].'"><strong>'.$row['phone_customer'].'</strong></a>';
        $row['status_id']= $row['status'];
        $row['status']='<div style="max-width:40px"><label style="background-color:'.$all_status['ArrColor'][$row['status_id']].';color:black;" class="label">'.$all_status['ArrStatus'][$row['status_id']].'</label></div>';
        $row['card']='
        <div class="accordion" id="accordionExample-'.$row['id_customer'].'">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button 
          style="width: 100%;margin-top: -10;margin-bottom: -10;" class="btn" type="button" data-toggle="collapse" data-target="#collapse-'.$row['id_customer'].'" aria-expanded="true" aria-controls="collapse-'.$row['id_customer'].'">
             <div class="row">
             <div class="col-xs-1 text-right">'.$row["id_customer"].'</div>
             <div class="col-xs-4 text-right">'.$row["name_customer"].'</div>
             <div class="col-xs-4 text-center">'.$row["email_customer"].'</div>
             <div class="col-xs-2 text-left">'.$row["phone_customer"].'</div>  
              </div>
              </button>
            </h5>
          </div>
      
          <div id="collapse-'.$row['id_customer'].'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample-'.$row['id_customer'].'">
            <div class="card-body">
            <div class="row">
            <div class="col-xs-3">
            <div style="font-size: 13;">תאריך:</div>
            <div>'.$row["created_at"].'</div>
            <div style="font-size: 13;">עריכה:</div>
            <div>'.$row["update_at"].'</div>
            </div>
            <div class="col-xs-3">
            <div style="font-size: 13;">שם:</div>
            <div>'.$row["name_customer"].'</div>
            <div style="font-size: 13;">אימייל:</div>
            <div>'.$row["email_customer"].'</div>
            </div>
            <div class="col-xs-3">
            <div style="font-size: 13;">פלאפון:</div>
            <div>'.$row["phone_customer"].'</div>
            <div style="font-size: 13;">סטטוס:</div>
            <div>'.$row["status"].'</div>
            </div>
            <div class="col-xs-3">
            <div class="btn-group-vertical pull-left">
                      <button type="button" class="btn btn-sm btn-info change_contact"
                            data-id='.$row['id_customer'].'
                            data-user_id='.$row['user_id'].'
                            data-name_customer="'.$row['name_customer'].'"
                            data-email_customer="'.$row['email_customer'].'"
                            
                            data-status='.$row['status_id'].'
                            data-company_number="'.$row['company_number'].'"
                            data-from_landing="'.$row['from_landing'].'"
                            data-address="'.$row['address'].'"
                            data-date_rem="'.date('Y-m-d', time()).'"
                            data-time_rem="'.date('H:i', time()).'" 
                            data-lid_from="'.$row['from_landing'].'" 
                      >ערוך</button>
                      <button type="button" class="btn btn-sm btn-danger" data-id='.$row['id_customer'].' id="delete_user">מחק</button>
                      
                    </div>
            </div>
            </div>  
            </div>
          </div>
        </div>
        </div>';
        $arr_search[]=$row;
    }
    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($arr_search),
        "iTotalDisplayRecords" => count($arr_search),
        "aaData"=>$arr_search);
    echo json_encode($results);

?>