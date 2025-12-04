<div class="application-content order-monitor-content">
    <div class="application-content__container order-monitor-content__container container">
        <!--<h1 class="application-content__page-heading">Order Monitor</h1>-->

        <div class="tabs orderdashboard-tab">
            <div class="tabs__row">
                <div class="tabs__content orderdashboard-tab__content">

                        <div class="restaurant-room-orders order-table-list">
                            <?php foreach ($rooms as $table) {
                                $table_name = $table['store_table_name'] ? $table['store_table_name'] : $table['table_name'];
                                $bgClass = 'available';
                                 ?>

                            <div class="order-table-list__item">
                                <a data-bs-toggle="modal" data-id="<?php echo $table['table_id']; ?>"
                                    data-name="<?php echo $table_name; ?>"
                                    class="w-100" type="button" title="Table Orders">
                                    <div id="order-table-list__item-heading_<?php echo $table['table_id']; ?>"
                                        class="order-table-list__item-heading order-table-list__item-heading-<?php echo $bgClass; ?>">
                                        <?php echo $table_name; ?>
                                        <img src="<?php echo base_url();?>assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                                </a>

                                <div class="order-table-list__item-content">
                                        <a data-table-id="<?php echo $table['table_id']; ?>" data-order-type="rom"
                                            data-name="<?php echo $table_name; ?>" class="order-table-list__completed-btn new-order-btn">New Order</a>
                                </div>
                            </div>

                            <?php } ?>
                        </div>

                    </div>
                    <!-- room end -->
                </div>
            </div>
        </div>
    </div>
</div>