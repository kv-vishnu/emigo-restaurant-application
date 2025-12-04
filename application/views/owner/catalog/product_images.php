<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet" /> <!-- 'classic' theme -->
<link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/admin/css/styles.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
<style>
.gallery {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* Two columns per row */
    gap: 20px;
    max-width: 100%;
    padding: 20px;
}

@media only screen and (min-width:768px) {
    .gallery {
        grid-template-columns: repeat(3, 1fr);
    }
}

.gallery-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #ddd;
    padding: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
}

.gallery-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

.gallery-item button {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #6d6f70;
    color: #fff;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 5px !important;
}

.gallery-item button:hover {
    background-color: #0056b3;
}
</style>











<div class="row">





    <input type="hidden" id="store_product_id" name="store_product_id" value="<?php echo $store_product_id; ?>">

    <div class="container">

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


        <div class="row">
            <div class="upload-section">
                <form action="<?php echo base_url('upload/image'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="imageUpload">Upload New Image:</label>
                        <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*" required>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-items-center">
            <!-- Dropdown column -->

            <div class="gallery">
                <?php foreach ($images as $image) { ?>
                <div class="gallery-item">
                    <h2>Default Image</h2>
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['default_image']; ?>">
                </div>

                <?php if (!empty($image['image1']) && file_exists(FCPATH . 'uploads/product/' . $image['image1'])){ ?>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image1']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image1']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set as default image</button>
                </div>
                <?php } ?>

                <?php if (!empty($image['image2']) && file_exists(FCPATH . 'uploads/product/' . $image['image2'])){ ?>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image2']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image2']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set as default image</button>
                </div>
                <?php } ?>

                <?php if (!empty($image['image3']) && file_exists(FCPATH . 'uploads/product/' . $image['image3'])){ ?>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image3']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image3']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set as default image</button>
                </div>
                <?php } ?>

                <?php if (!empty($image['image4']) && file_exists(FCPATH . 'uploads/product/' . $image['image4'])){ ?>
                <div class="gallery-item">
                    <img src="<?php echo base_url(); ?>uploads/product/<?php echo $image['image4']; ?>">
                    <button class="btn6-small set_default" data-image="<?php echo $image['image4']; ?>"
                        data-id="<?php echo $store_product_id; ?>">Set as default image</button>
                </div>
                <?php } ?>

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
    </script>

