<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="add-new-dish-list-combo">

                <?php if (!isset($page) || $page != 'support') { ?>
                <a  href="#" data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-country" class="add-new-dish-btn btn1">
                    <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                    " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                    Add
                </a>
                <?php } ?>

                <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
                        <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">Back</a>
            </div>
                </div>
            </div>
            <!-- end page title -->


            <?php
                if(isset($countryDet[0]['country_id'])) {
                    $path=base_url().'admin/country/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'admin/country/add';
                    $button_text='Save';
                    $button_name='add';
                }?>
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
            <div class="container">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered mt-3" style="width:100%">
                        <thead style="background: #e5e5e5;">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Currency</th>
                                <!-- Show this only support page -->
                                <?php if (!isset($page) || $page == 'support') { ?>
                                <th>Support Number</th>
                                <th>Support Email</th>
                                <?php } ?>
                                <!-- Show this only support page -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                       if(!empty($countries)){
                       $count = 1;
                       foreach($countries as $val){ ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $val['name'];?></td>
                                <td><?php echo $val['code'];?></td>
                                <td><?php echo $val['currency'];?></td>
                                <!-- Show this only support page -->
                                <?php if (!isset($page) || $page == 'support') { ?>
                                <td><?php echo $val['support_number'];?></td>
                                <td><?php echo $val['support_email'];?></td>
                                <?php } ?>
                                <!-- Show this only support page -->
                                <td class="pb-0 pt-0 d-flex">

                                        <input type="hidden" name="id" value="<?php echo $val['country_id']; ?>">
                                        <button class="btn tblEditBtn edit_country pl-0 pr-0" type="submit" id=""
                                            data-id="<?php echo $val['country_id']; ?>" data-bs-toggle="modal"  data-bs-target="#edit-country"><i class="fa fa-edit"></i></button>


                                    <a class="btn tblDelBtn pl-0 pr-0 delete_country" type="button" data-bs-toggle="modal"
                                        data-id="<?php echo $val['country_id']; ?>"
                                        data-bs-original-title="Delete Country" data-bs-target="#exampleModal"><i
                                            class="fa fa-trash"></i></a>
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






        <!-- add country -->

        <div class="modal fade" id="add-country" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Country</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="add-new-country" method="post" enctype="multipart/form-data">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input class="form-control" value="" placeholder="Name" type="text"
                                    name="country_name">
                                <span class="error errormsg mt-2" id="country_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Code</label>
                                <input class="form-control" value="" placeholder="Name" type="text"
                                    name="country_code" >
                                <span class="error errormsg mt-2" id="country_code_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Currency</label>
                                <input class="form-control" value="" placeholder="Currency" type="text"
                                    name="country_currency">
                                <span class="error errormsg mt-2" id="country_currency_error"></span>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1 w-md" type="button" id="add_country">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- add country -->



<!-- ! SECTION: HEADER -->
    <div class="modal fade" id="edit-country" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row mt-0 mb-0" id="edit_save_country" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="hidden_country_id" >
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Name</label>
                                <input class="form-control" value="" placeholder="Name" type="text"
                                    name="country_name" id="country_name">
                                <span class="error errormsg mt-2" id="country_edit_name_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Country Code</label>
                                <input class="form-control" value="" placeholder="Country Code" type="text"
                                    name="country_code" id="country_code">
                                <span class="error errormsg mt-2" id="country_edit_code_error"></span>
                                <div id="general_error" class="error errormsg"></div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Currency</label>
                                <input class="form-control" value="" placeholder="Currency" type="text"
                                    name="country_currency" id="country_currency">
                                <span class="error errormsg mt-2" id="country_edit_currency_error"></span>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Support Number</label>
                                <input class="form-control" value="" placeholder="Support Number" type="text"
                                    name="support_number" id="support_number">
                                    <span class="error errormsg mt-2" id="country_edit_support_number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label">Support Email</label>
                                <input class="form-control" value="" placeholder="Support Email" type="text"
                                    name="support_email" id="support_email">
                                    <span class="error errormsg mt-2" id="country_edit_support_email_error"></span>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1 w-md" type="button" id="save_country">Update</button>
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




<script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>