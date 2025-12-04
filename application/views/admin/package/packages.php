
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Packages</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">Packages</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                    <!-- Displaying Date and Time -->
                    <!-- <?php $time=strtotime(date("Y/m/d"));
 $month=date("F",$time);
 $year=date("Y",$time);
 $date=date("d",$time);  ?>
                          <h2 class="f-w-400"> <span><?php echo $month; ?> <?php echo $date; ?> <?php echo $year; ?><sup><i class="fa fa-circle-o f-10"></i></sup></span></h2> -->
                    <!-- Displaying Date and Time -->
                    <?php 
                if(isset($packageDet[0]['package_id'])) {
                    $path=base_url().'admin/package/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'admin/package/add';
                    $button_text='Save';
                    $button_name='add';
                }?>
                
                    <form method="post" action="<?php echo $path; ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php  if(isset($packageDet[0]['package_id'])){echo $packageDet[0]['package_id'];}?>">
                    <div class="row bg-soft-light mb-3 border1 pt-2">

                       <div class="col-md-3">
                           <div class="mb-2 focus">
                               <label class="form-label" for="default-input">Package Name</label>
                               <input class="form-control" value="<?php if(isset($packageDet[0]['name'])){echo $packageDet[0]['name']; }else{ echo set_value('package_name'); } ?>" type="text" name="package_name">
                               <?php if(form_error('package_name')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('package_name'); ?></div>
      <?php } ?>
                           </div>
                       </div>

                       <div class="col-md-3">
                           <div class="mb-2 focus">
                               <label class="form-label" for="default-input">Quantity</label>
                               <input class="form-control" value="<?php if(isset($packageDet[0]['no_of_quantity'])){echo $packageDet[0]['no_of_quantity']; }else{ echo set_value('qty'); } ?>" type="text" name="qty">
                               <?php if(form_error('qty')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('qty'); ?></div>
      <?php } ?>
                           </div>
                       </div>

                       <div class="col-md-3">
                           <div class="mb-2 focus">
                               <label class="form-label" for="default-input">Remarks</label>
                               <input class="form-control" value="<?php if(isset($packageDet[0]['remarks'])){echo $packageDet[0]['remarks']; }else{ echo set_value('remarks'); } ?>" type="text" name="remarks">
                               <?php if(form_error('remarks')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('remarks'); ?></div>
      <?php } ?>
                           </div>
                       </div>


                       
                       <div class="col-md-3">
                           <div class="mb-4">
                               <label class="form-label" for="default-input">&nbsp;</label><br>
                               <button class="btn btn-success w-md" type="submit" name="<?php echo $button_name; ?>"><?php echo $button_text; ?></button>
                           </div>
                       </div>
                       
</form>
                   
                   <!-- Section 2 -->
   
               
               
                   
               
               
               </div>

                



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



                            <table id="example" class="table table-striped" style="width:100%">
        <thead style="background: #e5e5e5;">
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
                       if(!empty($packages)){
                       $count = 1;
                       foreach($packages as $val){ ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $val['name'];?></td>
               
                <td class="pb-0 pt-0 d-flex">
                    <!-- <form class="m-0" action="<?php echo base_url();?>admin/package/edit" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['package_id']; ?>"> 
                                        <button class="btn tblEditBtn pl-0 pr-0" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['package_id']; ?>" data-bs-original-title="Edit package"><i class="fa fa-edit"></i></button>
                    </form> -->
                    
                    <a class="btn tblDelBtn pl-0 pr-0 del_package" type="button" data-bs-toggle="modal" data-id="<?php echo $val['package_id']; ?>" data-bs-original-title="Delete package" data-bs-target="#exampleModal"><i class="fa fa-trash"></i></a>
                    

                    </td>
            </tr>
            <?php $count++; }} ?>

           
            
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
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="emp-informations.html" style="width: 100%; height: 500px;"></iframe>
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
                                <input type="hidden" name="id" id="package_id1" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_package" type="button" data-bs-dismiss="modal">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->





            </div>

            <script src="<?php echo base_url();?>assets/admin/js/modules/store.js"></script>