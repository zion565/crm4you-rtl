<script>
$(document.body).on('click', '.change_contact', function(e){
        e.preventDefault();
        var $self = $(this);
       
        var id = $self.data('id');
        var user_id_rem = $self.data('user_id');  
        var name = $self.data('name_customer');
		var email = $self.data('email_customer');
		var phone = $self.data('phone_customer');
		var status = $self.data('status');
		
		// var address = $self.data('address');
		// var company_number = $self.data('company_number');
		
		var new_date_rem = $self.data('date_rem');
		 var new_time_rem = $self.data('time_rem');
         var lid_from = $self.data('lid_from');

        // $('#date_rem_cus').val(new_date_rem); 
		// $('#time_rem_cus').val(new_time_rem);
		// $('#customer_name').val(name);
		// $('#customer_email').val(email);
		// $('#customer_phone').val(phone);
		// $('#lid_from').val(lid_from);
		// $("input[name='optradio']").attr('checked',false);
		// $('#'+status).attr('checked', true);

		//console.log("statusval= "+status+" is check? "+$('#'+status).val());

		// $('#customer_address').val(address);
		// $('#customer_company_number').val(company_number);
		// $('#customer_id').val(id);
		// $('#user_id_rem').val(user_id_rem);
		// $('#customer_id_rem').val(id);
		
		//$('#customer_email').prop( "disabled", true );

		// $('#save_user').show();
		// $('#add_user_form_title').hide();
		// $('#edit_user_form_title').show();
		// $('#save_new_user').hide();
		// $('#status_buttons').show();
		// $('#add-line-rem').removeClass("hide");
		// $('#add-line-contact').addClass("hide");
		// $('#add-line-item').addClass("hide");
		// $('#add-line-buy').addClass("hide");
		
        $('#userModel').modal('show');
	    
	    expenseDataId = $self.data('id');
            expenseObj = $self;
        
    });
    </script>