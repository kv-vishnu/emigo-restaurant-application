<div class="application-content add-new-dish">
    <div class="application-content__container container add-new-dish__container">
        <h1 class="application-content__page-heading">Add New Combo</h1>
        <div class="add-new-dish-form">

            <form id="add-new-dish" method="post" enctype="multipart/form-data" class="add-new-dish-form__body">

                <div class="add-new-dish-form__section-container">
                    <div class="add-new-dish-form__section">
                        <h2 class="add-new-dish-form__section-heading">Product Details</h2>
                        <div class="form__field-container-group gc">
                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Category</label>
                                <select class="form__input-select" name="category_id">

                                    <option value="23">Combo</option>

                                </select>
                                <div class="form__validation">
                                    <span id="category_id_error"
                                        class="error errormsg mt-2"><?= form_error('category_id'); ?></span>
                                </div>
                            </div>
                            <!-- sub category -->
                            <!--<div class="form__field-container xs12 lg4">-->
                            <!--    <label class="form__label">SubCategory </label>-->
                            <!--    <select class="form__input-select" name="subcategory_id">-->
                            <!--        <option value="">Select Sub Category</option>-->
                                    <?php
                        foreach($subcategories as $category)
                        {
                        ?>
                                    <!--<option value="<?=$category['subcategory_id'];?>"-->
                                    <!--    <?php echo set_select('subcategory_id', $category['subcategory_id'])?>>-->
                                    <!--    <?=$category['subcategory_name_en'];?></option>-->
                                    <?php
                        }
                        ?>
                            <!--    </select>-->
                            <!--</div>-->
                            
                            <div class="form__field-container xs12 lg4">
                                <label class="form__label">Veg/Non Veg</label>
                                <select class="form__input-select" name="product_veg_nonveg">
                                    <option value="">Select any</option>
                                    <option value="veg">Veg</option>
                                    <option value="non-veg">Non-Veg</option>
                                </select>
                            </div>
                        </div>
                        <span id="product_veg_nonveg_error"
                            class="error errormsg mt-2"><?= form_error('product_veg_nonveg'); ?></span>
                        <div class="form__field-container-group gc">
                            <div class="form__field-container xs12 lg2">
                                <div class="form__input-group-checkbox">
                                    <label class="form__label">Is Customizable</label>
                                    <input type="hidden" name="iscustomizable_hidden" value="0"
                                        id="iscustomizable_hidden">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="checkbox_is_customizable">
                                </div>
                            </div>
                            <div class="form__field-container xs12 lg2">
                                <div class="form__input-group-checkbox">
                                    <label class="form__label">Is Addon</label>
                                    <input type="hidden" name="isaddon_hidden" value="0" id="isaddon_hidden">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox_is_addon">
                                </div>
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
                                <div class="form__validation"><span id="product_name_ma_error"
                                        class="error errormsg mt-2"><?= form_error('product_name_ma'); ?></span></div>
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
                                <div class="form__validation"><span id="product_name_en_error"
                                        class="error errormsg mt-2"><?= form_error('product_name_en'); ?></span></div>
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
                                <div class="form__validation"><span id="product_name_hi_error"
                                        class="error errormsg mt-2"><?= form_error('product_name_hi'); ?></span></div>
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
                                <span id="product_name_ar_error"
                                    class="error errormsg mt-2"><?= form_error('product_name_ar'); ?></span>
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
                                <input type="file" name="images[]" class="form-control" id="preview1" />
                            </div>
                            <div class="image-item">
                                <img id="previewImage2"
                                    src="<?php echo base_url(); ?>uploads/product/<?php if(isset($productDet[0]['image1'])) echo $productDet[0]['image1']; ?>"
                                    width="100" class="image-to-crop d-none" />
                                <input type="file" name="images[]" class="form-control" id="preview2" />
                            </div>
                            <div class="image-item">
                                <img id="previewImage3"
                                    src="<?php echo base_url(); ?>uploads/product/<?php if(isset($productDet[0]['image2'])) echo $productDet[0]['image2']; ?>"
                                    width="100" class="image-to-crop d-none" />
                                <input type="file" name="images[]" class="form-control" id="preview3" />
                            </div>
                            <div class="image-item">
                                <img id="previewImage4"
                                    src="<?php echo base_url(); ?>uploads/product/<?php if(isset($productDet[0]['image3'])) echo $productDet[0]['image3']; ?>"
                                    width="100" class="image-to-crop d-none" />
                                <input type="file" name="images[]" class="form-control" id="preview4" />
                            </div>
                            <div class="image-item">
                                <img id="previewImage5"
                                    src="<?php echo base_url(); ?>uploads/product/<?php if(isset($productDet[0]['image4'])) echo $productDet[0]['image4']; ?>"
                                    width="100" class="image-to-crop d-none" />
                                <input type="file" name="images[]" class="form-control" id="preview5" />
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




<!-- Modal for Image Cropping -->
<div id="cropper-modal" class="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="hiddenImgId">
                <img id="image-to-crop-modal" src="" alt="image-to-crop" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn1" id="crop-button">CROP AND UPDATE</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Cropper.js & jQuery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
$(document).ready(function() {
    var cropper;

    // Trigger cropper modal when image is clicked
    $('.image-to-crop').click(function() {
        var imageSrc = $(this).attr('src');
        var dataId = $(this).attr('id');
        $('#image-to-crop-modal').attr('src', imageSrc);

        // Destroy existing cropper if any
        if (cropper) {
            cropper.destroy();
        }

        // Initialize the cropper on the modal image
        $('#cropper-modal').modal('show');
        $('#hiddenImgId').val(dataId);
        var image = document.getElementById('image-to-crop-modal');
        cropper = new Cropper(image, {
            aspectRatio: 1, // Optional: change aspect ratio if needed
            viewMode: 1,
            scalable: true,
            zoomable: true,
            movable: true
        });
    });

    // Crop the image and upload
    $('#crop-button').click(function() {
        var croppedCanvas = cropper.getCroppedCanvas();
        var croppedImage = croppedCanvas.toDataURL('image/jpeg'); // Get cropped image data
        var fileName = 'cropped-image-' + new Date().getTime() + '.jpg';
        $.ajax({
            url: '<?= base_url("owner/Product/update_image") ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                image: croppedImage,
                imageId: $('#hiddenImgId').val(),
                file_name: fileName // Send file name for saving
            },
            success: function(response) {
                console.log(response);

                $('.image-to-crop[src="' + $('#image-to-crop-modal').attr(
                        'src') + '"]')
                    .attr('src', croppedImage);

                // Hide the modal after updating
                $('#cropper-modal').modal('hide');
                if (response.imageId == 'previewImage1') {
                    $('#imghidden1').val(response.filename);
                }
                if (response.imageId == 'previewImage2') {
                    $('#imghidden2').val(response.filename);
                }
                if (response.imageId == 'previewImage3') {
                    $('#imghidden3').val(response.filename);
                }
                if (response.imageId == 'previewImage4') {
                    $('#imghidden4').val(response.filename);
                }
                if (response.imageId == 'previewImage5') {
                    $('#imghidden5').val(response.filename);
                }
            },
            error: function() {
                alert('Failed to update the image.');
            }
        });
    });

    // Handle real-time image preview when files are selected
    function previewImage(inputId, previewImageId, imgHidden) {
        $(inputId).on('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const filename = file.name;
                $(imgHidden).val(filename);
                const reader = new FileReader();
                reader.onload = function(e) {
                    $(previewImageId).removeClass('d-none');
                    $(previewImageId).attr('src', e.target
                        .result); // Update the preview image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
                var formData = new FormData();
                formData.append("file", file);
                $.ajax({
                    url: '<?= base_url("owner/Product/update_image1") ?>',
                    method: 'POST',
                    data: formData,
                    contentType: false, // Don't set contentType
                    processData: false,
                    success: function(response) {}
                });
            }
        });
    }

    // Bind preview image functionality to file inputs
    previewImage('#preview1', '#previewImage1', '#imghidden1');
    previewImage('#preview2', '#previewImage2', '#imghidden2');
    previewImage('#preview3', '#previewImage3', '#imghidden3');
    previewImage('#preview4', '#previewImage4', '#imghidden4');
    previewImage('#preview5', '#previewImage5', '#imghidden5');
});
</script>
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
    $('#addNewDish').click(function() {

        let formData = new FormData($('#add-new-dish')[0]); // Capture the form data, including files

        $.ajax({
            url: '<?= base_url("owner/Product/save") ?>', // URL to the controller method
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function(response) {

                if (response.errors) {
                    // Define a mapping between error keys and their corresponding HTML elements
                    const errorMapping = {
                        category_id: '#category_id_error',
                        subcategory_id: '#subcategory_id_error',
                        product_veg_nonveg: '#product_veg_nonveg_error',
                        product_name_ma: '#product_name_ma_error',
                        product_name_en: '#product_name_en_error',
                        product_name_hi: '#product_name_hi_error',
                        product_name_ar: '#product_name_ar_error',
                        images: '#image_error',
                    };

                    // Iterate through the errorMapping and set the corresponding error messages
                    Object.keys(errorMapping).forEach(key => {
                        if (response.errors[key]) {
                            $(errorMapping[key]).html(response.errors[key]);
                        } else {
                            $(errorMapping[key]).html(
                                ''); // Clear the error message if not present
                        }
                    });
                } else {
                        $(this).prop('disabled', true).text('Processing...');
                        window.location.href = '<?= base_url("owner/combo") ?>';
                }

            },
            error: function(xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });
});
</script>
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