<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/order-details-accordion.css">

<div class="popup">
    <?php if (!empty($orders)) {
        // Show only the first order
        $order = $orders[0];
    ?>
        <div class="popup-content">
        <div class="accordion-item">
            <div class="accordion-header">
                <div class="order-info">
                    <span class="order-id">Order #<?= $order['orderno']; ?></span>
                    <span class="order-id">Total: <?= round($order_total, 2); ?></span>
                    <span class="order-id">Tax(5%): <?= round($tax_amount, 2); ?></span>
                    <span class="order-id">Paid Amount: <?= round($order_total_paid, 2); ?></span>
                </div>
            </div>

            <div class="order-items">

            <!-- Table Heading Row -->
                                <div class="order-item order-item-header">
                                    <span class="item-name">Item Name</span>
                                    <div class="item-details">
                                        <div class="item-qty">
                                            <span class="qty-label">Quantity</span>
                                        </div>
                                        <span class="item-rate">Rate</span>
                                        <span class="item-total">Total</span>
                                    </div>
                                </div>
                            <!-- Table Heading Row -->

                <?php foreach ($order['items'] as $key => $item) {
                    $productName = $this->Ordermodel->getProductName($item['product_id']);
                    $variantName = $this->Ordermodel->getVariantName($item['variant_id']);
                    $item_quantity = $item['quantity'] - $item['return_qty'];
                ?>
                    <div class="order-item">
                        <span class="item-name">
                            <?= $productName . ($variantName ? ' (' . $variantName . ')' : ''); ?>
                        </span>


                        <span class="qty-label" style="margin-right: 40px;"><?= $item_quantity; ?></span>


                        <span class="item-rate" data-rate="<?= $item['rate']; ?>"><?= $item['rate']; ?></span>
                        <span class="item-total"><?= $item['rate'] * $item_quantity; ?></span>
                    </div>
                <?php } ?>
            </div>

            <?php
                // $login_user_id = $user_id;
                // $user_role_id = $role_id;
                // $approved_user = 266;
                $approved_btn_disabled = ($approved_user) ? '' : 'disabled';
                $order_status = $order['order_status'];
                $order_is_paid = $order['is_paid'];

                $pay_btn_disabled  = '';

                if ($order_is_paid == 1)
                {
                    $pay_btn_disabled = 'disabled';
                }

                switch ($order_status) {
                    case 0: $btn_text = 'Pending'; $btn_class = 'btn-pending'; break;
                    case 1: $btn_text = 'Approved'; $btn_class = 'btn-approve'; break;
                    case 2: $btn_text = 'Cooking'; $btn_class = 'btn-cooking'; break;
                    case 3: $btn_text = 'Ready'; $btn_class = 'btn-ready'; break;
                    case 4: $btn_text = 'Out For Delivery'; $btn_class = 'btn-out-for-delivery'; break;
                    case 5: $btn_text = 'Delivered'; $btn_class = 'btn-delivered'; break;
                    default: $btn_text = 'Unknown'; $btn_class = 'btn-secondary'; break;
                }
            ?>

            <div class="action-buttons order-row">
                <!-- <button class="btn <?= $btn_class ?>">
                    <?= $btn_text ?>
                </button> -->
                <span class="btn"><?= $btn_text ?></span>
                <button class="btn btn-pay pay_order" data-order-id="<?= $order['orderno']; ?>" <?= $pay_btn_disabled ?>>PAY <?= round($order_total_paid, 2); ?></button>
            </div>
        </div>

        </div>
    <?php } else { ?>
        <div class="popup-content">
            No pending orders for this table.
        </div>
    <?php } ?>
</div>

<script src="<?php echo base_url(); ?>assets/admin/js/owner/order/pending_orders_by_table.js"></script>
