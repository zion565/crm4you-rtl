<script>
var urlTable = "data/customer-json.php";
function reloadTable(){
    table = $('#example1').DataTable({
    	"stateSave": true,
        "bProcessing": true,
        "ordering": false,
        "info": false,
        //"bServerSide":true,
        "sAjaxSource": urlTable,
        "aoColumns": [
        	{ mData: 'card'}
            
            
            
           
        ],
        // "columnDefs": [
        // 	{
        //         "targets": [ 6 ],
        //         "visible": false
        //     },
        //     {
        //         "targets": [ 7 ],
        //         "visible": false
        //     },
        //     {
        //         "targets": [ 8 ],
        //         "visible": false
        //     },
        //     ],
            "searching": true,
             "language": {
                 "lengthMenu": "מציג _MENU_ רשומות בדף ",
                 "zeroRecords": "לא נמצאו רשומות",
                 "info": "מציג דף _PAGE_ מתוך _PAGES_",
                 "infoEmpty": "אין רשומות קיימות",
                 "infoFiltered": "(filtered from _MAX_ total records)",
                 "emptyTable":     "אין מידע להצגה בטבלה זו",
                 "loadingRecords": '',
                 "processing":     '<img src="<?=$base_admin_path;?>/dist/img/crm/favicon.png" width="70px" height="40px"/>מעבד...',
                 "search":         "חיפוש:",
                 "paginate": {
                     "first":      "ראשון",
                     "last":       "אחרון",
                     "next":       "הבא",
                     "previous":   "הקודם"
                 }
             },
             'initComplete' : function(settings) {
                $('#Thide').hide();
                $('#example1_paginate').parent().prev().removeClass('col-sm-5');
                $('#example1_paginate').parent().prev().addClass('col-sm-2');
                $('#example1_paginate').parent().removeClass('col-sm-7');
                $('#example1_paginate').parent().addClass('col-sm-8');
             }
            
         });
         
        }
</script>