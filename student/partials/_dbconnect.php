$sql="UPDATE `student` SET `student_name` = '$student_name', `student_branch` = '$student_branch', `student_email` = '$student_email',`student_id` ='$student_id' 
";


$sql = "DELETE FROM `student` WHERE `student_id` = '$student_id';




$student_id = $_POST["eid"];
    $student_name = $_POST["ename"];
    $student_branch = $_POST["ebranch"];
    $student_email = $_POST["eemail"];
    

    // Sql query to be executed
    $sql = "INSERT INTO `student` (`student_id`, `student_name`, `student_branch`, `student_email`, `date`) VALUES ('$student_id', '$student_name', '$student_branch', '$student_email', current_timestamp())
    ";