<div class="application-content order-monitor-content">
    <audio id="kitchen_alert-audio" src="<?php echo base_url(); ?>uploads/order-siren.mp3" preload="auto"></audio>
    <div class="application-content__container order-monitor-content__container container">
        <h1 class="application-content__page-heading">Kitchen Monitor - <?php echo $name; ?></h1>


        <div class="tabs orderdashboard-tab" id="orderdashboard-tab__content">
            <div class="tabs__row">
                <ul class="tabs__nav">

                    <li class="active"><a href="#tabs1">Orders<span id="tabs__nav_approved_table_count"
                                class="d-none"></span> </a>
                    </li>
                    <li class=""><a href="#tabs2">Ready Orders <span id="tabs__nav_approved_ready_count"
                                class="d-none"></span> </a>
                    </li>
                    <li class=""><a href="#tabs3">Out For Delivery Orders<span id="tabs__nav_approved_delivered_count"
                                class="d-none"></span>
                        </a></li>
                </ul>
                <div class="tabs__content orderdashboard-tab__content">





                    <div id="tabs1" class="tabs__pane active">
                        <div class="table-status">
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-available"></div>
                                <div class="table-status__item-label">Dining</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-reserved"></div>
                                <div class="table-status__item-label">Pickup</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-booked"></div>
                                <div class="table-status__item-label">Delivery</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color room-status__item-color-booked"></div>
                                <div class="table-status__item-label">Room</div>
                            </div>

                        </div>

                        <div class="kitchen-monitor-approved-orders order-table-list" id="approved-orders">

                            <?php foreach ($approved_orders as $order) {
                                $order_status = '';
                                $type = '';
                                if ($order['order_status'] == 1) {
                                    $order_status = 'Approved';
                                    $btn_class='btn-approved w-100 mt-2';
                                } elseif ($order['order_status'] == 2) {
                                    $order_status = 'Cooking';
                                    $btn_class='btn-cooking w-100 mt-2';
                                }elseif ($order['order_status'] == 3) {
                                    $order_status = 'Ready';
                                    $btn_class='btn-ready w-100 mt-2';
                                }
                                elseif ($order['order_status'] == 4) {
                                    $order_status = 'Out For Delivery';
                                    $btn_class='btn-approved w-100 mt-2';
                                }


                                if($order['order_type'] == 'D'){
                                    $type = 'Dining';
                                    $order_type = $this->Ordermodel->get_table_name($order['table_id']); //Display table name if order type dining
                                    $bgClass = '#ede1db';
                                }
                                if($order['order_type'] == 'PK'){
                                    $type = 'Pickup';
                                    $order_type = 'Pickup'; //Display table name if order type dining
                                    $bgClass = '#b4c9dd';
                                }
                                if($order['order_type'] == 'DL'){
                                    $type = 'Delivery';
                                    $order_type = 'Delivery'; //Display table name if order type dining
                                    $bgClass = '#f1b3a1';
                                }

                                  if($order['order_type'] == 'rom'){
                                    $type = 'Room';
                                    $order_type = 'Room'; //Display table name if order type dining
                                    $bgClass = '#eb191994';
                                }
                               ?>
                            <div class="order-table-list__item">
                                <a data-bs-toggle="modal" data-id="<?php echo $order['orderno']; ?>"
                                    data-name="<?php echo $order['orderno']; ?>" data-bs-target="#order_details_popup"
                                    class="w-100 kitchen_monitor_orders_details" type="button" title="Table Orders">
                                    <div id="order-table-list__item-heading_<?php echo $order['orderno']; ?>"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: <?php echo $bgClass; ?>">
                                        <?php echo $order_type; ?> - <?php echo $order['order_token']; ?>
                                        <img src="<?php echo base_url();?>assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                                </a>
                                <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order['approved_by_name']; ?></button>
                                <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order_status; ?></button>
                            </div>
                            <?php } ?>
                        </div>


                    </div>
                    <div id="tabs2" class="tabs__pane">
                        <div class="table-status">
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-available"></div>
                                <div class="table-status__item-label">Dining</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-reserved"></div>
                                <div class="table-status__item-label">Pickup</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-booked"></div>
                                <div class="table-status__item-label">Delivery</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color room-status__item-color-booked"></div>
                                <div class="table-status__item-label">Room</div>
                            </div>
                        </div>
                        <div class="kitchen-monitor-ready-orders order-table-list" id="ready-orders">
                            <?php foreach ($ready_orders as $order) {
                                $order_status = '';
                                $type = '';
                                if ($order['order_status'] == 1) {
                                    $order_status = 'Approved';
                                    $btn_class='btn-approved w-100 mt-2';
                                } elseif ($order['order_status'] == 2) {
                                    $order_status = 'Cooking';
                                    $btn_class='btn-cooking w-100 mt-2';
                                }elseif ($order['order_status'] == 3) {
                                    $order_status = 'Ready';
                                    $btn_class='btn-ready w-100 mt-2';
                                }
                                elseif ($order['order_status'] == 4) {
                                    $order_status = 'Out For Delivery';
                                    $btn_class='btn-approved w-100 mt-2';
                                }


                                if($order['order_type'] == 'D'){
                                    $type = 'Dining';
                                    $order_type = $this->Ordermodel->get_table_name($order['table_id']); //Display table name if order type dining
                                    $bgClass = '#ede1db';
                                }
                                if($order['order_type'] == 'PK'){
                                    $type = 'Pickup';
                                    $order_type = 'Pickup'; //Display table name if order type dining
                                    $bgClass = '#b4c9dd';
                                }
                                if($order['order_type'] == 'DL'){
                                    $type = 'Delivery';
                                    $order_type = 'Delivery'; //Display table name if order type dining
                                    $bgClass = '#f1b3a1';
                                }

                                if($order['order_type'] == 'rom'){
                                    $type = 'Room';
                                    $order_type = 'Room'; //Display table name if order type dining
                                    $bgClass = '#eb191994';
                                }
                               ?>
                            <div class="order-table-list__item">
                                <a data-bs-toggle="modal" data-id="<?php echo $order['orderno']; ?>"
                                    data-name="<?php echo $order['orderno']; ?>" data-bs-target="#order_details_popup"
                                    class="w-100 kitchen_monitor_ready_order_details" type="button" title="Table Orders">
                                    <div id="order-table-list__item-heading_<?php echo $order['orderno']; ?>"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: <?php echo $bgClass; ?>">
                                        <?php echo $order_type; ?> - <?php echo $order['order_token']; ?>
                                        <img src="<?php echo base_url();?>assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                                </a>
                                 <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order['approved_by_name']; ?></button>
                                <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order_status; ?></button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div id="tabs3" class="tabs__pane">
                        <div class="table-status">
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-available"></div>
                                <div class="table-status__item-label">Dining</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-reserved"></div>
                                <div class="table-status__item-label">Pickup</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color table-status__item-color-booked"></div>
                                <div class="table-status__item-label">Delivery</div>
                            </div>
                            <div class="table-status__item">
                                <div class="table-status__item-color room-status__item-color-booked"></div>
                                <div class="table-status__item-label">Room</div>
                            </div>
                        </div>
                        <div class="kitchen-monitor-out-for-delivery-orders order-table-list" id="out-for-delivery-orders">
                            <?php foreach ($out_for_delivery_orders as $order) {
                                 $order_status = '';
                                 $type = '';
                                 if ($order['order_status'] == 1) {
                                     $order_status = 'Approved';
                                     $btn_class='btn-approved w-100 mt-2';
                                 } elseif ($order['order_status'] == 2) {
                                     $order_status = 'Cooking';
                                     $btn_class='btn-cooking w-100 mt-2';
                                 }elseif ($order['order_status'] == 3) {
                                     $order_status = 'Ready';
                                     $btn_class='btn-ready w-100 mt-2';
                                 }
                                 elseif ($order['order_status'] == 4) {
                                     $order_status = 'Out For Delivery';
                                     $btn_class='btn-approved w-100 mt-2';
                                 }
                                 elseif ($order['order_status'] == 5) {
                                     $order_status = 'Delivered';
                                     $btn_class='btn-approved w-100 mt-2';
                                 }


                                 if($order['order_type'] == 'D'){
                                    $type = 'Dining';
                                    $order_type = $this->Ordermodel->get_table_name($order['table_id']); //Display table name if order type dining
                                    $bgClass = '#ede1db';
                                }
                                if($order['order_type'] == 'PK'){
                                    $type = 'Pickup';
                                    $order_type = 'Pickup'; //Display table name if order type dining
                                    $bgClass = '#b4c9dd';
                                }
                                if($order['order_type'] == 'DL'){
                                    $type = 'Delivery';
                                    $order_type = 'Delivery'; //Display table name if order type dining
                                    $bgClass = '#f1b3a1';
                                }
                                if($order['order_type'] == 'rom'){
                                    $type = 'Room';
                                    $order_type = 'Room'; //Display table name if order type dining
                                    $bgClass = '#eb191994';
                                }
                               ?>
                            <div class="order-table-list__item">
                                <a data-bs-toggle="modal" data-id="<?php echo $order['orderno']; ?>"
                                    data-name="<?php echo $order['orderno']; ?>" data-bs-target="#order_details_popup"
                                    class="w-100 kitchen_monitor_delivered_orders_details" type="button" title="Table Orders">
                                    <div id="order-table-list__item-heading_<?php echo $order['orderno']; ?>"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: <?php echo $bgClass; ?>">
                                        <?php echo $order_type; ?> - <?php echo $order['order_token']; ?>
                                        <img src="<?php echo base_url();?>assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                                </a>
                                <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order['approved_by_name']; ?></button>
                                <button type="button"
                                    class="btn <?php echo $btn_class; ?>"><?php echo $order_status; ?> (<?php echo $order['out_for_delivery_time']; ?>)</button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for detailed view -->
<div class="modal fade" id="order_details_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orders_content">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<!-- Modal for detailed view -->
<div class="modal fade" id="print_order_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->

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