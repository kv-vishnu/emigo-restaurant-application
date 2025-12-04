
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/order-details-accordion.css">

    <div class="" id="">
        <div class="popup">

            <?php //print_r($orders); ?>

            <!-- Popup content start -->
            <?php if (!empty($orders)) { ?>
            <div class="popup-content">
                <!-- Order 1 -->
                <?php foreach ($orders as $index => $order){ ?>
                <?php
                    $isFirst = ($index === 0) ? 'active' : '';
                ?>
                <div class="accordion-item <?php echo $isFirst; ?> ">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <div class="order-info">
                            <span class="order-id">Order #<?= $order['orderno']; ?></span>
                            <span class="order-total"><?= round($order['total_amount'], 2); ?></span>
                        </div>
                        <span class="accordion-icon">▼</span>
                    </div>
                    <div class="accordion-body">
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

                            <!-- loop item start -->
                            <?php foreach ($order['items'] as $key => $item){
                                    $productName = $this->Roommodel->getProductName($item['product_id']);
                                    $variantName = $this->Roommodel->getVariantName($item['variant_id']);
                                    $total_variant = 1;
                                    if($item['variant_id'])
                                    {
                                        $variantValue = $this->Roommodel->getVariantValue($item['variant_id'], $item['product_id']);
                                        $total_variant =  $item['quantity'] * $variantValue;
                                    }

                                    $bgColor = $item['is_delete'] ? '#f8d7da' : ($item['is_reorder'] ? '#86d7cf' : '#fff');

                                    // if approved order disable qty section
                                    $approved_user = $order['approved_by'];
                                    $item_quantity_disabled = ($approved_user) ? 'disabled' : '';
                            ?>
                            <div class="order-item">
                                <span class="product-id" style="display:none;"><?= $item['product_id'] ?></span>
                                <!-- Update order item using this PK ID -->
                                <span class="order-item-id" style="display:none;"><?= $item['id'] ?></span>
                                <span class="order-number" style="display:none;"><?= $order['orderno'] ?></span>
                                <span class="item-variant-value" style="display:none;"><?= $variantValue; ?></span>

                                <!-- variant total hidden field for each row -->
                                <input type="hidden" class="product_<?= $item['product_id'] ?>_total_stock" value="<?= $total_variant; ?>">

                                <span class="item-name"><?= $productName . ($variantName ? ' (' . $variantName . ')' : ''); ?></span>
                                <div class="item-details">
                                    <div class="item-qty">
                                        <div class="qty-controls">
                                            <button <?= $item_quantity_disabled ?> class="qty-btn" onclick="decrementQty(this)" type="button">−</button>
                                            <span class="qty-value"><?= $item['quantity']; ?></span>
                                            <button <?= $item_quantity_disabled ?> class="qty-btn" onclick="incrementQty(this)" type="button">+</button>
                                        </div>
                                    </div>
                                    <span class="item-rate" data-rate="<?= $item['rate']; ?>"><?= $item['rate']; ?></span>
                                    <span class="item-total"><?= $item['rate'] * $item['quantity']; ?></span>
                                </div>
                            </div>
                            <!-- loop item end -->
                            <?php } ?>
                        </div>

                        <!-- Switch button clours and text based on order status -->
                        <?php
                            $login_user_id = $user_id;//Logged in user id
                            $user_role_id = $role_id; //Admin or Shopowner
                            $approved_user = $order['approved_by'];
                            $approved_disabled = ($approved_user) ? 'disabled' : '';
                            $delete_disabled = ($approved_user) ? 'disabled' : '';
                            $order_status = $order['order_status'];
                            switch ($order_status) {
                                case 0:
                                    $btn_text = 'Pending';
                                    $btn_class = 'btn-pending';
                                    break;
                                case 1:
                                    $btn_text = 'Approved';
                                    $btn_class = 'btn-approve';
                                    break;
                                case 2:
                                    $btn_text = 'Cooking';
                                    $btn_class = 'btn-cooking';
                                    break;
                                case 3:
                                    $btn_text = 'Ready';
                                    $btn_class = 'btn-ready';
                                    break;
                                case 4:
                                    $btn_text = 'Out For Delivery';
                                    $btn_class = 'btn-out-for-delivery';
                                    break;
                                case 5:
                                    $btn_text = 'Delivered';
                                    $btn_class = 'btn-delivered';
                                    break;
                                default:
                                    $btn_text = 'Unknown';
                                    $btn_class = 'btn-secondary';
                                    break;
                            }
                        ?>
                        <div class="action-buttons order-row">
                            <button class="btn <?= $btn_class ?>"><?= $btn_text ?></button>

                            <!-- user id 1 or 2 display select box otherwise logged inuser id should not change -->
                            <?php if($user_role_id == 1 || $user_role_id == 2){ ?>
                                <select class="select-box supplier-select">
                                <option value="">Select Supplier</option>
                                <?php foreach ($suppliers as $supplier) { ?>
                                    <option value="<?= $supplier['userid'] ?>" <?= ($supplier['userid'] == $approved_user) ? 'selected' : '' ?>><?= $supplier['Name'] ?></option>
                                <?php } ?>
                                </select>
                            <?php }else{ ?>
                                <select class="select-box supplier-select" disabled>
                                <?php foreach ($suppliers as $supplier) { ?>
                                    <option value="<?= $supplier['userid'] ?>" <?= ($supplier['userid'] == $login_user_id) ? 'selected' : '' ?>><?= $supplier['Name'] ?></option>
                                <?php } ?>
                                </select>
                            <?php } ?>

                            <button data-order-id=<?= $order['orderno']; ?> data-kot-enable=<?= $kot_enable; ?> class="btn btn-approve" <?= $approved_disabled ?>>Approve</button>
                            <button data-order-id=<?= $order['orderno']; ?> class="btn btn-print print_order">Print</button>
                            <button data-order-id=<?= $order['orderno']; ?> class="btn btn-delete delete_order" <?= $delete_disabled ?>>Delete</button>
                             <!-- <button class="btn btn-pay" onclick="cancelOrder(1234)">Pay</button> -->
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- Order 1 end -->

            </div>
            <?php } else { ?>
                <div class="popup-content">
                    No pending orders for this table.
                </div>
                <?php } ?>
            <!-- Popup content end -->
        </div>


        <script src="<?php echo base_url(); ?>assets/admin/js/owner/order/pending_orders_by_table.js"></script>
