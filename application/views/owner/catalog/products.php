<div class="application-content dashboard-content">
    <div class="application-content__container container">
        <!--<h1 class="application-content__page-heading">Dishes Catalog</h1>-->

        <div class="search-add-new-dish-list-combo">
            <form class="product-search__form search">
                <input type="text" id="search_product" placeholder="Search for a product" name="search"
                    class="product-search__field search-input1">
                <button type="submit" class="product-search__button"><img
                        src="<?php echo base_url(); ?>assets/admin/images/product-search-icon.svg" width="22"
                        height="23" alt="SearchIcon" class="product-search__icon"></button>
                <ul id="autocomplete-results1" class="autocomplete-results">
                </ul>
            </form>
            <div class="add-new-dish-list-combo">
                <a href="<?php echo base_url('owner/product/add'); ?>" class="add-new-dish-btn btn1">
                    <img src="<?php echo base_url(); ?>assets/admin/images/add-new-dish-icon.svg" alt="add new dish"
                        class="add-new-dish__icon" width="23" height="23">
                    Add New Dish
                </a>
                <!-- <a href="<?php echo base_url('owner/combo'); ?>" class="list-combo-btn btn2">
                    <img src="<?php echo base_url(); ?>assets/admin/images/list-combo-icon.svg" alt="list combo icon"
                        class="list-combo__icon" width="23" height="23">
                    Combos
                </a> -->
            </div>

        </div>
        <div class="product-list" id="search_result_container">

            <?php
            if(!empty($products)){
                // print_r($products);
                $count = 1;
                foreach($products as $val){

                    if($val['category_id'] != 23 ){
                        $stock = $this->Ordermodel->getCurrentStock($val['store_product_id'], $date, $this->session->userdata('logged_in_store_id'));
 ?>
            <div class="product-list__item">
                <div class="product-list__item-image-and-details">
                   <?php
                        $storeImage = !empty($val['store_image']) ? $val['store_image'] : 'default.png';
                        $path = site_url("uploads/product/" . ($storeImage));
                        $product_name =  ($val['store_product_name_en'] != '') ? $val['store_product_name_en'] : $val['product_name_en'];
                    ?>
                    <img src="<?php echo $path; ?>" alt="<?= $product_name ?>" class="product-list__item-img" width="190"
                        height="150">
                    <div class="product-list__item-details">
                        <h3 class="product-list__item-name">
                        <?= $product_name ?>
                        </h3>
                        <p class="product-list__item-price">
                            ₹<?php
                                            if ($val['is_customizable'] == 0)
                                            {
                                                echo $val['rate'];
                                            }
                                            else
                                            {
                                                $this->Ordermodel->getCustomizeProductDefaultPrice($val['store_product_id'], $this->session->userdata('logged_in_store_id'));
                                            }
                            ?></p>



                        <?php
                        $status = ($stock > 0) && ($val['availability'] == 0) ? 'available' : 'unavailable';
                        ?>
                        <p class="product-list__item-status-<?php echo $status; ?> text-capitalize">
                            <?php echo $status; ?>
                        </p>
                        <div class="product-list__item-details-availability-stock">
                            <select width="50%" class="change_availability"
                                data-id="<?php echo $val['store_product_id']; ?>" class="form-select mb-2">

                                <option value="0" <?php echo ($val['availability'] == 0) ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="1" <?php echo ($val['availability'] == 1) ? 'selected' : ''; ?>>
                                    Inactive
                                </option>
                            </select>

                            <div class="product-list__item-stock">
                                <div class="product-list__item-stock-label">Stock</div>
                                <div class="product-list__item-stock-count">
                                    <?php
                                     echo ($stock !== null && $stock !== false) ? $stock : 0;
                                ?>
                                </div>



                            </div>
                            <div class="mt-2">
                                <?php
echo ($val['is_customizable'] == 1) ? 'Customisable' : '';
?>
                                </div>
                        </div>

                    </div>
                </div>
                <div class="product-list__item-buttons-block">
                    <div class="product-list__item-buttons-block-one">
                        <a href=""
                            class="product-list__item-buttons-block-btn product-list__item-buttons-block-add-new-stock-btn btn6 add_stock"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_product_id']; ?>"
                            data-bs-target="#addstock"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/add-stock-icon.svg" alt="add stock"
                                width="23" height="24"> Add Stock</a>
                        <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-remove-stock-btn remove_stock"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_product_id']; ?>"
                            data-bs-target="#removestock"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/remove-stock-icon.svg"
                                alt="remove stock" width="23" height="22">Remove Stock</a>
                    </div>
                    <div class="product-list__item-buttons-block-two">
                        <?php if($stock == 0){ ?>
                        <a href=""
                            class="product-list__item-buttons-block-btn btn6 product-list__item-buttons-block-next-available-btn nextavialable-modal"
                            data-bs-toggle="modal" data-id="<?php echo $val['store_product_id']; ?>"
                            data-bs-target="#nextavailabletime"><img class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/next-available-time-icon.svg"
                                alt="next available button stock" width="23" height="24">Next
                            Available Time</a>
                        <?php } ?>

                        <?php
                        $is_customizable =  $this->Productmodel->getCustomisableById($val['store_product_id'],$this->session->userdata('logged_in_store_id'));
                        ?>

                        <?php if ($this->session->userdata('role_id') == 2){ ?>
                        <a data-bs-toggle="modal" data-bs-target="#Edit-dish"
                            data-id="<?php echo $val['store_product_id']; ?>"
                            data-isCustomizable="<?php echo $is_customizable['is_customizable']; ?>" href=""
                            class="product-list__item-buttons-block-btn btn6 store_product_details product-list__item-buttons-block-edit-btn"><img
                                class="product-list__item-button-img"
                                src="<?php echo base_url(); ?>assets/admin/images/edit-dish-icon.svg" alt="add stock"
                                width="23" height="22">Edit Dish</a>
                        <?php } ?>
                    </div>



                </div>
            </div>
            <?php $count++; }} } ?>



        </div>
        <div class="pagination-wrapper">
            <?= $pagination; ?>
        </div>

    </div>



</div>

<!-- Enable Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <p id="enabledisable_message">Are you sure?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button>
        <button class="btn btn-danger" id="confirmStatusChange" type="button">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Enable Confirmation Modal -->



<!-- vishnu -->
<!-- modal for Add Stock -->
<div class="emigo-modal modal fade" id="addstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header emigo-modal__header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Add Stock</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body emigo-modal__body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <form action="" id="productstock" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control form__input-text" id="product_id" name="product_id"
                        value="">
                    <input type="number" class="form__input-text form-control mt-2" placeholder="Enter your Quanity"
                        name="pu_qty" id="stocks" value="">
                    <span class="error errormsg mt-2" id="addstocks_error"></span>
                </form>
                <div class="mt-2 text-center m-auto">
                    <button class="btn1-small" type="button" id="addStockBtn">ADD</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal for Add Stock -->

<!-- Modal for remove stock -->
<div class="emigo-modal modal fade" id="removestock" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header emigo-modal__header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Remove Stock</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body emigo-modal__body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <!-- if response within jquery -->
                <form action="" id="removesstock" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control form__input-text" id="product_id_remove"
                        name="product_id_remove" value="">
                    <input type="number" class="form-control mt-2 form__input-text" placeholder="Enter your Quanity"
                        name="sl_qty" id="remove_stocks" value="">
                    <span class="error errormsg mt-2" id="removestocks_error"></span>
                </form>
                <!-- <h1>addons</h1> -->
                <div class="mt-2 text-center m-auto">
                    <button class="btn1-small " type="button" id="removeStockBtn">REMOVE</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal for remove stock -->

<!-- Enable Confirmation Modal -->
<div class="modal fade" id="confirmDeleteProduct" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <p id="enabledisable_message">Are you sure?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button>
        <button class="btn btn-danger" id="confirmDeleteProductbtn" type="button">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Enable Confirmation Modal -->


<!-- Change Dish Informations -->

<!-- Change Description -->
<div class="emigo-modal modal fade" id="Edit-dish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header emigo-modal__header">
                <h1 class="emigo-modal__heading text-center" id="exampleModalLabel">Product Details</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body emigo-modal__body">

                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <!-- if response within jquery -->

                <input type="hidden" id="hiddenField" name="product_id" value="">
                <input type="hidden" id="isCustomizable" value="">
                <div class="container">
                    <div class="row mb-5 justify-content-center emigo-modal__header-button-group">
                        <a class="store_product btn7-small">Product</a>
                        <a class="addVariant btn7-small isCustomize">Variants</a>
                        <a class="addAddons btn7-small isCustomize">Addons</a>
                        <a class="addRecipe btn7-small isCustomize">Recipe</a>
                        <a class="addPhotos btn7-small ">Photos</a>
                    </div>
                </div>
                <div class="row">
                    <iframe id="iframe_body" height="700px" width="100%">rwerwerwer</iframe>
                    <form class="product-details-form" id="productForm" method="post" enctype="multipart/form-data">
                        <div class="product-details-form__section">
                            <div class="product-details-form__item">
                                <input type="hidden" id="product_id_new" name="product_id">
                                <label class="col-form-label product_rate_label">Rate</label>
                                <input type="text" class="form-control form__input-text product_rate"
                                    id="store_product_rate" name="store_product_rate" value="">
                            </div>
                            <div>
                                <label class="col-form-label">Customisable</label>
                                <select name="store_is_customisable" class="form-select " id="store_is_customisable">
                                <option value="0">Not customisable</option>
                                <option value="1">Customisable</option>
                                </select>
                            </div>
                            <div>
                            <label class="col-form-label">Type</label>
                                <select name="type" class="form-select " id="type">
                                <option value="veg">Veg</option>
                                <option value="non-veg">Non veg</option>
                                </select>
                            </div>
                            <div>
                            <label class="col-form-label">Is addon</label>
                                <select name="is_addon" class="form-select " id="is_addon">
                                <option value="0">No</option>
                                <option value="1">yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="product-details-form__section">
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Malayalam)</label>
                                <input type="text" class="form-control form__input-text" id="store_product_name_ma"
                                    name="store_product_name_ma" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (English)</label>
                                <input type="text" class="form-control form__input-text" id="store_product_name_en"
                                    name="store_product_name_en" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Hindi)</label>
                                <input type="text" class="form-control form__input-text" id="store_product_name_hi"
                                    name="store_product_name_hi" value="">
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Name (Arabic)</label>
                                <input type="text" class="form-control form__input-text" id="store_product_name_ar"
                                    name="store_product_name_ar" value="">
                            </div>
                        </div>

                        <div class="product-details-form__section">
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Malayalam)</label>
                                <textarea class="form-control product-details-form__textarea"
                                    name="description_malayalam" id="description_malayalam"
                                    placeholder="Malayalam"></textarea>
                                <span class="error errormsg mt-2" id="description_malayalam_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (English)</label>
                                <textarea class="form-control product-details-form__textarea" name="description_english"
                                    id="description_english" placeholder="English"></textarea>
                                <span class="error errormsg mt-2" id="description_english_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Hindi)</label>
                                <textarea class="form-control product-details-form__textarea" name="description_hindi"
                                    placeholder="hindi" id="description_hindi"></textarea>
                                <span class="error errormsg mt-2" id="description_hindi_error"></span>
                            </div>
                            <div class="product-details-form__item">
                                <label class="col-form-label">Description (Arabic)</label>
                                <textarea class="form-control product-details-form__textarea" name="description_arabic"
                                    id="description_arabic" placeholder="arabic"></textarea>
                                <span class="error errormsg mt-2" id="description_arabic_error"></span>
                            </div>
                        </div>

                        <div class="mt-2 text-center m-auto">
                            <button class="btn btn1 mt-2" type="button" id="saveProduct">Save</button>
                            <button class="btn btn7 mt-2 delete_store_product" type="button">Delete</button>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end -->



<div class="emigo-modal modal fade" id="nextavailabletime" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header emigo-modal__header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Next Available Time</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body emigo-modal__body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <!-- if response within jquery -->
                <form id="avialablestimes" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="product_id_time" value="">
                    <div class="col-12">
                        <label for="exampleSelect" class="form-label">Select an Option</label>
                        <select class="form-select form__input-select" id="available_select" style="margin-bottom:1rem">
                            <option value="Available Morning">Available Morning</option>
                            <option value="Available Afternoon">Available Afternoon</option>
                            <option value="Available Night">Available Night</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="default-input">Available Time</label>
                        <!-- <input type="text" class="form-control" name="name" id="time" value=""> -->
                        <div class="emigo-modal__time-container time-container d-flex ">
                            <!-- Hour Input -->
                            <input type="number" class="form-control form__input-text mx-1" id="hours" min="1" max="12"
                                value="12">
                            <input type="number" class="form-control form__input-text mx-1" id="minutes" min="0"
                                max="59" value="00">
                            <!-- AM/PM Dropdown -->
                            <select class="form-select form__input-select" id="ampm">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                    <!-- <input type="text" class="form-control mt-2" placeholder="Enter your Quanity" name="sl_qty"
                        id="remove_stocks" value=""> -->
                    <span class="error errormsg mt-2" id="removestocks_error"></span>
                </form>
                <!-- <h1>addons</h1> -->
                <div class="mt-2 text-center m-auto">
                    <button class="btn1-small " type="button" id="nextavaialabletimes">Update</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>