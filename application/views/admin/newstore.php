<!DOCTYPE html>
<html>

<!-- header start -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <title>Dashboard | Emigo </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Emigo" name="description" />
    <meta content="CVS" name="author" />

    <link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico">
    <link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/styles.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="application-header">
        <div class="application-header__container container">
            <div class="application-header__brand">
                <a href="#" class="application-header__brand-logo">
                    <img src="<?php echo base_url();?>assets/admin/images/emigo.png" alt="brand lgo"
                        class="application-header__brand-logo-img" width="97" height="97">
                </a>
                <div class="application-header__brand-address">
                    <h2 class="application-header__brand-name"></h2>
                    <p class="application-header__brand-address"></p>
                </div>
            </div>
            <!-- <div class="application-header__provider">
                <img src="<?php echo base_url();?>assets/admin/images/choose-my-food.png" alt="choose my food logo"
                    class="application-header__provider-img" width="300" height="37">
            </div> -->
        </div>

    </div>


    <!-- header end -->



    <!--  new store add  -->


    <div class="application-content add-new-dish">
        <div class="application-content__container container add-new-dish__container">
            <h1 class="application-content__page-heading">Registration</h1>
            <div class="add-new-dish-form">

                <form id="storeForm" enctype="multipart/form-data" method="post">

                    <div class="add-new-dish-form__section-container">
                        <div class="add-new-dish-form__section">
                            <h2 class="add-new-dish-form__section-heading">Restaurant Details</h2>


                            <!-- country -->

                            <div class="form__field-container-group gc">
                                <div class="form__field-container xs12 lg4">
                                    <label class="form__label">Country</label>
                                    <select class="form-select" name="country" id="country_id">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $country) { ?>
                                        <option value="<?= $country['country_id']; ?>">
                                            <?= $country['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="errormsg mt-2" id="country_error"></div>
                                </div>
                                <!--Gst Tax-->
                                <div class="form__field-container xs12 lg4">
                                    <label class="form__label">TAX</label>
                                    <select id="sel_gst_or_tax" class="form-select" name="gst_or_tax"></select>
                                    <div class="errormsg mt-2" id="gst_or_tax_error"></div>
                                </div>

                                <!--Registration Number-->

                                <div class="form__field-container textbox xs12 lg4 d-none">
                                    <label class="form__label" id="Tax_label">Registration Number</label>
                                    <input name="bill_no" class="form-control" id="inputbillno" placeholder="">

                                </div>


                            </div>





                            <div class="form__field-container-group gc" id="product_rate_div">

                                <!--Trade License-->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Trade License</label>
                                    <input class="form-control" type="text" name="trade_license" id="trade_license">
                                    <div class="errormsg mt-2" id="error_trade_license"></div>
                                </div>

                                <!--Location-->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Location</label>
                                    <input name="location" class="form-control" id="location" placeholder="">
                                    <div class="errormsg mt-2" id="error_location"></div>
                                </div>


                                <!-- display name -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Display Name</label>
                                    <input name="disp_name" class="form-control" id="disp_name" placeholder="">
                                    <div class="errormsg mt-2" id="disp_name_error"></div>

                                </div>

                                <!-- Registered Name -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Registered Name</label>
                                    <input class="form-control" type="text" name="name" id="reg_name">
                                    <div class="errormsg mt-2" id="name_error"></div>
                                </div>

                                <!-- Email -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Email</label>
                                    <input class="form-control" type="email" name="email" id="email">
                                    <div class="errormsg mt-2" id="email_error"></div>
                                </div>

                                <!-- Phone -->
                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Phone</label>
                                    <input class="form-control" type="text" name="phone" id="phone">
                                    <div class="errormsg mt-2" id="phone_error"></div>
                                </div>
                            </div>

                            <!-- address -->

                            <div class="form__field-container-group gc" id="product_rate_div">
                                <div class="form__field-container xs12 lg6">
                                    <label class="form__label">Address</label>
                                    <textarea name="address" class="form-control" id="address"></textarea>
                                    <div class="errormsg mt-2" id="address_error"></div>
                                </div>

                                <!-- Description -->

                                <div class="form__field-container xs12 lg6">
                                    <label class="form__label">Tag line</label>
                                    <textarea name="store_desc" class="form-control" id="store_desc"></textarea>
                                    <div class="errormsg mt-2" id="store_desc_error"></div>
                                </div>

                                <!-- Contract Start Date -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Contract Start Date</label>
                                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                        <input name="contract_start_date" class="form-control" type="text">
                                        <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                    <div class="errormsg mt-2" id="error_contract_start_date"></div>
                                </div>

                                <!-- Contract End Date -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Contract End Date</label>
                                    <input type="text" class="form-control" id="datepicker1" name="contract_end_date"
                                        placeholder="Select End Date">
                                    <div class="errormsg mt-2" id="error_contract_end_date"></div>
                                </div>


                                <!-- Next Follow Up Date -->

                                <div class="form__field-container xs12 lg2">
                                    <label class="form__label">Next Follow Up Date</label>
                                    <input type="text" class="form-control" id="datepicker2" name="next_followup_date"
                                        placeholder="Select Date">
                                    <div class="errormsg mt-2" id="error_next_followup_date"></div>
                                </div>

                                <!--select package  -->

                                <div class="form__field-container xs12 lg3">
                                    <label class="form__label">Select Package</label>
                                    <select class="form-select" name="no_of_tables" id="no_of_tables">
                                        <option value="">Select Package</option>
                                        <?php foreach($packages as $package) { ?>
                                        <option value="<?= $package['package_id']; ?>">
                                            <?= $package['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="errormsg mt-2" id="error_no_of_tables"></div>
                                </div>


                                <!-- Default Language  -->

                                <div class="form__field-container xs12 lg3">
                                    <label class="form__label">Preffered Language</label>
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



                            <div class="form__field-container-group gc" id="product_rate_div">

                            </div>


                            <!-- Select Language -->


                            <div class="form__field-container-group gc" id="product_rate_div">
                                <div class="form__field-container xs12 lg12">
                                    <label class="form__label">Select your Languages</label>
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
                                    <div class="errormsg mt-2" id="error_language"></div>
                                </div>
                            </div>

                            <!--Enable Order Monitor Tabs -->
<h2 class="add-new-dish-form__section-heading">Required Services</h2>
<div class="form__field-container-group gc table_monitor">

   <div class="form__field-container xs12 lg1">
        <label class="form__label">Table</label>
        <input type="checkbox" class="form-check-input" name="is_table_tab" id="is_table_tab"
            value="0">
    </div>

    <div class="form__field-container xs12 lg1">
        <label class="form__label">Pickup</label>
        <input type="checkbox" class="form-check-input" name="is_pickup_tab" id="is_pickup_tab"
            value="0">
    </div>

    <div class="form__field-container xs12 lg1">
        <label class="form__label">Delivery</label>
        <input type="checkbox" class="form-check-input" name="is_delivery_tab" id="is_delivery_tab"
            value="0">
    </div>

    <div class="form__field-container xs12 lg1">
        <label class="form__label">Room</label>
        <input type="checkbox" class="form-check-input" name="is_room_tab" id="is_room_tab"
            value="0">
    </div>

</div>
<!-- Order monitor tabs -->

<!--Contact person -->
<h2 class="add-new-dish-form__section-heading">Contact Person Details</h2>
<div class="form__field-container-group gc table_monitor">

    <div class="form__field-container xs12 lg4">
        <label class="form__label">Name</label>
        <input class="form-control" type="text" name="contact_person_name" id="contact_person_name">
        <div class="errormsg mt-2" id="error_contact_person_name"></div>
    </div>

    <div class="form__field-container xs12 lg4">
        <label class="form__label">Contact Number</label>
         <input class="form-control" type="text" name="contact_person_phone" id="contact_person_phone">
         <div class="errormsg mt-2" id="error_contact_person_phone"></div>
    </div>

    <div class="form__field-container xs12 lg4">
        <label class="form__label">Designation</label>
        <select class="form-select" name="contact_person_designation" id="contact_person_designation">
            <option value="">Select Designation</option>
            <option value="Owner">Owner</option>
            <option value="Manager">Manager</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Staff">Staff</option>
            <option value="Other">Other</option>
        </select>
        <div class="errormsg mt-2" id="error_contact_person_designation"></div>
    </div>

</div>
<!-- Contact person -->



                            <!-- username (shop owner)  -->

                            <!-- <div class="form__field-container-group gc" id="product_rate_div">
                                <div class="form__field-container xs12 lg3">
                                    <label class="form__label">Username (Shop owner)</label>
                                    <input class="form-control" type="text" name="username" id="username">
                                    <div class="errormsg mt-2" id="error_username"></div>

                                </div> -->

                                <!-- Password  -->

                                <!-- <div class="form__field-container xs12 lg3">
                                    <label class="form__label">password</label>
                                    <input class="form-control" type="password" name="password" id="password">
                                    <div class="errormsg mt-2" id="error_password"></div>

                                </div> -->

                                <!-- username (user)  -->

                                <!-- <div class="form__field-container xs12 lg3">
                                    <label class="form__label">Username (user)</label>
                                    <input class="form-control" type="text" name="user_username" id="user_username">
                                    <div class="errormsg mt-2" id="error_user_username"></div>

                                </div> -->


                                <!-- Password  -->

                                <!-- <div class="form__field-container xs12 lg3">
                                    <label class="form__label">password</label>
                                    <input class="form-control" type="password" name="user_password" id="user_password">
                                    <div class="errormsg mt-2" id="error_user_password"></div>

                                </div> -->
                            <!-- </div> -->


                            <!-- Store Logo  -->
                            <div class="form__field-container-group gc" id="product_rate_div">
                                <div class="form__field-container xs12 lg12">
                                    <label class="form__label">Store Logo</label>
                                    <input type="file" class="form-control-file" name="store_logo_image"
                                        id="store_logo_image">
                                    <div class="errormsg mt-2" id="error_store_logo_image"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn btn1 mt-2" type="submit">SAVE</button>

            </div>

            </form>
        </div>

    </div>


    <!-- new store add end -->


    <!-- footer starts -->

    <div class="application-footer">
        <div class="application-footer__container container">
            <div class="application-footer__company-logo">
                <img src="<?php echo base_url();?>assets/admin/images/emigo-logo.svg" alt="emigo logo"
                    class="application-footer__company-logo-img" width="210" height="69">
            </div>
            <div class="application-footer__copyright">

                <h1 class="application-content__page-heading_datetime text-center">
                    <!--<i class="fas fa-clock"></i>  -->
                    <?php
        $date = new DateTime();
        echo $date->format("h:i A");
        ?>
                </h1>
                @ All rights reserved. Emigo 2025
            </div>

        </div>
    </div>

    <button id="goToTop" style="display: none; position: fixed; bottom: 20px; right: 20px;">Top</button>
    <!-- footer ends -->


    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url();?>assets/admin/js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
    <script type="module" src="<?php echo base_url();?>assets/admin/js/newstore.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/scripts.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/datepicker.js"></script>
<script>
$(document).ready(function() {

    $(function() {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());

        $("#datepicker1").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });

   //MARK: -  Store Checkbox
    function bindCheckbox(selector) {
        $(document).on('change', selector, function() {
            $(this).val($(this).is(':checked') ? 1 : 0);
            console.log(selector + " changed → " + $(this).val());
        });
    }
    bindCheckbox('#is_table_tab');
    bindCheckbox('#is_pickup_tab');
    bindCheckbox('#is_delivery_tab');
    bindCheckbox('#is_room_tab');
})
</script>
</body>
</html>