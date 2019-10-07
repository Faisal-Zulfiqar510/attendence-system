hello <?php echo $data['name']?>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="../../../public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap.min.css.map">
    <link rel="stylesheet" type="text/css" href="../../../public/bootstrap-4.0.0-dist/css/bootstrap-grid.min.css.map">

    <script type="text/javascript" src="../../../public/js/jquery-3.4.1.js"></script>
    <script src="../../../public/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="login-form">
    <form action="/examples/actions/confirmation.php" method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>
    </form>

</div>
</body>
</html>
