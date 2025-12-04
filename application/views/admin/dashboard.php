
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                    <!-- Displaying Date and Time -->
                    <?php $time=strtotime(date("Y/m/d"));
 $month=date("F",$time);
 $year=date("Y",$time);
 $date=date("d",$time);  ?>
                          <!-- <h2 class="f-w-400"> <span><?php echo $month; ?> <?php echo $date; ?> <?php echo $year; ?><sup><i class="fa fa-circle-o f-10"></i></sup></span></h2> -->
                    <!-- Displaying Date and Time -->

                
                
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <a href="<?php echo base_url('admin/store'); ?>"><div class="card-body bg-b-purple">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <span class="text-white mb-3 d-block text-truncate">Stores</span>
                                            <h4 class="mb-3">
                                                <span class="text-white"><?php if(isset($Clientscount)) { echo $Clientscount; } ?></span>
                                            </h4>
                                        </div>
                                        <div class="col-4 icon">
                                            <i class="fa fa-store"></i>
                                        </div>
                                        
                                    </div>
                        
                                </div><!-- end card body -->
                            </a>
                            </div><!-- end card -->
                        </div><!-- end col -->
                
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <a href="<?php echo base_url('admin/user'); ?>"><div class="card-body bg-b-secondary">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <span class="text-white mb-3 d-block text-truncate">Users</span>
                                            <h4 class="mb-3">
                                                <span class="text-white"><?php if(isset($Clientscount)) { echo $Clientscount; } ?></span>
                                            </h4>
                                        </div>
                                        <div class="col-4 icon">
                                            <i class="fa fa-store"></i>
                                        </div>
                                        
                                    </div>
                        
                                </div><!-- end card body -->
                            </a>
                            </div><!-- end card -->
                        </div><!-- end col -->
                
                       
                        </div><!-- end col -->
                
                        
                

                        
                    </div>
                
                </div>


            </div>

           