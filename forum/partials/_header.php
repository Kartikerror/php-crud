<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>';




      
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '     <form class="d-flex" method="get" action="search.php">
        <input class="form-control me-2" type="search"  name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
            <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . ' </p>
            <a href="partials/_logout.php" class="btn btn-outline-success">Logout</a>
            </form>';
} else {
  echo '<form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" data-bs-target="#loginModal" style="margin-left: 10px;">Login</button>
      <button class="btn btn-outline-success" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal" style="margin-left: 10px;">Signup</button>';
}
echo  '</div>
  </div>
</nav>';
include 'loginmodal.php';
include 'signup.php';
include '_handleSignup.php';
include '_handleLogin.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Account is Created.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] != "true") {
  echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
  <strong>Fail!</strong> Invalid Credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your are Logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] != "true") {
  echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
  <strong>Fail!</strong> Invalid Credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
