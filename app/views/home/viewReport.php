<?php
include 'Header.php';
?>
<html>
<head>


</head>
<body>
<div class="table-responsive">
    <table id="reportTable"  class="table table-striped table-bordered table-hover table-condensed text-center">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['att'] as $book) {
            ?>
            <tr>
            <td><?php  echo $data['emp'][$book['emp_id']]; ?></td>
            <td><?php echo $book['date'];?></td>
                <?php if ($book['status'] == 0) { ?>
            <td>Absent</td>
                <?php } else {?>
                <td>Late</td>
                <?php } ?>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready( function () {
        $('#reportTable').DataTable();
    } );
</script>

</body>
</html>
