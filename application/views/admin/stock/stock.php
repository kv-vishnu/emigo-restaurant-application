<!-- header section -->
		<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Stock</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Stock</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          
          
          
          
          <!--modal for delete confirmation-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><?php echo confirm; ?></h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="stock_id" value=""/>
                               <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_stock" type="button" data-bs-dismiss="modal">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->
          
          
          
          
          
          <div class="container-fluid dashboard-default">
           
           
           
           
           
           
            <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success dark" role="alert">
                        <?php echo $this->session->flashdata('success');$this->session->unset_userdata('success'); ?>
                    </div><?php } ?>
                    
                    <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger dark" role="alert">
                        <?php echo $this->session->flashdata('error');$this->session->unset_userdata('error'); ?>
                    </div><?php } ?>
                    
           <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-4">
                <div class="card">
                    
                  <div class="card-header pb-0">
                      
                    
                    
                    
                    
                    
                    
                    
                    
                     <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                  
                <?php 
                if(isset($StockDet[0]['id'])) {
                    $path=base_url().'stock/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'stock/add';
                    $button_text='Add new stock';
                    $button_name='add';
                }?>
                        
                  <form class="" method="post" action="<?php echo $path;?>">
                      <input type="hidden" name="id" value="<?php  if(isset($StockDet[0]['id'])){echo $StockDet[0]['id'];}?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Consumable</label>
                            <select class="form-control btn-square" name="consumable">
                            <option value="">Select Consumables</option>
                            <?php
                            foreach($consumables as $cons)
                            {
                            ?>
                            <option value="<?=$cons['id'];?>" <?php if(isset($StockDet[0]['consumable_id']) && $StockDet[0]['consumable_id']==$cons['id']){echo 'selected'; }else{ echo set_select('consumable', $cons['id']); } ?>><?=$cons['name'];?></option>
                            <?php
                            }
                            ?>
                           </select>

                          </div>
                          <?php if(form_error('consumable')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('consumable'); ?></div>
                  <?php } ?>
                        </div>
                        
                        
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="<?php if(isset($StockDet[0]['qty'])){echo $StockDet[0]['qty']; }else{ echo set_value('quantity'); } ?>">
                            <?php if(form_error('quantity')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('quantity'); ?></div>
                  <?php } ?>
                        </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="mb-3">
                            <label>Stock added date</label>
                            <input class="datepicker-here form-control" type="text" data-language="en" name="stock_add_date" value="<?php if(isset($StockDet[0]['stock_add_date'])){echo $StockDet[0]['stock_add_date']; }else{  echo set_value('stock_add_date');}?>">
                          </div>
                        </div>
                        <?php
                        if(isset($StockDet[0]['id'])) {
                          ?>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Is Active</label>
                            <select class="form-control btn-square" name="status">
                              <option value="">Select Status</option>
						<option value="1" <?php if(isset($StockDet[0]['is_active']) && $StockDet[0]['is_active']=='1'){echo 'selected'; }else{ echo set_select('status', '1'); } ?>>Yes</option>
						<option value="0" <?php if(isset($StockDet[0]['is_active']) && $StockDet[0]['is_active']=='0'){echo 'selected'; }else{ echo set_select('status', '0'); }?>>No</option>
                            </select>
                          </div>
                          <?php if(form_error('status')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('status'); ?></div>
                  <?php } ?>
                        </div>
                         <?php
                          }
                          ?>
                       <div class="col-md-12">
                          <div class="">
                          <?php if($this->Rolemodel->check_permission(55,$this->session->userdata('roleid'),'can_add') == 1){ ?>
                              <button class="btn btn-primary mb-3 pull-right" type="submit" name="<?php echo $button_name; ?>" value="add"><?php echo $button_text; ?></button>
                            <?php } ?>
                            </div>
                    </div>
                      </div>
                    </div>
                    <div class="mb-3 text-end">
                      
                    </div>
                  </form>
               
              <!-- Zero Configuration  Ends-->
              
              
              
                    
                    
                    
    
                  </div>
                
                  
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
              
              
            <div class="col-sm-8">
                <div class="card">
                    
                  <div class="card-header pb-0">
                    <div class="">
                    <div class="table-responsive theme-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                        <th>No</th>
                           <th>Consumable</th>
                           <th>Quantity</th>
                           <th>Stock added date</th>

                            <!--<th>Is Active</th>-->
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                       if(!empty($stock)){
                       $count = 1;
                       foreach($stock as $val){ ?>
                       
                       <tr>
                           
                            <form action="" method="post">  
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo $val['qty'];?></td>
                            <td><?php echo date('d-M-y',strtotime($val['stock_add_date']));?></td>

                            <!--<td><?php if($val['is_active'] == 1) { echo "Yes"; }?></td>-->
                            </form>
                            <td> 
                              <ul class="action pull-right">
                               
                              <?php if($this->Rolemodel->check_permission(55,$this->session->userdata('roleid'),'can_edit') == 1){ ?>
                                <li class="delete">
                                    <form action="<?php echo base_url();?>stock/edit" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['id']; ?>"> 
                                        <button class="edit_role" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['id']; ?>" data-bs-original-title="Edit Stock"><i class="fa fa-edit"></i></button>
                                    </form>
                                </li>
                                <?php } ?>

                                <?php if($this->Rolemodel->check_permission(55,$this->session->userdata('roleid'),'can_delete') == 1){ ?>
                                <li class="edit">
                                    <form action="<?php echo base_url();?>stock/delete" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['id']; ?>"> 
                                        <button class="del_stock" type="button" data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>" data-bs-original-title="Delete Stock" data-bs-target="#exampleModal"><i class="fa fa-close"></i></button>
                                    </form>
                                </li>
                                <?php } ?>
                                
                              </ul>
                            </td>
                            
                          </tr>
                          
                       <?php $count++; }} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div></div></div>


                <div class="col-sm-12">
                <div class="card">
                    
                  <div class="card-header pb-0">
                    <div class="">
                    <h3>Available Stock</h3>

                    <div class="table-responsive theme-scrollbar">
                      <table class="display" id="basic-2">
                        <thead>
                          <tr>
                        <th>No</th>
                           <th>Consumable</th>
                           <th>Quantity</th>

                            <!--<th>Is Active</th>-->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                       if(!empty($available)){
                       $count = 1;
                       foreach($available as $val){ ?>
                       
                       <tr>
                           
                            <form action="" method="post">  
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo $val['qtysum'];?></td>

                            </form>

                          </tr>
                          
                       <?php $count++; }} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div></div></div>


            </div>
            
           
            
            
            
            
            
          </div>
          <!-- Container-fluid Ends-->
        </div>
        
        <!-- footer section -->
        <script src="<?php echo base_url();?>assets/js/deem/consumables/consumables.js"></script>
