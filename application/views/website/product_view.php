<!-- product_view.php -->
<html>
<head>
    <title><?php echo $product['title']; ?></title>
</head>
<body>

<h1><?php echo $product['title']; ?></h1>
<p><?php echo $product['description']; ?></p>
<p>Price: <?php echo $product['price']; ?></p>

<!-- Links to switch language -->
<a href="<?php echo base_url('website/products/set_language/ma'); ?>">Malayalam</a> |
<a href="<?php echo base_url('website/products/set_language/en'); ?>">English</a> |
<a href="<?php echo base_url('website/products/set_language/hi'); ?>">Hindi</a> |
<a href="<?php echo base_url('website/products/set_language/ar'); ?>">Arabic</a> 

</body>
</html>
