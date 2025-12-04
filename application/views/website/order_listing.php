<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet preload" href="<?php echo site_url(); ?>assets/website/css/plugins.css" as="style">
    <link rel="stylesheet preload" href="<?php echo site_url(); ?>assets/website/css/style.css" as="style">
    <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/user-custom-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
    body {
        font-family: 'Poppins' !important;
    }
    .cart-item img {
        max-width: 60px;
        height: auto;
    }

    .total-price {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .out_of_stock_warning {
        background: #f9f9f9;
        border-radius: 10px;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .out_of_stock_warning p,
    li {
        color: #ef4f5f !important;
        font-size: 14px !important;
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
        border: none;
        border-radius: 5px;
        cursor: pointer;
        animation: bounce 1s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
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

    <div class="user-cart-page">
        <div class="user-cart-page_title">
            <span class="left"><i class="fa fa-shopping-basket cart-icon"></i></span>
            <span class="right">My Orders</span>
        </div>
        <input type="hidden" id="reorder_link" value="<?php echo $reorder_link; ?>">

        <!-- Header Section -->
        <?php
  $this->load->model('website/Homemodel');
  $prevous_orders = $this->Homemodel->get_prevous_orders($order_number , $store_id);
  $order_summary = $this->Homemodel->get_prevous_order_summary($order_number , $store_id);

  if(!empty($prevous_orders)){ ?>

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
        <div class="user-cart-page__cart-total-container mt-5">
            <h6 class="user-cart-page__total-label">Total : </h6>
            <h6 class="user-cart-page__total-count"><?php echo $order_summary['amount']; ?></h6>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <h6 class="user-cart-page__total-label">
                <?php echo $tax_infr->tax_type;  ?> :
                    <!--(<?php echo $tax_infr->tax_rate;  ?> %)-->
            </h6>

            <h6 class="user-cart-page__total-count" id="vat-total">
                <?php
        if (isset($tax_infr->tax_rate) && isset($order_summary['amount'])) {
            $tax_amount = ($order_summary['amount'] * $tax_infr->tax_rate) / 100;
            echo number_format($tax_amount, 2);
        } else {
            echo '0.00';
        }
    ?>
            </h6>

        </div>

        <?php } ?>

        <input type="hidden" id="subtotal_previous" value="
<?php if(isset($order_summary))
{ echo $order_summary['amount'];
}
else
{
echo 0 ;
}; ?>">



        <div class="user-cart-page__cart-grand-total-container mt-1">
            <h6 class="user-cart-page__cart-grand-total-label">Grand Total  :  &nbsp;</h6>
            <h6 id="grand-total" class="user-cart-page__cart-grand-total-count"><?php
        if (isset($order_summary['amount']) && isset($tax_infr->tax_rate)) {
            $grand_total = $order_summary['amount'] + (($order_summary['amount'] * $tax_infr->tax_rate) / 100);
            echo number_format($grand_total, 2);
        } else {
            echo '0.00';
        }
    ?></h6>
        </div>

        <!--Thank you message-->
        <div class="user-cart-page_order_success">
            <span class="user-cart-page_thank_you">Thank you for your order! </span>
            <p class="user-cart-page_message">We have received your request and are preparing your delicious meal with
                care.</p>
        </div>
        <!--Thank you message end-->


        <a href="<?php echo $reorder_link; ?>" id="reorder_now" class="btn w-100 btn-checkout-new p-3 me-3 bouncing-button"
            style="font-size: 15px;border-radius: 10px;">For Reorder</a>

        <!--<a  class="btn w-50 test p-3 me-3" onclick="FnblankspaceTotal()" style="font-size: 15px;border-radius: 10px;">Add More Item</a>-->

        <!-- The Modal -->
        <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This is a simple Bootstrap modal popup.
                    </div>
                </div>
            </div>
        </div>
        <!-- validation -->
    </div>


    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- plugins js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/plugins.js"></script>

    <!-- custom js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/main.js"></script>
    <!-- header style two End -->
    <script>
    $(document).ready(function() {
        $('#reorder_now').on('click', function() {
            const reorder_link = $('#reorder_link').val();
            $.ajax({
                url: '<?= base_url("website/products/clear_session") ?>',
                type: 'POST',
                success: function(response) {
                    window.location.href = reorder_link;
                }
            });
        })

        // Prevent back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };


    });
    </script>
</body>

</html>