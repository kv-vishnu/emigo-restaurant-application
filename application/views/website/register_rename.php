<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('website/user/register_user'); ?>

    <label for="username">Name:</label>
    <input type="text" name="name" /><br>

    <label for="username">Username:</label>
    <input type="text" name="username" /><br>

    <label for="email">Email:</label>
    <input type="text" name="email" /><br>

    <label for="password">Password:</label>
    <input type="password" name="password" /><br>

    <input type="submit" value="Register" />
    <?php echo form_close(); ?>

    <p>Already registered? <a href="<?php echo site_url('website/user/login'); ?>">Login</a></p>
</body>
</html>
