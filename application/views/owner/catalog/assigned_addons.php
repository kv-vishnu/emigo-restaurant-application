<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
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
            <?php if(!empty($addons)){ ?>
            <table id="examplee" class="table table-striped mt-3" style="width:100%">
                <thead style="background: #e5e5e5;">
                    <tr>
                        <th>No</th>
                        <th>Select</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                       $count = 1;
                       foreach($addons as $val){
                            $isAssigned = in_array($val['store_product_id'], $already_assigned_addons_ids ?? []);
                        ?>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td>
                        <input type="checkbox" class="addon_checkbox"
                               data-addon-id="<?php echo $val['store_product_id']; ?>"
                               <?php echo $isAssigned ? 'checked' : ''; ?>>
                        </td>
                        <td><?=$val['product_name_en'];?></td>
                    </tr>
                    <?php $count++; } ?>
                </tbody>
                <tfoot>
                    <tr>

                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </tfoot>
            </table>
            <!-- Button column -->
             <div class="col-auto">
                <a class="btn btn1 mt-2" data-id="<?php echo $store_product_id; ?>" id="update_addons">Update Addons</a>
            </div>

            <?php } ?>

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
