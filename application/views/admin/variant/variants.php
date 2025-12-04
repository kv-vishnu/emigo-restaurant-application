
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="container">
            <div class="page-content p-2">

                


                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-variant" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Variant
                    </a>

                    <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
                        <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                      Back
                    </a>
                </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                    <!-- Displaying Date and Time -->
                    <!-- <?php $time=strtotime(date("Y/m/d"));
 $month=date("F",$time);
 $year=date("Y",$time);
 $date=date("d",$time);  ?>
                          <h2 class="f-w-400"> <span><?php echo $month; ?> <?php echo $date; ?> <?php echo $year; ?><sup><i class="fa fa-circle-o f-10"></i></sup></span></h2> -->
                    <!-- Displaying Date and Time -->
                    <?php 
                if(isset($variantDet[0]['variant_id'])) {
                    $path=base_url().'admin/variants/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'admin/variants/add';
                    $button_text='Save';
                    $button_name='add';
                }?>
                
                   
                   <!-- Section 2 -->
               </div>
                    <div class="row">
                        <div class="container">
                            <div class="table-responsive-sm">
                            <table id="example" class="table table-striped" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
                       if(!empty($variants)){
                       $count = 1;
                       foreach($variants as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $val['variant_name'];?></td>
                <td><?php echo $val['code'];?></td>
                <td class="pb-0 pt-0 d-flex">
                    <!-- <form class="m-0" action="<?php echo base_url();?>admin/variants/edit" method="post"> -->
                                      <input type="hidden" name="id" value="<?php echo $val['variant_id']; ?>"> 
                                        <button class="btn tblEditBtn edit_variant pl-0 pr-0" type="submit" data-bs-toggle="modal" data-id="<?php echo $val['variant_id']; ?>" data-bs-target="#edit-variant" data-bs-original-title="Edit Variant"><i class="fa fa-edit"></i></button>
                    <!-- </form> -->
                    
                    <a class="btn tblDelBtn pl-0 pr-0 del_variant" type="button" data-bs-toggle="modal" data-id="<?php echo $val['variant_id']; ?>" data-bs-original-title="Delete Variant" data-bs-target="#delete-variant"><i class="fa fa-trash"></i></a>
                    

                    </td>
            </tr>
            <?php $count++; }} ?>
        </tbody>
    </table>

   </div>
   </div>
   </div>



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
                          <!-- end -->


 <!-- add variant -->

  <div class="modal fade" id="add-variant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"     aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Variant</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="add-new-variant" method="post" enctype="multipart/form-data">
                       
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input class="form-control" value="" placeholder="Malayalam" type="text"
                                    name="variant_name">
                                <span class="error errormsg mt-2" id="variant_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">code</label>
                                <input class="form-control" value="" placeholder="English" type="text"
                                    name="variant_code" >
                                <span class="error errormsg mt-2" id="variant_code_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="add_variant">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- add variant -->      
     
    


     <!-- edit variant -->

  <div class="modal fade" id="edit-variant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"     aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Variant</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit-new-variant" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="hidden_variant_id">
                       
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input class="form-control" value="" placeholder="Malayalam" type="text"
                                    name="variant_name" id="variant_name">
                                <span class="error errormsg mt-2" id="variant_edit_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">code</label>
                                <input class="form-control" value="" placeholder="English" type="text"
                                    name="variant_code" id="variant_code">
                                <span class="error errormsg mt-2" id="variant_edit_code_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="save_variant">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- edit variant --> 



          <!-- delete variant -->
<div class="modal fade " id="delete-variant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_var_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_cook_user" type="button" data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete variant -->


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




            </div>
                       </div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>