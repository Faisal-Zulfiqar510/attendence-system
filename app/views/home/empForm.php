<?php
include 'base.php';

/*if(!(isset($_SESSION['hr']))) {
   header('Location: ../../home/index/');
} elseif (!(isset($_SESSION['ceo']))) {
    header('Location: ../../home/index/');
}*/
//print_r($data['col']);
//var_dump($data['col'][0]['name']);

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
 --> <script>
        $(document).ready(function () {
            <?php if (isset($_SESSION['hr'])) {?>
            $('#designation #dropdown_ceo').prop('disabled',true);
            <?php }?>

        })
    </script>


</head>
<body>
<div class="employee-form">
    <form>
        <h4 class="text-center">Employee Form</h4>
        <input type="hidden" id="id" name="id" >
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required">
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required="required">
        </div>
        <div class="form-group">
            <input type="text" name="user_name" id="username" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="text" name="dept" class="form-control" id="dept" placeholder="Department Name" required="required">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary" required="required">
        </div>
        <div class="form-group">
            <select name="designation" id="designation" onchange="selected(this.value)" class="designation dropdown dropdown-toggle dropdown-header" >
                <option class="dropdown-item" value="">Select Designation</option>
                <option class="dropdown-item" id="dropdown_ceo" value="Ceo">Ceo</option>
                <option class="dropdown-item" value="HR">HR</option>
                <option class="dropdown-item" value="Developer">Developer</option>
                <option class="dropdown-item" value="Manager">Manager</option>
            </select>
        </div>

        <div class="form-group" id="manager_div" style="display: none">
            <select name="manager" id="manager" class="designation dropdown dropdown-toggle dropdown-header">
                <?php foreach ($data['col'] as $manager) {?>
                <option class="dropdown-item" value="<?php echo $manager['id']?>"><?php echo $manager['name']?></option>
                <?php }?>
            </select>
        </div>

        <div id="test"></div>

        <div class="form-group">
            <input type="file" class="form-control" id="image" onchange="isSelected()" name="image" placeholder="Browse">
            <div id="imgSelected"></div>
        </div>
        <div class="form-group text-center">
            <button type="submit" id="btnSubmit" name="addEmp" formaction="../../home/addEmp" formmethod="post" formenctype="multipart/form-data" class="btn btn-primary">Add Employee</button>
            <button type="submit" id="btnUpdate" name="updateEmp" formaction="../../home/updateEmp" formmethod="post" formenctype="multipart/form-data" class="btn btn-primary">Update</button>
            <button type="button" id="btnCancel" class="btn btn-danger" name="btnCancel" onclick="window.location.replace('../../home/index/')">Cancel</button>
        </div>

    </form>

</div>

<script>
    function selected(val) {

        if (val == "Developer") {
            console.log(val);
           $('#manager_div').css('display', 'block');

        }else {
        $('#manager_div').css('display', 'none');
        }

    }


    function isSelected() {
        $(".error").remove();
        let size = $("#image")[0].files[0].size;
        console.log("in selected", size);
        $("#btnUpdate").removeAttr("disabled", true);
        $("#btnSubmit").removeAttr("disabled", true);
        //$(this).removeClass('input-validation-error').next('span').text('');

        if (size > 2621440) {
            $("#image").after('<span class="error" style="color: #b8daff">File size must 2.5mb or below</span>');
            $("#btnUpdate").attr("disabled", true);
            $("#btnSubmit").attr("disabled", true);
        }
        if ($("#image").val() != "") {
            console.log("remove");
            $("#myImage").remove();


        }
    }


</script>

<?php

if ($_SESSION['status'] == "yes") {
     $book = $data['column'];
        $path = "../../../app/uploadedPic/" . $book['profile_pic'];

        ?>
        <script>

            $("#name").val("<?php echo $book['name']; ?>");
            $("#id").val("<?php echo $book['id']; ?>");
            $("#email").val("<?php echo $book['email'] ;?>");
            $("#username").val("<?php echo $book['username'] ;?>");
            $("#dept").val("<?php echo $book['dept'] ;?>");
            $("#salary").val("<?php echo $book['salary'] ;?>");
            $("#designation").val("<?php echo $book['designation'] ;?>");

            $('#btnUpdate').css("display", "inline-block");
            $('#btnSubmit').css("display", "none");
            if ($("#image").val() == "") {
                $("#image").removeAttr("required");

                let img = $('<img />').attr({
                    'id': 'myImage',
                    'src': "<?php echo $path; ?>",
                    'alt': "../../../app/uploadedPic/alternative_img.png",
                    'width': 50,
                    'height': 50,
                    'style': "cursor:pointer"
                }).appendTo('#imgSelected');
            }

            //console.log("innnn");

        </script>
        <?php
        $_SESSION['status'] = 'no';
} ?>

</body>
</html>

