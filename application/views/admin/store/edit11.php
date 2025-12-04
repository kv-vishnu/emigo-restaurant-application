<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">




        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Store  eee</h4>

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

                <?php if(isset($storeDet[0]['store_id'])) {
            //print_r($storeDet);exit;
            ?>
                <form method="post" action="<?php echo base_url(); ?>admin/store/edit" enctype="multipart/form-data">
                    <input type="hidden" name="id"
                        value="<?php  if(isset($storeDet[0]['store_id'])){echo $storeDet[0]['store_id'];}?>">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="store-tab" data-bs-toggle="tab" data-bs-target="#store"
                                type="button" role="tab" aria-controls="store" aria-selected="true">Store</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                type="button" role="tab" aria-controls="image" aria-selected="false">Logo /
                                QR-Codes</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="store" role="tabpanel" aria-labelledby="store-tab">
                            <div class="row">








                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Country</label>
                                                <div class="col-sm-4">

                                                    <select class="form-select" name="country" id="country_id">
                                                        <option value="">Select Country</option>
                                                        <?php
                                foreach($countries as $country)
                                {
                                ?>
                                                        <option value="<?=$country['country_id'];?>"
                                                            <?php if(isset($storeDet[0]['store_country']) && ($storeDet[0]['store_country']==$country['country_id'])) echo 'selected';else echo set_select('country', $country['country_id'])?>>
                                                            <?=$country['name'];?></option>
                                                        <?php
                                }
                                ?>
                                                    </select>
                                                    <?php if(form_error('country')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('country'); ?></div>
                                                    <?php } ?>
                                                </div>

                                                <label class="col-sm-2 col-form-label">GST/TAX</label>
                                                <div class="col-sm-4">
                                                    <select id="sel_gst_or_tax" class="form-select" name="gst_or_tax">
                                                        <option value="1"
                                                            <?php if(isset($storeDet[0]['gst_or_tax']) && ($storeDet[0]['gst_or_tax']==1)) echo 'selected';else echo set_select('gst_or_tax', 1)?>>
                                                            Not Applicable</option>
                                                        <?php
                                foreach($tax_rates as $tax)
                                {
                                ?>
                                                        <option value="<?=$tax['tax_id'];?>"
                                                            <?php if(isset($storeDet[0]['gst_or_tax']) && ($storeDet[0]['gst_or_tax']==$tax['tax_id'])) echo 'selected';else echo set_select('gst_or_tax', $tax['tax_id'])?>>
                                                            <?=$tax['tax_rate'];?></option>
                                                        <?php
                                }
                                ?>
                                                    </select>
                                                    <?php if(form_error('gst_or_tax')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('gst_or_tax'); ?></div>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="form-group textbox row mb-2">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Registration
                                                    Number</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="bill_no" class="form-control"
                                                        value="<?php if(set_value('bill_no')){echo set_value('bill_no');}else if(isset($storeDet[0]['bill_no'])){echo $storeDet[0]['bill_no'];}?>"
                                                        id="inputPassword" placeholder="">
                                                    <?php if(form_error('bill_no')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('bill_no'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <script>
                                            $(document).ready(function() {
                                                function toggleTextbox() {
                                                    var taxRate = $('#sel_gst_or_tax').val();
                                                    if (taxRate === "1") {
                                                        // Hide the textbox if "Not Applicable" is selected
                                                        $('.form-group.textbox').addClass('d-none');
                                                    } else {
                                                        // Show the textbox otherwise
                                                        $('.form-group.textbox').removeClass('d-none');
                                                    }
                                                }

                                                // Trigger the toggle function on page load
                                                toggleTextbox();

                                                // Attach change event listener to dropdown
                                                $('#sel_gst_or_tax').on('change', function() {
                                                    toggleTextbox();
                                                });
                                            });
                                            </script>



                                            <div class="form-group row mb-2">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Display
                                                    Name</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="disp_name" class="form-control"
                                                        value="<?php if(set_value('disp_name')){echo set_value('disp_name');}else if(isset($storeDet[0]['store_disp_name'])){echo $storeDet[0]['store_disp_name'];}?>"
                                                        id="inputPassword" placeholder="">
                                                    <?php if(form_error('disp_name')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('disp_name'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Registered Name</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('name')){echo set_value('name');}else if(isset($storeDet[0]['store_name'])){echo $storeDet[0]['store_name'];}?>"
                                                        type="text" name="name">
                                                    <?php if(form_error('name')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('name'); ?></div>
                                                    <?php } ?>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('email')){echo set_value('email');}else if(isset($storeDet[0]['store_email'])){echo $storeDet[0]['store_email'];}?>"
                                                        type="text" name="email">
                                                    <?php if(form_error('email')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('email'); ?></div>
                                                    <?php } ?>
                                                </div>

                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('phone')){echo set_value('phone');}else if(isset($storeDet[0]['store_phone'])){echo $storeDet[0]['store_phone'];}?>"
                                                        type="text" name="phone">
                                                    <?php if(form_error('phone')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('phone'); ?></div>
                                                    <?php } ?>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-4 mb-2">
                                                    <textarea name="address" class="form-control"
                                                        id="exampleFormControlTextarea4"
                                                        rows="3"><?php if(set_value('address')){echo set_value('address');}else if(isset($storeDet[0]['store_address'])){echo $storeDet[0]['store_address'];}?></textarea>
                                                    <?php if(form_error('address')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('address'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea name="store_desc" class="form-control"
                                                        id="exampleFormControlTextarea4"
                                                        rows="3"><?php if(set_value('store_desc')){echo set_value('store_desc');}else if(isset($storeDet[0]['store_desc'])){echo $storeDet[0]['store_desc'];}?></textarea>
                                                </div>
                                            </div>








                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Contract Start Date</label>
                                                <div class="col-sm-2 mb-2">
                                                    <div id="datepicker" class="input-group date"
                                                        data-date-format="yyyy-mm-dd">
                                                        <input name="contract_start_date" class="form-control"
                                                            value="<?php if(set_value('contract_start_date')){echo set_value('contract_start_date');}else if(isset($storeDet[0]['contract_start_date'])){echo $storeDet[0]['contract_start_date'];}?>"
                                                            type="text">
                                                        <span class="input-group-addon"><i
                                                                class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                    <?php if(form_error('contract_start_date')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('contract_start_date'); ?></div>
                                                    <?php } ?>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Contract End Date</label>
                                                <div class="col-sm-2">
                                                    <input type="text"
                                                        value="<?php if(set_value('contract_end_date')){echo set_value('contract_end_date');}else if(isset($storeDet[0]['contract_end_date'])){echo $storeDet[0]['contract_end_date'];}?>"
                                                        class="form-control" id="datepicker1" name="contract_end_date"
                                                        placeholder="Select End Date">
                                                    <?php if(form_error('contract_end_date')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('contract_end_date'); ?></div>
                                                    <?php } ?>
                                                </div>

                                                <label class="col-sm-2 col-form-label">Next Followup Date</label>
                                                <div class="col-sm-2">
                                                    <input type="text"
                                                        value="<?php if(set_value('next_followup_date')){echo set_value('next_followup_date');}else if(isset($storeDet[0]['next_followup_date'])){echo $storeDet[0]['next_followup_date'];}?>"
                                                        class="form-control" id="datepicker2" name="next_followup_date"
                                                        placeholder="">
                                                    <?php if(form_error('next_followup_date')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('next_followup_date'); ?></div>
                                                    <?php } ?>
                                                </div>

                                            </div>


                                            <div class="form-group row mb-2">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Followup
                                                    Remarks</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="followup_remarks" class="form-control"
                                                        value="<?php if(set_value('followup_remarks')){echo set_value('followup_remarks');}else if(isset($storeDet[0]['followup_remarks'])){echo $storeDet[0]['followup_remarks'];}?>"
                                                        id="inputPassword" placeholder="">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Opening Times</label>
                                                <div class="col-sm-4 mb-2">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('store_opening_time')){echo set_value('store_opening_time');}else if(isset($storeDet[0]['store_opening_time'])){echo $storeDet[0]['store_opening_time'];}?>"
                                                        type="time" name="store_opening_time">
                                                    <?php if(form_error('store_opening_time')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('store_opening_time'); ?></div>
                                                    <?php } ?>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Closing Time</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('store_closing_time')){echo set_value('store_closing_time');}else if(isset($storeDet[0]['store_closing_time'])){echo $storeDet[0]['store_closing_time'];}?>"
                                                        type="text" name="store_closing_time">
                                                    <?php if(form_error('store_closing_time')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('store_closing_time'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>



                                            <input class="form-control"
                                                value="<?php if(set_value('no_of_tables')){echo set_value('no_of_tables');}else if(isset($storeDet[0]['no_of_tables'])){echo $storeDet[0]['no_of_tables'];}?>"
                                                type="hidden" name="no_of_tables">



                                            <div class="form-group row mb-2">

                                                <label class="col-sm-2 col-form-label">Trade License</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control"
                                                        value="<?php if(set_value('store_trade_license')){echo set_value('store_trade_license');}else if(isset($storeDet[0]['store_trade_license'])){echo $storeDet[0]['store_trade_license'];}?>"
                                                        type="text" name="store_trade_license">
                                                    <?php if(form_error('store_trade_license')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('store_trade_license'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label for="inputPassword"
                                                    class="col-sm-2 col-form-label">Location</label>
                                                <div class="col-sm-10 mb-2">
                                                    <input name="store_location" class="form-control"
                                                        value="<?php if(set_value('store_location')){echo set_value('store_location');}else if(isset($storeDet[0]['store_location'])){echo $storeDet[0]['store_location'];}?>"
                                                        id="inputPassword" placeholder="">
                                                </div>
                                            </div>


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Default Language</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" name="language">
                                                        <option value="">Select Country</option>
                                                        <option value="ma"
                                                            <?php if(isset($storeDet[0]['store_language']) && $storeDet[0]['store_language']=='ma'){echo 'selected'; }else{ echo set_select('country', 'ma'); } ?>>
                                                            Malayalam</option>
                                                        <option value="hi"
                                                            <?php if(isset($storeDet[0]['store_language']) && $storeDet[0]['store_language']=='hi'){echo 'selected'; }else{ echo set_select('country', 'hi'); }?>>
                                                            Hindi</option>
                                                        <option value="en"
                                                            <?php if(isset($storeDet[0]['store_language']) && $storeDet[0]['store_language']=='en'){echo 'selected'; }else{ echo set_select('country', 'en'); }?>>
                                                            English</option>
                                                        <option value="ar"
                                                            <?php if(isset($storeDet[0]['store_language']) && $storeDet[0]['store_language']=='ar'){echo 'selected'; }else{ echo set_select('country', 'ar'); }?>>
                                                            Arabic</option>
                                                    </select>
                                                    <?php if(form_error('language')){ ?>
                                                    <div class="errormsg mt-2" role="alert">
                                                        <?php echo form_error('language'); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <?php $saved_values = explode(",", $storeDet[0]['store_selected_languages']); ?>

                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Selected Languages</label>
                                                <div class="col-sm-10">

                                                    <input type="checkbox" name="checkbox[]" value="ma"
                                                        <?= in_array('ma', $saved_values) ? 'checked' : '' ?>>Malayalam<br>
                                                    <input type="checkbox" name="checkbox[]" value="en"
                                                        <?= in_array('en', $saved_values) ? 'checked' : '' ?>>English<br>
                                                    <input type="checkbox" name="checkbox[]" value="hi"
                                                        <?= in_array('hi', $saved_values) ? 'checked' : '' ?>>Hindi<br>
                                                    <input type="checkbox" name="checkbox[]" value="ar"
                                                        <?= in_array('ar', $saved_values) ? 'checked' : '' ?>>Arabic<br>

                                                </div>
                                            </div>



                                            <!-- <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Currency</label>
    <div class="col-sm-10">
    <select class="form-select" name="currency">
    <option value="">Select Country</option>
						<option value="inr" <?php if(isset($storeDet[0]['store_currency']) && $storeDet[0]['store_currency']=='inr'){echo 'selected'; }else{ echo set_select('country', 'inr'); } ?>>Indian Rupee</option>
						<option value="euro" <?php if(isset($storeDet[0]['store_currency']) && $storeDet[0]['store_currency']=='euro'){echo 'selected'; }else{ echo set_select('country', 'euro'); }?>>Euro</option>
						<option value="pound" <?php if(isset($storeDet[0]['store_currency']) && $storeDet[0]['store_currency']=='pound'){echo 'selected'; }else{ echo set_select('country', 'pound'); } ?>>Pound</option>
						<option value="dollar" <?php if(isset($storeDet[0]['store_currency']) && $storeDet[0]['store_currency']=='dollar'){echo 'selected'; }else{ echo set_select('country', 'dollar'); }?>>Dollar</option>
                            </select>
    <?php if(form_error('currency')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('currency'); ?></div>
      <?php } ?>
    </div>
  </div> -->


                                            <div class="form-group row mb-2">
                                                <label class="col-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select btn-square" name="is_active">
                                                        <option value="">Select Status</option>
                                                        <option value="1"
                                                            <?php if(isset($storeDet[0]['is_active']) && $storeDet[0]['is_active']=='1'){echo 'selected'; }else{ echo set_select('status', '1'); } ?>>
                                                            Yes</option>
                                                        <option value="0"
                                                            <?php if(isset($storeDet[0]['is_active']) && $storeDet[0]['is_active']=='0'){echo 'selected'; }else{ echo set_select('status', '0'); }?>>
                                                            No</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <h4 class="mb-sm-3 font-size-18">Serving Modes</h4>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input"
                                                    class="col-sm-2 col-form-label">Pickup/Take away</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        <?php echo ($storeDet[0]['is_pickup'] == 1) ? 'checked' : ''; ?>
                                                        id="checkbox_pickup_or_take_away">
                                                    <input type="hidden" name="checkbox_pickup_or_take_away"
                                                        value="<?php echo ($storeDet[0]['is_pickup'] == 1) ? '1' : '0'; ?>"
                                                        id="pickup_hidden">
                                                </div>
                                                <div class="col-sm-4 d-flex">
                                                    <input name="txt_pickup_or_take_away" class="form-control"
                                                        value="<?php if(set_value('txt_pickup_or_take_away')){echo set_value('txt_pickup_or_take_away');}else if(isset($storeDet[0]['pickup_number'])){echo $storeDet[0]['pickup_number'];}?>"
                                                        id="inputPassword" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input"
                                                    class="col-sm-2 col-form-label">Dining</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="checkbox_dining"
                                                        <?php echo ($storeDet[0]['is_dining'] == 1) ? 'checked' : ''; ?>
                                                        id="checkbox_dining">
                                                    <input type="hidden" name="checkbox_dining"
                                                        value="<?php echo ($storeDet[0]['is_dining'] == 1) ? '1' : '0'; ?>"
                                                        id="dining_hidden">
                                                </div>
                                                <div class="col-sm-4 d-flex">
                                                    <input name="txt_dining" class="form-control"
                                                        value="<?php if(set_value('txt_dining')){echo set_value('txt_dining');}else if(isset($storeDet[0]['dining_number'])){echo $storeDet[0]['dining_number'];}?>"
                                                        id="inputPassword" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-firstname-input"
                                                    class="col-sm-2 col-form-label">Delivery</label>
                                                <div class="col-sm-2 d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        <?php echo ($storeDet[0]['is_delivery'] == 1) ? 'checked' : ''; ?>
                                                        name="checkbox_delivery" id="checkbox_delivery">
                                                    <input type="hidden" name="checkbox_delivery"
                                                        value="<?php echo ($storeDet[0]['is_delivery'] == 1) ? '1' : '0'; ?>"
                                                        id="delivery_hidden">
                                                </div>
                                                <div class="col-sm-4 d-flex">
                                                    <input name="txt_delivery" class="form-control"
                                                        value="<?php if(set_value('txt_delivery')){echo set_value('txt_delivery');}else if(isset($storeDet[0]['delivery_number'])){echo $storeDet[0]['delivery_number'];}?>"
                                                        id="inputPassword" placeholder="">
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="is_whatsapp"
                                                    <?php echo ($storeDet[0]['whatsapp_enable'] == 1) ? 'checked' : ''; ?>>
                                                <label class="form-check-label">
                                                    WhatsApp
                                                </label>
                                                <input type="hidden" name="is_whatsapp_check" id="is_whatsapp_check"
                                                    value="<?php echo ($storeDet[0]['whatsapp_enable'] == 1) ? '1' : '0'; ?>">
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
                                                        <input type="hidden" name="old_image"
                                                            value="<?php if(isset($storeDet[0]['store_logo_image'])) echo $storeDet[0]['store_logo_image'];?>">
                                                        <img width="100" height="100"
                                                            src="<?php echo base_url(); ?>uploads/store/<?php if(isset($storeDet[0]['store_logo_image'])) echo $storeDet[0]['store_logo_image']; ?>"
                                                            class="img-thumbnail">
                                                        <input type="file" class="form-control-file"
                                                            name="store_logo_image">
                                                    </div>

                                                </div>





                                            </div>

                                        </div>


                                        <div class="row">





                                            <?php if ($storeDet[0]['pickup_number'] != '') { ?>
                                            <div class="col-xl-3 col-md-6">

                                                <div class="card-body bg-b-success">

                                                    <div class="row align-items-center">
                                                        <div class="col-8">
                                                            <span class="text-white text-truncate"
                                                                style="font-size: 19px;">Download
                                                                Pickup QR
                                                                Code</span>
                                                            <span class="text-white text-truncate"
                                                                style="font-size: 15px;"><?php echo $storeDet[0]['pickup_number'] ?></span>
                                                        </div>
                                                        <div class="col-4 icon">
                                                            <a href="<?php echo base_url(); ?>admin/qrcodes/generatePickupQRCode1/<?php echo $storeDet[0]['store_id']; ?>"
                                                                target="_blank">
                                                                <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                                                            </a>
                                                            <!-- <i class="fa fa-qrcode" style="font-size: 50px;"></i> -->
                                                        </div>
                                                    </div>

                                                </div></a><!-- end card body -->

                                            </div>

                                            <?php } ?>


                                            <?php if ($storeDet[0]['delivery_number'] != '') { ?>
                                            <div class="col-xl-3 col-md-6">

                                                <div class="card-body bg-b-success">

                                                    <div class="row align-items-center">
                                                        <div class="col-8">
                                                            <span class="text-white text-truncate"
                                                                style="font-size: 19px;">Download
                                                                Delivery QR
                                                                Code</span>
                                                            <span class="text-white text-truncate"
                                                                style="font-size: 15px;"><?php echo $storeDet[0]['delivery_number'] ?></span>
                                                        </div>
                                                        <div class="col-4 icon">
                                                            <a href="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQrCode1/<?php echo $storeDet[0]['store_id']; ?>"
                                                                target="_blank">
                                                                <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                                                            </a>
                                                            <!-- <i class="fa fa-qrcode" style="font-size: 50px;"></i> -->
                                                        </div>
                                                    </div>

                                                </div></a><!-- end card body -->

                                            </div>

                                            <?php } ?>





                                            <div class="col-xl-3 col-md-6">

                                                <a class="store_table btn tblLogBtn pl-0 pr-0" id=""
                                                    data-id="<?php echo $storeDet[0]['store_id'] ?>"
                                                    data-name="<?php echo $storeDet[0]['store_name'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#emp_informations"
                                                    class="btn tblLogBtn pl-0 pr-0" title="Tables">
                                                    <div class="card-body bg-b-success">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <span class="text-white text-truncate"
                                                                    style="font-size: 19px;">Generate Table QR
                                                                    Codes</span>
                                                            </div>
                                                            <div class="col-4 icon">
                                                                <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </a><!-- end card body -->

                                            </div>

                                            <div class="col-xl-3 col-md-6">

                                                <div class="card-body bg-b-success">

                                                    <div class="row align-items-center">
                                                        <div class="col-8">
                                                            <span class="text-white text-truncate"
                                                                style="font-size: 19px;">Table QR
                                                                PDF</span>
                                                        </div>
                                                        <div class="col-4 icon">
                                                            <a href="<?php echo base_url(); ?>admin/qrcodes/pdf/<?php echo $storeDet[0]['store_id']; ?>"
                                                                target="_blank">
                                                                <i class="fa-solid fa-file-pdf"
                                                                    style="font-size: 50px;"></i>
                                                            </a>
                                                            <!-- <i class="fa fa-qrcode" style="font-size: 50px;"></i> -->
                                                        </div>
                                                    </div>

                                                </div></a><!-- end card body -->

                                            </div>




                                        </div>




                                    </div>
                                </div>
                            </div>




                            <!-- Modal for detailed view -->
                            <div class="modal fade" id="emp_informations" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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
                        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
                    </div>
                    <input type="hidden" name="hiddencountry"
                        value="<?php if(isset($storeDet[0]['store_country'])){echo $storeDet[0]['store_country'];}?>">
                    <button class="btn btn-primary pull-right mb-4" type="submit" name="edit">Save</button>
                </form>
                <?php } ?>


            </div>