
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">QR Codes</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">QR Codes</li>
                                    </ol>
                                </div>
                               
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



                            <a class="btn btn-primary mb-2 f-right" href="<?php echo base_url(); ?>admin/store/add" role="button"><i class="fa fa-plus"></i> Add Store</a>



                            <table id="example" class="table table-striped" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Store</th>
            <th>Pickup Number</th>
            <th>Dining Number</th>
            <th>Delivery Number</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($stores)) { 
        $count = 1;
        foreach ($stores as $val) { ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $val['store_name']; ?></td>
            
            <!-- Pickup Number -->
            <td>
                <div class="d-flex align-items-center">
                    <a href="<?php echo base_url(); ?>admin/qrcodes/download_vcf/<?php echo $val['pickup_number']; ?>"><span><?php echo $val['pickup_number']; ?></span></a>
                    <?php if ($val['pickup_number'] != '') { ?>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generatePickupNumber" method="post">
                            <input type="hidden" name="pickup_number_hidden" value="<?php echo $val['pickup_number']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Get Pickup Number">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generatePickupQrCode1" method="post">
                            <input type="hidden" name="store_id_hidden" value="<?php echo $val['store_id']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Download Pickup QR CODE">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </td>

            <!-- Dining Number -->
            <td>
                <div class="d-flex align-items-center">
                    <span><?php echo $val['dining_number']; ?></span>
                    <?php if ($val['dining_number'] != '') { ?>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generateDiningNumber" method="post">
                            <input type="hidden" name="dining_number_hidden" value="<?php echo $val['dining_number']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Get Dining Number">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                        
                    <?php } ?>
                </div>
            </td>

            <!-- Delivery Number -->
            <td>
                <div class="d-flex align-items-center">
                    <span><?php echo $val['delivery_number']; ?></span>
                    <?php if ($val['delivery_number'] != '') { ?>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryNumber" method="post">
                            <input type="hidden" name="delivery_number_hidden" value="<?php echo $val['delivery_number']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Get Delivery Number">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generateDeliveryQRCode1" method="post">
                        <input type="hidden" name="store_id_hidden" value="<?php echo $val['store_id']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Download Delivery QR CODE">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </td>

            <!-- Location -->
            <td>
                <div class="d-flex align-items-center">
                    <span><?php echo $val['store_location']; ?></span>
                    <?php if ($val['store_location'] != '') { ?>
                        <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/generateLocationQRCode" method="post">
                            <input type="hidden" name="location_hidden" value="<?php echo $val['store_location']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="Get Location">
                                <i class="fa-solid fa-download ml-5"></i>
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </td>

            <td><?php echo ($val['is_active'] == 1) ? '<span class="badge-success">Active</span>' : '<span class="badge-danger">Inactive</span>'; ?></td>
            <td class="pb-0 pt-0 d-flex icon-cell">
                <form class="m-0" action="<?php echo base_url(); ?>admin/qrcodes/pdf" method="post">
                            <input type="hidden" name="store_id_hidden" value="<?php echo $val['store_id']; ?>">
                            <button type="submit" class="btn tblLogBtn pl-0 pr-0" data-toggle="tooltip" title="PDF">
                                <i class="fa-solid fa-file-pdf ml-5"></i>
                            </button>
                        </form>
                <a class="store_table btn tblLogBtn pl-0 pr-0" id="" data-id="<?php echo $val['store_id']; ?>" data-name="<?php echo $val['store_name']; ?>" data-bs-toggle="modal" data-bs-target="#emp_informations" class="btn tblLogBtn pl-0 pr-0" title="Tables">
                    <i class="fa-solid fa-circle-plus"></i>
                </a>
            </td>
        </tr>
    <?php $count++; } } ?>
</tbody>

        <tfoot>
            <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
        </tfoot>
    </table>








                               
                               
                                
                            </div>
                        </div>
                    </div>



<!-- Modal for detailed view -->
                    <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modal_title_table"></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                <iframe id="table_iframe" height="600px" width="100%"></iframe>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end -->



                           <!--modal for delete confirmation-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="store_id" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_store" type="button" data-bs-dismiss="modal">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->





            </div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>

            <script>
                $(document).ready(function() {
                    $('.store_table').click(function() {
                        var storeId = $(this).attr('data-id');
                        var storeName = $(this).attr('data-name');
                        document.getElementById('modal_title_table').innerHTML = storeName + ' - Tables';
                        document.getElementById('table_iframe').src = '<?php echo base_url('admin/table/load_store_tables_iframe/'); ?>' + storeId;
                    });
                } );
            </script>
            