<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<!-- header section -->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Timesheet Report</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><i data-feather="home"></i>Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
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
                                <input type="hidden" name="id" id="task_id" value=""/>
                                <?php echo are_you_sure; ?></div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                              <button class="btn btn-secondary" id="yes_del_task" type="button" data-bs-dismiss="modal">Yes</button>
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
            <div class="col-sm-12">
                <div class="card">
                <div class="card-header pb-0">
                <div class="d-flex">
                <div class="col-md-3">
                          <div class="mb-3 me-3">
                            <label class="form-label f-w-500">Client</label>
                            <select class="form-select" name="status" id="client_select">
                            <option value="">Select</option>
                            <?php foreach($client as $value){?>
                              <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="mb-3 me-3">
                            <label class="form-label f-w-500">Tecnician</label>
                            <select class="form-select" name="status" id="technician_select">
                            <option value="">Select</option>
                            <?php foreach($technicians as $value){ ?>
                              <option value="<?=$value['userid'];?>"><?=$value['Name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <div class="mb-3 me-3">
                            <label class="form-label f-w-500">Select</label>
                            <select class="form-select" name="status" id="select_criteria">
                                <option value="">Select</option>
                                <option value="date">Date </option>
						        <option value="week">Week</option>
						        <option value="month">Month</option>
                                <option value="range">Date Range</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="display_filter">
                    
                        <div class="mb-3 d-none" id="date_display">
                            <label>Date</label>
                            <input id="date" class="datepicker-here form-control" type="text" data-language="en" name="date_assign">
                        </div>
                    
                        <div class="mb-3 d-none" id="month_display">
                            <label>Month</label>
                            <input id="month" class="datepicker-here form-control" type="text" data-language="en" name="date_assign" data-min-view="months" data-view="months" data-date-format="MM yyyy">
                        </div>
                    
                        <div class="mb-3 d-none" id="week_display">
                            <label>Select date range</label>
                            <input id="week" class="datepicker-here form-control" type="text" data-language="en" name="date_assign" data-range="true" data-multiple-dates-separator=" - " data-language="en">
                          </div>
                            
                 
                        <div class="mb-3 d-none" id="date_range_display">
                            <label>Date Range</label>
                            <input id="range" type="text" class="form-control" name="daterange" value="" />
                        </div>
                    </div>
                            </div>
                          
                          <div class="ccol-sm-3 pull-right">
                            <div class="">
                            
                 <a target="_blank" id="filter_csv" class="btn btn-primary mb-4" type="submit" title="">CSV</a>
                 <a target="_blank" id="filter_pdf" class="btn btn-primary mb-4" type="submit" title="">PDF</a>
                 <a target="_blank" id="filter_excel" class="btn btn-primary mb-4" type="submit" title="">Excel</a>
                </div> 

                </div> 

                <div class="table-responsive theme-scrollbar w-100">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Timesheet ID</th>
                            <th>Timesheet No</th>
                            <th>Client</th>
                            <th>Technician</th>
                            <th>Date</th>
                           
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php //print_r($timesheet);exit;
                       if(!empty($timesheet)){
                       $count = 1;
                       foreach($timesheet as $val){ ?>
                       
                       <tr>
                           
                           
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['timesheet_id'];?></td>
                            <td><?php echo $val['timesheet_no'];?></td>
                            <td><?php echo $val['cl_name']; ?></td>
                            <td><?php echo $val['tech_name']; ?></td>
                            <td><?php echo $val['date'];?></td>
                            
                            <td> 
                              <ul class="action">
                                 
                                
                              <li class="edit">
                                    <form action="<?php echo base_url();?>cordinator/task_view" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['task_id']; ?>"> 
                                        <button class="bg-info" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['id']; ?>" >View</button>
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

                
          
                </div>
                                  

               
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
          <!-- Container-fluid Ends-->
        </div>
        
        <!-- footer section -->
        <script src="<?php echo base_url();?>assets/js/deem/report.js"></script>