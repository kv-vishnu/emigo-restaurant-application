<div class="main-content">
    <div class="page-content">




        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Store</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a>
                                </li>
                                <i class="fa-solid fa-chevron-right "
                                    style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                <li class="breadcrumb-item active">Store</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->






            <div class="row">


                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success dark" role="alert">
                    <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                </div><?php } ?>

                <?php if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger dark" role="alert">
                    <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                </div><?php } ?>





                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="store-tab" data-bs-toggle="tab" data-bs-target="#store"
                            type="button" role="tab" aria-controls="store" aria-selected="true">Store</button>
                    </li>
                    <?php if($this->session->userdata('last_insert_store_id') != ''){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                            type="button" role="tab" aria-controls="image" aria-selected="false">QR Codes</button>
                    </li>
                    <?php } ?>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="store" role="tabpanel" aria-labelledby="store-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">


                                        <form id="storeForm" enctype="multipart/form-data">
                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Country</label>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="country" id="country_id">
                                                        <option value="">Select Country</option>
                                                        <?php foreach ($countries as $country) { ?>
                                                        <option value="<?= $country['country_id']; ?>">
                                                            <?= $country['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="errormsg mt-2" id="country_error"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">GST/TAX</label>
                                                <div class="col-sm-4">
                                                    <select id="sel_gst_or_tax" class="form-select"
                                                        name="gst_or_tax"></select>
                                                    <div class="errormsg mt-2" id="gst_or_tax_error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group textbox row mb-2 d-none">
                                                <label class="col-sm-2 col-form-label">Registration Number</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="bill_no" class="form-control" id="inputbillno"
                                                        placeholder="">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Display Name</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="disp_name" class="form-control" id="disp_name"
                                                        placeholder="">
                                                    <div class="errormsg mt-2" id="disp_name_error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Registered Name</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="name" id="reg_name">
                                                    <div class="errormsg mt-2" id="name_error"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="email" name="email" id="email">
                                                    <div class="errormsg mt-2" id="email_error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="phone" id="phone">
                                                    <div class="errormsg mt-2" id="phone_error"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-4 mb-2">
                                                    <textarea name="address" class="form-control"
                                                        id="address"></textarea>
                                                    <div class="errormsg mt-2" id="address_error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 mb-2">
                                                    <textarea name="store_desc" class="form-control" id="store_desc"
                                                        rows="3"></textarea>
                                                    <div class="errormsg mt-2" id="store_desc_error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Contract Start Date</label>
                                                <div class="col-sm-2 mb-2">
                                                    <div id="datepicker" class="input-group date"
                                                        data-date-format="yyyy-mm-dd">
                                                        <input name="contract_start_date" class="form-control"
                                                            type="text">
                                                        <span class="input-group-addon"><i
                                                                class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                    <div class="errormsg mt-2" id="error_contract_start_date"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Contract End Date</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="datepicker1"
                                                        name="contract_end_date" placeholder="Select End Date">
                                                    <div class="errormsg mt-2" id="error_contract_end_date"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Next Followup Date</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="datepicker2"
                                                        name="next_followup_date" placeholder="Select Date">
                                                    <div class="errormsg mt-2" id="error_next_followup_date"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Followup Remark</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="followup_remarks" class="form-control" placeholder="">
                                                    <div class="errormsg mt-2" id="error_followup_remarks"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Opening Time</label>
                                                <div class="col-sm-4 mb-2">
                                                    <input class="form-control" type="time" name="store_opening_time"
                                                        id="store_opening_time">
                                                    <div class="errormsg mt-2" id="error_store_opening_time"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Closing Time</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="time" name="store_closing_time"
                                                        id="store_closing_time">
                                                    <div class="errormsg mt-2" id="error_store_closing_time"></div>
                                                </div>
                                            </div>

                                            <!-- Add similar error divs for the remaining fields -->


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Select Package</label>
                                                <div class="col-sm-4 mb-2">
                                                    <select class="form-select" name="no_of_tables" id="no_of_tables">
                                                        <option value="">Select Package</option>
                                                        <?php foreach($packages as $package) { ?>
                                                        <option value="<?= $package['package_id']; ?>">
                                                            <?= $package['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="errormsg mt-2" id="error_no_of_tables"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Trade License</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text" name="trade_license"
                                                        id="trade_license">
                                                    <div class="errormsg mt-2" id="error_trade_license"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Location</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="location" class="form-control" id="location"
                                                        placeholder="">
                                                    <div class="errormsg mt-2" id="error_location"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Default Language</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" name="language" id="language">
                                                        <option value="">Select Language</option>
                                                        <option value="ma">Malayalam</option>
                                                        <option value="hi">Hindi</option>
                                                        <option value="en">English</option>
                                                        <option value="ar">Arabic</option>
                                                    </select>
                                                    <div class="errormsg mt-2" id="error_language"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Selected Languages</label>
                                                <div class="col-sm-10">
                                                    <input type="checkbox" name="checkbox[]" value="ma" checked>
                                                    Malayalam<br>
                                                    <input type="checkbox" name="checkbox[]" value="en" checked>
                                                    English<br>
                                                    <input type="checkbox" name="checkbox[]" value="hi" checked>
                                                    Hindi<br>
                                                    <input type="checkbox" name="checkbox[]" value="ar" checked>
                                                    Arabic<br>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Username (Shop Owner)</label>
                                                <div class="col-sm-4 mb-2">
                                                    <input class="form-control" type="text" name="username"
                                                        id="username">
                                                    <div class="errormsg mt-2" id="error_username"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="password" name="password"
                                                        id="password">
                                                    <div class="errormsg mt-2" id="error_password"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Username (User)</label>
                                                <div class="col-sm-4 mb-2">
                                                    <input class="form-control" type="text" name="user_username"
                                                        id="user_username">
                                                    <div class="errormsg mt-2" id="error_user_username"></div>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="password" name="user_password"
                                                        id="user_password">
                                                    <div class="errormsg mt-2" id="error_user_password"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Store Logo</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control-file" name="store_logo_image"
                                                        id="store_logo_image">
                                                    <div class="errormsg mt-2" id="error_store_logo_image"></div>
                                                </div>
                                            </div>

                                            <h4 class="mb-sm-3 font-size-18">Serving Modes</h4>

                                            <!-- Pickup/Take away Section -->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 col-form-label">Pickup/Take away</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkbox_pickup_or_take_away">
                                                    <input type="text" name="checkbox_pickup_or_take_away" value="0"
                                                        id="pickup_hidden">
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Country code (91)"
                                                        class="form-control" name="pickup_country_code"
                                                        id="pickup_country_code">
                                                    <div class="errormsg mt-2" id="error_pickup_country_code"></div>
                                                </div>

                                                <div class="col-sm-4 d-flex">
                                                    <input type="text" placeholder="Enter Pickup Number"
                                                        class="form-control" name="txt_pickup_or_take_away"
                                                        id="txt_pickup_or_take_away">
                                                    <div class="errormsg mt-2" id="error_txt_pickup_or_take_away">
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 d-flex">
                                                    <button type="button" class="btn btn-primary"
                                                        id="send_pickup_test_message">Send Test Message</button>
                                                </div>
                                            </div>

                                            <!-- Dining Section -->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 col-form-label">Dining</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkbox_dining">
                                                    <input type="text" name="checkbox_dining" value="0"
                                                        id="dining_hidden">
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Country code (91)"
                                                        class="form-control" name="dining_country_code"
                                                        id="dining_country_code">
                                                    <div class="errormsg mt-2" id="error_dining_country_code"></div>
                                                </div>

                                                <div class="col-sm-4 d-flex">
                                                    <input type="text" placeholder="Enter Dining Number"
                                                        class="form-control" name="txt_dining" id="txt_dining">
                                                    <div class="errormsg mt-2" id="error_txt_dining"></div>
                                                </div>

                                                <div class="col-sm-2 d-flex">
                                                    <button type="button" class="btn btn-primary"
                                                        id="send_dining_test_message">Send Test Message</button>
                                                </div>
                                            </div>

                                            <!-- Delivery Section -->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 col-form-label">Delivery</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkbox_delivery">
                                                    <input type="text" name="checkbox_delivery" value="0"
                                                        id="delivery_hidden">
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Country code (91)"
                                                        class="form-control" name="delivery_country_code"
                                                        id="delivery_country_code">
                                                    <div class="errormsg mt-2" id="error_delivery_country_code">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 d-flex">
                                                    <input type="text" placeholder="Enter Delivery Number"
                                                        class="form-control" name="txt_delivery" id="txt_delivery">
                                                    <div class="errormsg mt-2" id="error_txt_delivery"></div>
                                                </div>

                                                <div class="col-sm-2 d-flex">
                                                    <button type="button" class="btn btn-primary"
                                                        id="send_delivery_test_message">Send Test Message</button>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="is_whatsapp">
                                                    <label class="form-check-label">
                                                        WhatsApp Enable
                                                    </label>
                                                    <input type="text" name="is_whatsapp_check" id="is_whatsapp_check"
                                                        value="0">
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
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





                                            <?php if ($store_details[0]['pickup_number'] != '') { ?>
                                            <div class="col-xl-3 col-md-6">
                                                <form class="m-0"
                                                    action="<?php echo base_url(); ?>admin/qrcodes/generatePickupQrCode"
                                                    method="post">
                                                    <?php if($this->session->userdata('last_insert_store_id') != ''){ ?>
                                                    <input type="hidden" name="store_id_hidden"
                                                        value="<?php echo $this->session->userdata('last_insert_store_id'); ?>">
                                                    <?php } ?>
                                                    <!-- <input type="hidden" name="store_id_hidden" value="<?php echo $this->session->userdata('logged_in_store_id'); ?>"> -->
                                                    <input type="hidden" name="pickup_number_hidden"
                                                        value="<?php echo $store_details[0]['pickup_number']; ?>">
                                                    <div class="card-body bg-b-success">
                                                        <button class="bg-b-success" style="border: none;"
                                                            type="submit">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <span class="text-white text-truncate"
                                                                        style="font-size: 19px;">Download
                                                                        Pickup QR
                                                                        Code</span>
                                                                    <span class="text-white text-truncate"
                                                                        style="font-size: 15px;"><?php echo $store_details[0]['pickup_number'] ?></span>
                                                                </div>
                                                                <div class="col-4 icon">
                                                                    <a href="<?php echo base_url(); ?>admin/qrcodes/generatePickupQrCode"
                                                                        target="_blank">
                                                                        <i class="fa fa-qrcode"
                                                                            style="font-size: 50px;"></i>
                                                                    </a>
                                                                    <!-- <i class="fa fa-qrcode" style="font-size: 50px;"></i> -->
                                                                </div>
                                                            </div>

                                                    </div></button><!-- end card body -->

                                            </div>
                                            </form>
                                            <?php } ?>


                                            <?php if ($store_details[0]['delivery_number'] != '') { ?>
                                            <div class="col-xl-3 col-md-6">
                                                <form class="m-0"
                                                    action="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQRCode"
                                                    method="post">
                                                    <?php if($this->session->userdata('last_insert_store_id') != ''){ ?>
                                                    <input type="hidden" name="store_id_hidden"
                                                        value="<?php echo $this->session->userdata('last_insert_store_id'); ?>">
                                                    <?php } ?>
                                                    <input type="hidden" name="delivery_number_hidden"
                                                        value="<?php echo $store_details[0]['delivery_number']; ?>">
                                                    <div class="card-body bg-b-success">
                                                        <button class="bg-b-success" style="border: none;"
                                                            type="submit">
                                                            <div class="row align-items-center">
                                                                <div class="col-8">
                                                                    <span class="text-white text-truncate"
                                                                        style="font-size: 19px;">Download
                                                                        Delivery QR
                                                                        Code</span>
                                                                    <span class="text-white text-truncate"
                                                                        style="font-size: 15px;"><?php echo $store_details[0]['delivery_number'] ?></span>
                                                                </div>
                                                                <div class="col-4 icon">
                                                                    <a href="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQRCode"
                                                                        target="_blank">
                                                                        <i class="fa fa-qrcode"
                                                                            style="font-size: 50px;"></i>
                                                                    </a>
                                                                    <!-- <i class="fa fa-qrcode" style="font-size: 50px;"></i> -->
                                                                </div>
                                                            </div>

                                                    </div></button><!-- end card body -->

                                            </div>
                                            </form>
                                            <?php } ?>




                                            <div class="col-xl-3 col-md-6">

                                                <a class="store_table btn tblLogBtn pl-0 pr-0" id=""
                                                    data-id="<?php echo $this->session->userdata('last_insert_store_id'); ?>"
                                                    data-name="<?php echo $this->session->userdata('last_insert_store_name'); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#emp_informations"
                                                    class="btn tblLogBtn pl-0 pr-0" title="Tables">
                                                    <div class="card-body bg-b-success">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <span class="text-white text-truncate"
                                                                    style="font-size: 19px;">Generate
                                                                    Table QR Codes</span>
                                                            </div>
                                                            <div class="col-4 icon">
                                                                <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </a><!-- end card body -->

                                            </div>





                                        </div>

                                    </div>






                                </div>




                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>




        <!-- Modal for detailed view -->
        <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <iframe id="table_iframe" height="600px" width="100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
    </div>