<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo base_url();?>assets/admin/css/styles.css" id="styles" rel="stylesheet" type="text/css" /> -->
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>




<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body text-success fw-bold"></div>
    </div>
  </div>
</div>
<!-- success modal -->








<div class="row">



    <div class="">
        <div class="table-responsive-sm">


            <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">
            <input type="hidden" id="taxRate" name="taxRate" value="<?php echo $default_tax_rate; ?>">


            <table id="examplee" class="table table-striped mt-3" style="width:100%">
                <thead style="background: #e5e5e5;">
                    <tr>
                        <th>No</th>
                        <th>Select</th>
                        <th>Variant</th>
                        <th>Rate</th>
                        <th>Is Default</th>
                        <th>Value</th>
                        <!-- <th>Is Active</th> -->
                    </tr>
                </thead>

                <tbody>

                    <?php

            if (in_array(4, $already_assigned_variants_ids) && in_array(3, $already_assigned_variants_ids) && in_array(2, $already_assigned_variants_ids)) //If exist quarter , Half and Full
            {
                $quarter_variant_value = 1;
                $half_variant_value = 2;
                $full_variant_value = 4;

            }
            elseif (in_array(4, $already_assigned_variants_ids) && in_array(3, $already_assigned_variants_ids)) // If exist Quarter and Half
            {
                $quarter_variant_value = 1;
                $half_variant_value = 2;
                $full_variant_value = 0;

            }
            elseif (in_array(3, $already_assigned_variants_ids) && in_array(2, $already_assigned_variants_ids)) // If exist Quarter and Half
            {
                $quarter_variant_value = 0;
                $half_variant_value = 1;
                $full_variant_value = 2;

            }

            else  // If exist full only
            {
                $quarter_variant_value = 0;
                $half_variant_value = 0;
                $full_variant_value = 1;
            }
                       if(!empty($variants)){
                       $count = 1;
                       foreach($variants as $val){
            $query = $this->db->query("SELECT rate,variant_value, tax, tax_amount, total_amount ,is_default, is_active FROM store_variants WHERE variant_id = ".$val['variant_id']." AND store_id = ".$this->session->userdata('logged_in_store_id')." AND store_product_id = ".$store_product_id."");
            $variantDetails = $query->result_array();
            //print_r($variantDetails);
            $hasVariantDetails = !empty($variantDetails);
            $rate = $hasVariantDetails ? $variantDetails[0]['rate'] : 0;
            $is_default = ($hasVariantDetails && $variantDetails[0]['is_default'] == 1) ? 1 : 0;
            $variant_value = '';
            if($val['variant_id'] == 4)
            {
                $variant_value = $quarter_variant_value;
            }elseif($val['variant_id'] == 3)
            {
                $variant_value = $half_variant_value;
            }elseif($val['variant_id'] == 2)
            {
                $variant_value = $full_variant_value;
            }
            else
            {

            }
                        ?>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td><input type="checkbox" class="variant_checkbox" data-variant-id="<?php echo $val['variant_id'];?>" <?php echo $hasVariantDetails ? 'checked' : ''; ?>></td>
                        <td><?php echo $val['variant_name'];?> </td>
                        <td><input type="text" class="form-control rate" style="width:50%;"
           data-variant-id="<?php echo $val['variant_id'];?>"
           value="<?php echo $rate; ?>"></td>
                        <td class="d-none">
                            <select class="form-select" name="tax" id="" style="width: 80%;">
                                <option value="0"
                                    <?php echo (isset($variantDetails[0]['tax']) && $variantDetails[0]['tax'] == 0) ? 'selected' : ''; ?>>
                                    0</option>
                                <?php
                      foreach($store_taxes as $tax) {
                        if(isset($val['tax'])){
                          $selected = (isset($val['tax']) && $tax['tax_rate'] == $variantDetails[0]['tax']) ? 'selected' : '';
                        }else{
                          $selected = (isset($variantDetails[0]['tax']) && $tax['tax_rate'] == $variantDetails[0]['tax']) ? 'selected' : '';
                      }
                      ?>
                                <option value="<?php echo $tax['tax_rate']; ?>" <?php echo $selected; ?>>
                                    <?php echo $tax['tax_rate']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="d-none">
                            <input type="text" class="form-control" style="width: 50%;"
                                value="<?php echo isset($variantDetails[0]['tax_amount']) ? $variantDetails[0]['tax_amount'] : ''; ?>"
                                name="tax_amount">
                        </td>
                        <td class="d-none">
                            <input type="text" class="form-control" style="width: 50%;"
                                value="<?php echo isset($variantDetails[0]['total_amount']) ? $variantDetails[0]['total_amount'] : ''; ?>"
                                name="total_amount">
                        </td>
                        <td>
        <input type="checkbox" class="is_default"
           data-variant-id="<?php echo $val['variant_id'];?>"
           <?php echo $is_default ? 'checked' : ''; ?>>
    </td>
                        <td><input type="text" class="form-control variant_value" data-variant-id="<?php echo $val['variant_id'];?>"
                                value="<?php echo $variant_value; ?>"
                                name="variant_value" readonly style="width: 50%;"></td>
                       <td>

                    </td>

                    </tr>
                    <?php $count++; }} ?>



                </tbody>
                <tfoot>
                    <tr>

                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </tfoot>
            </table>
            <!-- Button column -->
            <!-- <div class="col-auto">
                <a class="btn btn1 mt-2" data-id="<?php echo $store_product_id; ?>" id="add_variant" disabled>Add Custom Variant</a>
            </div> -->

            <div class="col-auto">
                <a class="btn btn1 mt-2" data-id="<?php echo $store_product_id; ?>" id="update_variants" disabled>Update Variant</a>
            </div>











        </div>
    </div>
</div>





<!-- Modal add variant -->
<div class="modal fade" id="addVariantModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">ADD VARIANT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="variantForm" method="post" enctype="multipart/form-data">

                    <input type="hidden" id="product_id" name="product_id" value="">
                    <label class="col-sm-12 col-form-label">Variant Name</label>
                    <input type="text" class="form-control" id="variant_name" name="variant_name" value="">
                    <span class="error errormsg mt-2" id="variant_name_error"></span>
                    <label class="col-sm-12 col-form-label">Code</label>
                    <input type="text" class="form-control" id="variant_code" name="variant_code" value="">
                    <span class="error errormsg mt-2" id="variant_code_error"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save_variant" data-bs-dismiss="SAVE">SAVE</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>

<script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/metismenu.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/feather.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
<script type="module" src="<?php echo base_url();?>assets/admin/js/ownerscripts.js"></script>