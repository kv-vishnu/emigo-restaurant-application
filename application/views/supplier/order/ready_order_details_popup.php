<div class="accordion" id="ordersAccordion">
<?php foreach ($orders as $index => $order): ?>
    <?php
        $isFirst = ($index === 0);
        $selectedDeliveryBoy = $order['delivery_boy'];
        $orderNo = $order['orderno'];
    ?>
    <form>
        <input type="hidden" name="product_name" value="<?= $orderNo ?>">

        <div class="accordion-item mb-3">
            <h2 class="accordion-header" id="heading<?= $order['id'] ?>">
                <button class="accordion-button <?= !$isFirst ? 'collapsed' : '' ?>"
                        style="background:#eeeef9"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $order['id'] ?>"
                        aria-expanded="<?= $isFirst ? 'true' : 'false' ?>"
                        aria-controls="collapse<?= $order['id'] ?>">
                    <?= $index + 1 ?> :- Order No: <?= $orderNo ?>
                </button>
            </h2>

            <div id="collapse<?= $order['id'] ?>"
                 class="accordion-collapse collapse <?= $isFirst ? 'show' : '' ?>"
                 aria-labelledby="heading<?= $order['id'] ?>"
                 data-bs-parent="#ordersAccordion">

                <div class="accordion-body product-item">
                    <table class="ready-orders-table-details table table-bordered order_details_table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Recipe Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['items'] as $key => $item): ?>
                                <?php
                                    $backgroundColor = '#fff';
                                    $disabled = '';

                                    if ($item['is_delete'] == 1) {
                                        $backgroundColor = '#f8d7da';
                                        $disabled = 'disabled';
                                    } elseif ($item['is_reorder'] == 1) {
                                        $backgroundColor = '#86d7cf';
                                    }

                                    $productName = $this->Ordermodel->getProductName($item['product_id']);
                                    $variantName = $this->Ordermodel->getVariantName($item['variant_id']);
                                ?>
                                <tr style="background-color: <?= $backgroundColor ?>">
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $productName ?><?= $variantName ? " ($variantName)" : '' ?></td>
                                    <td>
                                        <div class="input-group qty-group">
                                            <input type="text"
                                                class="form-control text-center quantity"
                                                value="<?= $item['quantity'] ?>" readonly>
                                        </div>
                                    </td>
                                    <td><?= $item['item_remarks'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                        <tfoot class="table-light order-details_buttons">
                            <tr>
                                <td colspan="2">
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="orderStatusDropdown" data-bs-toggle="dropdown">
                                            <?= ($order['order_status'] == "0") ? "Pending" :
                                            (($order['order_status'] == "1") ? "Approved" :
                                            (($order['order_status'] == "2") ? "Cooking" :
                                            (($order['order_status'] == "3") ? "Ready" :
                                            (($order['order_status'] == "4") ? "Out For Delivery" :
                                            (($order['order_status'] == "5") ? "Delivered" : "Select Status"))))) ?>

                                        </button>
                                    </div>
                                </td>

                                <?php if ($order['order_type'] == 'DL' && $order['order_status'] == 7): ?>
                                    <td colspan="2">
                                        <select class="form-select delivery_boy" data-order-id="<?= $orderNo ?>">
                                            <option value="">Select Delivery Boy</option>
                                            <?php foreach ($deliveryBoys as $boy): ?>
                                                <option value="<?= $boy['userid'] ?>" <?= ($boy['userid'] == $selectedDeliveryBoy) ? 'selected' : '' ?>>
                                                    <?= $boy['Name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                <?php endif; ?>

                                <?php
            // Button classes based on order status
            $deliveryOrderClass = ($order['order_status'] == 4)
                ? 'btn8-small delivery_table_order'
                : 'btn6-small delivery_table_order disabled-link';

            $payOrderClass = ($order['order_status'] == 5)
                ? 'btn8-small pay_delivered_order'
                : 'btn6-small pay_delivered_order';

            $diningOrderClass = ($order['order_status'] == 3)
                ? 'btn8-small dining_order'
                : 'btn6-small dining_order disabled';
        ?>

        <td colspan="8" class="text-end">
            <button type="button"
                    class="btn6-small kot_table_order"
                    data-order-id="<?= $orderNo ?>"
                    data-kot-enable="<?= $kot_enable ?>">KOT</button>

            <button type="button"
                    class="btn6-small pay_order_print"
                    data-bs-toggle="modal"
                    data-bs-target="#printModal"
                    data-order-id="<?= $orderNo ?>">Print</button>

            <!-- Delivery, Dining, and Pay buttons with class conditions -->
            <a id="deliver_order" class="<?= $deliveryOrderClass ?>"
                    data-order-id="<?= $orderNo ?>"
                    style="margin-left: 10px;">Delivered</a>

            <a class="<?= $payOrderClass ?>"
                    data-order-id="<?= $orderNo ?>"
                    style="margin-left: 10px;">Pay <?php echo $order['total_amount'] ?></a>
        </td>
                            </tr>

                            <tr class="msgContainer<?= $orderNo ?> d-none">
                                <td colspan="12">
                                    <div class="alert alert-success ordermsg<?= $orderNo ?> d-none">Order</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>
</div>

<!-- Recipe Modals -->
<div class="modal fade" id="recipe" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Recipe Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <iframe id="table_iframe_recipe1" height="600px" width="100%"></iframe>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="recipe1" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Recipe Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <iframe id="table_iframe_recipe2" height="600px" width="100%"></iframe>
      </div>
    </div>
  </div>
</div>

<style>
.disabled-link {
  pointer-events: none;   /* Disables clicking */
  opacity: 0.65;          /* Makes it look faded */
  cursor: not-allowed;    /* Shows "forbidden" cursor */
}
</style>

<script>
     $(document).on("click", "#deliver_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order/update_order_status_and_delivery_time"); ?>',
            type: "POST",
            data: {
                orderId: orderId,
                status: 5
            },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    $(".ordermsg" + orderId).removeClass("d-none").text("Order marked as Delivered successfully.");
                    $(".msgContainer" + orderId).removeClass("d-none");
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                }
            },
        });
    });

    $(document).on("click", ".pay_delivered_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: '<?= base_url("owner/order/pay_order"); ?>',
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    window.parent.$('#recipe').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);

                }
            },
        });
    });
</script>