<!-- header section -->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Client - <?php if(isset($details[0]['name'])){ echo $details[0]['name']; } ?> new</h3>
                  <input type="hidden" id="client_id" value="<?php if(isset($details[0]['id'])){ echo $details[0]['id']; } ?>">
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
       <div class="container-fluid dashboard-default">

      <!-- for javascript validation showing -->
      <div id="displaymsg" class="alert alert-success dark d-none" role="alert"></div>
      <div class="alert alert-danger dark d-none" role="alert"></div>
            <!-- for javascript validation showing -->

       
             <!--modal for delete location confirmation-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="clientjobloc_id" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_client_jobloc" type="button" data-bs-dismiss="modal">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->
        <!--modal for delete project confirmation-->
        <div class="modal fade" id="deleteProject" tabindex="-1" role="dialog" aria-labelledby="deleteProject" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="del_project_id" value=""/>
                                <h6><?php echo are_you_sure; ?></h6></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                              <button class="btn btn-secondary" id="yes_del_project" type="button" data-bs-dismiss="modal">Delete</button>
                            </div>
                          </div>
                        </div>
                      </div>
        <!--modal for delete confirmation-->
       
       
       
            <div class="row">  
            <div class="col-sm-12">
                <div class="card pb-4">   
                  <div class="card-header pb-0">

                   <!--details start  -->
                  
                    <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="profile-tab" data-bs-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
                      
                      <?php if($this->Rolemodel->check_permission(37,$this->session->userdata('roleid'),'can_edit') == 1){ ?>
                      <li class="nav-item"><a class="nav-link" id="projects-tab" data-bs-toggle="pill" href="#projects" role="tab" aria-controls="projects" aria-selected="false"><i class="fa fa-tag" aria-hidden="true"></i>Projects</a></li>
                      <li class="nav-item"><a class="nav-link" id="location-tab" data-bs-toggle="pill" href="#location" role="tab" aria-controls="location" aria-selected="false"><i class="fa fa-map-marker" aria-hidden="true"></i>Job Locations</a></li>
                      <?php } ?>
                    </ul>
                    <div class="tab-content" id="pills-warningtabContent">
                      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        



                      <div class="user-profile">
                          <div class="collapse show">
                            <div class="post-about mt-4">
                                <?php if(isset($details[0])){ ?>
                            <ul>
                                <li>
                                  <div class="icon"><i data-feather="user"></i></div>
                                  <div>
                                    <h6><?php echo $details[0]['name']; ?></h6>
                                    <!-- <p class="mb-0">banglore - 2022</p> -->
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="inbox"></i></div>
                                  <div>
                                    <h5><?php echo $details[0]['email']; ?></h5>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="phone"></i></div>
                                  <div>
                                    <h5><?php echo $details[0]['phone']; ?></h5>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="map-pin"></i></div>
                                  <div>
                                    <h5><?php echo $details[0]['address']; ?></h5>
                                  </div>
                                </li>
                                
                              </ul>
                              <?php } ?>
                            </div>
                          </div>
                        </div>




                      </div>
                      <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
                     

                      <!-- project modals -->
                      <!-- modal start -->
                      <div class="modal fade" id="add_project_modal" tabindex="-1" role="dialog" aria-labelledby="add_project_modal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Project - <?php if(isset($details[0])){ echo $details[0]['name']; } ?></h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                      <form id="form" method="post" >     
                      <div class="row">
                        <div class="col">
                        
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="name" value="" name="name" class="form-control">
                            <div id="valid_name" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Details</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" id="proj_details" name="proj_details" rows="2" cols="2"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-primary" id="saveProject">Save</a>
                            </div>
                                </form>
                          </div>
                        </div>
                      </div>
                      <!-- modal end -->
                      <!-- update project modal start -->
                      <div class="modal fade" id="edit_project" tabindex="-1" role="dialog" aria-labelledby="edit_project" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Project</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              
                      <form id="form" method="post" >  
                      <input type="hidden" value="" id="hiddenProjectId">
                      <input type="hidden" value="" id="hiddenClientIdp">   
  
                      <div class="row">
                        <div class="col">
                        
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="edit_name" value="" name="name" class="form-control">
                            <div id="edit_valid_project" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Details</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" id="edit_proj_details" name="details" rows="2" cols="2"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-primary" id="updateProject">Update</a>
                            </div>
                                </form>
                          </div>
                        </div>
                      </div>
                      <!-- update project modal end -->
                      <!-- project modal -->
                      <!-- project tab start -->
                      <div class="table-responsive theme-scrollbar mt-4">
                        <button id="addnewproject" class="btn btn-primary pull-right mb-4" type="button" data-bs-toggle="modal" data-bs-target="#add_project_modal">Add new project</button>
                        <table class="display" id="basic-2">
                        <thead>
                          <tr>
                        <th>No</th>
                           <th>Project</th>
                            
                            <th class="text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                       if(!empty($projects)){
                       $count = 1;
                       foreach($projects as $val){ ?>
                       
                       <tr>
                           
                           
                            <td><?php echo $count; ?></td>
                            <td><a href=""><?php echo $val['name'];?></a></td>
                           
                            <td> 
                              <ul class="action pull-right">
                              
                                <li class="delete">   
                                <button class="edit_project" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit Project" data-id="<?php echo $val['id']; ?>"><i class="fa fa-edit"></i></button>  
                                </li>
                                <li class="edit">
                                    <form action="" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['id']; ?>"> 
                                        <button class="del_project" type="button" data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>" data-bs-original-title="Delete Project" data-bs-target="#deleteProject"><i class="fa fa-close"></i></button>
                                    </form>
                                </li>
                              </ul>
                            </td>
                            
                          </tr>
                          
                       <?php $count++; }} ?>
                        </tbody>
                      </table>
                      </div>
                      <!-- project tab end -->
                      
                    </div>
                      <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                      <!-- location content start -->
                      <div class="table-responsive theme-scrollbar mt-4">
                      <button id="addnewjoblocation" class="btn btn-primary pull-right mb-4" type="button" data-bs-toggle="modal" data-bs-target="#joblocationmodal">Add new Job Location</button>
                      
                      
                      <!-- modal start -->
                      <div class="modal fade" id="joblocationmodal" tabindex="-1" role="dialog" aria-labelledby="joblocationmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Job Location</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                      <form id="form" method="post" >     
                      <div class="row">
                        
                        <div class="col">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Project</label>
                            
                            <div class="col-sm-9">
                            <select id="sel_project" class="form-control btn-square" name="sel_project">
                              
                            </select>
                            <div id="valid_project" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>

                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="joblocation" value="" name="joblocation" class="form-control">
                            <div id="valid_location" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Contact Person</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="contact_person" value="" name="contact_person" class="form-control">
                            <div id="valid_cp" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Contact Person Phone</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="contact_person_phone" value="" name="contact_person_phone" class="form-control">
                            <div id="valid_cpp" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Location Details</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" id="details" name="details" rows="2" cols="2"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-primary" id="save">Save</a>
                            </div>
                                </form>
                          </div>
                        </div>
                      </div>
                      <!-- modal end -->


                       <!-- update modal start -->
                       <div class="modal fade" id="edit_joblocationmodal" tabindex="-1" role="dialog" aria-labelledby="edit_joblocationmodal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Update Job Location</h5>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              
                      <form id="form" method="post" >  
                      <input type="hidden" value="" id="hiddenClientJobId">                       <input type="hidden" value="" id="p">   
  
                      <div class="row">
                        <div class="col">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Project</label>
                            
                            <div class="col-sm-9">
                            <select id="edit_sel_project" class="form-control btn-square" name="edit_sel_project">
        
                            </select>
                            <div id="edit_valid_project" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="edit_joblocation" value="" name="joblocation" class="form-control">
                            <div id="edit_valid_location" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Contact Person</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="contact_person_upd" name="contact_person" class="form-control">
                            <div id="valid_cp" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Contact Person Phone</label>
                            
                            <div class="col-sm-9">
                            <input type="text" id="contact_person_phone_upd" name="contact_person_phone" class="form-control">
                            <div id="valid_cpp" class="alert alert-danger dark mt-1 d-none" role="alert"></div>  
                          </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Location Details</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" id="edit_details" name="details" rows="2" cols="2"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-primary" id="update">Update</a>
                            </div>
                                </form>
                          </div>
                        </div>
                      </div>
                      <!-- update modal end -->
                      
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                        <th>No</th>
                        <th>Project</th>
                           <th>Job Location</th>
                            
                            <th class="text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                       if(!empty($job_locations)){
                       $count = 1;
                       foreach($job_locations as $val){ ?>
                       
                       <tr>
                           
                           
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['proj_name'];?></td>
                            <td><a href=""><?php echo $val['job_location'];?></a></td>
                           
                            <td> 
                              <ul class="action pull-right">
                              
                                <li class="delete">
                                    
                                <button class="edit_job_loc" type="button" data-bs-toggle="tooltip" data-bs-original-title="Edit Job Location" data-id="<?php echo $val['job_location_id']; ?>"><i class="fa fa-edit"></i></button>
                                   
                                </li>
                                
                                <li class="edit">
                                    <form action="<?php echo base_url();?>client/delete_jobloc" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['job_location_id']; ?>"> 
                                        <button class="del_client_jobloc" type="button" data-bs-toggle="modal" data-id="<?php echo $val['job_location_id']; ?>" data-bs-original-title="Delete Job Location" data-bs-target="#exampleModal"><i class="fa fa-close"></i></button>
                                    </form>
                                </li>
                              </ul>
                            </td>
                            
                          </tr>
                          
                       <?php $count++; }} ?>
                        </tbody>
                      </table>
                      </div>
                    <!-- location content end -->
                      </div>
                    </div>
                    <a href="<?php echo base_url(); ?>client" class="btn btn-primary mt-4 pull-left">Back</a>
                   <!--details end  -->

                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- Container-fluid Ends-->
        </div>
        <!-- footer section -->
        <script src="<?php echo base_url();?>assets/js/deem/client/client.js"></script>
        <script src="<?php echo base_url();?>assets/js/deem/project/project.js"></script>



       