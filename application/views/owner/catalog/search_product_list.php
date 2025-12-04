<?php if (!empty($searchproducts)): ?>
    <?php foreach ($searchproducts as $product): ?>
        <?php
            $date = $date ?? date('Y-m-d');
            $store_id = $store_id ?? 0;

            if ($product->is_customizable == 0) {
                $product_rate = $product->rate;
            } else {
                $product_rate = $this->Ordermodel->getCustomizeProductDefaultPriceOnSearch($product->store_product_id, $store_id);
            }

            $path = !empty($product->image)
                ? site_url("uploads/product/" . $product->image)
                : site_url("uploads/product/" . $product->store_image);

            if ($product->category_id == 23) continue;

            $stock = $this->Ordermodel->getCurrentStock($product->store_product_id, $date, $store_id);
            $product_name = !empty($product->store_product_name_en)
                ? $product->store_product_name_en
                : $product->product_name_en;
        ?>

        <div class="product-list__item">
            <div class="product-list__item-image-and-details">
                <img src="<?= $path; ?>" alt="<?= $product_name; ?>"
                     class="product-list__item-img" width="190" height="150">

                <div class="product-list__item-details">
                    <h3 class="product-list__item-name"><?= $product_name; ?></h3>
                    <p class="product-list__item-price"><?= $product_rate; ?></p>
                    <p class="product-list__item-status-<?= (($stock > 0) && ($product->availability == 0)) ? 'available' : 'unavailable'; ?> text-capitalize">
                        <?= (($stock > 0) && ($product->availability == 0)) ? 'Available' : 'Unavailable'; ?>
                    </p>

                    <select width="50%" class="change_availability mb-2"
                            data-id="<?= $product->store_product_id; ?>">
                        <option value="0" <?= ($product->availability == 0) ? 'selected' : ''; ?>>Active</option>
                        <option value="1" <?= ($product->availability == 1) ? 'selected' : ''; ?>>Inactive</option>
                    </select>

                    <div class="product-list__item-stock">
                        <div class="product-list__item-stock-label">Stock</div>
                        <div class="product-list__item-stock-count"><?= ($stock !== null && $stock !== false) ? $stock : 0; ?></div>
                    </div>

                    <?php if ($product->is_customizable == 1): ?>
                        <div class="mt-2">Customisable</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="product-list__item-buttons-block">
                <div class="product-list__item-buttons-block-one">

                    <a href="#" class="product-list__item-buttons-block-btn btn6 open-modal"
                       data-bs-toggle="modal" data-id="<?= $product->store_product_id; ?>"
                       data-bs-target="#addstock">
                        <img class="product-list__item-button-img"
                             src="<?= base_url('assets/admin/images/add-stock-icon.svg'); ?>" alt="add stock"
                             width="23" height="24"> Add Stock
                    </a>

                    <a href="#" class="product-list__item-buttons-block-btn btn6 remove-modal"
                       data-bs-toggle="modal" data-id="<?= $product->store_product_id; ?>"
                       data-bs-target="#removestock">
                        <img class="product-list__item-button-img"
                             src="<?= base_url('assets/admin/images/remove-stock-icon.svg'); ?>" alt="remove stock"
                             width="23" height="22"> Remove Stock
                    </a>

                    <?php if ($stock == 0): ?>
                        <a href="#" class="product-list__item-buttons-block-btn btn6 nextavialable-modal"
                           data-bs-toggle="modal" data-id="<?= $product->store_product_id; ?>"
                           data-bs-target="#nextavailabletime">
                            <img class="product-list__item-button-img"
                                 src="<?= base_url('assets/admin/images/next-available-time-icon.svg'); ?>"
                                 alt="next available" width="23" height="24"> Next Available Time
                        </a>
                    <?php endif; ?>

                    <a href="#" class="product-list__item-buttons-block-btn btn6 store_product_details"
                       data-bs-toggle="modal" data-bs-target="#Edit-dish"
                       data-id="<?= $product->store_product_id; ?>"
                       data-isCustomizable="<?= $product->is_customizable; ?>">
                        <img class="product-list__item-button-img"
                             src="<?= base_url('assets/admin/images/edit-dish-icon.svg'); ?>" alt="edit dish"
                             width="23" height="22"> Edit Dish
                    </a>

                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php else: ?>
    <div class="no-products-found"><p>No products found.</p></div>
<?php endif; ?>
