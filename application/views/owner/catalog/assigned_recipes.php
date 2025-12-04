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


   <!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body text-success fw-bold"></div>
    </div>
  </div>
</div>
<!-- success modal -->



    <div class="">
        <div class="table-responsive-sm">


            <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">


            <div class="container">
                <div class="row align-items-center">
                    <!-- Dropdown column -->



                </div>
            </div>


            <table id="examplee" class="table table-striped mt-3" style="width:100%">
                <thead style="background: #e5e5e5;">
                    <tr>
                        <th>No</th>
                        <th>Recipe</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                       if(!empty($recipes)){
                       $count = 1;
                       foreach($recipes as $val){
                        ?>
                    <tr>
                        <td><?php echo $count;?></td>

                        <td><?php echo $val['name_en'];?></td>
                        <td>
                        <button type="button" class="btn btn-danger btn-sm delete-recipe" data-id="<?php echo $val['store_recipe_id']; ?>">Delete</button>
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
            <div class="col-auto">
                <a class="btn btn1 mt-2" data-bs-toggle="modal" data-bs-target="#reciepe">Add Recipe</a>
            </div>




            <div class="modal fade " id="reciepe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Recipe</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="message d-none" role="alert"></div>
                            <div class="row">
                                <form id="addreciepe" method="post" enctype="multipart/form-data" style="">
                                    <label class="col-sm-3 col-form-label">Name (Malayalam)</label>
                                    <input type="text" class="form-control" id="reciepe_name_ma" name="reciepe_name_ma"
                                        value="">
                                    <label class="col-sm-3 col-form-label">Name (English)</label>
                                    <input type="text" class="form-control" id="reciepe_name_en" name="reciepe_name_en"
                                        value="">
                                    <label class="col-sm-3 col-form-label">Name (Hindi)</label>
                                    <input type="text" class="form-control" id="reciepe_name_hi" name="reciepe_name_hi"
                                        value="">
                                    <label class="col-sm-3 col-form-label">Name (Arabic)</label>
                                    <input type="text" class="form-control" id="reciepe_name_ar" name="reciepe_name_ar"
                                        value="">
                                </form>

                                <div class="mt-2 text-center m-auto">
                                    <button class="btn btn1" type="button" id="saveReciepe">Save</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>









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
<script src="<?php echo base_url();?>assets/admin/js/metismenu.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/feather.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
<script type="module" src="<?php echo base_url();?>assets/admin/js/ownerscripts.js"></script>