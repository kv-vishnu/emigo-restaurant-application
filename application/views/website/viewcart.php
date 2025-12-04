
<link rel="stylesheet preload" href="<?php echo site_url(); ?>assets/website/css/plugins.css" as="style">
<link rel="stylesheet preload" href="<?php echo site_url(); ?>assets/website/css/style.css" as="style">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobile Cart Page</title>
  <!-- Bootstrap CSS -->

  <style>
    .cart-item img {
      max-width: 60px;
      height: auto;
    }
    .total-price {
      font-size: 1.2rem;
      font-weight: bold;
    }
    .btn-checkout {
      background-color: #ff7f50;
      color: white;
      width: 100%;
    }
    .bouncing-button {
    padding: 15px 30px;
    font-size: 16px;
    color: #fff;
    background-color: #198754;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    animation: bounce 1s infinite;
  }

  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
      transform: translateY(0);
    }
    40% {
      transform: translateY(-10px);
    }
    60% {
      transform: translateY(-5px);
    }
  }
  </style>
</head>
<body>
  <input type="hidden" id="delivery_type" value="<?php echo $this->session->userdata('delivery_type'); ?>">
  <input type="hidden" id="delivery_type_phone" value="<?php echo $this->session->userdata('delivery_type_phone'); ?>">
  <input type="hidden" id="store_id" value="<?php echo $this->session->userdata('store_id'); ?>">
  <!-- Header Section -->
 

  <?php
  foreach($prevous_orders as $item){
    } ?>
  
      <!-- Cart Items List -->
      <div class="container mt-4">
        <h6 class="mb-4">Previous Orders</h6>
        <div class="list-group" id="cart-items">
        
        <?php foreach($prevous_orders as $item){ ?>
        <div class="list-group-item d-flex justify-content-between align-items-center cart-item">
            <div class="col-6">
            <h6 class="mb-0 heading"><?php echo $this->Ordermodel->getProductName($item['product_id']); ?></h6>
            <small class="d-none">Short Description</small>
            </div>
            <div class="col-3 text-center product" data-id="">
            <div class="d-flex align-items-center">
                <input type="number" disabled class="" value="<?php echo $item['quantity']; ?>" min="1">
            </div>
            </div>
    
    <div class="col-3 text-end">
    <p><b><?php echo $item['quantity'] * $item['rate']; ?></b></p>
    </div>
  </div>
<?php } ?>



        </div>
      
      

   

      <a href="<?php echo base_url(); ?>website/products/<?php echo $token; ?>/<?php echo $orderno; ?>" class="btn w-50 btn-checkout p-3 me-3 mt-5" style="font-size: 15px;border-radius: 10px;">Add More Item</a>

      </div>
  
 

  
  <?php
  if($this->session->userdata('delivery_type') == 'DL' || $this->session->userdata('delivery_type') == 'PK'){ ?>
    <div class="container mt-5">
    <form>
      <!-- Name -->
      <div class="mb-3">
        <input type="text" class="form-control" id="name" placeholder="Name" required>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <input type="text" class="form-control" id="phone" placeholder="Phone" required>
      </div>

      <!-- Address -->
      <div class="mb-3">
        <textarea class="form-control" id="address" rows="2" placeholder="Address" required></textarea>
      </div>

      <!-- Submit Button -->
    </form>
  </div>
  <?php } ?>



  
  <!-- Cart Buttons -->
   
  
  <div class="container">
  <?php 
  $cart = $this->session->userdata('cart');
  //print_r($cart);
  if(!empty($cart) && $this->session->userdata('delivery_type') == 'D'){ ?>
    <div class="d-flex justify-content-between">
      <?php
      if($this->session->userdata('store_token') != ''){
        $backLink = base_url('website/products/'.$this->session->userdata('store_token').'/0');
      }else{
        $backLink = base_url('website/products/shop/'.$this->session->userdata('store_id').'/'.$this->session->userdata('delivery_type').'/0');
      }
      ?>
      <a href="<?php echo $backLink; ?>" class="btn w-50 btn-checkout p-3 me-3" style="font-size: 15px;border-radius: 10px;">Add More Item</a>
      <button class="btn btn-success w-50 p-3 table_order bouncing-button" style="font-size: 15px;border-radius: 10px;">Confirm Order </button>
    </div>
    <?php }
     if(!empty($cart) && $this->session->userdata('delivery_type') != 'D'){ ?>
      <div class="d-flex justify-content-between">
      <?php
      if($this->session->userdata('store_token') != ''){
        $backLink = base_url('website/products/'.$this->session->userdata('store_token').'/0');
      }else{
        $backLink = base_url('website/products/shop/'.$this->session->userdata('store_id').'/'.$this->session->userdata('delivery_type').'/0');
      }
      ?>
      <a href="<?php echo $backLink; ?>" class="btn w-50 btn-checkout p-3 me-3" style="font-size: 15px;border-radius: 10px;">Add More Item</a>
      <button class="btn btn-success w-50 p-3 type_order bouncing-button" style="font-size: 15px;border-radius: 10px;">Confirm Order </button>
    </div>
    <?php } ?>
     <div class="d-flex justify-content-between">
    </div>
  </div>
  


</body>
</html>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.table_order').on('click', function(){
     sendToWhatsAppOrder();
    });
    $('.type_order').on('click', function () {
    const name = $('#name').val().trim();
    const phone = $('#phone').val().trim();
    const address = $('#address').val().trim();

    if (!name || !phone || !address) {
        alert('Please enter Name, Phone, and Address.');
        return; // Stop execution if any field is empty
    }

    sendToWhatsAppOrderWithDetails(); // Call the function if validation passes
});
});
</script>

<script>
function sendToWhatsAppOrder() {
 const phoneNumber = $('#delivery_type_phone').val();
 const table = $('#store_table').val(); 
 
 $.ajax({
   url: '<?= base_url("website/products/checkout") ?>',
   method: 'GET',
   dataType: 'json',
   success: function(response) {
   //console.log(response);
   
            $.ajax({
              url: '<?= base_url("cart/get") ?>',
              method: 'GET',
              success: function(data) {
                  var type = '<?= $tax_infr->tax_type;  ?>';
                  var rate = '<?= $tax_infr->tax_rate;  ?>';
                  const cartData = JSON.parse(data);
                  let message = `*ORDER DETAILS - ${table}*\n`;
                  message += `------------------------\n`;
                  let overallTotal = 0;
                  let index = 0;
                  $.each(cartData, function(id, item) {
                    const itemTotal = item.price * item.quantity;
                    overallTotal += itemTotal; 
                    message += `${index + 1}. ${item.name} : ${item.price}x${item.quantity} = ₹${itemTotal.toFixed(2)}\n`;
                    index++;
                  });
                  message += `------------------------\n`;
                  let taxAmount = (overallTotal * rate) / 100; // Calculate tax amount
                  let grandTotal = overallTotal + taxAmount;  // Calculate grand total

                  message += `*SubTotalll : Rs ₹${overallTotal.toFixed(2)}*\n`;
                 // message += `*${type}:* ₹${taxAmount.toFixed(2)} (${rate}%)\n\n`;
                 // message += `*Grand Total:* ₹${grandTotal.toFixed(2)}\n\n`;
                  message += `------------------------\n`;
                  //const websiteLink = `https://qr-experts.com/codeigniter/website/products/${response.storeToken}/${response.orderNo}`;
                  const websiteLink = `http://localhost/codeigniter/cart/viewcart/${response.storeToken}`;
                  message += `For Re Order, visit: ${websiteLink}\n\n`;
                            const whatsappNumber = phoneNumber;
                            const encodedMessage = encodeURIComponent(message);
                            const whatsappURL = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
                            window.location.href=whatsappURL;
                            clearsession();
                }
            });
   }
  });
}

function clearsession(){
    $.ajax({
            url: '<?= base_url("website/products/clear_session") ?>',
            method: 'POST',
            success: function(datas) {
                
            }
        });
}
</script>


<script>
function sendToWhatsAppOrderWithDetails() {
  const phoneNumber = $('#delivery_type_phone').val(); 
  const name = $('#name').val(); 
  const phone = $('#phone').val(); 
  const address = $('#address').val();
  const store_id = $('#store_id').val(); 
  const type = $('#delivery_type').val();
  const table = '';
  
  $.ajax({
   url: '<?= base_url("website/products/typecheckout") ?>',
   method: 'POST',
   data: { name: name, phone: phone, address: address, store_id1: store_id, type: type },
   dataType: 'json',
   success: function(response) {
   
            $.ajax({
              url: '<?= base_url("cart/get") ?>',
              method: 'GET',
              success: function(data) {
                  var type = '<?= $tax_infr->tax_type;  ?>';
                  var rate = '<?= $tax_infr->tax_rate;  ?>';
                  
                  const cartData = JSON.parse(data);
                  let message = `*ORDER DETAILS: ${table}\n\n`;
                  message += `------------------------\n`;
                  message += `*Name:* ${name}\n`;
                  message += `*Phone:* ${phone}\n`;
                  message += `*Address:* ${address}\n`;
                  let overallTotal = 0;
                  let index = 0;
                  $.each(cartData, function(id, item) {
                    const itemTotal = item.price * item.quantity;
                    overallTotal += itemTotal; 
                    message += `${index + 1}. ${item.name} : ${item.price}x${item.quantity} = ₹${itemTotal.toFixed(2)}\n`;
                    index++;
                  });
                  message += `------------------------\n`;
                  let taxAmount = (overallTotal * rate) / 100; // Calculate tax amount
                  let grandTotal = overallTotal + taxAmount;  // Calculate grand total

                  message += `*SubTotal:* ₹${overallTotal.toFixed(2)}\n\n`;
                  message += `*${type}:* ₹${taxAmount.toFixed(2)} (${rate}%)\n\n`;
                  message += `*Grand Total:* ₹${grandTotal.toFixed(2)}\n\n`;
                  
                  const websiteLink = `https://qr-experts.com/codeigniter/website/products/shop/${response.store_id}/${response.order_type}/${response.orderNo}`;
                  message += `For Re Order, visit: ${websiteLink}\n\n`;
                  
                            const whatsappNumber = "917012713312";
                            const encodedMessage = encodeURIComponent(message);
                            const whatsappURL = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
                            window.location.href=whatsappURL;
                            clearsession();
                }
            });
   }
  });

}

function clearsession(){
    $.ajax({
            url: '<?= base_url("website/products/clear_session") ?>',
            method: 'POST',
            success: function(datas) {
                
            }
        });
}
</script>



<script>
        $(document).ready(function() {
        loadCart();

    // Update cart quantity
    function updateCartQuantity(productId, quantity) {
        $.ajax({
            url: '<?= base_url("cart/updateQuantity") ?>',
            method: 'POST',
            data: { product_id: productId, quantity: quantity },
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
              console.log(data);
                const cartData = JSON.parse(data);
                displayCart(cartData);
            }
        });
    }

    // Display cart items and update total items count and total value
    function displayCart(cartData) {
        $('#cart-items').empty();
        $('#addon-items').empty();
        let totalItems = 0;
        let cartTotal = 0;

        $.each(cartData, function(id, item) {
            const itemTotal = item.quantity * item.price;
            cartTotal += itemTotal;
            totalItems += item.quantity;
            if(item.is_addon == 0){ 
              
            $('#cart-items').append(
  `<div class="list-group-item d-flex justify-content-between align-items-center cart-item">
    <div class="col-6">
      <h6 class="mb-0 heading">${item.name}</h6>
      <small class="d-none">Short Description</small>
    </div>
    <div class="col-3 text-center product" data-id="${id}">
      <div class="d-flex align-items-center add-button2">
        <button class="btn-sm btn-outline-secondary decrement-btn" data-id="${id}">-</button>
        <input type="number" class="form-control1 quantity4" value="${item.quantity}" min="1">
        <button class="btn-sm btn-outline-secondary increment-btn" data-id="${id}">+</button>
      </div>
    </div>
    
    <div class="col-3 text-end">
      <p><b>${itemTotal} (${item.price} * ${item.quantity})</b></p>
    </div>
  </div>`
);

          }

            else{
              $('#addon-items').append(
  `<div class="list-group-item d-flex justify-content-between align-items-center cart-item">
    <div class="col-6">
      <h6 class="mb-0 heading">${item.name}</h6>
      <small class="d-none">Short Description</small>
    </div>
    <div class="col-3 text-end product" data-id="${id}">
      <div class="d-flex align-items-center add-button2">
        <button class="btn-sm btn-outline-secondary decrement-btn" data-id="${id}">-</button>
        <input type="number" class="form-control1 quantity4" value="${item.quantity}" min="1">
        <button class="btn-sm btn-outline-secondary increment-btn" data-id="${id}">+</button>
      </div>
    </div>
    
    <div class="col-3 text-end">
      <p><b>${itemTotal} (${item.price} * ${item.quantity})</b></p>
    </div>
  </div>`
);
            }

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
        
        vatPercentage = <?php echo $tax_infr->tax_rate; ?>


        $('#total-items').text(total+ ' Items Added' + ' ₹' + cartTotal.toFixed(2));
        $('#item-total').text(cartTotal.toFixed(2));
        $('#vat-total').text((cartTotal * (vatPercentage / 100)).toFixed(2));
        $('#grand-total').text((cartTotal + (cartTotal * (vatPercentage / 100))).toFixed(2));
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
            data: { product_id: productId },
            success: function() {
                loadCart();
            }
        });
    }
    
    // Increment button click
  $(document).on('click', '.increment-btn', function() {
        const product = $(this).closest('.product');
        const productId = product.data('id');
        const quantityInput = product.find('.quantity4');
        let quantity = parseInt(quantityInput.val()) + 1;
        quantityInput.val(quantity);
        updateCartQuantity(productId, quantity , 0);
  });

  // Decrement button click
  $(document).on('click', '.decrement-btn', function() {
    const product = $(this).closest('.product');
        const productId = product.data('id');
        const quantityInput = product.find('.quantity4');
        let quantity = parseInt(quantityInput.val()) - 1;
        if (quantity > 0) {
            quantityInput.val(quantity);
            updateCartQuantity(productId, quantity , 0);
        }
        else{
          deleteCartItem(productId , 0);
        }
  });
});

    </script>



