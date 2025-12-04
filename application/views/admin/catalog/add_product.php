 <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">

                


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Product</h4>
                
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
                                        <i class="fa-solid fa-chevron-right " style="font-size: 9px;margin: 6px 5px 0px 5px;"></i>
                                        <li class="breadcrumb-item active">Product</li>
                                    </ol>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                   

                
                
                  <div class="row">
                        
                    
                  <form method="post" action="<?php echo base_url(); ?>admin/product/add" enctype="multipart/form-data">

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <!-- <li class="nav-item" role="presentation">
      <button class="nav-link active" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab" aria-controls="store" aria-selected="true">Store</button>
    </li> -->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="store" role="tabpanel" aria-labelledby="store-tab">
      <div class="row">
        






     
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">






     
  <div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label">Category </label>
    <div class="col-sm-3">
    <select class="form-select" name="category_id">
                                <option value="">Select Category</option>
    <?php
                                foreach($categories as $category)
                                {
                                ?>
                              <option value="<?=$category['category_id'];?>" <?php echo set_select('category_id', $category['category_id'])?>><?=$category['category_name_en'];?></option>
                              <?php
                                }
                                ?>
    </select>
    <?php if(form_error('category_id')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('category_id'); ?></div>
      <?php } ?>
    </div>


<!-- sub category -->

<label class="col-sm-2 col-form-label">SubCategory </label>
<div class="col-sm-3">
<select class="form-select" name="subcategory_id">
                            <option value="">Select Sub Category</option>

                            
<?php
                            foreach($subcategories as $category)
                            {
                            ?>
                          <option value="<?=$category['subcategory_id'];?>" <?php echo set_select('subcategory_id', $category['subcategory_id'])?>><?=$category['subcategory_name_en'];?></option>
                          <?php
                            }
                            ?>
</select>
<?php if(form_error('subcategory_id')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('subcategory_id'); ?></div>
  <?php } ?>
</div>





    <!-- <label class="col-sm-1 col-form-label">Photo</label>
    <div class="col-sm-2">
    <input type="file" class="form-control-file" name="userfile">
    <?php if(form_error('userfile')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('userfile'); ?></div>
      <?php } ?>
      <?php if (isset($error)): ?>
        <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
    <?php endif; ?>
    </div>

    
    
  </div> -->



  <div class="form-group row mt-2">

<label class="col-sm-2 col-form-label">Veg/Non Veg</label>
<div class="col-sm-3">
<select class="form-select" name="product_veg_nonveg">
  <option value="">Select any</option>
        <option value="veg">Veg</option>
        <option value="non-veg">Non-Veg</option>
  </select>
  <?php if(form_error('product_veg_nonveg')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_veg_nonveg'); ?></div>
      <?php } ?>
</div>
<div class="col-sm-2">
<label class="col-sm-12 col-form-label">Is Customizable</label>
</div>
<div class="col-sm-1">
  <input type="hidden" name="iscustomizable_hidden" value="0" id="iscustomizable_hidden">
<input class="form-check-input" type="checkbox" value="" id="checkbox_is_customizable"> 
</div>
<div class="col-sm-2">
<label class="col-sm-12 col-form-label">Is Addon</label>
</div>
<div class="col-sm-1">
  <input type="hidden" name="isaddon_hidden" value="0" id="isaddon_hidden">
<input class="form-check-input" type="checkbox" value="" id="checkbox_is_addon"> 
</div>


</div>



  <div class="form-group row mb-2">

    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">Malayalam</label>
    </div>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">English</label>
    </div>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">Hindi</label>
    </div>
    <div class="col-sm-2">
    <label class="col-sm-12 col-form-label">Arabic</label>
    </div>


  </div>



  <div class="form-group row mb-2">

    <label class="col-sm-2 col-form-label">Product Name</label>
    <div class="col-sm-2">
    <input class="form-control" value="<?php echo set_value('product_name_ma'); ?>" type="text" placeholder="Malayalam" name="product_name_ma">
    <?php if(form_error('product_name_ma')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_name_ma'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-2">
    <input class="form-control" value="<?php echo set_value('product_name_en'); ?>" type="text" placeholder="English" name="product_name_en">
    <?php if(form_error('product_name_en')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_name_en'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-3">
    <input class="form-control" value="<?php echo set_value('product_name_hi'); ?>" type="text" placeholder="Hindi" name="product_name_hi">
    <?php if(form_error('product_name_hi')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_name_hi'); ?></div>
      <?php } ?>
    </div>
    <div class="col-sm-3">
    <input class="form-control" value="<?php echo set_value('product_name_ar'); ?>" type="text" placeholder="Arabic" name="product_name_ar">
    <?php if(form_error('product_name_ar')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_name_ar'); ?></div>
      <?php } ?>
    </div>

  </div>



  <div class="form-group row mb-2">

<label class="col-sm-2 col-form-label">Description</label>
<div class="col-sm-2">
<textarea name="product_desc_ma" class="form-control" id="exampleFormControlTextarea4" placeholder="Malayalam" rows=""><?php echo set_value('product_desc_ma'); ?></textarea>
<?php if(form_error('product_desc_ma')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_desc_ma'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-2">
<textarea name="product_desc_en" class="form-control" id="exampleFormControlTextarea4" placeholder="English" rows=""><?php echo set_value('product_desc_en'); ?></textarea>
<?php if(form_error('product_desc_en')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_desc_en'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-3">
<textarea name="product_desc_hi" class="form-control" id="exampleFormControlTextarea4" placeholder="Hindi" rows=""><?php echo set_value('product_desc_hi'); ?></textarea>
<?php if(form_error('product_desc_hi')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_desc_hi'); ?></div>
  <?php } ?>
</div>
<div class="col-sm-3">
<textarea name="product_desc_ar" class="form-control" id="exampleFormControlTextarea4" placeholder="Arabic" rows=""><?php echo set_value('product_desc_ar'); ?></textarea>
<?php if(form_error('product_desc_ar')){ ?>
<div class="errormsg mt-2" role="alert"><?php echo form_error('product_desc_ar'); ?></div>
  <?php } ?>
</div>



</div>
  
  

<div class="container mt-5">
  <div class="row g-3">
<!-- default image -->

<div class="col">
  <label for="file1" class="form-label">Default image</label>
  <input type="file" class="form-control" id="file1" name="userfile" accept="image/*">
  <?php if(form_error('userfile')){ ?>
    <div class="errormsg mt-2" role="alert"><?php echo form_error('userfile'); ?></div>
          <?php } ?>
          <?php if (isset($error)): ?>
            <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
        <?php endif; ?>
</div>

      <!-- First File Input -->
      <div class="col">
          <label for="file1" class="form-label">Image 1</label>
          <input type="file" class="form-control" id="file1" name="image1" accept="image/*">
          <?php if(form_error('image1')){ ?>
            <div class="errormsg mt-2" role="alert"><?php echo form_error('image1'); ?></div>
                  <?php } ?>
                  <?php if (isset($error)): ?>
                    <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
                <?php endif; ?>
      </div>

     
            
      <!-- Second File Input -->
      <div class="col">
          <label for="file2" class="form-label">Image 2</label>
          <input type="file" class="form-control" id="file2" name="image2" accept="image/*">
          <?php if(form_error('image2')){ ?>
            <div class="errormsg mt-2" role="alert"><?php echo form_error('image2'); ?></div>
                  <?php } ?>
                  <?php if (isset($error)): ?>
                    <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
                <?php endif; ?>
      </div>
      <!-- Third File Input -->
      <div class="col">
          <label for="file3" class="form-label">Image 3</label>
          <input type="file" class="form-control" id="file3" name="image3" accept="image/*">
          <?php if(form_error('image3')){ ?>
            <div class="errormsg mt-2" role="alert"><?php echo form_error('image3'); ?></div>
                  <?php } ?>
                  <?php if (isset($error)): ?>
                    <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
                <?php endif; ?>
      </div>
      <!-- Fourth File Input -->
      <div class="col">
          <label for="file4" class="form-label">Image 4</label>
          <input type="file" class="form-control" id="file4" name="image4" accept="image/*">
          <?php if(form_error('image4')){ ?>
            <div class="errormsg mt-2" role="alert"><?php echo form_error('image4'); ?></div>
                  <?php } ?>
                  <?php if (isset($error)): ?>
                    <div class="errormsg mt-2" role="alert"><?php echo $error; ?></div>
                <?php endif; ?>
      </div>
      <!-- Fifth File Input -->
     
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

  <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
fffffffffff
  </div> -->
</div>
<button class="btn btn-primary pull-right mb-4" type="submit" name="add">Save</button>

<p class="text-danger fw-bold">image size should be 20 kb</p>
</form>
                    


                  </div>

        


<script>
   $(document).ready(function() {
    $('#checkbox_is_customizable').on('click', function() {
                if ($(this).is(':checked')) {
                  $('#iscustomizable_hidden').val(1);
                } else {
                  $('#iscustomizable_hidden').val(0);
                }
    });

    $('#checkbox_is_addon').on('click', function() {
                if ($(this).is(':checked')) {
                  $('#isaddon_hidden').val(1);
                } else {
                  $('#isaddon_hidden').val(0);
                }
    });
  })
</script>