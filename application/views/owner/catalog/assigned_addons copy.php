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












<div class="row">


    <!-- if response within jquery -->
    <div class="message d-none" role="alert"></div>
    <!-- if response within jquery -->


    <?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success dark" role="alert">
        <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
    </div><?php } ?>

    <?php if($this->session->flashdata('error')){ ?>
    <div class="alert alert-danger dark" role="alert">
        <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
    </div><?php } ?>



    <div class="">
        <div class="table-responsive-sm">


            <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">


            <div class="container">
                <div class="row align-items-center">
                    <!-- Dropdown column -->



                </div>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <!-- Dropdown column -->
                    <div class="col">
                        <select class="form-select" name="product_id" id="product_id">
                            <option value="">Select Addon Product</option>
                            <?php
                                foreach($addons as $addon)
                                {
                                ?>
                            <option value="<?=$addon['store_product_id'];?>"
                                <?php echo set_select('product_id', $addon['store_product_id'])?>>
                                <?=$addon['product_name_en'];?></option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>

                    <!-- Button column -->
                    <div class="col-auto">
                        <button class="btn6-small" id="update_btn" type="submit" name="update" disabled>Add</button>
                    </div>
                </div>
            </div>
            <?php if(!empty($selected_addons)){ ?>

            <table id="examplee" class="table table-striped mt-3" style="width:100%">
                <thead style="background: #e5e5e5;">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Is Active</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                       $count = 1;
                       foreach($selected_addons as $val){
                        ?>
                    <tr>
                        <td><?php echo $count;?> <?php echo $val['addon_id'];?></td>
                        <td><?php echo $this->Productmodel->get_product_name($val['addon_item_id']); ?></td>
                        <td>
                            <select name="is_active" class="form-select selected_addon" data-id="<?php echo $val['addon_id'];?>" style="width: 80%;">
                                <option value="1"
                                    <?php echo (isset($val['is_active']) && $val['is_active'] == 1) ? 'selected' : ''; ?>>
                                    Active</option>
                                <option value="0"
                                    <?php echo (isset($val['is_active']) && $val['is_active'] == 0) ? 'selected' : ''; ?>>
                                    Inactive</option>
                            </select>
                        </td>

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

            <?php } ?>










        </div>
    </div>
</div>





<!--modal for delete confirmation-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="table_id" value="" />
                <input type="hidden" name="id" id="store_id_hidden_popup" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-secondary" id="yes_del_table" type="button" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--modal for delete confirmation-->





</div>

<script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/metismenu.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/feather.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
</script>

<script>
$(document).ready(function() {
    new DataTable('#example');
    
    $('.selected_addon').on('change', function() {
        var selected_addon_id = $(this).data('id');
        var is_active = $(this).val();
        $.ajax({
            url: '<?= base_url("owner/product/update_selected_addons_status"); ?>', // Controller method URL
            type: 'POST',
            data: {
                'selected_addon_id': selected_addon_id,
                'is_active': is_active
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('.message').removeClass('d-none');
                    $('.message').removeClass('alert alert-danger');
                    $('.message').addClass('alert alert-success');
                    $('.message').text('Addon updated successfully.');
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // 3000 ms = 3 seconds
                    // Reload the page if necessary
                }
            }
        });
    });
    
});
</script>
<script>
$('#product_id').on('change', function() {
    $('#update_btn').prop('disabled', !this.value);
});
</script>
<script>
$('#update_btn').click(function() {
    var product_id = $('#product_id').val();
    var store_product_id = $('#store_product_id').val();

    //alert(product_id);alert(store_product_id);
    // Send selectedProducts to CodeIgniter controller via AJAX
    $.ajax({
        url: '<?= base_url("owner/product/update_selected_addons"); ?>', // Controller method URL
        type: 'POST',
        data: {
            'product_id': product_id,
            'store_product_id': store_product_id
        },
        dataType: 'json',
        success: function(response) {
            //alert(response);

            if (response.status === 'success') {
                $('.message').removeClass('d-none');
                $('.message').removeClass('alert alert-danger');
                $('.message').addClass('alert alert-success');
                $('.message').text('Product addon updated successfully.');
                setTimeout(function() {
                    location.reload();
                }, 1000); // 3000 ms = 3 seconds
                // Reload the page if necessary
            } else {
                $('.message').removeClass('d-none');
                $('.message').addClass('alert alert-danger');
                $('.message').text('Addon already exist.');
            }
        }
        // ,
        // error: function() {
        //     $('.message').removeClass('d-none');
        //     $('.message').addClass('alert alert-danger');
        //     $('.message').text('Please select at least one checkbox for update.');
        // }
    });
});
</script>