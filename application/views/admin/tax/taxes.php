
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="">
            <div class="page-content p-2">




            <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="add-new-dish-list-combo">
                <a  href="#" data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-tax" class="add-new-dish-btn btn1">
                    <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
" alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                    Add Tax
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



                    <!-- <?php
                if(isset($taxDet[0]['tax_id'])) {
                    $path=base_url().'admin/tax/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'admin/tax/add';
                    $button_text='Save';
                    $button_name='add';
                }?>
                 -->
                    <!-- <form method="post" action="<?php echo $path; ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php  if(isset($taxDet[0]['tax_id'])){echo $taxDet[0]['tax_id'];}?>">
                    <div class="row bg-soft-light mb-3 border1 pt-2">

                       <div class="col-md-3">
                           <div class="mb-2 focus">
                               <label class="form-label" for="default-input">Country Name</label>
                               <select class="form-select" name="country_id">
                                <option value="">Select Country</option>
    <?php
                                foreach($countries as $country)
                                {
                                ?>
                              <option value="<?=$country['country_id'];?>" <?php if(isset($taxDet[0]['country_id']) && ($taxDet[0]['country_id']==$country['country_id'])) echo 'selected';else echo set_select('country_id', $country['country_id'])?>><?=$country['name'];?></option>
                              <?php
                                }
                                ?>
    </select>
                               <?php if(form_error('country_id')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('country_id'); ?></div>
      <?php } ?>
                           </div>
                       </div>

                       <div class="col-md-3">
                           <div class="mb-4">
                           <label class="form-label" for="default-input">Tax type</label>
                           <select class="form-select" name="tax_type">
                            <option value="">Select Type</option>
                            <option value="gst" <?php if(isset($taxDet[0]['tax_type']) && $taxDet[0]['tax_type']=='gst'){echo 'selected'; }else{ echo set_select('tax_type', 'gst'); } ?>>GST</option>
						<option value="vat" <?php if(isset($taxDet[0]['tax_type']) && $taxDet[0]['tax_type']=='vat'){echo 'selected'; }else{ echo set_select('tax_type', 'vat'); }?>>VAT</option>
                            </select>
                            <?php if(form_error('tax_type')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('tax_type'); ?></div>
      <?php } ?>
                           </div>
                       </div>

                       <div class="col-md-3">
                           <div class="mb-4">
                           <label class="form-label" for="default-input">Amount(%)</label>
                           <input class="form-control" value="<?php if(set_value('tax_rate')){echo set_value('tax_rate');}else if(isset($taxDet[0]['tax_rate'])){echo $taxDet[0]['tax_rate'];}?>" type="text" name="tax_rate">
                           <?php if(form_error('tax_rate')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('tax_rate'); ?></div>
      <?php } ?>
                           </div>
                       </div>



                       <div class="col-md-3">
                           <div class="mb-4">
                               <label class="form-label" for="default-input">&nbsp;</label><br>
                               <button class="btn btn-success w-md" type="submit" name="<?php echo $button_name; ?>"><?php echo $button_text; ?></button>
                           </div>
                       </div>

</form> -->

                   <!-- Section 2 -->






               </div>





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
                            <table id="example" class="table table-bordered mt-3" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Type</th>
            <th>Rate</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
                       if(!empty($taxes)){
                       $count = 1;
                       foreach($taxes as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $val['name'];?></td>
                <td><?php if($val['tax_type'] == 'gst'){ ?> <span class="badge-success">GST</span> <?php } else { ?> <span class="badge-danger">VAT</span> <?php }?></td>
                <td><?php echo $val['tax_rate'];?></td>
                <td class="pb-0 pt-0 d-flex">
                    <!-- <form class="m-0"> -->
                                      <input type="hidden" name="id" value="<?php echo $val['tax_id']; ?>">
                                        <a class="btn tblEditBtn  pl-0 pr-0 edit_tax" id="" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['tax_id']; ?>" data-bs-original-title="Edit Tax"><i class="fa fa-edit"></i></a>
                    <!-- </form> -->

                    <a class="btn tblDelBtn pl-0 pr-0 delete_tax" type="button" data-bs-toggle="modal" data-id="<?php echo $val['tax_id']; ?>" data-bs-original-title="Delete Tax" data-bs-target="#exampleModal"><i class="fa fa-trash"></i></a>


                    </td>
            </tr>
            <?php $count++; }}

            else{
                echo '<tr><td colspan="5" class="text-center">No Tax Found</td></tr>';
            }

            ?>



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



        <!-- add tax -->

        <div class="modal fade" id="add-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Tax</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="add-new-tax" method="post" enctype="multipart/form-data">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Country Name</label>
                                <select name="country_name"  class="form-select" >
                                    <option value="">select country</option>
                                    <?php
                                foreach($countries as $country)
                                {
                                ?>
                              <option value="<?=$country['country_id'];?>" <?php if(isset($taxDet[0]['country_id']) && ($taxDet[0]['country_id']==$country['country_id'])) echo 'selected';else echo set_select('country_id', $country['country_id'])?>><?=$country['name'];?></option>
                              <?php
                                }
                                ?>

                                </select>
                                <!-- <input class="form-control" value="" placeholder="Name" type="text"
                                    name="country_name"> -->
                                <span class="error errormsg mt-2" id="country_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Tax Type</label>
                                <select name="country_tax"  class="form-select" >
                                    <option value="">select tax</option>
                                    <option value="gst" <?php if(isset($taxDet[0]['tax_type']) && $taxDet[0]['tax_type']=='gst'){echo 'selected'; }else{ echo set_select('tax_type', 'gst'); } ?>>GST</option>
                                    <option value="vat" <?php if(isset($taxDet[0]['tax_type']) && $taxDet[0]['tax_type']=='vat'){echo 'selected'; }else{ echo set_select('tax_type', 'vat'); }?>>VAT</option>


                                </select>
                                <!-- <input class="form-control" value="" placeholder="Name" type="text"
                                    name="country_code" > -->
                                <span class="error errormsg mt-2" id="country_tax_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Amount %</label>
                                <input class="form-control" value="" placeholder="Amount %" type="text"
                                    name="country_amount" >
                                <span class="error errormsg mt-2" id="country_amount_error"></span>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1 w-md" type="button" id="add_tax">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit tax -->
    <div class="modal fade" id="edit-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit Tax</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit_tax_country" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="hidden_tax_id" >

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Country Name</label>
                                <select name="country_name" class="form-select" id="country_name">
                                    <option value="">select country</option>
                                    <?php foreach ($countries as $value) { ?>
                                <option value="<?php echo $value['country_id']; ?>"
                                    <?php if (isset($selected_country_id) && $selected_country_id == $value['country_id']) echo 'selected'; ?>>
                                    <?php echo $value['name']; ?>
                                </option>
                                    <?php } ?>
                                </select>

                                <span class="error errormsg mt-2" id="tax_edit_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Tax</label>
                                <select name="country_tax" class="form-select" id="country_tax">
                                    <option value="">select tax</option>
                                    <option value="gst" <?= set_select('role', 'gst') ?>>GST</option>
                                    <option value="vat" <?= set_select('role', 'vat') ?>>VAT</option>
                                </select>
                                <span class="error errormsg mt-2" id="tax_edit_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Amount</label>
                                <input class="form-control" value="" placeholder="Amount" type="text"
                                    name="country_amount" id="country_amount">
                                <span class="error errormsg mt-2" id="tax_edit_amount_error"></span>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1 w-md" type="button" id="save_tax">Update</button>
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
    <div class="modal fade " id="delete-tax" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_user" type="button" data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete user -->








            </div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>