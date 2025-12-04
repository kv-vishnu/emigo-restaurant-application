<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Emigo: Powered by Emigo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Grocery, Store, stores">
    <title>Emigo</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/images/favicon.ico">
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/user-custom-styles.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body,
    html {
        height: 100%;
    }

    .background {
        /* background: url('background.jpg') no-repeat center center/cover; */
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #efefef;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
    }
    </style>
</head>

<body>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Bootstrap Modal -->

    <div class="background">
        <div class="form-container">
            <h2>Secret Code Varification</h2>
            <form>
                <input type="text" id="secret_code_hidden" value="<?php echo $secret_code; ?>">
                <input type="hidden" id="token" value="<?php echo $token; ?>">
                <p>Please enter the secret code to proceed:</p>
                <input type="password" id="secretCode" class="form-control" placeholder="Enter code">
                <p id="errorMessage" class="text-danger mt-2" style="display: none;"></p>
                <button type="button" class="btn btn-primary" id="verifyButton">Verify</button>
            </form>
        </div>
    </div>


</body>
<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    // Show modal on page load
    $("#verifyButton").click(function() {
        let base_url = $('#base_url').val();
        let enteredCode = $("#secretCode").val(); //You entered secret code
        let correctCode = $("#secret_code_hidden").val(); //Your secret code
        let token = $("#token").val();

        if (enteredCode === correctCode) {
            window.location.href =
                `${base_url}website/load_orders/${token}/0`;
        } else {
            $("#errorMessage").text("Incorrect code. Try again!").show();
        }
    });
});
</script>

</html>