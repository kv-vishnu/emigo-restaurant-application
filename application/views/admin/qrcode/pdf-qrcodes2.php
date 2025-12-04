<style>
/* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* A4 paper size for printing */
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    .print-area {
        width: 210mm;
        /* A4 width */
        height: 297mm;
        /* A4 height */
        margin: 0 auto;
        page-break-after: always;
    }
}

/* Layout for the QR cards */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 0;
    padding: 20px;
    box-sizing: border-box;
}

.col-6 {
    flex: 1 1 48%;
    /* Set 48% width to ensure two cards fit in a row */
    max-width: 48%;
    padding: 10px;
    box-sizing: border-box;
    page-break-inside: avoid;
    /* Avoid breaking a single card across pages */
    margin-bottom: 20px;
    /* Add some space between rows */
}

/* Card styling */
.card {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    text-align: center;
    background-color: #f9f9f9;
    height: 450px;
    /* Adjust card height to fit two cards per row */
}

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
    width: 160px;
    /* Adjust the QR code image size */
    height: 140px;
}

.card-title {
    position: absolute;
    bottom: 10px;
    left: 50%;
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
    <div class="row">
        <?php if (!empty($tableQrCodes)) { ?>
        <?php foreach ($tableQrCodes as $qrcode) { ?>
        <div class="col-6">
            <div class="card">
                <img src="<?php echo base_url(); ?>uploads/qrbg.jpg" class="card-img-top" alt="QR Background">
                <div class="qr-card">
                    <img src="<?php echo $qrcode['qr_code']; ?>" alt="QR Code">
                </div>
                <h5 class="card-title"><?php echo htmlspecialchars($qrcode['table_name']); ?></h5>
            </div>
        </div>
        <?php } ?>
        <?php } else { ?>
        <p>No QR codes available.</p>
        <?php } ?>
    </div>
</div>