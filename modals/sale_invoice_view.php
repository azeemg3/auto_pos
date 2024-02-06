  <div class="modal fade" id="sale_invoice_view" role="dialog">
    <div class="modal-dialog" style="width:80%">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onClick="reset_form('proForm')">&times;</button>
          <h4 class="modal-title">Sale Invoice</h4>
        </div>
        <div class="modal-body">
        	<span>Client Name: <strong id="client_name"></strong></span>
          <table class="table table-bordered table-striped">
            <thead>
              <tr style="background:#cdcccc; box-shadow:0px 0 1px #777 inset; font-size:12px;">
                <th>Product Name</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Total Amount</th>
              </tr>
            </thead>
            <tbody class="sale_inv_view"></tbody>
            </table>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
