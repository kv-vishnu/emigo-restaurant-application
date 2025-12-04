
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="container p-0">
            <div class="page-content p-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add product" data-bs-target="#add-product" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Product
                    </a>

                    <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
                        <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                      Back
                    </a>

                    <div class="mt-3">
                    <form class="product-search__form search">
                <input type="text" id="search_admin_product" placeholder="Search for a product" name="search"
                    class="product-search__field search-input1">
                <button type="submit" class="product-search__button"><img
                        src="<?php echo base_url(); ?>assets/admin/images/product-search-icon.svg" width="22"
                        height="23" alt="SearchIcon" class="product-search__icon"></button>
                <ul id="autocomplete-results1" class="autocomplete-results">
                </ul>
            </form>
                    </div>
                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                    <!-- <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success dark" role="alert">
                        <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                    </div><?php } ?>

                    <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger dark" role="alert">
                        <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                    </div><?php } ?> -->

                        <div class="container">
                            <div class="table-responsive-sm">
                            <!-- <div class="product-list" id="search_result_admin_container"> -->

        <table id="example" class="table table-striped" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody id="search_result_admin_container">



        <?php
                       if(!empty($products)){
                       $count = 1;
                       foreach($products as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                 <td><?php echo $val['product_name_en'];?></td>
                 <td><?php echo $val['category_name_en'];?></td>
                 <td><img width="100" height="100" src="<?php echo base_url(); ?>uploads/product/<?php if(isset($val['image1'])) echo $val['image1']; ?>" class="img-thumbnail"></td>
                <td>
                                        <?php if ($val['is_active'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger toggle-status disable_item"
                                                    data-id="<?php echo $val['product_id']; ?>"
                                                    data-type = "product"
                                                    data-status="0">
                                                Disable
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-success toggle-status enable_item"
                                                    data-id="<?php echo $val['product_id']; ?>"
                                                    data-type = "product"
                                                    data-status="1">
                                                Enable
                                            </button>
                                        <?php } ?>
                                    </td>
                <td class="pb-0 pt-0 d-flex">
                                      <input type="hidden" name="id" value="<?php echo $val['product_id']; ?>">
                                        <button class="btn tblEditBtn edit_product pl-0 pr-0" type="submit" data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>" data-bs-original-title="Edit Product" data-bs-target="#edit-product"><i class="fa fa-edit"></i></button>
                    <!-- <a class="btn tblDelBtn pl-0 pr-0 del_product" type="button" data-bs-toggle="modal" data-id="<?php echo $val['product_id']; ?>" data-bs-original-title="Delete Product" data-bs-target="#delete-product"><i class="fa fa-trash"></i></a> -->
                </td>
            </tr>
            <?php $count++; }} ?>



        </tbody>
    </table>











                            </div>
                            <div class="pagination-wrapper">
            <?= $pagination; ?>
        </div>

                        </div>
                    </div>



      <!-- add cooking -->

      <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Product</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
<form class="row mt-0 mb-0" id="add-new-product" method="post" enctype="multipart/form-data">

    <!-- Category -->
    <div class="col-md-12">
        <div class="mb-2">
            <label class="form-label">Category</label>
            <select class="form-select" name="category_id">
                <option value="">Select Category</option>
                <?php foreach($categories as $category) { ?>
                    <option value="<?= $category['category_id']; ?>">
                        <?= $category['category_name_en']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- Product Names -->
    <div class="col-md-3">
        <label>Product Malayalam</label>
        <input class="form-control" type="text" name="products_name_ma">
    </div>

    <div class="col-md-3">
        <label>Product English</label>
        <input class="form-control" type="text" name="products_name_en">
    </div>

    <div class="col-md-3">
        <label>Product Hindi</label>
        <input class="form-control" type="text" name="products_name_hi">
    </div>

    <div class="col-md-3">
        <label>Product Arabic</label>
        <input class="form-control" type="text" name="products_name_ar">
    </div>

    <!-- Descriptions -->
    <div class="col-md-3">
        <label>Description Malayalam</label>
        <textarea name="products_desc_ma" class="form-control"></textarea>
    </div>

    <div class="col-md-3">
        <label>Description English</label>
        <textarea name="products_desc_en" class="form-control"></textarea>
    </div>

    <div class="col-md-3">
        <label>Description Hindi</label>
        <textarea name="products_desc_hi" class="form-control"></textarea>
    </div>

    <div class="col-md-3">
        <label>Description Arabic</label>
        <textarea name="products_desc_ar" class="form-control"></textarea>
    </div>

    <!-- Images -->
    <div class="col-md-3">
        <label>Image 1</label>
        <input type="file" class="form-control" name="image1" accept="image/*">
    </div>

    <div class="col-md-3">
        <label>Image 2</label>
        <input type="file" class="form-control" name="image2" accept="image/*">
    </div>

    <div class="col-md-3">
        <label>Image 3</label>
        <input type="file" class="form-control" name="image3" accept="image/*">
    </div>

    <div class="col-md-3">
        <label>Image 4</label>
        <input type="file" class="form-control" name="image4" accept="image/*">
    </div>

    <!-- Submit -->
    <div class="col-md-12 mt-3">
        <button class="btn btn1 w-md" type="submit" id="add_product" style="float:right;">Save</button>
    </div>

</form>


                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- add cooking -->




          <!-- edit product -->

          <div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Product</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit-new-product" method="post" enctype="multipart/form-data">
    <input type="hidden" id="hidden_products_id">

    <!-- Category (single row full width) -->
    <div class="col-md-12">
        <div class="mb-2">
            <label class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option value="">Select Category</option>
                <?php foreach($categories as $category) { ?>
                    <option value="<?=$category['category_id'];?>"
                        <?php if(isset($productDet[0]['category_id']) && ($productDet[0]['category_id']==$category['category_id'])) echo 'selected'; else echo set_select('category_id', $category['category_id']); ?>>
                        <?=$category['category_name_en'];?>
                    </option>
                <?php } ?>
            </select>
            <span class="error errormsg mt-2" id="category_edit_id_error"></span>
            <div id="general_error" class="error errormsg"></div>
        </div>
    </div>

    <!-- Product Names (4 in one row) -->
    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Product Malayalam</label>
            <input class="form-control" type="text" placeholder="Malayalam"
                   name="products_name_ma" id="products_name_ma">
            <span class="error errormsg mt-2" id="products_edit_name_ma_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Product English</label>
            <input class="form-control" type="text" placeholder="English"
                   name="products_name_en" id="products_name_en">
            <span class="error errormsg mt-2" id="products_edit_name_en_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Product Hindi</label>
            <input class="form-control" type="text" placeholder="Hindi"
                   name="products_name_hi" id="products_name_hi">
            <span class="error errormsg mt-2" id="products_edit_name_hi_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Product Arabic</label>
            <input class="form-control" type="text" placeholder="Arabic"
                   name="products_name_ar" id="products_name_ar">
            <span class="error errormsg mt-2" id="products_edit_name_ar_error"></span>
        </div>
    </div>

    <!-- Descriptions (4 in one row) -->
    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Description Malayalam</label>
            <textarea name="products_desc_ma" id="products_desc_ma"
                      class="form-control" placeholder="Malayalam"></textarea>
            <span class="error errormsg mt-2" id="products_edit_desc_ma_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Description English</label>
            <textarea name="products_desc_en" id="products_desc_en"
                      class="form-control" placeholder="English"></textarea>
            <span class="error errormsg mt-2" id="products_edit_desc_en_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Description Hindi</label>
            <textarea name="products_desc_hi" id="products_desc_hi"
                      class="form-control" placeholder="Hindi"></textarea>
            <span class="error errormsg mt-2" id="products_edit_desc_hi_error"></span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-2">
            <label class="form-label">Description Arabic</label>
            <textarea name="products_desc_ar" id="products_desc_ar"
                      class="form-control" placeholder="Arabic"></textarea>
            <span class="error errormsg mt-2" id="products_edit_desc_ar_error"></span>
        </div>
    </div>

    <!-- Images (4 in one row) -->
    <div class="col-md-3">
        <input type="file" class="form-control" name="image1" id="image1" accept="image/*" required>
        <input type="hidden" name="imagehidden1" id="imagehidden1">
        <img id="images1" src="" alt="Image 1" width="100">
        <span class="error errormsg mt-2" id="products_edit_image1_error"></span>
    </div>

    <div class="col-md-3">
        <input type="file" class="form-control" name="image2" id="image2" accept="image/*" required>
        <input type="hidden" name="imagehidden2" id="imagehidden2">
        <img id="images2" src="" alt="Image 2" width="100">
        <span class="error errormsg mt-2" id="products_edit_image2_error"></span>
    </div>

    <div class="col-md-3">
        <input type="file" class="form-control" name="image3" id="image3" accept="image/*" required>
        <input type="hidden" name="imagehidden3" id="imagehidden3">
        <img id="images3" src="" alt="Image 3" width="100">
        <span class="error errormsg mt-2" id="products_edit_image3_error"></span>
    </div>

    <div class="col-md-3">
        <input type="file" class="form-control" name="image4" id="image4" accept="image/*" required>
        <input type="hidden" name="imagehidden4" id="imagehidden4">
        <img id="images4" src="" alt="Image 4" width="100">
        <span class="error errormsg mt-2" id="products_edit_image4_error"></span>
    </div>

    <!-- Submit -->
    <div class="col-md-12 mt-3">
        <div class="justify-content-center" style="float: right;">
            <button class="btn btn1 w-md" type="button" id="save_product">Update</button>
        </div>
    </div>
</form>

                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- add cooking -->




<!-- Modal for detailed view -->
                    <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="emp-informations.html" style="width: 100%; height: 500px;"></iframe>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end --></div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>



