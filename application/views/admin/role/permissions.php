<!-- header section -->
		<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Assign Permission</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Permission</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default1">
           
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
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h4>Assign permissions - <?php if(isset($roleDet[0]['rolename'])){ echo $roleDet[0]['rolename']; } ?></h4>
                  </div>
                  <div class="card-body animate-chk">
                    
                  <!-- table start -->
                  <form method="post" action="<?php echo base_url()?>role/permission">
                  <input type="hidden" name="length_module" value="<?php echo count($modules); ?>">
                  <input type="hidden" name="roleid" value="<?php if(isset($roleid)){echo $roleid; }?>">
  <table class="table table-bordered permission_table">
  <thead>
                      <tr>
                        <th>Module</th>
                        <th>View</th>
                        <th>Add</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Approve</th>
                      </tr>
                    </thead>
                <?php if(empty($permissions)){
                  if(!empty($modules)){ foreach($modules as $key => $val){ ?>
                    <input type="hidden" name="modulename<?php echo $key; ?>" value="<?php echo $val['moduleid']; ?>">
                        <tr>
                          <td><?php echo $val['modulename']; ?></td>
                          <td><?php if($val['enable_view'] == 1){ ?> <input type="checkbox" value="1" name="checkbox_row_v<?php echo $key; ?>"> <?php } ?></td>
                          <td><?php if($val['enable_add'] == 1){ ?> <input type="checkbox" value="1" name="checkbox_row_a<?php echo $key; ?>"> <?php } ?></td>
                          <td><?php if($val['enable_edit'] == 1){ ?> <input type="checkbox" value="1" name="checkbox_row_e<?php echo $key; ?>"> <?php } ?></td>
                          <td><?php if($val['enable_delete'] == 1){ ?> <input type="checkbox" value="1" name="checkbox_row_d<?php echo $key; ?>"> <?php } ?></td>
                          <td><?php if($val['enable_approve'] == 1){ ?> <input type="checkbox" value="1" name="checkbox_row_ap<?php echo $key; ?>"> <?php } ?></td>
                        </tr>
                  <?php }}}else{
                    //print_r($permissions);
                     if(!empty($modules)){ foreach($modules as $key => $val){
                      //print_r($modules);
                     $permission=$this->Rolemodel->getPermissions($val['moduleid'],$roleid);//print_r($permission);
                      ?>
                    <input type="hidden" name="modulename<?php echo $key; ?>" value="<?php echo $val['moduleid']; ?>">
                    <tr>
                      <td><?php echo $val['modulename']; ?></td>
                      <td><?php if($val['enable_view'] == 1){ ?><input type="checkbox" value="1" name="checkbox_row_v<?php echo $key; ?>" <?php if(isset($permission[0]) && $permission[0]['can_view'] == 1){ echo "checked"; }?>><?php } ?></td>
                      <td><?php if($val['enable_add'] == 1){ ?><input type="checkbox" value="1" name="checkbox_row_a<?php echo $key; ?>" <?php if(isset($permission[0]) && $permission[0]['can_add'] == 1){ echo "checked"; }?>><?php } ?></td>
                      <td><?php if($val['enable_edit'] == 1){ ?><input type="checkbox" value="1" name="checkbox_row_e<?php echo $key; ?>" <?php if(isset($permission[0]) && $permission[0]['can_edit'] == 1){ echo "checked"; }?>><?php } ?></td>
                      <td><?php if($val['enable_delete'] == 1){ ?><input type="checkbox" value="1" name="checkbox_row_d<?php echo $key; ?>" <?php if(isset($permission[0]) && $permission[0]['can_delete'] == 1){ echo "checked"; }?>><?php } ?></td>
                      <td><?php if($val['enable_approve'] == 1){ ?><input type="checkbox" value="1" name="checkbox_row_ap<?php echo $key; ?>" <?php if(isset($permission[0]) && $permission[0]['can_approve'] == 1){ echo "checked"; }?>><?php } ?></td>
                    </tr>
                 <?php }}}?>
                
                 
  </table>
  <div class="col-12 mt-3">
    <a href="<?php echo base_url()?>role" class="btn btn-primary pull-left" >Back</a>
    <button class="btn btn-primary pull-right" type="submit" name="assign" data-bs-original-title="" title="">Save</button>
  </div>
</form>
                  <!-- table end -->
                  
                  
                  
                  
                  
                  
                  
                  
                  
                 
                  </div>
                </div>
              </div>
              
              
              <!-- Zero Configuration  Ends-->
              
              
           
            </div>
            
            
            
            
            
            
            
          </div>
          <!-- Container-fluid Ends-->
        </div>
        
        <!-- footer section -->