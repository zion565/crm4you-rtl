<?php

class Controller
{
    protected $config;
    protected $db;

    public $createErrors = [];

    public function __construct()
    {
        
        $this->db = get_db();
    }

    public function getAllStatus()
    {
        
        $status = $this->db->query('select * from tbl_status_setting');
        $from_status = [];
        $from_status_color = [];
        $indexcolor1=0;
        while($rows = $status->fetch(PDO::FETCH_ASSOC)){
            //array_push($user_list[$row['id']],$row['name']);
            $from_status[$indexcolor1]=$rows['title'];
            $from_status_color[$indexcolor1]=$rows['color'];
            $indexcolor1++;
        }
        return ['ArrStatus'=>$from_status,'ArrColor'=>$from_status_color];

    }
    public function getCustomer()
    {
       
        $customer = $this->db->query('Select tbl_customer.id as id_customer,
                                            tbl_customer.created_at ,
                                            tbl_customer.update_at ,
                                            tbl_customer.name as name_customer,
                                            tbl_customer.email as email_customer,
                                            tbl_customer.phone as phone_customer,
                                            tbl_customer.address,
                                            tbl_customer.company_number,
                                            tbl_customer.user_id,
                                            tbl_customer.user_id as user_select,
                                            tbl_customer.status,
                                            tbl_customer.from_landing,
                                            tbl_customer.reed,
                                            tbl_contact.date as call_date,
                                            tbl_contact.comanication,
                                            tbl_user.name as name_user,
                                            tbl_history_items.date as buy_date,
                                            tbl_accounting_items.item_name
                                         from tbl_customer
                                         LEFT JOIN tbl_contact ON tbl_customer.last_call = tbl_contact.id
                                         LEFT JOIN tbl_user ON tbl_user.id = tbl_contact.user_id
                                         LEFT JOIN tbl_history_items ON tbl_customer.last_item_buy = tbl_history_items.id
                                         LEFT JOIN tbl_accounting_items ON tbl_history_items.item_id = tbl_accounting_items.item_id
                                         WHERE tbl_customer.del=0
                                         ORDER BY tbl_customer.update_at DESC');
        return $customer;

    }
    public function getNewCustomer($customer_id)
    {
        
        $new_customer = $this->db->query('Select
                  tbl_history_new_customer.id as id_new_customer ,
                    tbl_customer.id as id_customer_n,
                    tbl_history_new_customer.date as created_at_n,
                    tbl_history_new_customer.user_id as user_id_n,
                    tbl_history_new_customer.user_id as user_select_n,
                    tbl_history_new_customer.status as status_n,
                    tbl_history_new_customer.from_lid ,
                    tbl_contact.date as  call_date_n,
                    tbl_contact.comanication as comanication_n,
                    tbl_user.id as id_user_n,
                    tbl_user.name as  name_user_n,
                    tbl_history_items.date as buy_date_n,
                    tb_his_ite.id as buyer_n,
                    tbl_history_new_customer.item_id as item_id_n,
                    tbl_accounting_items.item_name as item_name_n,
                    tbl_accounting_items.item_amount as item_amount_n,
                    tbl_accounting_items.from_landing as from_landing_n
                      from tbl_history_new_customer
                        INNER JOIN tbl_customer ON tbl_history_new_customer.customer_id = tbl_customer.id
                        LEFT JOIN tbl_contact ON tbl_history_new_customer.last_call = tbl_contact.id
                        LEFT JOIN tbl_user ON tbl_user.id = tbl_history_new_customer.user_id
                        LEFT JOIN tbl_history_items ON tbl_history_new_customer.item_buy = tbl_history_items.id
                        LEFT JOIN tbl_history_items AS tb_his_ite ON tbl_customer.last_item_buy = tb_his_ite.id
                        LEFT JOIN tbl_accounting_items ON tbl_history_new_customer.item_id = tbl_accounting_items.item_id
                        WHERE tbl_history_new_customer.customer_id = ?
                         ORDER BY tbl_history_new_customer.date DESC',$customer_id);
        return $new_customer;
        
    }
    public function getNewCustomerFilter($customer_id,$filter)
    {
        
        if ($filter=="afliat") {
            $filter_index="!=";
        }else if ($filter=="not_afliat") {
            $filter_index="=";
        } 
        $new_customer_filter = $this->db->query('Select
                    tbl_history_new_customer.id as id_new_customer ,
                    tbl_customer.id as id_customer_n,
                    tbl_history_new_customer.date as created_at_n,
                    tbl_history_new_customer.user_id as user_id_n,
                    tbl_history_new_customer.user_id as user_select_n,
                    tbl_history_new_customer.status as status_n,
                    tbl_history_new_customer.from_lid as from_lid,
                    tbl_contact.date as  call_date_n,
                    tbl_contact.comanication as comanication_n,
                    tbl_user.id as id_user_n,
                    tbl_user.name as name_user_n,
                    tbl_history_items.date as buy_date_n,
                    tb_his_ite.id as buyer_n,
                    tbl_history_new_customer.item_id as item_id_n,
                    tbl_accounting_items.item_name as item_name_n,
                    tbl_accounting_items.item_amount as item_amount_n,
                    tbl_accounting_items.from_landing as from_landing_n
                      from tbl_history_new_customer
                        INNER JOIN tbl_customer ON tbl_history_new_customer.customer_id = tbl_customer.id
                        LEFT JOIN tbl_contact ON tbl_history_new_customer.last_call = tbl_contact.id
                        LEFT JOIN tbl_user ON tbl_user.id = tbl_history_new_customer.user_id
                        LEFT JOIN tbl_history_items ON tbl_history_new_customer.item_buy = tbl_history_items.id
                        LEFT JOIN tbl_history_items AS tb_his_ite ON tbl_customer.last_item_buy = tb_his_ite.id
                        LEFT JOIN tbl_accounting_items ON tbl_history_new_customer.item_id = tbl_accounting_items.item_id
                          WHERE tbl_history_new_customer.user_id' .$filter_index. '0 AND tbl_history_new_customer.customer_id = ?
                             ORDER BY tbl_history_new_customer.date DESC',$customer_id);
        return $new_customer_filter;
        
    }
    public function getRemembers($customer_id)
    {
        
        $customer = $this->db->query('SELECT tbl_rememberes.id,
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
                    WHERE tbl_rememberes.customer_id=?
                    ORDER BY tbl_rememberes.date DESC ,tbl_rememberes.time ASC',$customer_id);
        return $customer;
        
    }

}