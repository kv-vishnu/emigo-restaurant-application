<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo">
                        <a href="#" data-bs-toggle="modal" data-bs-original-title="Add Followup"
                            data-bs-target="#add-followup" class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                    " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add Followup
                        </a>

                        <a href="<?php echo base_url('admin/store/all'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">Back</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
        <div class="row">
            <div class="container">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered mt-3" style="width:100%">
                        <thead style="background: #e5e5e5;">
                            <tr>
                                <th>No</th>
                                <th>UserName</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                       if(!empty($followup)){
                       $count = 1;
                       foreach($followup as $val){ ?>
                            <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $val['entered_user'];?></td>
                                <td><?php echo $val['date_and_time'];?></td>
                                <td><?php echo $val['remark'];?></td>
                                <td class="pb-0 pt-0 d-flex">
                                    <!--Edit-->
                                    <input type="hidden" name="id" value="<?php echo $val['follow_up_id']; ?>">
                                    <button class="btn tblEditBtn edit_followup pl-0 pr-0" type="submit" id=""
                                        data-id="<?php echo $val['follow_up_id']; ?>" data-bs-toggle="modal"
                                        data-bs-target="#edit-followup"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            <?php $count++; }} ?>
                        </tbody>
                    </table>

                    <div class="float-end">
                        <button class=" btn btn5" id="delete_followup" data-id="<?php echo $store_id; ?>"
                            type="button">Close
                            Followup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add followup -->

        <div class="modal fade" id="add-followup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Add Followup</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2 pb-2">
                            <form class="row mt-0 mb-0" id="add-new-followup" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="store_id" id="store_id"
                                    value="<?php echo $store_id; ?>">
                                <!-- User -->

                                <div class=" col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">User</label>
                                        <select name="followup_user" id="" class="form-select">
                                            <?php
                                            if(!empty($listfollowupuser)){
                                            $count = 1;
                                            foreach($listfollowupuser as $val){ ?>
                                            <option value="<?php echo $val['Name']; ?>">
                                                <?php echo $val['Name']; ?></option>

                                            <?php $count++; }} ?>
                                        </select>
                                        <span class="error errormsg mt-2" id="followup_user_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>

                                <!-- Date -->

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Date</label>
                                        <input class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                            placeholder="Date" type="date" name="followup_date">
                                        <span class="error errormsg mt-2" id="followup_date_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>

                                <!-- Remarks -->

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Remarks</label>
                                        <input class="form-control" value="" placeholder="Remarks" type="text"
                                            name="followup_remarks">
                                        <span class="error errormsg mt-2" id="followup_remarks_error"></span>

                                    </div>
                                </div>

                            </form>


                        </div>

                        <div class="col-md-12">
                            <div class="justify-content-center" style="float: right;">
                                <button class="btn btn1" type="button" id="add_followup">Save</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit Followup -->

    <div class="modal fade" id="edit-followup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Edit Followup</h2>
                    <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row bg-soft-light mb-3 border1 pt-2">
                        <form class="row mt-0 mb-0" id="edit_save_followup" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="hidden_followup_id">

                            <!-- User -->

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Username</label>
                                    <select name="followup_edit_user" id="followup_edit_user" class="form-select">
                                        <?php
                                            if(!empty($listfollowupuser)){
                                            $count = 1;
                                            foreach($listfollowupuser as $val){ ?>
                                        <option value="<?php echo $val['Name']; ?>">
                                            <?php echo $val['Name']; ?>
                                        </option>
                                        <?php $count++; }} ?>
                                    </select>
                                    <span class="error errormsg mt-2" id="followup_edit_user_error"></span>

                                </div>
                            </div>

                            <!--Date -->

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Date</label>
                                    <input class="form-control" value="" placeholder="Date" type="date"
                                        name="followup_edit_date" id="followup_edit_date" value="">
                                    <span class="error errormsg mt-2" id="followup_edit_date_error"></span>

                                </div>
                            </div>


                            <!--Remarks -->

                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label" for="default-input">Remarks</label>
                                    <input class="form-control" value="Remarks" placeholder="Currency" type="text"
                                        name="followup_edit_remarks" id="followup_edit_remarks">
                                    <span class="error errormsg mt-2" id="followup_edit_remarks_error"></span>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="justify-content-center" style="float: right;">
                                    <button class="btn btn1" type="button"
                                        id="save_followup">Update</button>
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
<div class="modal fade " id="delete-followup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Followup</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_followup_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_followup" type="button"
                    data-bs-dismiss="modal">Yes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- delete user -->

<script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>