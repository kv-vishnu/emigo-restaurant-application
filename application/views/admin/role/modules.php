<!-- header section -->
		<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Modules</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Modules</li>
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
                                <input type="hidden" name="id" id="module_id" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_module" type="button" data-bs-dismiss="modal">Yes</button>
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
                if(isset($moduleDet[0]['moduleid'])) {
                    $path=base_url().'module/edit';
                    $button_text='Update';
                    $button_name='edit';
                }else{
                    $path= base_url().'module/add';
                    $button_text='Add new module';
                    $button_name='add';
                }?>
                        
                  <form class="" method="post" action="<?php echo $path;?>">
                      <input type="hidden" name="moduleid" value="<?php  if(isset($moduleDet[0]['moduleid'])){echo $moduleDet[0]['moduleid'];}?>">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Module name</label>
                            <input class="form-control" value="<?php if(isset($moduleDet[0]['modulename'])){echo $moduleDet[0]['modulename']; }else{ echo set_value('modulename'); } ?>" type="text" name="modulename">
                          </div>
                          <?php if(form_error('modulename')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('modulename'); ?></div>
                  <?php } ?>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Module code</label>
                            <input class="form-control" value="<?php if(isset($moduleDet[0]['modulecode'])){echo $moduleDet[0]['modulecode']; }else{ echo set_value('modulecode'); } ?>" type="text" name="modulecode">
                          </div>
                          <?php if(form_error('modulecode')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('modulecode'); ?></div>
                  <?php } ?>
                        </div>
                        
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Icon</label>
                            <input class="form-control" value="<?php if(isset($moduleDet[0]['icon'])){echo $moduleDet[0]['icon']; }else{ echo set_value('icon'); } ?>" type="text" name="icon">
                          </div>
                          
                        </div>
                        
                       <?php if(isset($moduleDet[0]['moduleid'])) { ?>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Is Active</label>
                            <select class="form-control btn-square" name="status">
                              <option value="">Select Status</option>
						<option value="1" <?php if(isset($moduleDet[0]['is_active']) && $moduleDet[0]['is_active']=='1'){echo 'selected'; }else{ echo set_select('status', '1'); } ?>>Yes</option>
						<option value="0" <?php if(isset($moduleDet[0]['is_active']) && $moduleDet[0]['is_active']=='0'){echo 'selected'; }else{ echo set_select('status', '0'); }?>>No</option>
                            </select>
                          </div>
                          <?php if(form_error('status')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('status'); ?></div>
                  <?php } ?>
                        </div>
                         <?php } ?>
                         
                       <div class="col-md-12">
                          <div class="">
                              <button class="btn btn-primary mb-3 pull-right" type="submit" name="<?php echo $button_name; ?>" value="add"><?php echo $button_text; ?></button>
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
                           <th>Module</th>
                            <th>Code</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                       if(!empty($module)){
                       $count = 1;
                       foreach($module as $val){ ?>
                       
                       <tr>
                           
                             
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['modulename'];?></td>
                            <td><?php echo $val['modulecode'];?></td>
                            
                            <td> 
                              <ul class="action pull-right">
                                 
                                <li class="delete">
                                    <form action="<?php echo base_url();?>module/edit" method="post">
                                      <input type="hidden" name="moduleid" value="<?php echo $val['moduleid']; ?>"> 
                                        <button class="" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['moduleid']; ?>" data-bs-original-title="Edit Module"><i class="fa fa-edit"></i></button>
                                    </form>
                                </li>
                                <li class="edit">
                                    <form action="<?php echo base_url();?>module/delete" method="post">
                                      <input type="hidden" name="moduleid" value="<?php echo $val['moduleid']; ?>"> 
                                        <button class="del_module" type="button" data-bs-toggle="modal" data-id="<?php echo $val['moduleid']; ?>" data-bs-original-title="Delete Module" data-bs-target="#exampleModal"><i class="fa fa-close"></i></button>
                                    </form>
                                </li>
                              </ul>
                            </td>
                            
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
        <script src="<?php echo base_url();?>assets/js/deem/role/role.js"></script>
