<style>
/* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* A4 paper size and layout for printing */
.print-area {
    width: 210mm;
    height: 297mm;
    margin: 0 auto;
    padding: 10mm;
    box-sizing: border-box;
    overflow: hidden;
}

/* Floated QR cards */
.card {
    float: left;
    width: 40%;
    /* Two cards per row (48% with 2% gap) */
    height: 40%;
    /* Adjust height to fit 4 cards per page */
    border: 1px solid #ddd;
    border-radius: 8px;
    text-align: center;
    background-color: #f9f9f9;
    margin-bottom: 5mm;
    margin-right: 2%;
    box-sizing: border-box;
    position: relative;
    overflow: hidden;
    page-break-inside: avoid;
}



/* Clear floats after every row */
.clearfix {
    clear: both;
}

/* QR card styles */
.card img.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.qr-card {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    text-align: center;
}

.qr-card img {
    width: 145px;
    height: 145px;
}

.card-title {
    position: absolute;
    bottom: 100px;
    left: 45%;
    transform: translateX(-50%);
    font-size: 14px;
    font-weight: bold;
    background: rgba(255, 255, 255, 0.8);
    padding: 5px 10px;
    border-radius: 5px;
    z-index: 3;
}
</style>

<div class="print-area">
    <?php if (!empty($tableQrCodes)) { ?>
    <?php foreach ($tableQrCodes as $index => $qrcode) { ?>
    <div class="card">
        <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Background">
        <div class="qr-card">
            <img src="<?php echo $qrcode['qr_code']; ?>" alt="QR Code">
        </div>
        <h5 class="card-title">
    <?php 
        $table_display = !empty($qrcode['store_table_name']) ? $qrcode['store_table_name'] : $qrcode['table_name'];
        echo htmlspecialchars($table_display);
    ?>
</h5>

    </div>
    <?php if (($index + 1) % 2 == 0) { ?>
    <div class="clearfix"></div> <!-- Clear floats after every 2 cards -->
    <?php } ?>
    <?php if (($index + 1) % 4 == 0) { ?>
    <div style="page-break-after: always;"></div> <!-- Add page break after every 4 cards -->
    <?php } ?>
    <?php } ?>
    <?php } else { ?>
    <p>No QR codes available.</p>
    <?php } ?>
</div>