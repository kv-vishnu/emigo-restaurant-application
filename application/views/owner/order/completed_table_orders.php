
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/order-details-accordion.css">

    <div class="" id="">
        <div class="popup">

          <!-- Datepicker here -->

           <!-- Datepicker here -->

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
                                    $productName = $this->Tablemodel->getProductName($item['product_id']);
                                    $variantName = $this->Tablemodel->getVariantName($item['variant_id']);
                                    $bgColor = $item['is_delete'] ? '#f8d7da' : ($item['is_reorder'] ? '#86d7cf' : '#fff');
                            ?>
                            <div class="order-item">
                                <span class="item-name"><?= $productName . ($variantName ? ' (' . $variantName . ')' : ''); ?></span>
                                <div class="item-details">
                                    <div class="item-qty">
                                        <span class="qty-label"><?= $item['quantity']; ?></span>
                                    </div>
                                    <span class="item-rate" data-rate="<?= $item['rate']; ?>"><?= $item['rate']; ?></span>
                                    <span class="item-total"><?= $item['rate'] * $item['quantity']; ?></span>
                                </div>
                            </div>
                            <!-- loop item end -->
                            <?php } ?>
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
