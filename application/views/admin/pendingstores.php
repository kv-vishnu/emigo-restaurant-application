<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container">
    <div class="page-content p-2">
    <div class="container p-0">
            <div class="row">
                <div class="col-12">
                <div class="add-new-dish-list-combo">

                <a  href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
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
            if(!empty($pendingstores)){
                $count = 1;
                foreach($pendingstores as $val){


 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                <img src="<?php echo base_url('uploads/store/') . $val['store_logo_image']; ?>" alt="chapathi" class="product-list__item-img" width="100" height="100">

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
                        <a href="<?php echo base_url('admin/store/editstore/'.$val['store_id']); ?>"
                            class="product-list__item-buttons-block-btn product-list__item-buttons-block-add-new-stock-btn btn6 open-modal" data-id="<?php echo $val['store_id']; ?>"
                          >
                          <img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="24"> View Store
                            </a>




                        <!-- <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn delete_store"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_id']; ?>"
                            data-bs-target="#removestock"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Remove Store</a> -->
                    </div>
                    <div class="product-list__item-buttons-block-two">

                        <!-- <a href="#"
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn approve"
                           data-id="<?php echo $val['store_id']; ?>"
                          ><img class="product-list__item-button-img"
                                src="https://img.icons8.com/fluency/30/ok--v1.png"
                                alt="next available button stock" width="23" height="24">Approve Store</a> -->




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
                            <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe id="table_iframe_product_assign" height="750px" width="100%"></iframe>
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
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row  pt-2">
                    <!-- <form class="row mt-0 mb-0" id="edit_save_country" method="post" enctype="multipart/form-data"> -->
                 <input type="hidden" id="qr_code_id" >
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

    <!-- qr code end -->









