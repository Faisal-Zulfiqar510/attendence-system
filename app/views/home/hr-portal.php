<?php
include 'Header.php';?>
<html>
<head>
    <div id="show_employee">
        <h2 class="text-center pt-2 pb-2" >Employees List</h2>
    </div>
</head>
<body>
<div class="table-responsive">
    <table  class="table table-striped table-bordered table-hover table-condensed text-center">
        <thead>
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Username</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Manager</th>
            <th>Designation</th>
            <th>Profile Pic</th>
            <th colspan="2">Action</th>

        </tr>
        </thead>
        <tbody>
        <?php


        //print_r($data);
        foreach ($data['book'] as $book) {
            //var_dump($book);die;

            $cover_name = "../../../app/uploadedPic/" . $book['profile_pic'];
            ?>
            <td><?php echo $book['name'] ?></td>
            <td><?php echo $book['email'] ?></td>
            <td><?php echo $book['username'] ?></td>
            <td><?php echo $book['dept'] ?></td>
            <td><?php echo $book['salary'] ?></td>
            <td><?php echo $book['manager'] ?></td>
            <td><?php echo $book['designation'] ?></td>
            <td><img src="<?php echo $cover_name ?>" height="40" style="cursor: pointer" width="40"
                     onclick='window.open("<?php echo $cover_name ?>","_blank");'></td>
            <td>

                <?php echo "<button type='button' name='delete' value=" . $book['id'] . "  class='btn btn-outline-danger' onclick='delRow(this.value)' >Delete Row</button>" ?> </td>
            <td>
                <?php echo "<button type='button' name='edit' value=" . $book['id'] . "  class='btn btn-outline-info' onclick='editRow(this.value)' >Edit Row</button>" ?> </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script>
    function delRow(val) {
        let ans = confirm("Are you sure to delete entry from table");
        console.log(ans);
        if (ans) {
            window.location.replace("../../home/delEmp/"+val);
            //alert(val);
        } else {
            return;
        }

    }
    function editRow(val)
    {
        window.location.replace("../../home/editEmp/"+val);
    }
</script>
</body>
</html>
