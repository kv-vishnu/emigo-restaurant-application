<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container">
    <div class="page-content p-2">




        <div class="container p-0">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                        <a data-bs-toggle="modal" data-bs-original-title="Add Country" data-bs-target="#add-user"
                            class="add-new-dish-btn btn1">
                            <img src="<?php echo base_url('assets/admin/images/add-new-dish-icon.svg'); ?>
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                            Add User
                        </a>
                        <a href="<?php echo base_url('admin/settings'); ?>" class="add-new-dish-btn btn1">
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



            <div class="row">
                <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Store</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($users)){
                       $count = 1;
                       foreach($users as $val){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['store_name'];?></td>
                                    <td><?php echo $val['Name'];?></td>
                                    <td><?php echo $val['userEmail'];?></td>
                                    <td><?php echo $val['UserPhoneNumber'];?></td>
                                    <td>
                                            <?php
                                                if ($val['userroleid'] == 1) {
                                                    echo "Admin";
                                                } elseif ($val['userroleid'] == 2) {
                                                    echo "Shop Owner";
                                                } elseif ($val['userroleid'] == 3) {
                                                    echo "Employee";
                                                }
                                                elseif ($val['userroleid'] == 4) {
                                                    echo "Delivery Boy";
                                                }elseif ($val['userroleid'] == 5) {
                                                    echo "Supplier";
                                                }elseif ($val['userroleid'] == 6) {
                                                    echo "Kitchen";
                                                }
                                            ?>
                                    </td>
                                    <td><?php if($val['is_active'] == 1){ ?> <span class="badge-success">Active</span>
                                        <?php } else { ?> <span class="badge-danger">Inactive</span> <?php }?></td>
                                    <td class="pb-0 pt-0 d-flex">
                                        <!-- <form class="m-0" action="<?php echo base_url();?>admin/user/edit"
                                            method="post"> -->
                                        <input type="hidden" name="id" value="<?php echo $val['userid']; ?>">
                                        <button class="btn tblEditBtn edit_user pl-0 pr-0" type="submit"
                                            data-bs-toggle="modal" data-id="<?php echo $val['userid']; ?>"
                                            data-bs-target="#edit-user" data-bs-original-title="Edit User"><i
                                                class="fa fa-edit"></i></button>
                                        <!-- </form> -->

                                        <a class="btn tblDelBtn pl-0 pr-0 del_user" type="button" data-bs-toggle="modal"
                                            data-id="<?php echo $val['userid']; ?>" data-bs-original-title="Delete User"
                                            data-bs-target="#delete-user"><i class="fa fa-trash"></i></a>

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



            <!-- add user -->

            <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add User</h2>
                            <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row bg-soft-light mb-3 border1 pt-2">
                                <form class="row mt-0 mb-0" id="add-new-user" method="post"
                                    enctype="multipart/form-data">

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Name </label>
                                            <input class="form-control" value="" placeholder="Name" type="text"
                                                name="add_user">
                                            <span class="error errormsg mt-2" id="add_user_error"></span>
                                            <div id="general_error" class="error errormsg"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Email</label>
                                            <input class="form-control" value="" placeholder="Email" type="text"
                                                name="add_user_email">
                                            <span class="error errormsg mt-2" id="add_user_email_error"></span>
                                            <div id="general_error" class="error errormsg"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Phone</label>
                                            <input class="form-control" value="" placeholder="phone" type="text"
                                                name="add_user_phone">
                                            <span class="error errormsg mt-2" id="add_user_phone_error"></span>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Address</label>
                                            <input class="form-control" value="" placeholder="Address" type="text"
                                                name="add_user_address">
                                            <span class="error errormsg mt-2" id="add_user_address_error"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Username</label>
                                            <input class="form-control" value="" placeholder="Username" type="text"
                                                name="add_user_username">
                                            <span class="error errormsg mt-2" id="add_user_username_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Password</label>
                                            <input class="form-control" value="" placeholder="Password" type="text"
                                                name="add_user_password">
                                            <span class="error errormsg mt-2" id="add_user_password_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Role</label>
                                            <select class="form-control" name="add_user_role">
                                                <option value="">Select role</option>
                                                <option value="2" <?= set_select('role', '2') ?>>Shop Owner</option>
                                                <!-- <option value="3" <?= set_select('role', '3') ?>>Employee</option> -->
                                                <option value="4" <?= set_select('role', '4') ?>>Delivery Boy</option>
                                                <option value="5" <?= set_select('role', '5') ?>>Supplier</option>
                                                <option value="6" <?= set_select('role', '6') ?>>Kitchen</option>
                                            </select>
                                            <span class="error errormsg mt-2" id="add_user_role_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-2">
                                            <label class="form-label" for="default-input">Shop</label>
                                            <select class="form-control" name="add_user_shop">
                                                <option value="">Select shop</option>
                                                <?php foreach($stores as $key => $store): ?>
                                                <option value="<?= $store['store_id']; ?>">
                                                    <?= $store['store_name']; ?>
                                                    (<?= $store['store_trade_license']; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="error errormsg mt-2" id="add_user_shop_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="justify-content-center" style="float: right;">
                                            <button class="btn btn1 w-md" type="button"
                                                id="add_user">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>

        <!-- add user -->


        <!-- edit user -->
        <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Edit User</h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-soft-light mb-3 border1 pt-2">
                            <form class="row mt-0 mb-0" id="edit-new-user" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="hidden_user_id">
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Name </label>
                                        <input class="form-control" value="" placeholder="Name" type="text"
                                            name="add_user" id="add_username">
                                        <span class="error errormsg mt-2" id="add_edit_user_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Email</label>
                                        <input class="form-control" value="" placeholder="Email" type="text"
                                            name="add_user_email" id="add_user_email">
                                        <span class="error errormsg mt-2" id="add_edit_user_email_error"></span>
                                        <div id="general_error" class="error errormsg"></div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Phone</label>
                                        <input class="form-control" value="" placeholder="phone" type="text"
                                            name="add_user_phone" id="add_user_phone">
                                        <span class="error errormsg mt-2" id="add_edit_user_phone_error"></span>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Address</label>
                                        <input class="form-control" value="" placeholder="Address" type="text"
                                            name="add_user_address" id="add_user_address">
                                        <span class="error errormsg mt-2" id="add_edit_user_address_error"></span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Username</label>
                                        <input class="form-control" value="" placeholder="Username" type="text"
                                            name="add_user_username" id="add_user_username">
                                        <span class="error errormsg mt-2" id="add_edit_user_username_error"></span>
                                    </div>
                                </div>

                                <!-- <div class="col-md-4">
                            <div class="mb-2">
                                <label class="form-label" for="default-input">Password</label>
                                <input class="form-control" value="" placeholder="Password" type="text"
                                name="add_user_password" id="add_user_password">
                                <span class="error errormsg mt-2" id="add_edit_user_password_error"></span>
                            </div>
                        </div> -->

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Role</label>
                                        <select class="form-control" name="add_user_role" id="add_user_role">
                                            <option value="">Select role</option>
                                            <option value="2" <?= set_select('role', '2') ?>>Shop Owner</option>
                                            <option value="4" <?= set_select('role', '4') ?>>Delivery Boy</option>
                                            <option value="5" <?= set_select('role', '5') ?>>Supplier</option>
                                            <option value="6" <?= set_select('role', '6') ?>>Kitchen</option>
                                        </select>
                                        <span class="error errormsg mt-2" id="add_edit_user_role_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label" for="default-input">Shop</label>
                                        <select class="form-control" name="add_user_shop" id="add_user_shop">
                                            <option value="">Select shop</option>
                                            <?php foreach($stores as $key => $store): ?>
                                            <option value="<?= $store['store_id']; ?>">
                                                <?= $store['store_name']; ?>
                                                (<?= $store['store_trade_license']; ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="error errormsg mt-2" id="add_edit_user_shop_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="justify-content-center" style="float: right;">
                                        <button class="btn btn1 w-md" type="button"
                                            id="save_user">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

    <!-- edit user -->



    <!-- delete user -->
    <div class="modal fade " id="delete-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_user_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button"
                        data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_del_user_user" type="button"
                        data-bs-dismiss="modal">Yes</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->




</div>
</div>
</div>