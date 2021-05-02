<?php
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $student_enroll = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `student` WHERE `student_enroll` = '$student_enroll'";

    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $student_enroll = $_POST["titleEdit"];
        $student_name = $_POST["nameEdit"];
        $student_branch = $_POST["branchEdit"];
        $student_email = $_POST["emailEdit"];

        // Sql query to be executed
        $sql = "UPDATE `student` SET `student_enroll` = '$student_enroll', `student_name` = '$student_name', `student_branch` = '$student_branch', `student_email` = '$student_email' WHERE `student`.`student_enroll` = '$sno'
        ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        $student_enroll = $_POST["sid"];
        $student_name = $_POST["sname"];
        $student_branch = $_POST["sbranch"];
        $student_email = $_POST["semail"];


        // Sql query to be executed
        $sql = "INSERT INTO `student` (`student_enroll`, `student_name`, `student_branch`, `student_email`, `date`) VALUES ('$student_enroll', '$student_name', '$student_branch', '$student_email', current_timestamp())
    ";
        $result = mysqli_query($conn, $sql);


        if ($result) {
            $insert = true;
        } else {
            echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="../student/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Enrollment_No</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Name</label>
              <textarea class="form-control" id="nameEdit" name="nameEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="desc">Branch</label>
              <textarea class="form-control" id="branchEdit" name="branchEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="desc">Email</label>
              <textarea class="form-control" id="emailEdit" name="emailEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Data has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Data has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Data has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <div class="container my-4">
        <h2>Student Data</h2>
        <form action="../student/index.php" method="POST">
            <div class="form-group">
                <label for="title">Student Enrollment_No</label>
                <input type="text" class="form-control" id="sid" name="sid" aria-describedby="emailHelp">

                <label for="title">Student Name</label>
                <input type="text" class="form-control" id="sname" name="sname" aria-describedby="emailHelp">

                <label for="title">Student branch</label>
                <input type="text" class="form-control" id="sbranch" name="sbranch" aria-describedby="emailHelp">
                <label for="title">Student Email</label>
                <input type="text" class="form-control" id="semail" name="semail" aria-describedby="emailHelp">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-4">


<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Enrollment</th>
      <th scope="col">Name</th>
      <th scope="col">Branch</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `student`";
    $result = mysqli_query($conn, $sql);
    $sno = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $sno = $sno + 1;
      echo "<tr>
        <th scope='row'>" . $sno . "</th>
        <td>" . $row['student_enroll'] . "</td>
        <td>" . $row['student_name'] . "</td>
        <td>" . $row['student_branch'] . "</td>
        <td>" . $row['student_email'] . "</td>
        <td> <button class='edit btn btn-sm btn-primary' id=" . $row['student_enroll'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['student_enroll'] . ">Delete</button>  </td>
      </tr>";
    }
    ?>


  </tbody>
</table>
</div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        name = tr.getElementsByTagName("td")[1].innerText;
        branch = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
        console.log(title, name,branch,email);
        titleEdit.value = title;
        nameEdit.value = name;
        branchEdit.value = branch;
        emailEdit.value = email;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `../student/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        } else {
          console.log("no");
        }
      })
    })
  </script>


</body>

</html>