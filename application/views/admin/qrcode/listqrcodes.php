
        <!-- ============================================================== -->
        <div class="">
            <div class="page-content p-2">




                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">QR Codes</h4>

                                <!-- <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">QR Codes</li>
                                    </ol>
                                </div> -->

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


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


<?php if (!empty($tableQrCodes)) { ?>
    <!-- Tables QR Codes -->
    <h4 class="mb-3">Table QR Codes</h4>
    <div class="row">
        <?php foreach ($tableQrCodes as $qrcode) { ?>
            <?php if (!empty($qrcode['qr_code'])) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Code">
                        <div class="card-body qr-card text-center">
                            <img src="<?php echo $qrcode['qr_code']; ?>" class="mb-2">
                            <h5 class="card-title mt-2">
                                <?php echo !empty($qrcode['store_table_name'])
                                    ? $qrcode['store_table_name']
                                    : $qrcode['table_name']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>


<?php if (!empty($roomQrCodes)) { ?>
    <!-- Rooms QR Codes -->
    <h4 class="mt-4 mb-3">Room QR Codes</h4>
    <div class="row">
        <?php foreach ($roomQrCodes as $qrcode) { ?>
            <?php if (!empty($qrcode['qr_code'])) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Code">
                        <div class="card-body qr-card text-center">
                            <img src="<?php echo $qrcode['qr_code']; ?>" class="mb-2">
                            <h5 class="card-title mt-2">
                                <?php echo !empty($qrcode['store_table_name'])
                                    ? $qrcode['store_table_name']
                                    : $qrcode['table_name']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>

<h4 class="mt-4 mb-3">Pickup And Delivery QR Codes</h4>
<div class="row">
            <?php if (!empty($pickupQr)) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Code">
                        <div class="card-body qr-card text-center">
                            <img src="<?php echo $pickupQr; ?>" class="mb-2">
                            <h5 class="card-title mt-2">
                                Pickup QR Code
                            </h5>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($deliveryQr)) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Code">
                        <div class="card-body qr-card text-center">
                            <img src="<?php echo $deliveryQr; ?>" class="mb-2">
                            <h5 class="card-title mt-2">
                                Delivery QR Code
                            </h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
    </div>


                            </div>

                            <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/qrcodes/generatePdf/<?php echo $storeId; ?>"
                                                                    target="_blank">
                                                                    <i class="fa-solid fa-file-pdf"
                                                                        ></i>Generate PDF
                                                                </a>

                        </div>
                    </div>





            </div>
    </div>
            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>


