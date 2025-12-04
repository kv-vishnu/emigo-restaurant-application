<input type="hidden" id="store_id" value="<?= $store_id ?>">
<input type="hidden" id="base_url" value="<?php echo base_url();?>">

<!-- Category Filter -->
<select id="product_category_id" class="form-select">
    <option value="">All Categories</option>
    <?php foreach($categories as $cat): ?>
        <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name_en'] ?></option>
    <?php endforeach; ?>
</select>

<!-- Product List -->
<div id="product_list">
    <?php $this->load->view('admin/partials/product_list', ['products' => $products]); ?>
</div>

<button type="button" id="saveAssignments" class="btn btn1">Save Assignments</button>

<script>
$(document).ready(function() {
    var base_url = $("#base_url").val();
    $('#product_category_id').change(function() {
        var cat_id = $(this).val();
        var store_id = $("#store_id").val();
        $.post(base_url + "admin/Product_assign/filter", {category_id: cat_id, store_id: store_id}, function(res) {
            $("#product_list").html(res);
        });
    });

    //MARK: -Save Assignments
    $('#saveAssignments').click(function() {
        var store_id = $("#store_id").val();
        var category_id = $("#product_category_id").val();
        var selected = [];
        $('#product_list input[name="product_ids[]"]:checked').each(function() {
            selected.push($(this).val());
        });

        $.post(base_url + "admin/Product_assign/save", {store_id: store_id, product_ids: selected , category_id:category_id }, function(res) {
            var data = JSON.parse(res);
            alert(data.message);
        });
    });
});
</script>