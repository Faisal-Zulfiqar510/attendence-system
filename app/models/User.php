<?php
 class User
 {
     public $name;
     /*protected function getallUsers()
     {
         $sql = "SELECT * FROM user";
         $result = $this->connect()->query($sql);
         $numRows = $result->num_rows;
         if ($numRows > 0)
         {
             while ($row = $result->fetch_assoc())
             {
                 $data[] = $row;
             }
             return $data;
         }
     }*/
    public $student_one = array("Maths"=>95, "Physics"=>90,
        "Chemistry"=>96, "English"=>93,
        "Computer"=>98);
 }