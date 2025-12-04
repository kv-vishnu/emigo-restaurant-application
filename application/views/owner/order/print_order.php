<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<div class="row">
    <input type="hidden" id="order_id" value="<?php echo $order_no;?>">

    <div class="container">
        <div class="row">

            <style>
                .invoice-container {
                    max-width: 99%;
                    background: #fff;
                    border-radius: 8px;
                }

                .header {
                    text-align: center;
                    border-bottom: 2px solid #eee;
                    padding-bottom: 10px;
                }

                .header h1 {
                    margin: 0;
                    color: #333;
                }

                .header p {
                    margin: 5px 0;
                    color: #666;
                    font-size: 14px;
                }

                .items {
                    width: 100%;
                    margin: 20px 0;
                    border-collapse: collapse;
                }

                .items th,
                .items td {
                    padding: 10px;
                    text-align: left;
                    border: 1px solid #ddd;
                }

                .items th {
                    background: #f4f4f4;
                    font-weight: bold;
                }

                @media print {
                    body {
                        margin: 0;
                        padding: 0;
                    }

                    table {
                        page-break-inside: auto;
                    }
                }
            </style>

            <body>
                <div class="invoice-container" id="printableArea">

                    <div class="header">
                        <img width="150px"
                            src="<?php echo base_url(); ?>/uploads/store/<?php echo $storeDet[0]['store_logo_image']; ?>"
                            alt="Restaurant Logo" class="logo">

                        <h5 class="mt-2"><?php echo $storeDet[0]['store_name']; ?></h5>
                        <p><?php echo $storeDet[0]['store_address']; ?></p>
                        <p>Phone: <?php echo $storeDet[0]['store_phone']; ?></p>
                        <p>Email: <?php echo $storeDet[0]['store_email']; ?></p>

                        <?php
                            switch ($order_type) {
                                case 'D':  $order_text = 'Dine In - ' . $table_name; break;
                                case 'PK': $order_text = 'Pickup'; break;
                                case 'DL': $order_text = 'Delivery'; break;
                                default:   $order_text = 'Unknown';
                            }
                        ?>
                        <p><?php echo $order_text; ?></p>
                    </div>

                    <table class="items">
                        <thead>
                            <tr>
                                <th width="5%">Sl</th>
                                <th width="25%">Item</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Price</th>
                                <th width="10%">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $grand_total = 0;
                                $sl = 1;
                            ?>

                            <?php foreach($order_items as $orders):

                                $item_quantity = $orders['quantity'] - $orders['return_qty'];
                                $row_total = $orders['rate'] * $item_quantity;
                                $grand_total += $row_total;
                            ?>

                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $this->Ordermodel->getProductName($orders['product_id']); ?></td>
                                <td><?php echo $item_quantity; ?></td>
                                <td><?php echo number_format($orders['rate'], 2); ?></td>
                                <td><?php echo number_format($row_total, 2); ?></td>
                            </tr>

                            <?php endforeach; ?>

                            <?php
                                $vat = round($grand_total * 0.05, 2);
                                $total_amount = round($grand_total + $vat, 2);
                            ?>

                            <tr>
                                <td colspan="12" class="text-end">
                                    Subtotal : <b><?php echo number_format($grand_total, 2); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-end">
                                    VAT (5%) : <b><?php echo number_format($vat, 2); ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="text-end">
                                    Total : <b><?php echo number_format($total_amount, 2); ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="text-center">
                    <p>Thank you, visit again</p>
                    <p>Consume packed food within 2 hours.</p>

                    <button class="btn btn-primary print_order_bill">Print</button>
                </div>
            </body>
        </div>
    </div>
</div>
