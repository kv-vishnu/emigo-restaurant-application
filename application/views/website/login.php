<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('website/user/login_user'); ?>
    <label for="email">Email:</label>
    <input type="text" name="email" /><br>

    <label for="password">Password:</label>
    <input type="password" name="password" /><br>

    <input type="submit" value="Login" />
    <?php echo form_close(); ?>

    <p>Don't have an account? <a href="<?php echo site_url('website/user/register'); ?>">Register</a></p>
</body>
</html>
