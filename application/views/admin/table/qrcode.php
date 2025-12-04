
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<link href="<?php echo base_url();?>assets/admin/css/crm-responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/classic.min.css" rel="stylesheet"  /> <!-- 'classic' theme -->
    <link href="<?php echo base_url();?>assets/admin/fonts/css/all.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/icon.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/otherscripts.js"></script>

<div class="row">
<?php if ($storeDet[0]['pickup_number'] != '') { ?>
<div class="col-xl-4 col-md-6">

    <!-- <div class="add-new-dish-list-combo">
        <a href="<?php echo base_url(); ?>admin/qrcodes/generatePickupQRCode1/<?php echo $storeDet[0]['store_id']; ?>"
           class="add-new-dish-btn btn1" target="_blank" style="height:7rem;">
           <i class="fa fa-qrcode" style="font-size: 50px;"></i>

            Download Pickup QR Code (<?php echo $storeDet[0]['pickup_number']; ?>)
        </a>
    </div> -->




    <!-- <div class="card-body bg-b-success">

        <div class="row align-items-center">
            <div class="col-8">
                <span class="text-white text-truncate"
                    style="font-size: 19px;">Download
                    Pickup QR
                    Code</span>
                <span class="text-white text-truncate"
                    style="font-size: 15px;"><?php echo $storeDet[0]['pickup_number'] ?></span>
            </div>
            <div class="col-4 icon">
                <a href="<?php echo base_url(); ?>admin/qrcodes/generatePickupQRCode1/<?php echo $storeDet[0]['store_id']; ?>"
                    target="_blank">
                    <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                </a>

            </div>
        </div>

    </div>
</a> -->


</div>

<?php } ?>


<?php if ($storeDet[0]['delivery_number'] != '') { ?>
<div class="col-xl-4 col-md-6">

      <!-- <div class="add-new-dish-list-combo">
        <a href="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQrCode1/<?php echo $storeDet[0]['store_id']; ?>"
           class="add-new-dish-btn btn1" target="_blank" style="height:7rem;">
           <i class="fa fa-qrcode" style="font-size: 50px;"></i>

            Download Delivery QR Code (<?php echo $storeDet[0]['delivery_number']; ?>)
        </a>
    </div> -->

    <!-- <div class="card-body bg-b-success">
        <div class="row align-items-center">
            <div class="col-8">
                <span class="text-white text-truncate"
                    style="font-size: 19px;">Download
                    Delivery QR
                    Code</span>
                <span class="text-white text-truncate"
                    style="font-size: 15px;"><?php echo $storeDet[0]['delivery_number'] ?></span>
            </div>
            <div class="col-4 icon">
                <a href="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQrCode1/<?php echo $storeDet[0]['store_id']; ?>"
                    target="_blank">
                    <i class="fa fa-qrcode" style="font-size: 50px;"></i>
                </a>

            </div>
        </div>

    </div></a> -->

</div>

<?php } ?>







<div class="col-xl-4 col-md-6">

    <div class="add-new-dish-list-combo">
        <a href="<?php echo base_url(); ?>admin/qrcodes/pdf/<?php echo $storeDet[0]['store_id']; ?>"
           class="add-new-dish-btn btn1" target="_blank" style="height:2rem;">
           <i class="fa fa-qrcode" style="font-size: 10px;"></i>

            Download Table QR PDF
        </a>
    </div>

    <!-- <div class="card-body bg-b-success">

        <div class="row align-items-center">
            <div class="col-8">
                <span class="text-white text-truncate"
                    style="font-size: 19px;">Table QR
                    PDF</span>
            </div>
            <div class="col-4 icon">
                <a href="<?php echo base_url(); ?>admin/qrcodes/pdf/<?php echo $storeDet[0]['store_id']; ?>"
                    target="_blank">
                    <i class="fa-solid fa-file-pdf"
                        style="font-size: 50px;"></i>
                </a>

            </div>
        </div>

    </div>
</a> -->

</div>




</div>



<div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                <iframe id="table_iframes" height="600px" width="100%"></iframe>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>