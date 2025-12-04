<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-whatsappno" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Whatsapp
                    </a>
                    <a href="<?php echo base_url('owner/settings'); ?>"   class="add-new-dish-btn btn1">
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
                                    <th>Whatsapp No</th>
                                    <!-- <th>Image</th> -->
                                    <!-- <th>Order</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($whatsappno)){
                       $count = 1;
                       foreach($whatsappno as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <!-- <td><?php echo $val['id']; ?></td> -->
                                    <td><?php echo $val['whatsapp_no'];?></td>
                                     <!-- <td><img width="100" height="100"
                                            src="<?php echo base_url(); ?>uploads/categories/<?php if(isset($val['category_img'])) echo $val['category_img']; ?>"
                                            class="img-thumbnail"></td> -->
                                   

                                    <!-- <td><?php if($val['is_active'] == 1){ ?> <span class="badge-success">Active</span>
                                        <?php } else { ?> <span class="badge-danger">Inactive</span> <?php }?></td> -->
                                    <td class="pb-0 pt-0 d-flex">
                                       
                                         
                                     

                                        <a class="btn tblDelBtn pl-0 pr-0 del_whatsapp" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-whatsapp"><i
                                                class="fa fa-trash"></i></a>

                                                
                                        <!-- <a data-bs-toggle="modal" data-bs-target="#emp_informations" class="btn tblLogBtn pl-0 pr-0" type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Additional Informations">
                        <i class="fa-solid fa-circle-plus"></i>
                    </a> -->
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

        <div class="modal fade" id="add-whatsappno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Whatsapp No</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="addWhatsappno"
                    enctype="multipart/form-data" method="post" >
                        

                       

                        <div class="col-md-5">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Whatsapp No</label>
                                <input class="form-control" value="" placeholder="Enter Whatsapp No"
                                type="text" name="whatsapp_no">
                                <span class="error errormsg mt-2" id="whatsapp_no_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                        <div class="justify-content-center " style="float: right; margin-top:1.8rem;">
                                <button class="btn btn-primary w-md"  type="button" id="add_whatsapp_no" >Save</button>
                            </div>    
                        </div>



                        

                        <!-- <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md"  type="button" id="add_category" >Save</button>
                            </div>
                        </div> -->
                    </form>
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
                        <h2 class="modal-title" id="exampleModalLabel">edit category</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                        <form class="row mt-0 mb-0" id="edit_categories"
                        enctype="multipart/form-data" method="post" >

                        <input type="hidden" id="hidden_category_id" >
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Code</label>
                                    <input class="form-control" value="" placeholder="code"
                                    type="text" name="category_code" id="category_code">
                                    <span class="error errormsg mt-2" id="category_edit_code_error"></span>
                                    <div id="general_error" class="error errormsg"></div>
                                   
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Order</label>
                                    <input type="text" class="form-control" readonly name="category_order" id="category_order"
                                    value="" placeholder="Order"> 
                                    <span class="error errormsg mt-2" id="category_edit_order_error"></span>
                                    <div id="general_error" class="error errormsg"></div>
                                </div>
                            </div>
    
    
                            <!-- <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">photo</label>
                                    <input  type="hidden" value="" class="form-control-file"  name="existing_userfile" id="existing_userfile">
                                    <input  type="file" value="" class="form-control-file" name="userfile" id="userfile">
                                    <img id="preview_img" src="" alt="Preview" style="max-width: 150px;">
                                    <span class="error errormsg mt-2" id="category_edit_userfile_error"></span>
                                </div>
                            </div> -->
    
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Category Malayalam</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="Malayalam" name="category_name_ma" id="category_name_ma">
                                    <span class="error errormsg mt-2" id="category_edit_name_ma_error"></span>
                                </div>
                            </div>
    
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Category English</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="English" name="category_name_en" id="category_name_en">
                                    <span class="error errormsg mt-2" id="category_edit_name_en_error" ></span>
                                </div>
                            </div>
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> category Hindi</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="Hindi" name="category_name_hi" id="category_name_hi">
                                    <span class="error errormsg mt-2" id="category_edit_name_hi_error"></span>
                                </div>
                            </div>
    
    
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input"> Category  Arabic</label>
                                    <input class="form-control"
                                    value="" type="text"
                                    placeholder="Arabic" name="category_name_ar" id="category_name_ar">
                                    <span class="error errormsg mt-2" id="category_edit_name_ar_error"></span>
                                </div>
                            </div>
    
    
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Desc malayalam</label>
                                    <textarea name="category_desc_ma" id="category_desc_ma" class="form-control"
                                  id="category_desc_ma" placeholder="Malayalam"
                                    rows=""></textarea>
                                    <span class="error errormsg mt-2" id="category_edit_name_desc_ma_error"></span>
                                
                                </div>
                            </div>
    
    
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Desc English</label>
                                    <textarea name="category_desc_en"  class="form-control"
                                         id="category_desc_en" placeholder="English"
                                                   rows=""></textarea>
                                 <span class="error errormsg mt-2" id="category_edit_name_desc_en_error"></span>
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Desc Hindi</label>
                                    <textarea  name="category_desc_hi" id="category_desc_hi" class="form-control"
                                  id placeholder="Hindi"
                                    rows=""></textarea>
                             <span class="error errormsg mt-2" id="category_edit_name_desc_hi_error"></span>
                                
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Desc Arabic</label>
                                    <textarea name="category_desc_ar" class="form-control"
                                  id="category_desc_ar" placeholder="Arabic"
                                    rows=""></textarea>
                                    <span class="error errormsg mt-2" id="category_edit_name_desc_ar_error"></span>
                                
                                
                                </div>
                            </div>
    
    
    
    
                            
    
                            <div class="col-md-12">
                                <div class="justify-content-center" style="float: right;">
                                    <button class="btn btn-primary w-md"  type="button" id="save_category" >Update</button>
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



 <!-- success modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel"></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary reload-close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- success modal -->


    <!-- delete user -->
    <div class="modal fade " id="delete-whatsapp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_whatsapp_no_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_whatsapp_no_user" type="button" data-bs-dismiss="modal">Yes</button>
                </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










        </div>