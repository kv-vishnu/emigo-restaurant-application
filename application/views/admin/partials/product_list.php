<table class="table table-bordered">
    <tr>
        <th>Category</th>
        <th>Product</th>
        <th>Assign</th>
    </tr>
    <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['category_name_en'] ?></td>
            <td><?= $p['product_name_en'] ?></td>
            <td>
                <input type="checkbox" name="product_ids[]" value="<?= $p['product_id'] ?>"
                       <?= $p['is_assigned'] ? 'checked' : '' ?>>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
