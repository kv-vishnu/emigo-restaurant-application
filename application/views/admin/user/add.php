<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">




        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a>
                                </li>
                                <i class="fa-solid fa-chevron-right "
                                    style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->






            <div class="row">


                <form method="post" action="<?php echo base_url(); ?>admin/user/add" enctype="multipart/form-data">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user"
                                type="button" role="tab" aria-controls="user" aria-selected="true">User</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <div class="row">








                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">






                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" value="<?php echo set_value('name'); ?>"
                                                        type="text" name="name">
                                                    <?php if(form_error('name')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('name'); ?></div>
                                                    <?php } ?>
                                                </div>

                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control"
                                                        value="<?php echo set_value('email'); ?>" type="text"
                                                        name="email">
                                                    <?php if(form_error('email')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('email'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control"
                                                        value="<?php echo set_value('phone'); ?>" type="text"
                                                        name="phone">
                                                    <?php if(form_error('phone')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('phone'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10 mb-2">
                                                    <textarea name="address" class="form-control"
                                                        id="exampleFormControlTextarea4"
                                                        rows="3"><?php echo set_value('address'); ?></textarea>
                                                    <?php if(form_error('address')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('address'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control"
                                                        value="<?php echo set_value('username'); ?>" type="text"
                                                        name="username">
                                                    <?php if(form_error('username')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('username'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control"
                                                        value="<?php echo set_value('password'); ?>" type="text"
                                                        name="password">
                                                    <?php if(form_error('password')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('password'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Role</label>
    <div class="col-sm-10">
    <select class="form-control" name="role">
                            <option value="">Select role</option>
                            <option value="2" <?= set_select('role', '2') ?>>Shop Owner</option>
                            <!-- <option value="1" <?= set_select('role', '1') ?>>Admin</option> -->
                            </select>
    <?php if(form_error('role')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('role'); ?></div>
      <?php } ?>
    </div>
  </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Shop</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="store_id">
                                                        <option value="">Select shop</option>
                                                        <?php foreach($stores as $key => $store): ?>
                                                        <option value="<?= $store['store_id']; ?>">
                                                            <?= $store['store_name']; ?>
                                                            (<?= $store['store_trade_license']; ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if(form_error('store_id')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('store_id'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>





                                            <div class="form theme-form">




                                                <!-- row start -->
                                                <div class="row">






                                                </div>
                                                <!-- row end -->


                                            </div>




                                        </div>
                                    </div>
                                </div>











                            </div>
                        </div>
                        <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">





                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form theme-form">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label>Photo</label>
                                                        <input type="file" class="form-control-file"
                                                            name="user_logo_image">
                                                    </div>

                                                </div>





                                            </div>

                                        </div>






                                    </div>




                                </div>
                            </div>
                        </div>






                    </div>
                    <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
            </div>
            <button class="btn btn-primary pull-right mb-4" type="submit" name="add">Save</button>
            </form>



        </div>