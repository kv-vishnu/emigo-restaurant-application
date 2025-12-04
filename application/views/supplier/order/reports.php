<div class="application-content reports-content">
    <div class="application-content__container reports-content__container container">
        <!--<h1 class="application-content__page-heading">Reports</h1>-->
        <div class="reports-content__data">


            <div class="modal-container">
                <a class="modal-trigger reports-content__item sales" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/dollar-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Sales</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_sales" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>

            <!-- <div class="modal-container">
                <a class="modal-trigger reports-content__item user" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/user-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">User</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_user" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div> -->

            <div class="modal-container">
                <a class="modal-trigger reports-content__item delivery" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/delivery-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Delivery</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_delivery" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>


            <!-- Room pending bills -->

            <div class="modal-container d-none">
                <a class="modal-trigger reports-content__item reports_pending" data-store-id="<?php echo $store_id; ?>"
                    data-name="Reports Pending">
                    <img src="https://img.icons8.com/fluency/30/report-file.png" alt="report icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Reports</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                        <div class="modal-data">
                            <iframe id="table_iframe_reports_pending" height="750px" width="100%"></iframe>
                        </div>
                        <div class="close-icon"></div>
                    </div>
                </div>
            </div>


            <div class="modal-container d-none">
                <div class="reports-content__item " data-store-id="<?php echo $store_id; ?>"
                    data-name="Reports Pending">

                    <div class="row ">
                        <!-- Paid Section -->
                        <div class="col-md-6 text-center border-end">
                            <h2 class="reports-content__item-text " style="white-space:nowrap">Today Paid</h2>
                            <p class=" settings-content__item-attributes-value">₹2,550</p>
                        </div>

                        <!-- Unpaid Section -->
                        <div class="col-md-6 text-center">
                            <h2 class="reports-content__item-text" style="white-space:nowrap">Today Unpaid</h2>
                            <p class="settings-content__item-attributes-value">₹2,550</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
</div>