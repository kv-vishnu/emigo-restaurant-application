<div class="application-content add-new-dish">
    <div class="application-content__container container add-new-dish__container">
        <h1 class="application-content__page-heading">Add New Dish</h1>
        <div class="add-new-dish-form">

            <form id="add-new-dish" method="post" enctype="multipart/form-data" class="add-new-dish-form__body">

                <div class="add-new-dish-form__section-container">
                    <div class="add-new-dish-form__section">
                        <h2 class="add-new-dish-form__section-heading">Dish Details</h2>
                        <div class="form__field-container-group gc">
                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Category</label>
                                <select class="form__input-select" name="category_id">
                                    <option value="">Select Category</option>
                                    <?php
                          foreach($categories as $category)
                          {
                          ?>
                                    <option value="<?=$category['category_id'];?>"
                                        <?php echo set_select('category_id', $category['category_id'])?>>
                                        <?=$category['category_name_en'];?></option>
                                    <?php
                          }
                          ?>
                                </select>
                            </div>

                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Dish Type</label>
                                <select class="form__input-select" name="product_veg_nonveg">
                                    <option value="">Select any</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non-Veg</option>
                                </select>
                            </div>

                            <div class="form__field-container xs12 lg2">

                                    <label class="form__label">Is Customizable</label>
                                    <input type="hidden" name="iscustomizable_hidden" value="0"
                                        id="iscustomizable_hidden">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="checkbox_is_customizable">

                            </div>
                            <div class="form__field-container xs12 lg2">

                                    <label class="form__label">Is Addon</label>
                                    <input type="hidden" name="isaddon_hidden" value="0" id="isaddon_hidden">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox_is_addon">

                            </div>

                        </div>


                        <div class="form__field-container-group gc" id="product_rate_div">
                            <div class="form__field-container xs12 lg3">
                                <label class="form__label">Rate</label>
                                <input type="text" class="form__input-text"
                                    value="<?php echo isset($val['rate']) ? $val['rate'] : ''; ?>" id="rate" name="rate"
                                    style="width:100%;">
                            </div>
                            <div class="form__field-container xs12 lg3">
                                <label class="form__label">Tax</label>
                                <select class="form__input-select" name="tax" id="tax">
                                    <option value="0"
                                        <?php echo (isset($default_tax_rate) && $default_tax_rate == 0) ? 'selected' : ''; ?>>
                                        0</option>
                                    <?php
                    foreach($store_taxes as $tax) {
                      if(isset($val['tax'])){
                        $selected = (isset($val['tax']) && $tax['tax_rate'] == $val['tax']) ? 'selected' : '';
                      }else{
                        $selected = (isset($default_tax_rate) && $tax['tax_rate'] == $default_tax_rate) ? 'selected' : '';
                    }
                    ?>
                                    <option value="<?php echo $tax['tax_rate']; ?>" <?php echo $selected; ?>>
                                        <?php echo $tax['tax_rate']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form__field-container xs12 lg3">
                                <label class="form__label">Tax amount</label>
                                <input type="text" class="form__input-text"
                                    value="<?php echo isset($val['rate']) ? $val['rate'] : ''; ?>" name="tax_amount"
                                    id="taxAmount" style="width: 100%;">
                            </div>
                            <div class="form__field-container xs12 lg3">
                                <label class="form__label">Total amount</label>
                                <input type="text" class="form__input-text"
                                    value="<?php echo isset($val['rate']) ? $val['rate'] : ''; ?>" id="totalAmount"
                                    name="total_amount" style="width: 100%;">
                            </div>
                        </div>
                    </div>

                    <div class="add-new-dish-form__section">
                        <h2 class="add-new-dish-form__section-heading">Product Name & Description</h2>
                        <div class="form__field-container-group gc">
                            <div class="form__field-container add-new-dish-form__proudct-name-description xs12 lg3">
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Name</label>
                                    <input class="form-control" value="" type="text" placeholder="Malayalam"
                                        name="product_name_ma">
                                </div>
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Description</label>
                                    <textarea name="product_desc_ma" class="form-control"
                                        id="exampleFormControlTextarea4" placeholder="Malayalam" rows=""></textarea>
                                </div>
                            </div>
                            <div class="form__field-container add-new-dish-form__proudct-name-description xs12 lg3">
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Name</label>
                                    <input class="form-control" value="" type="text" placeholder="English"
                                        name="product_name_en">
                                </div>
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Description</label>
                                    <textarea name="product_desc_en" class="form-control"
                                        id="exampleFormControlTextarea4" placeholder="English" rows=""></textarea>
                                </div>
                            </div>
                            <div class="form__field-container add-new-dish-form__proudct-name-description xs12 lg3">
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Name</label>
                                    <input class="form-control" value="" type="text" placeholder="Hindi"
                                        name="product_name_hi">
                                </div>
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Description</label>
                                    <textarea name="product_desc_hi" class="form-control"
                                        id="exampleFormControlTextarea4" placeholder="Hindi" rows=""></textarea>
                                </div>
                            </div>
                            <div class="form__field-container add-new-dish-form__proudct-name-description xs12 lg3">
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Name</label>
                                    <input class="form-control" value="" type="text" placeholder="Arabic"
                                        name="product_name_ar">
                                </div>
                                <div class="form__field-container-label-input-group">
                                    <label class="form__label">Product Description</label>
                                    <textarea name="product_desc_ar" class="form-control"
                                        id="exampleFormControlTextarea4" placeholder="Arabic" rows=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-new-dish-form__section">
                        <h2 class="add-new-dish-form__section-heading">Product Images</h2>
                        <span id="image_error" class="error errormsg mt-2"></span>
                        <div id="image-container" class="product-images">
                            <div class="image-item">
                                <img id="previewImage1"
                                    src="<?php echo base_url(); ?>uploads/product/<?php if(isset($productDet[0]['image'])) echo $productDet[0]['image']; ?>"
                                    width="100" class="image-to-crop d-none" />
                                <input type="file" name="images" class="form-control" id="preview1" />
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn1 mt-2" type="button" id="addNewDish">SAVE PRODUCT</button>
        </div>



        </form>
    </div>

</div>
</div>


</div>


<script>
$(document).ready(function() {
    $('#checkbox_is_customizable').on('click', function() {
        if ($(this).is(':checked')) {
            $('#iscustomizable_hidden').val(1);
        } else {
            $('#iscustomizable_hidden').val(0);
        }
    });

    $('#checkbox_is_addon').on('click', function() {
        if ($(this).is(':checked')) {
            $('#isaddon_hidden').val(1);
        } else {
            $('#isaddon_hidden').val(0);
        }
    });
})
</script>
<script>
const rateInput = document.getElementById('rate');
const taxInput = document.getElementById('tax');
const taxAmountInput = document.getElementById('taxAmount');
const totalAmountInput = document.getElementById('totalAmount');

function calculateTotal() {
    const rate = parseFloat(rateInput.value) || 0;
    const tax = parseFloat(taxInput.value) || 0;

    const taxAmount = (rate * tax) / 100;
    const totalAmount = rate + taxAmount;

    taxAmountInput.value = taxAmount.toFixed(2);
    totalAmountInput.value = totalAmount.toFixed(2);
}

rateInput.addEventListener('input', calculateTotal);
taxInput.addEventListener('input', calculateTotal);
</script>


</div>
</div>

<!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
</div>
</form>



</div>
<script>
$(document).ready(function() {
    $('#checkbox_is_customizable').on('click', function() {
        if ($(this).is(':checked')) {
            $('#iscustomizable_hidden').val(1);
            $('#product_rate_div').hide();
        } else {
            $('#iscustomizable_hidden').val(0);
            $('#product_rate_div').show();
        }
    });

    $('#checkbox_is_addon').on('click', function() {
        if ($(this).is(':checked')) {
            $('#isaddon_hidden').val(1);
        } else {
            $('#isaddon_hidden').val(0);
        }
    });

})
</script>
</body>

</html>