<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container">
    <div class="page-content p-2">
        <div class="container p-0">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo">
                        <a href="<?php echo base_url('admin/store/addstore'); ?>" class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
" alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Store
                        </a>

                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
" alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="product-list" id="search_result_container">

            <?php
            if(!empty($stores)){
                $count = 1;
                foreach($stores as $val){


 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                    <img src="<?php echo base_url('uploads/store/') . $val['store_logo_image']; ?>" alt="chapathi"
                        class="product-list__item-img" width="100" height="100">

                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                            <?php echo ($val['store_disp_name'] != '') ? $val['store_disp_name'] : $val['store_disp_name']; ?>
                        </h3>
                        <p class="product-list__item-price">
                            <?php
                                echo $val['store_address']
                            ?></p>




                        <p class="product-list__item-status text-capitalize">
                            <?php echo $val['store_phone']; ?>
                        </p>
                        <div class="product-list__item-details-availability-stock">

                            <div class="product-list__item-stock d-none">
                                <!-- <div class="product-list__item-stock-label">active</div> -->
                                <div class="product-list__item-stock-count d-none">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="product-list__item-buttons-block">
                    <div class="product-list__item-buttons-block-one">

                        <input type="hidden" name="id" value="<?php echo $val['store_id']; ?>">
                        <a title="Edit Store" href="<?php echo base_url('admin/store/editstore/'.$val['store_id']); ?>"
                            class="product-list__item-buttons-block-btn product-list__item-buttons-block-add-new-stock-btn btn6 open-modal"
                            data-id="<?php echo $val['store_id']; ?>">
                            <img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="24"> Edit
                        </a>




                        <a title="Disable Store" class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn disable"
                            data-id="<?php echo $val['store_id']; ?>" data-type="store"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Disable</a>

                                <!-- <a target="_blank" href="<?php echo $val['admin_login_qr']; ?>" title="Download Admin Login QR" class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn disable"><img class="product-list__item-button-img">Login QR</a> -->

                    </div>
                    <div class="product-list__item-buttons-block-two">

                        <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn qrcode-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                            data-bs-target="#qr-code"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Qr Codes</a>

                        <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn product_assign"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                            data-name="<?php echo $val['store_disp_name']; ?>" data-bs-target="#emp_informations"><img
                                class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Product Assign</a>


                    </div>

                    <div class="product-list__item-buttons-block-three d-grid w-100">
                        <form action="<?php echo base_url(); ?>admin/followup/" method="post">
                            <input type="hidden" name="store_id" value="<?php echo $val['store_id']; ?>">
                            <button type="submit"
                                class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn w-100 d-flex">
                                <img class="product-list__item-button-img"
                                    src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/30/external-follow-up-job-search-flaticons-lineal-color-flat-icons.png"
                                    alt="next available button stock" width="23" height="24">Follow up
                            </button>
                        </form>
                    </div>


                    <div class="product-list__item-buttons-block-three d-grid w-100">
                        <form action="<?php echo base_url(); ?>admin/rooms/index" method="post">
                            <input type="hidden" name="store_id" value="<?php echo $val['store_id']; ?>">
                            <button type="submit"
                                class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn w-100 d-flex">
                                <img class="product-list__item-button-img" src="https://img.icons8.com/dusk/30/room.png"
                                    alt="next available button stock" width="23" height="24">Rooms
                            </button>
                        </form>
                    </div>



                </div>
            </div>
            <?php $count++; } } ?>



        </div>



        <!-- Modal for detailed product assign -->
        <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="product_assign">
                        <!-- <iframe id="table_iframe_product_assign" height="750px" width="100%"></iframe> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->


        <!-- qr code -->
        <div class="modal fade" id="qr-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">qr codes</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row  pt-2">
                            <!-- <form class="row mt-0 mb-0" id="edit_save_country" method="post" enctype="multipart/form-data"> -->
                            <input type="hidden" id="qr_code_id">
                            <iframe id="table_iframe" height="600px" width="100%">



                            </iframe>




                            <!-- </form> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>

<!-- edit country -->