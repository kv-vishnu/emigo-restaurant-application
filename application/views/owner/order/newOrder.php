<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/order-details-accordion.css">
<div class="application-content">
    <input type="hidden" id="order_number" value="<?php echo $order_number;?>">
    <input type="hidden" id="order_type" value="<?php echo $order_type;?>">
    <input type="hidden" id="table_id" value="<?php echo $table_id;?>">

    <div class="container mt-4 new-order">
        <h1 class="new-order-heading">New Order - <?= $order_number ?></h1>

        <!-- FOOD SELECT + ADD -->
        <div class="row g-3 align-items-end">

            <div class="col-md-3">
    <label>Food Item</label>
    <select id="product" class="form-control">
        <option value="" disabled selected>Select Item</option>
    </select>
</div>

<!-- Variant Dropdown -->
<div class="col-md-3">
    <label>Variant</label>
    <select id="variant" class="form-control">
        <option value="" selected>Select Variant</option>
        <option value="Quarter">Quarter</option>
        <option value="Half">Half</option>
        <option value="Full">Full</option>
    </select>
</div>

<!-- Rate -->
<div class="col-md-2">
    <label>Rate</label>
    <input type="number" id="rate" class="form-control" readonly>
</div>


            <!-- QUANTITY -->
            <div class="col-md-2">
                <label>Qty</label>
                <input type="number" id="order_qty" class="form-control" min="1">
            </div>

            <!-- ADD BUTTON -->
            <div class="col-md-2">
                <button class="btn btn btn1" id="addBtn">Add</button>
            </div>
        </div>

        <!-- ORDER TABLE -->
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-bordered" id="orderTable">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Rate</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <h5 class="text-end new-order-grand-total">Grand Total: <span id="grandTotal">0</span></h5>
                <button class="btn btn-danger btn-sm save-order" id="save_new_order">Save Order</button>
                <button class="btn btn-danger btn-sm save-order" id="back_to_order_monitor">BACK</button>
            </div>
        </div>

    </div>
</div>


<!-- Common Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p id="confirmMessage">Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="confirmCancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="confirmOk" class="btn btn-yes">Yes, Proceed</button>
      </div>
    </div>
  </div>
</div>

