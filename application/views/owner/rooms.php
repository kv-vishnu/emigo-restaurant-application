<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="container">
    <div class="page-content p-2">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo">
                        <?php if ($role_id == 1) { ?>
                        <a href="<?php echo base_url('admin/store/all'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png" alt="Back"
                                class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>
                        <?php } elseif ($role_id == 2) { ?>
                        <a href="<?php echo base_url('owner/settings'); ?>" class="add-new-dish-btn btn1">
                            <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png" alt="Back"
                                class="add-new-dish__icon" width="23" height="23">
                            Back
                        </a>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="bg-light rounded shadow-sm mb-3 p-3 border mt-3">
                <form class="row mt-0 mb-0" action="" id="addroomsform" method="post">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Select Room</label>
                        <div class="input-group">
                            <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
                            <select class="form-select" name="roomselect">
                                <option value="" selected>Select Room Count</option>
                                <option value="1">1</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>

                        </div>
                        <span class="error errormsg mt-2" id="roomselect_error"></span>
                    </div>


                    <div class="col-md-4">
                        <button class="btn btn1 mt-4" type="button" id="addrooms">Add</button>
                    </div>
                </form>
            </div>


        </div>







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
                <table id="example" class="table table-striped">
                    <thead style="background: #e5e5e5;">
                        <tr>
                            <th>No</th>
                            <th>Room Name</th>
                            <th>Name</th>
                            <!-- <th>Image</th> -->
                            <!-- <th>Order</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                       if(!empty($rooms)){
                       $count = 1;
                       foreach($rooms as $val){ ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td data-field="table_name"><?php echo $val['table_name'];?></td>
                            <td><input type="text" class="form-control editable_room w-50"
                                    value="<?php echo $val['store_table_name'];?>" readonly
                                    data-id="<?php echo $val['table_id']; ?>" data-field="store_table_name"></td>
                            <td class="pb-0 pt-0 d-flex">

                                <input type="hidden" name="id" value="<?php echo $val['table_id']; ?>">
                                <button class="btn tblEditBtn edit_rooms pl-0 pr-0" type="submit"
                                    data-id="<?php echo $val['table_id']; ?>" data-bs-original-title="Edit Rooms"><i
                                        class="fa fa-edit"></i></button>


                                <a class="btn tblDelBtn pl-0 pr-0 del_room" type="button" data-bs-toggle="modal"
                                    data-id="<?php echo $val['table_id']; ?>" data-bs-original-title="Delete Category"
                                    data-bs-target="#delete-room"><i class="fa fa-trash"></i></a>


                                <?php if($val['store_table_token'] == ''){ ?>

                                <a target="_blank" class="btn tblQrcodeBtn btn-btn-secondary pl-0 pr-0 qr-code "
                                    type="button" data-bs-toggle="tooltip" data-id="<?php echo $val['table_id']; ?>"
                                    data-store-id="<?php echo $val['store_id']; ?>"
                                    store-name="<?php echo $store_name; ?>"
                                    data-bs-original-title="Download <?php echo $val['table_name']; ?> QR Code"><i
                                        class="fa-solid fa-upload"></i></a>
                                <!-- <form class="m-0 d-flex" action="<?php echo base_url();?>admin/qrcodes/generateRoomQRCode" method="post">
                        <input type="hidden" name="table_id_hidden" value="<?php echo $val['table_id']; ?>">
                        <input type="hidden" name="store_name_hidden" value="<?php echo $store_name; ?>">
                        <input type="hidden" name="store_id" value="<?php echo $val['store_id']; ?>">
                    <button type="submit" class="btn tblLogBtn pl-0 pr-0" type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Generate <?php echo $val['table_name']; ?> QR Code"><i class="fa-solid fa-upload"></i></button>
                    </form> -->
                                <?php }
                    else{ ?>
                                <a target="_blank" href="<?php echo $val['qr_code']; ?>"
                                    class="btn tblEditBtn pl-0 pr-0 download-btn" type="button" data-bs-toggle="tooltip"
                                    data-id="<?php echo $val['table_id']; ?>"
                                    data-bs-original-title="Download <?php echo $val['table_name']; ?> QR Code"><i
                                        class="fa fa-download"></i></a>
                                <?php }
                    ?>
                            </td>
                        </tr>
                        <?php $count++; }} ?>

                    </tbody>
                </table>
            </div>
        </div>











        <!--modal for delete confirmation-->
        <div class="modal fade" id="delete-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h1>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="room_id" value="" />
                        <?php echo are_you_sure; ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                        <button class="btn btn-secondary" id="yes_del_room" type="button"
                            data-bs-dismiss="modal">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--modal for delete confirmation-->







    </div>
</div>

<!-- qr code end -->


<!-- success modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel"></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
<!-- success modal -->