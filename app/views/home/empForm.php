<?php
include 'base.php';
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
<div class="employee-form">
    <form action="../../home/addEmp" method="post">
        <h4 class="text-center">Employee Form</h4>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="text" name="dept" class="form-control" placeholder="Department Name" required="required">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="salary" placeholder="Salary" required="required">
        </div>
        <div class="form-group">
            <select name="designation" class="designation dropdown dropdown-toggle dropdown-header" >
                <option class="dropdown-item" value="">Select Designation</option>
                <option class="dropdown-item" value="Ceo">Ceo</option>
                <option class="dropdown-item" value="HR">HR</option>
                <option class="dropdown-item" value="Developer">Developer</option>
                <option class="dropdown-item" value="Manager">Manager</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="addEmp" formmethod="post" class="btn btn-primary btn-block">Add Employee</button>
        </div>

    </form>

</div>
</body>
</html>

