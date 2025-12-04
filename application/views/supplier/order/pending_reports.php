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


    <input type="hidden" id="store_id" value="<?php echo $store_id;?>">

    <div class="mt-5">
        <div class="table-responsive-sm">



            <form class="row g-3">
                <!-- Product ID Field -->
                <div class="col-md-3 d-none">
                    <label for="productId" class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="productId" name="productId"
                        placeholder="Enter Product ID">
                </div>

                <!-- Select Room  -->


                <div class="col-md-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="order-date" name="date"
                        value="<?php echo date('Y-m-d');?>">
                </div>

                <div class="col-md-3">
                    <label for="roomId" class="form-label">Order Type</label>

                    <select name="" id="" class="form-select">
                        <option value="Order Type">Select Order Type</option>
                        <option value="all">All</option>
                        <option value="Room">Room </option>
                        <option value="Dining">Dining</option>
                        <option value="Delivery">Delivery</option>
                        <option value="Pickup">Pickup</option>
                    </select>
                </div>

                <!-- Select Room Name  -->


                <div class="col-md-3">
                    <label for="roomId" class="form-label"> Service Name</label>

                    <select name="" id="" class="form-select">
                        <option value="Select Service">Select Service</option>
                        <option value="all">All</option>
                        <option value="Room 1">Room 1 </option>
                        <option value="Room 2">Room 2</option>
                        <option value="Room 3">Room 3</option>
                        <option value="Room 4">Room 4</option>
                    </select>
                </div>


                <!-- Date Field -->



                <!-- Select Status  -->


                <div class="col-md-3">
                    <label for="roomId" class="form-label">Status</label>

                    <select name="" id="" class="form-select">
                        <option value="Select Status">Select Status</option>
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>

                    </select>
                </div>



            </form>


            <table class="table">
                <tbody>


                    <tr>
                        <td colspan="4" class="text-center select-criteria">Please
                            Select Search
                            Criteria.</td>
                    </tr>


                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order Type</th>
                                <th>Service Name</th>
                                <th>Order Amount</th>
                                <th>Payment Status</th>

                            </tr>
                        </thead>

                        <!--   Row 1  -->
                        <tr data-bs-toggle="modal" data-bs-target="#pending1Modal">
                            <td><?php echo date('Y-m-d');?></td>
                            <td>Room</td>
                            <td>Room 1</td>
                            <td>Rs 1500</td>
                            <td><span class="badge bg-success" style="color: #ffff; padding: 10px;">Paid</span></td>

                        </tr>



                        <!--   Row 2  -->
                        <tr data-bs-toggle="modal" data-bs-target="#pending2Modal">
                            <td><?php echo date('Y-m-d');?></td>
                            <td>Dining</td>
                            <td>Table 1</td>
                            <td>Rs 1700</td>
                            <td><span class="badge bg-danger" style="color: #ffff; padding: 10px;">UnPaid</span>
                            </td>


                        </tr>



                        <!--   Row 3  -->
                        <tr data-bs-toggle="modal" data-bs-target="#pending3Modal">
                            <td><?php echo date('Y-m-d');?></td>
                            <td>Pickup</td>
                            <td>Pickup</td>
                            <td>Rs 1900</td>
                            <td><span class="badge bg-success" style="color: #ffff; padding: 10px;">Paid</span></td>

                        </tr>



                    </table>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success btn-lg fs-6 mx-1 fw-bold">Paid : 2550</button>
                        <button class="btn btn-danger btn-lg fs-6 mx-2 fw-bold">Unpaid : 2550</button>
                        <button class="btn btn-primary btn-lg fs-6 fw-bold">Total Amount : 5100</button>
                    </div>
                </tbody>
            </table>

            <!-- <div id="reportContainer"></div> -->











        </div>
    </div>
</div>





<!-- Modal Row 1 -->
<div class="modal fade" id="pending1Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Order Details</h4>
                <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



            </div>

            <div class="row" style="padding:1rem;">
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Id</p>
                    <span class="order-items_popup">#123456789</span>
                </div>
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Time</p>
                    <span class="order-items_popup">
                        28 Dec 2024 11:07 pm
                    </span>
                </div>

                <div class="col-md-4">
                    <p class="modal-title fw-bold">Delivery Boy
                    </p>
                    <span class="order-items_popup">
                        Alan
                    </span>
                </div>


            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Amount</th>

                        </tr>
                    </thead>

                    <!--   Row 1  -->
                    <tr>
                        <td>Chicken Mandhi</td>
                        <td>1</td>
                        <td>500</td>
                        <td>500</td>
                    </tr>


                    <tr>
                        <td>Mutton Mandhi</td>
                        <td>1</td>
                        <td>500</td>
                        <td>500</td>
                    </tr>


                    <tr>
                        <td>Beef Mandhi</td>
                        <td>1</td>
                        <td>500</td>
                        <td>500</td>
                    </tr>








                </table>

                <div class="d-flex justify-content-end">

                    <button class="btn btn-primary btn-lg fs-6 fw-bold">Total Amount : 1500</button>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Modal Row 2 -->
<div class="modal fade" id="pending2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Order Details</h4>
                <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



            </div>

            <div class="row" style="padding:1rem;">
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Id</p>
                    <span class="order-items_popup">#1234567889</span>
                </div>
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Time</p>
                    <span class="order-items_popup">
                        29 Dec 2024 12:07 pm
                    </span>
                </div>

                <div class="col-md-4">
                    <p class="modal-title fw-bold">Delivery Boy
                    </p>
                    <span class="order-items_popup">
                        Arjun
                    </span>
                </div>


            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Amount</th>

                        </tr>
                    </thead>

                    <!--   Row 1  -->
                    <tr>
                        <td>Chicken Madfoon</td>
                        <td>1</td>
                        <td>700</td>
                        <td>700</td>
                    </tr>


                    <tr>
                        <td>Mutton Madfoon</td>
                        <td>1</td>
                        <td>500</td>
                        <td>500</td>
                    </tr>


                    <tr>
                        <td>Beef Madfoon</td>
                        <td>1</td>
                        <td>500</td>
                        <td>500</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end">

                    <button class="btn btn-primary btn-lg fs-6 fw-bold">Total Amount : 1700</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal Row 3 -->

<div class="modal fade" id="pending3Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Order Details</h4>
                <button type=" button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



            </div>

            <div class="row" style="padding:1rem;">
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Id</p>
                    <span class="order-items_popup">#1234567789</span>
                </div>
                <div class="col-md-4">
                    <p class="modal-title fw-bold">Order Time</p>
                    <span class="order-items_popup">
                        30 Dec 2024 13:07 pm
                    </span>
                </div>

                <div class="col-md-4">
                    <p class="modal-title fw-bold">Delivery Boy
                    </p>
                    <span class="order-items_popup">
                        Vishnu
                    </span>
                </div>


            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Amount</th>

                        </tr>
                    </thead>

                    <!--   Row 1  -->
                    <tr>
                        <td>Chicken Mazbi</td>
                        <td>1</td>
                        <td>450</td>
                        <td>450</td>
                    </tr>


                    <tr>
                        <td>Mutton Mazbi</td>
                        <td>1</td>
                        <td>450</td>
                        <td>450</td>
                    </tr>


                    <tr>
                        <td>Beef Mazbi</td>
                        <td>1</td>
                        <td>450</td>
                        <td>450</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end">

                    <button class="btn btn-primary btn-lg fs-6 fw-bold">Total Amount : 1900</button>
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
                <button class=" btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/metismenu.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/feather.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
</script>

<!-- <script>
$(document).ready(function() {
    // Get current date in YYYY-MM-DD format
    const store_id = $('#store_id').val();
    const currentDate = new Date().toISOString().split('T')[0];
    $('#order-date').val(currentDate);


    // Function to fetch orders based on date
    function fetchDeliveryReport() {
        $.ajax({
            url: '<?= base_url("owner/order/getDeliveryReportByStoreId"); ?>',
            method: 'POST',
            data: {
                store_id: store_id,
                date: $('#order-date').val()
            },
            dataType: 'html',
            success: function(response) {
                console.log(response);
                $('#reportContainer').html(response);
            }
        });
    }

    fetchDeliveryReport();

    $('#order-date').on('change', function() {
        const selectedDate = $(this).val();
        fetchDeliveryReport(selectedDate);
    });

});
</script> -->