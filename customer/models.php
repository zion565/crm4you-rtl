<div class="modal modal-info" id="userModel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">עריכה</h4>
              </div>
              <div class="modal-body">

              <div class="form-group">   
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" placeholder="שם">
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="אימייל">
              </div>
              </div>
              <div class="form-group">
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="mask:999-99-99-999;" data-mask="">
                </div>
                </div>
                <div class="form-group">
                <div class="btn-group">
                      <button type="button" class="btn btn-default">סטאטוס:</button>
                      <?php foreach($all_status['ArrStatus'] as $status_id => $status_name) { ?>
                        <button type="button" style="background-color:<?= $all_status['ArrColor'][$status_id]?>;" class="btn"><?= $status_name ?></button>
                      <?php } ?>
                      
                    </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">סגור</button>
                <button type="button" class="btn btn-outline">שמור</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>