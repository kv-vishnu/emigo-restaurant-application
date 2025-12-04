<!-- header section -->
		<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Add Role</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Add Role</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default">
           
           
           
           
           
           
           
           <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="col-xl-12 col-lg-12">
                  <form class="card" method="post" action="<?php echo base_url(); ?>admin/role/add">
                    <div class="card-header pb-0">
                      <!--<h4 class="card-title mb-0">Edit Profile</h4>-->
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Role</label>
                            <input class="form-control" value="<?php echo set_value('role');?>" type="text" name="role">
                          </div>
                        </div>
                        <?php if(form_error('role')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('role'); ?></div>
                  <?php } ?>
                        
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Description</label>
                            <textarea class="form-control" type="text" name="desc"><?php echo set_value('desc');?></textarea>
                          </div>
                        </div>
                        
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label f-w-500">Is Active</label>
                            <select class="form-control btn-square" name="status">
                              <option value="">Select Status</option>
						<option value="1" <?php if(isset($clientDet[0]['is_active']) && $clientDet[0]['is_active']=='1'){echo 'selected'; }else{ echo set_select('status', '1'); } ?>>Yes</option>
						<option value="0" <?php if(isset($clientDet[0]['is_active']) && $clientDet[0]['is_active']=='0'){echo 'selected'; }else{ echo set_select('status', '0'); }?>>No</option>
                            </select>
                          </div>
                        </div>
                         <?php if(form_error('status')){ ?>
<div class="errormsg" role="alert"><?php echo form_error('status'); ?></div>
                  <?php } ?>
                       
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit" name="add" value="add">Save</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
              
              
           
            </div>
            
            
            
            
            
            
            
          </div>
          <!-- Container-fluid Ends-->
        </div>
        
        <!-- footer section -->