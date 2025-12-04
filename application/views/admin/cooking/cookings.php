
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="container">
            <div class="page-content p-2">

                


                <div class="container">
                    <div class="row">
                        <div class="col-12">
                        <div class="add-new-dish-list-combo mb-3">
                    <a   data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-cooking" class="add-new-dish-btn btn1">
                        <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                        Add Cooking Request
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
                if(isset($cookingDet[0]['id'])) {
                    $path=base_url().'admin/cooking/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'admin/cooking/add';
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
            <th>Malayalam</th>
            <th>English</th>
            <th>Hindi</th>
            <th>Arabic</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
                       if(!empty($cookings)){
                       $count = 1;
                       foreach($cookings as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $val['name_ma'];?></td>
                <td><?php echo $val['name_en'];?></td>
                <td><?php echo $val['name_hi'];?></td>
                <td><?php echo $val['name_ar'];?></td>
               
                <td class="pb-0 pt-0 d-flex">
                    <!-- <form class="m-0" action="<?php echo base_url();?>admin/cooking/edit" method="post"> -->
                     <input type="hidden" name="id" value="<?php echo $val['id']; ?>"> 
                    <button class="btn tblEditBtn edit_cooking pl-0 pr-0" type="submit" data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>" data-bs-target="#edit-cooking" data-bs-original-title="Edit"><i class="fa fa-edit"></i></button>
                    <!-- </form> -->
                    
                    <a class="btn tblDelBtn pl-0 pr-0 del_cooking" type="button" data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>" data-bs-original-title="Delete" data-bs-target="#delete-cooking"><i class="fa fa-trash"></i></a>
                    

                    </td>
            </tr>
            <?php $count++; }} ?>

           
            
        </tbody>
    
    </table>       
                            </div>
                        </div>
                    </div>




                            <!-- add cooking -->

        <div class="modal fade" id="add-cooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Cooking</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="add-new-cooking" method="post" enctype="multipart/form-data">
                       
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Malayalam)</label>
                                <input class="form-control" value="" placeholder="Malayalam" type="text"
                                    name="cooking_name_ma">
                                <span class="error errormsg mt-2" id="cooking_name_ma_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (English)</label>
                                <input class="form-control" value="" placeholder="English" type="text"
                                    name="cooking_name_en" >
                                <span class="error errormsg mt-2" id="cooking_name_en_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Hindi)</label>
                                <input class="form-control" value="" placeholder="Hindi" type="text"
                                    name="cooking_name_hi">
                                <span class="error errormsg mt-2" id="cooking_name_hi_error"></span>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Arabic)</label>
                                <input class="form-control" value="" placeholder="Arabic" type="text"
                                name="cooking_name_ar">
                                <span class="error errormsg mt-2" id="cooking_name_ar_error"></span>
                            </div>
                        </div>


                       

                        

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="add_cooking">Save</button>
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





     <!-- edit cooking -->

     <div class="modal fade" id="edit-cooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Cooking</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit-new-cooking" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="hidden_cooking_id">
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Malayalam)</label>
                                <input class="form-control" value="" placeholder="Malayalam" type="text"
                                    name="cooking_name_ma" id="cooking_name_ma">
                                <span class="error errormsg mt-2" id="cooking_edit_name_ma_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (English)</label>
                                <input class="form-control" value="" placeholder="English" type="text"
                                    name="cooking_name_en" id="cooking_name_en" >
                                <span class="error errormsg mt-2" id="cooking_edit_name_en_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Hindi)</label>
                                <input class="form-control" value="" placeholder="Hindi" type="text"
                                    name="cooking_name_hi" id="cooking_name_hi">
                                <span class="error errormsg mt-2" id="cooking_edit_name_hi_error"></span>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name (Arabic)</label>
                                <input class="form-control" value="" placeholder="Arabic" type="text"
                                name="cooking_name_ar" id="cooking_name_ar">
                                <span class="error errormsg mt-2" id="cooking_edit_name_ar_error"></span>
                            </div>
                        </div>


                       

                        

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn-primary w-md" type="button" id="save_cooking">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>
                   
                </div>
            </div>
        </div>



    </div>

   <!-- edit cooking -->


      <!-- delete user -->
<div class="modal fade " id="delete-cooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_cook_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_cook_user" type="button" data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete user -->


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
           </div>
            