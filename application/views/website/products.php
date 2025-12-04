<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="Emigo: A sleek, responsive, and user-friendly HTML template designed for online grocery stores.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Grocery, Store, stores">
    <title>Emigo</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url() ?>assets/website/images/fav.webp">
    <!-- plugins css -->
    <link rel="stylesheet preload" href="<?php echo site_url() ?>assets/website/css/plugins.css" as="style">
    <link rel="stylesheet preload" href="<?php echo site_url() ?>assets/website/css/style.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="shop-main-h">


    <input type="hidden" id="store_phone" value="<?php echo $store_phone; ?>">
    <input type="hidden" id="store_id" value="<?php echo $store_id; ?>">
    <input type="hidden" id="language" name="language" value="<?php echo $language; ?>">
    <div class="weekly-best-selling-area bg_light-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-card-main-over1">

                        <div class="container" style="padding: 0px !important;">








                            <ul class="nav-h_top language p-0">
                                <li class="category-hover-header language-hover">
                                    <a href="#">
                                        <?php if(isset($language)){
                                                 if($language == 'ma'){
                                                    $lang = 'മലയാളം';
                                                }
                                                if($language == 'en'){
                                                    $lang = 'English';
                                                }
                                                if($language == 'hi'){
                                                    $lang = 'हिन्दी';
                                                }
                                                if($language == 'ar'){
                                                    $lang = 'وتُكتب';
                                                }
                                                echo $lang;
                                            } ?>
                                    </a>
                                    <ul class="category-sub-menu">
                                        <?php $selected_languages = explode(",", $store_selected_languages );
                                        foreach ($selected_languages as $languag){ ?>
                                        <li class="category-hover-header language-hover">
                                            <?php if($languag == 'ma'){
                                                $lang = 'മലയാളം';
                                            }
                                            if($languag == 'en'){
                                                $lang = 'English';
                                            }
                                            if($languag == 'hi'){
                                                $lang = 'हिन्दी';
                                            }
                                            if($languag == 'ar'){
                                                $lang = 'وتُكتب';
                                            }
                                            ?>
                                            <a href="<?php echo base_url('website/products/set_language/'.$languag); ?>"
                                                class="menu-item">
                                                <span><?php echo $lang; ?></span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                            </ul>







                            <div class="row">
                                <div class="col-lg-12">
                                    <img class="logo"
                                        src="https://dheputtu.com/images/ximg-logo.png.pagespeed.ic.VwEVliEuNo.webp"
                                        alt="Veg">
                                    <h2 class="title-left"><?php echo $store_informations->store_name; ?> -
                                        <?php echo $table; ?></h2>
                                    <div class="title_desc">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                    </div>
                                    <hr class="separation-b">
                                    <div class="title-area-between mb-0">

                                        <ul class="nav nav-tabs best-selling-grocery food-type" id="myTab"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button onclick="loadCategories('veg')" class="nav-link active"
                                                    id="veg-tab" data-bs-toggle="tab" data-bs-target="#veg"
                                                    type="button" role="tab" aria-controls="veg"
                                                    aria-selected="true"><img class="veg"
                                                        src="<?php echo base_url(); ?>assets/website/images/veg.png">
                                                    Veg</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button onclick="loadCategories('non-veg')" class="nav-link"
                                                    id="non-veg-tab" data-bs-toggle="tab" data-bs-target="#non-veg"
                                                    type="button" role="tab" aria-controls="non-veg"
                                                    aria-selected="false"><img class="veg"
                                                        src="<?php echo base_url(); ?>assets/website/images/nonveg.png">
                                                    Non-veg</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>




                            <div class="accordion" id="accordion-content">
                                <?php foreach ($categories as $key => $category) {
            $products = $this->Productmodel->getProductsUnderCategoriesWithType($category['category_id'],$store_id);
            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?php echo $key; ?>">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>"
                                            aria-expanded="false"
                                            aria-controls="collapse<?php echo $key; ?>"><?php echo $category['category_name_'.$language]; ?></button>
                                    </h2>
                                    <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse"
                                        aria-labelledby<?php echo $key; ?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row g-4">
                                                <!-- loop content -->
                                                <?php if (!empty($products)): ?>
                                                <?php foreach ($products as $product): ?>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="product-grid">
                                                        <!-- Left Column -->
                                                        <div class="left-column" style="width: 65%;float: left;">
                                                            <a href="">
                                                                <h4 class="title">
                                                                    <?php echo $product['product_name_' . $language]; ?>
                                                                </h4>
                                                            </a>
                                                            <div class="product-description">
                                                                <?php echo $product['product_desc_' . $language]; ?>.
                                                            </div>
                                                            <!-- <div class="product-rating">⭐⭐⭐⭐☆</div> -->
                                                            <div class="price-area">
                                                                <span
                                                                    class="current">₹<?php echo $product['price']; ?></span>
                                                                <!-- <div class="previous">$36.00</div> -->
                                                            </div>
                                                        </div>


                                                        <!-- Right Column -->
                                                        <div class="right-column" style="width: 35%;float: right;">

                                                            <?php if($product['is_customizable'] == 1){ ?>
                                                            <img src="<?php echo site_url() ?>uploads/product/<?php echo $product['image']; ?>"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#productCustomize"
                                                                data-prodId="<?php echo $product['store_product_id']; ?>"
                                                                data-id="<?php echo $product['product_id']; ?>"
                                                                alt="Product Image" class="product-image customize">
                                                            <!-- Add button -->
                                                            <div class="product"
                                                                data-id="<?php echo $product['product_id']; ?>"
                                                                data-price="<?php echo $product['price']; ?>">
                                                                <input type="hidden" name="product_id"
                                                                    value="<?php echo $product['product_id']; ?>">
                                                                <button data-id="<?php echo $product['product_id']; ?>"
                                                                    class="add-button" data-bs-toggle="modal"
                                                                    data-bs-target="#productCustomize">ADD</button>
                                                            </div>
                                                            <?php }else{ ?>
                                                            <img src="<?php echo site_url() ?>uploads/product/<?php echo $product['image']; ?>"
                                                                alt="Product Image" class="product-image">
                                                            <!-- Add button -->
                                                            <div class="product"
                                                                data-id="<?php echo $product['product_id']; ?>"
                                                                data-price="<?php echo $product['price']; ?>">
                                                                <input type="hidden" name="product_id"
                                                                    value="<?php echo $product['product_id']; ?>">
                                                                <button class="add-button add-to-cart"
                                                                    onclick="addToCart(this)">ADD</button>
                                                                <div id="quantityControls" class="add-button"
                                                                    style="display: none;">
                                                                    <button class="decrement">-</button>
                                                                    <input type="number" class="quantity" value="1"
                                                                        min="1" readonly>
                                                                    <!-- <span id="quantity">1</span> -->
                                                                    <button class="increment">+</button>
                                                                </div>
                                                            </div>
                                                            <?php } ?>

                                                            <!-- <button class="add-button">ADD</button> -->









                                                            <!-- <form action="<?php echo site_url('website/cart/add'); ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <button class="rts-btn btn-primary radious-sm with-icon" type="submit"><div class="btn-text">
                                                    ADD
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa fa-cart-shopping"></i>
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa fa-cart-shopping"></i>
                                                </div></button>
            </form> -->






                                                        </div>
                                                        <?php if($product['is_customizable'] == 1){ ?>
                                                        <span class="custom-text">Customisable</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <p>No products found.</p>
                                                <?php endif; ?>
                                                <!-- loop content end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="separation-b">
                                <?php }
        ?>
                            </div>

                        </div>
                    </div>
                </div>
                <hr class="separation-b">
                <!-- <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Fish
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <hr class="separation-b"> -->
                <!-- <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Salad
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div> -->
            </div>




        </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    <div class="fixed-cart-total"
        style="position:fixed;bottom:0px;width:100%;background: #ef4f5f;color: #fff;text-align: center;padding: 13px;font-size: 15px;">
        <a href="<?php echo site_url() ?>cart/view">
            <p class="cart-total" style="color: #fff;font-size: 15px;"><span id="total-items"> Items Added - ₹<span
                        id="cart-total"></span></p>
        </a>
    </div>










    <!-- rts copyright-area start -->
    <div class="rts-copyright-area d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-between-1">
                        <p class="disc">
                            Copyright 2024 <a href="#">EMIGO</a>. All rights reserved.
                        </p>
                        <!-- <a href="#" class="playstore-app-area">
                            <span>Download App</span>
                            <img src="<?php echo site_url() ?>assets/website/images/googleplay.webp" alt="">
                            <img src="<?php echo site_url() ?>assets/website/images/appstore.webp" alt="">
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts copyright-area end -->










    <!-- customize modal -->
    <div class="modal fade" id="customizeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <iframe id="iframe_product_customize" height="700px" width="100%"></iframe>

            </div>
        </div>
    </div>
    <!--customize modal end -->




    <div class="modal fade" id="productCustomize" tabindex="-1" role="dialog" aria-labelledby="foodModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modalBodyContent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                    <button type="button" class="btn btn-block btn-popup">Add Item - ₹540</button>


                </div>



            </div>
        </div>

    </div>
    </div>
    </div>


    <div class="cart d-none">
        <h2>Cart</h2>
        <p>Total Items: <span id="total-items"></span></p>
        <ul id="cart-items"></ul>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- plugins js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/plugins.js"></script>

    <!-- custom js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/main.js"></script>
    <!-- header style two End -->


</body>

</html>


<script>
function loadCategories(type) {
    $.ajax({
        url: '<?= base_url("website/products/load_categories_with_products") ?>',
        type: 'POST',
        data: {
            type: type,
            store_id: $('#store_id').val(),
            language: $('#language').val()
        },
        dataType: 'text', // Expect JSON response
        success: function(response) {
            //alert(response); // Inspect the data to ensure it's being received correctly
            $('#accordion-content').html(response);
            // Initialize accordion functionality if needed
        },
        error: function() {
            alert("An error occurred while loading categories.");
        }
    });
}
</script>



<script>
function addToCart(button) {
    // Hide the Add button
    button.style.display = "none";
    // Show the quantity controls
    const quantityControls = button.nextElementSibling;
    quantityControls.style.display = "inline-flex";
}

function incrementQuantity(button) {
    // Get the quantity span and increase the value
    const quantityDisplay = button.previousElementSibling;
    let quantity = parseInt(quantityDisplay.textContent, 10);
    quantityDisplay.textContent = ++quantity;
}

function decrementQuantity(button) {
    // Get the quantity span and decrease the value if greater than 1
    const quantityDisplay = button.nextElementSibling;
    let quantity = parseInt(quantityDisplay.textContent, 10);
    if (quantity > 1) {
        quantityDisplay.textContent = --quantity;
    } else {
        // Hide quantity controls and show Add button again if quantity is 1
        const quantityControls = button.parentElement;
        quantityControls.style.display = "none";
        const addButton = quantityControls.previousElementSibling;
        addButton.style.display = "inline";
    }
}
</script>

<script>
function copyToClipboard(element) {
    var text = element.textContent;
    $('#output-textarea').val(text);
}
</script>



<script>
$(document).ready(function() {
    loadCart();

    // Add to cart
    $(document).on('click', '.add-to-cart', function() {

        const productId = $(this).closest('.product').data('id');
        const price = $(this).closest('.product').data('price');
        const quantity = 1;
        //alert(productId);

        $.ajax({
            url: '<?= base_url("cart/add") ?>',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                price: price
            },
            success: function() {
                loadCart();
            }
        });
    });

    // Increment quantity
    $(document).on('click', '.increment', function() {
        const product = $(this).closest('.product');
        const productId = product.data('id');
        const quantityInput = product.find('.quantity');
        let quantity = parseInt(quantityInput.val()) + 1;
        quantityInput.val(quantity);
        updateCartQuantity(productId, quantity);
    });

    // Decrement quantity
    $(document).on('click', '.decrement', function() {
        const product = $(this).closest('.product');
        const productId = product.data('id');
        const quantityInput = product.find('.quantity');
        let quantity = parseInt(quantityInput.val()) - 1;
        if (quantity > 0) {
            quantityInput.val(quantity);
            updateCartQuantity(productId, quantity);
        } else {
            //alert('zero');
            $(this).closest('.product').find('.add-to-cart').css('display', 'block');
            $(this).closest('.product').find('#quantityControls').css('display', 'none');

            deleteCartItem(productId);
        }
    });

    // Update cart quantity
    function updateCartQuantity(productId, quantity) {
        $.ajax({
            url: '<?= base_url("cart/updateQuantity") ?>',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function() {
                loadCart();
            }
        });
    }

    // Load cart items and total
    function loadCart() {
        $.ajax({
            url: '<?= base_url("cart/get") ?>',
            method: 'GET',
            success: function(data) {
                const cartData = JSON.parse(data);
                displayCart(cartData);
            }
        });
    }

    // Display cart items and update total items count and total value
    function displayCart(cartData) {
        $('#cart-items').empty();
        let totalItems = 0;
        let cartTotal = 0;

        $.each(cartData, function(id, item) {
            const itemTotal = item.quantity * item.price;
            cartTotal += itemTotal;
            totalItems += item.quantity;

            $('#cart-items').append(
                `<li>${item.name} - ₹${item.price} x ${item.quantity} = ₹${itemTotal.toFixed(2)}
                <span class="delete-item" data-id="${id}">X</span></li>`
            );
        });

        let total = sumOfDigits(totalItems);

        function sumOfDigits(number) {
            let sum = 0;
            let digits = number.toString().split(''); // Convert number to a string and split into digits

            digits.forEach(function(digit) {
                sum += parseInt(digit, 10); // Convert each digit back to an integer and add to sum
            });

            return sum;
        }


        $('#total-items').text(total + ' Items Added' + ' ₹' + cartTotal.toFixed(2));
        $('#cart-total').text(cartTotal.toFixed(2));
    }

    // Delete item from cart
    $(document).on('click', '.delete-item', function() {
        const productId = $(this).data('id');
        deleteCartItem(productId);
    });

    // Function to delete cart item
    function deleteCartItem(productId) {
        $.ajax({
            url: '<?= base_url("cart/delete") ?>',
            method: 'POST',
            data: {
                product_id: productId
            },
            success: function() {
                loadCart();
            }
        });
    }
});
</script>

<script>
$(document).ready(function() {
    // Triggered when the modal is about to be shown
    $('#productCustomize').on('show.bs.modal', function(event) {
        // Get the button that triggered the modal and extract the product ID
        var button = $(event.relatedTarget);
        var productId = button.data('id');
        var product = button.data('prodid'); //alert(product);

        // Send an AJAX request to fetch variants and addons
        $.ajax({
            url: "<?php echo base_url('website/products/getVariantsAndAddons'); ?>",
            type: "POST",
            data: {
                product_id: productId,
                store_id: $('#store_id').val(),
                language: $('#language').val(),
                prod: product
            },
            success: function(response) {
                //alert(response);
                // Populate the modal with the response data
                $('#modalBodyContent').html(response);
            },
            error: function() {
                $('#modalBodyContent').html(
                    '<p class="text-danger">Unable to load data. Please try again.</p>');
            }
        });
    });


    // Function to update the button price
    function updateButtonPrice() {
        var selectedPrice = $('input[name="variant"]:checked').data('price');
        $('#buttonPrice').text(selectedPrice);
    }

    // Use event delegation to handle radio button changes for dynamically added content
    $('#modalBodyContent').on('change', 'input[name="variant"]', function() {
        updateButtonPrice();
        var selectedPrice1 = $(this).data('price');
        $('#customizeProduct').attr('data-price', selectedPrice1);
    });

});
</script>