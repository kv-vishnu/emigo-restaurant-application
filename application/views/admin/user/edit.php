
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">User</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">User</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                   

                
                
                  <div class="row">
                        
                  <?php if(isset($userDet[0]['userid'])) {
            //print_r($userDet);exit;
            ?>
                  <form method="post" action="<?php echo base_url(); ?>admin/user/edit" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php  if(isset($userDet[0]['userid'])){echo $userDet[0]['userid'];}?>">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="true">User</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
    </li>
    <!-- <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li> -->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
      <div class="row">
        






     
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">





     
  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
    <input class="form-control" value="<?php if(set_value('name')){echo set_value('name');}else if(isset($userDet[0]['Name'])){echo $userDet[0]['Name'];}?>" type="text" name="name">
    <?php if(form_error('name')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('name'); ?></div>
      <?php } ?>
    </div>
    
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <input class="form-control" value="<?php if(set_value('email')){echo set_value('email');}else if(isset($userDet[0]['userEmail'])){echo $userDet[0]['userEmail'];}?>" type="text" name="email">
    <?php if(form_error('email')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('email'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-10">
    <input class="form-control" value="<?php if(set_value('phone')){echo set_value('phone');}else if(isset($userDet[0]['UserPhoneNumber'])){echo $userDet[0]['UserPhoneNumber'];}?>" type="text" name="phone">
    <?php if(form_error('phone')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('phone'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10 mb-2">
    <textarea name="address" class="form-control" id="exampleFormControlTextarea4" rows="3"><?php if(set_value('address')){echo set_value('address');}else if(isset($userDet[0]['userAddress'])){echo $userDet[0]['userAddress'];}?></textarea>
    <?php if(form_error('address')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('address'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
    <input class="form-control" value="<?php if(set_value('username')){echo set_value('username');}else if(isset($userDet[0]['userName'])){echo $userDet[0]['userName'];}?>" type="text" name="username">
    <?php if(form_error('username')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('username'); ?></div>
      <?php } ?>
    </div>
  </div>

  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
    <input class="form-control" value="<?php if(set_value('password')){echo set_value('password');}else if(isset($userDet[0]['userPassword'])){echo $userDet[0]['userPassword'];}?>" type="password" name="password">
    <?php if(form_error('password')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('password'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Role</label>
    <div class="col-sm-10">
    <select class="form-control" name="role">
    <option value="">Select role</option>
    <option value="2" 
        <?= (isset($userDet[0]['userroleid']) && $userDet[0]['userroleid'] == '2') ? 'selected' : ''; ?>>
        Shop Owner
    </option>
    <option value="1" 
        <?= (isset($userDet[0]['userroleid']) && $userDet[0]['userroleid'] == '1') ? 'selected' : ''; ?>>
        Admin
    </option>
</select>
    
    <?php if(form_error('role')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('role'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Store</label>
    <div class="col-sm-10">
    <select class="form-control" name="store_id">
    <?php
                                foreach($stores as $role)
                                {
                                ?>
                              <option value="<?=$role['store_id'];?>" <?php if(isset($userDet[0]['store_id']) && ($userDet[0]['store_id']==$role['store_id'])) echo 'selected';else echo set_select('store_id', $role['store_id'])?>><?=$role['store_name'];?></option>
                              <?php
                                }
                                ?>
    </select>
    <?php if(form_error('store_id')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('store_id'); ?></div>
      <?php } ?>
    </div>
  </div>


  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
  <select class="form-control btn-square" name="is_active">
                              <option value="">Select Status</option>
						<option value="1" <?php if(isset($userDet[0]['is_active']) && $userDet[0]['is_active']=='1'){echo 'selected'; }else{ echo set_select('status', '1'); } ?>>Yes</option>
						<option value="0" <?php if(isset($userDet[0]['is_active']) && $userDet[0]['is_active']=='0'){echo 'selected'; }else{ echo set_select('status', '0'); }?>>No</option>
                            </select>
                            </div>
  </div>



        
        <div class="form theme-form">
        
          
          

          <!-- row start -->
          <div class="row">
            
            
            
            
              
            
          </div>
          <!-- row end -->
            
            
          </div>
          
      
        
    
          </div>
                </div>
        </div>
        
        

            







      </div>
  </div>
  <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
    
  



  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        
        <div class="form theme-form">
        
          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label>Photo</label>
                <input type="hidden" name="old_image" value="<?php if(isset($userDet[0]['profileimg'])) echo $userDet[0]['profileimg'];?>">
                <img width="100" height="100" src="<?php echo base_url(); ?>uploads/user/<?php if(isset($userDet[0]['profileimg'])) echo $userDet[0]['profileimg']; ?>" class="img-thumbnail">
                <input type="file" class="form-control-file" name="user_logo_image">
              </div>
              
            </div>
            
            
            
            
      
            </div>
            
          </div>
          
          
          
          
            
            
          </div>
          
      
        
    
          </div>
                </div>
        </div>






  </div>
  <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
</div>
<button class="btn btn-primary pull-right mb-4" type="submit" name="edit">Save</button>
</form>
<?php } ?>               


                  </div>

        