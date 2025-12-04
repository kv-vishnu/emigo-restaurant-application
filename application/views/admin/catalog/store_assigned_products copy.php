<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet"  /> <!-- 'classic' theme -->
    <link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>

       
       
       

                    
               

                



                    <div class="row">





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

<form method="post" id="form_product_display" action="<?php echo base_url();?>admin/product_assign/update">
<input type="hidden" name="store_id_hidden" value="<?php echo $store_id; ?>">
<input type="hidden" name="product_id_hidden" value="<?php echo $store_id; ?>">



<div class="container">
    <div class="row align-items-center">
        <!-- Dropdown column -->
        <div class="col d-none">
        <select class="form-select" name="category_id" id="category_id">
                                <option value="">Select Category</option>
    <?php
                                foreach($categories as $category)
                                {
                                ?>
                              <option value="<?=$category['category_id'];?>" <?php echo set_select('category_id', $category['category_id'])?>><?=$category['category_name_en'];?></option>
                              <?php
                                }
                                ?>
    </select>
        </div>
        
    </div>
</div>

<div style="height:600px;overflow:scroll;">


                            <table id="examplee" class="table table-striped mt-3" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Select</th>
            <th>Name</th>
            <th>Category</th>
            <!-- <th>Actions</th> -->
            </tr>
        </thead>

        <tbody>

        <?php
                       if(!empty($products)){
                       $count = 1;
                       foreach($products as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                <td>
                    <input type="checkbox" class="check-item" name="selected_items[]" value="<?php echo $val['product_id']; ?>"
                        <?php echo in_array($val['product_id'], $already_assigned_products_ids) ? 'checked' : ''; ?>>
                </td>
                <td><?php echo $val['product_name_en'];?></td>
                <td><?php echo $val['category_name_en']; ?></td>
            </tr>
            <?php $count++; }} ?>

           
            
        </tbody>
        <tfoot>
            <tr>
            
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
        </tfoot>
    </table>
    
    </div>









                               
                               
                                
                            </div>
                            <div class="col-auto">
        <button class="btn btn-primary pull-right mt-0" id="update_btn" type="submit" name="update" disabled>Update</button>
        </div>
                        </div>
                    </div>





                           <!--modal for delete confirmation-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="table_id" value=""/>
                                <input type="hidden" name="id" id="store_id_hidden_popup" value=""/>
                                <?php echo are_you_sure; ?></div>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {   	
new DataTable('#example');
} );
</script>
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            $('#form_product_display').submit();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Function to toggle button based on checkbox state
        function toggleButton() {
            if ($('.check-item:checked').length > 0) {
                $('#update_btn').prop('disabled', false); // Enable button
            } else {
                $('#update_btn').prop('disabled', true); // Disable button
            }
        }

        // Initial check on page load
        toggleButton();

        // Check on change event
        $('.check-item').change(function() {
            toggleButton();
        });
    });
</script>