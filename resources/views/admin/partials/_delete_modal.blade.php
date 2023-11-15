 <div class="modal fade" id="delete_restore_modal" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header py-2" id="delete_restore_modal_heading">
                 <h5 class="h5 modal-title font-weight-bold text-white"></h5>
             </div>
             <div class="modal-body" id="delete_restore_modal_body">
                 <h6 class="h6 font-weight-bold"></h6>
                 <form class="form" id="delete_restore_form">
                     @csrf
                     <input type="hidden" name="id" id="id">
                 </form>
             </div>
             <div class="modal-footer justify-content-between py-1">
                 <button type="button" class="btn btn-outline-secondary btn-sm delete_restore_close">Close</button>
                 <button type="submit" name="submit" class="btn btn-sm" id="delete_restore_modal_btn">
                     <span class="spinner-border spinner-border-sm d-none" id="delete_btn_spinner"></span>
                     <span id="confirm_btn_text"></span>
                 </button>
             </div>
         </div>
     </div>
 </div>
