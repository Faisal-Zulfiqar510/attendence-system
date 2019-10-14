 <?php
session_start();
include 'base.php';
 if (isset($_SESSION['developer'])) {
     header('Location:/attendance-system/public/home/emp/');
 }
?>

<html>
<head>

    <link rel="stylesheet" type="text/css" href="../../../public/css/stylesheet.css">
   <!-- <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="../../../public/js/jquery-3.4.1.js"></script>
    <script src="../../../public/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
-->


</head>
<body>
<div class="login-form">
    <form action="../../home/login/" method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="text" id="userName" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div>
            <span id="error_msg"></span>
        </div>
    </form>

</div>
<script>
    $('#error_msg').html("<?php echo $data['error']?>");
    $('#userName').val("<?php echo $data['userName']?>");
</script>
</body>
</html>
