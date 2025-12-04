<!-- <div class="row">
<input type="text" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">
    <h4>hiii</h4>
</div> -->


<link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>


<div class="row bg-soft-light mb-3 border1 pt-2">
    <form class="row g-3" id="addcomboitems" method="post" enctype="multipart/form-data">
        <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">
        <div class="col-md-3">
            <div class="mb-2 ">
                <label class="form-label mx-2" for="default-input">Select Products</label>
                <select class="form-select mx-2" name="combo_id" id="comboitemproducts">
                    <option value="">Select Product</option>
                    <?php
                        if(!empty($products)){
                            foreach($products as $product)
                            {
                            ?>
                    <option value="<?=$product['store_product_id'];?>"
                        <?php echo set_select('store_product_id', $product['store_product_id'])?>>
                        <?=$product['product_name_en'];?></option>
                    <?php
                            }}
                            ?>

                </select>
                <span class="error errormsg mt-2 mx-2" id="comboitems_error"></span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-2 focus">
                <label class="form-label" for="default-input">Quantity</label>
                <input class="form-control" value="" placeholder="Quantity" type="text" name="quanitity_id">
                <span class="error errormsg mt-2" id="comboquanityitems_error"></span>
            </div>
        </div>



        <div class="col-md-3">
            <div class="mb-4">
                <label class="form-label" for="default-input">&nbsp;</label><br>
                <button class="btn6-small" type="button" id="addcombo">Add</button>
            </div>
        </div>
    </form>
</div>



<!-- Section 2 -->

<?php if(!empty($comboItems)){ ?>

<table id="examplee" class="table table-striped mt-3" style="width:100%">
    <thead style="background: #e5e5e5;">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        <?php
                       $count = 1;
                       foreach($comboItems as $combo){
                        ?>
        <tr>
            <td><?=$combo['combo_item_id'];?></td>
            <td><?=$this->Ordermodel->getProductName($combo['item_id'])?></td>
            <td><?=$combo['quantity'];?></td>
            <td>
                <button class="btn tblEditBtn pl-0 pr-0 edit-combo-item" type="submit"
                    data-qty="<?=$combo['quantity']; ?>" data-bs-toggle="tooltip"
                    data-id="<?=$combo['combo_item_id'];?>" data-bs-original-title="Edit Country"><i class="fa fa-edit"
                        data-bs-target="#editcombo" data-bs-toggle="modal"></i></button>
                <button data-id="<?=$combo['combo_item_id'];?>" class="btn tblDelBtn pl-0 pr-0 delete-combo-item"
                    type="submit" data-bs-toggle="tooltip"><i class="fa fa-trash" data-bs-target="#deletecombo"
                        data-bs-toggle="modal"></i></button>
            </td>


        </tr>
        <?php $count++; } ?>



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
<?php } ?>


<div class="modal fade " id="deletecombo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE COMBO ITEM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <input type="hidden" name="id" id="delete_id" value="" />
                <?php echo are_you_sure; ?>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">NO</button>
                <button class="btn btn-secondary" id="yes_del_combo" type="button"
                    data-bs-dismiss="modal">DELETE</button>
            </div>

            </form>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="editcombo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT COMBO ITEM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- if response within jquery -->
                <div class="message d-none" role="alert"></div>
                <form action="" id="edit_combo_item" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="combo_item_id" name="combo_item_id" value="">
                    <input type="text" class="form-control mt-2" placeholder="Enter your Quanity" name="qty" id="qty"
                        value="">

                </form>
                <div class="mt-2 text-center m-auto">
                    <button class="btn btn-primary " type="button" id="save_edit_combo">UPDATE</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $(document).on('click', '.delete-combo-item', function() {
        var id = $(this).data('id');
        $('#delete_id').val(id);
    });

    $('#yes_del_combo').click(function() {
        $.ajax({
            method: "POST",
            url: '<?= base_url("owner/Combo/DeleteComboItems") ?>',
            data: {
                'id': $('#delete_id').val()
            },
            success: function(data) {
                window.location.href = '';
            }
        });
    });

    $(document).on('click', '.edit-combo-item', function() {
        var id = $(this).data('id');
        $('#combo_item_id').val(id);
        $('#qty').val($(this).data('qty'));
    });

    $('#addcombo').click(function(e) {
        let formData = new FormData($('#addcomboitems')[0]);
        $.ajax({
            url: '<?= base_url("owner/Combo/addComboItems") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response); // Log response for debugging
                if (response.success) {
                    $('#comboitems_error').html('');
                    $('#comboquanityitems_error').html('');
                    location.reload();
                } else if (response.errors.combo_id) {
                    $('#comboitems_error').html(response.errors.combo_id);
                }
                if (response.errors.quanitity_id) {
                    $('#comboquanityitems_error').html(response.errors.quanitity_id);
                }

            },

        });
    });

    $("#save_edit_combo").click(function(e) {
        var id = $("#combo_item_id").val();
        //alert(id);
        let formData = new FormData($('#edit_combo_item')[0]);
        $.ajax({
            url: "<?= base_url("owner/Combo/UpdateComboItems") ?>",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if (response.success) {
                    location.reload();
                }
            }
        })
    })

});
</script>



<!-- Button column -->