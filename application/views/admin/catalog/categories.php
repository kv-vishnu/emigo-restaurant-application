<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-category" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Categories
                    </a>
                    <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
                        <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                      Back
                    </a>
                </div>
                    </div>
            </div>
            <div class="row">

                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success dark" role="alert">
                    <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                </div><?php } ?>

                <?php if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger dark" role="alert">
                    <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                </div><?php } ?>



                <div class="">
                    <div class="table-responsive-sm">






                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($categories)){
                       $count = 1;
                       foreach($categories as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['category_name_en'];?></td>
                                    <td>
                                        <input type="text" class="form-control update_category_order" style="width:30%;"
                                            value="<?php echo $val['order_index']; ?>"
                                            data-category-id="<?php echo $val['category_id']; ?>" />
                                    </td>

                                    <td>
                                        <?php if ($val['is_active'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger toggle-status disable_item"
                                                    data-id="<?php echo $val['category_id']; ?>"
                                                    data-type = "category"
                                                    data-status="0">
                                                Disable
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-success toggle-status enable_item"
                                                    data-id="<?php echo $val['category_id']; ?>"
                                                    data-type = "category"
                                                    data-status="1">
                                                Enable
                                            </button>
                                        <?php } ?>
                                    </td>

                                    <td class="pb-0 pt-0 d-flex">

                                            <input type="hidden" name="id" value="<?php echo $val['category_id']; ?>">
                                            <button class="btn tblEditBtn edit_category pl-0 pr-0" type="submit"
                                                data-bs-toggle="modal" data-id="<?php echo $val['category_id']; ?>"
                                                data-bs-original-title="Edit Category" data-bs-target="#edit-category"><i
                                                    class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                                <?php $count++; }} ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!-- Modal for detailed view -->
            <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
            <!-- end -->




        <!-- add category -->

        <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Category</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                       <!-- Add category form start -->
                    <form class="row g-3 mt-0 mb-0" id="addCategories" enctype="multipart/form-data" method="post" style="width:100%">

                        <!-- Order field full width -->
                        <div class="col-12">
                            <label class="form-label">Order</label>
                            <input type="text" readonly class="form-control" name="category_order"
                                value="<?php echo $order_index; ?>" placeholder="Order">
                            <span class="error errormsg mt-2" id="category_order_error"></span>
                            <div id="general_error" class="error errormsg"></div>
                        </div>

                        <!-- Four fields per row -->
                        <div class="col-md-3">
                            <label class="form-label">Category Malayalam</label>
                            <input class="form-control" type="text" placeholder="Malayalam" name="category_name_ma">
                            <span class="error errormsg mt-2" id="category_name_ma_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Category English</label>
                            <input class="form-control" type="text" placeholder="English" name="category_name_en">
                            <span class="error errormsg mt-2" id="category_name_en_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Category Hindi</label>
                            <input class="form-control" type="text" placeholder="Hindi" name="category_name_hi">
                            <span class="error errormsg mt-2" id="category_name_hi_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Category Arabic</label>
                            <input class="form-control" type="text" placeholder="Arabic" name="category_name_ar">
                            <span class="error errormsg mt-2" id="category_name_ar_error"></span>
                        </div>

                        <!-- Descriptions, also 4 in a row -->
                        <div class="col-md-3">
                            <label class="form-label">Desc Malayalam</label>
                            <textarea name="category_desc_ma" class="form-control" placeholder="Malayalam"></textarea>
                            <span class="error errormsg mt-2" id="category_name_desc_ma_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Desc English</label>
                            <textarea name="category_desc_en" class="form-control" placeholder="English"></textarea>
                            <span class="error errormsg mt-2" id="category_name_desc_en_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Desc Hindi</label>
                            <textarea name="category_desc_hi" class="form-control" placeholder="Hindi"></textarea>
                            <span class="error errormsg mt-2" id="category_name_desc_hi_error"></span>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Desc Arabic</label>
                            <textarea name="category_desc_ar" class="form-control" placeholder="Arabic"></textarea>
                            <span class="error errormsg mt-2" id="category_name_desc_ar_error"></span>
                        </div>

                        <!-- Save Button -->
                        <div class="col-12 text-end mt-3">
                            <button class="btn btn1 w-md" type="button" id="add_category">Save</button>
                        </div>
                    </form>
                    <!-- Add category form end -->
                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- add category -->
    <!-- <input type="text" id="hidden_category_id" > -->

    <!-- edit category -->
    <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit_categories"
                        enctype="multipart/form-data" method="post" >

                        <input type="hidden" id="hidden_category_id">

                        <!-- Order (full width single line) -->
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label" for="category_order">Order</label>
                                <input type="text" class="form-control" readonly
                                    name="category_order" id="category_order"
                                    value="" placeholder="Order">
                                <span class="error errormsg mt-2" id="category_edit_order_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <!-- Category Names (4 in one row) -->
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_name_ma">Category Malayalam</label>
                                <input class="form-control" type="text"
                                    placeholder="Malayalam" name="category_name_ma" id="category_name_ma">
                                <span class="error errormsg mt-2" id="category_edit_name_ma_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_name_en">Category English</label>
                                <input class="form-control" type="text"
                                    placeholder="English" name="category_name_en" id="category_name_en">
                                <span class="error errormsg mt-2" id="category_edit_name_en_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_name_hi">Category Hindi</label>
                                <input class="form-control" type="text"
                                    placeholder="Hindi" name="category_name_hi" id="category_name_hi">
                                <span class="error errormsg mt-2" id="category_edit_name_hi_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_name_ar">Category Arabic</label>
                                <input class="form-control" type="text"
                                    placeholder="Arabic" name="category_name_ar" id="category_name_ar">
                                <span class="error errormsg mt-2" id="category_edit_name_ar_error"></span>
                            </div>
                        </div>

                        <!-- Category Descriptions (4 in one row) -->
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_desc_ma">Desc Malayalam</label>
                                <textarea name="category_desc_ma" id="category_desc_ma" class="form-control"
                                        placeholder="Malayalam" rows="2"></textarea>
                                <span class="error errormsg mt-2" id="category_edit_name_desc_ma_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_desc_en">Desc English</label>
                                <textarea name="category_desc_en" id="category_desc_en" class="form-control"
                                        placeholder="English" rows="2"></textarea>
                                <span class="error errormsg mt-2" id="category_edit_name_desc_en_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_desc_hi">Desc Hindi</label>
                                <textarea name="category_desc_hi" id="category_desc_hi" class="form-control"
                                        placeholder="Hindi" rows="2"></textarea>
                                <span class="error errormsg mt-2" id="category_edit_name_desc_hi_error"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="category_desc_ar">Desc Arabic</label>
                                <textarea name="category_desc_ar" id="category_desc_ar" class="form-control"
                                        placeholder="Arabic" rows="2"></textarea>
                                <span class="error errormsg mt-2" id="category_edit_name_desc_ar_error"></span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1 w-md" type="button" id="save_category">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit country -->


    <!-- delete user -->
    <div class="modal fade " id="delete-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_cat_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_cat_user" type="button" data-bs-dismiss="modal">Yes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










        </div>