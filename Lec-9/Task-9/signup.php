<?php
$errors = [];
if (isset($_POST['reg'])) {
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";

  $name = $_POST['name'];
  $user_name = $_POST['user_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check Name Contains only letters the name may contain space
  if (empty(!$name)) {
    if (preg_match('/^[a-zA-Z ]+$/', $name)) {
    } else {
      $errors['name'] = 'Name should contains only letters.';
    }
  } else {
    $errors['name'] = 'Name should not be empty.';
  }


  // Check User Name
  if (empty(!$user_name)) {
    if (preg_match('/^.{4,}$/', $user_name)) {
      if (!preg_match('/^[A-Za-z0-9]+$/', $user_name)) {
        $errors['user_name'] = 'User Name should contains only letters and numbers.';
      }
    } else {
      $errors['user_name'] = 'User Name should be longer than 6 characters.';
    }
  } else {
    $errors['user_name'] = 'User Name should not be empty.';
  }

  // Check Email
  if (empty(!$email)) {
    if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
    } else {
      $errors['email'] = 'Email address is invalid.';
    }
  } else {
    $errors['email'] = 'Email should not be empty.';
  }

  // Check Password: Password at least 4.
  if (empty(!$password)) {
    if (!preg_match('/^.{4,}$/', $password)) {
      $errors['password'] = 'Password at least 4.';
    }
  } else {
    $errors['password'] = 'Password should not be empty.';
  }

  if (count($errors) == 0) {

    // connect to database and insert data
    $conn = mysqli_connect('localhost', 'root', '', 'project');
    $sql = "INSERT INTO users (name, user_name, email, password) VALUES ('$name', '$user_name', '$email', '$password')";
    mysqli_query($conn, $sql);


    header('location:signin.php');
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Sign Up</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="layer"></div>
  <main class="page-center">
    <article class="sign-up">
      <h1 class="sign-up__title">Get started</h1>
      <p class="sign-up__subtitle">Start creating the best possible user experience for you customers</p>
      <form class="sign-up-form form" action="" method="post">
        <label class="form-label-wrapper">
          <p class="form-label">Name</p>
          <input class="form-input " type="text" name="name" placeholder="Enter your Name" required>
          <?php if (array_key_exists('name', $errors)) : ?>
            <div class="text-danger mb-3">
              <?= $errors['name'] ?>
            </div>
          <?php
          endif; ?>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">User Name</p>
          <input class="form-input " type="text" name="user_name" placeholder="Enter your User name" required>
          <?php if (array_key_exists('user_name', $errors)) : ?>
            <div class="text-danger mb-3">
              <?= $errors['user_name'] ?>
            </div>
          <?php
          endif; ?>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">Email</p>
          <input class="form-input " type="email" name="email" placeholder="Enter your email" required>
          <?php if (array_key_exists('email', $errors)) : ?>
            <div class="text-danger mb-3">
              <?= $errors['email'] ?>
            </div>
          <?php
          endif; ?>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">Password</p>
          <input class="form-input " type="password" name="password" placeholder="Enter your password" required>
          <?php if (array_key_exists('password', $errors)) : ?>
            <div class="text-danger mb-3">
              <?= $errors['password'] ?>
            </div>
          <?php
          endif; ?>
        </label>
        <button class="form-btn primary-default-btn transparent-btn" name="reg" value="reg">Register</button>
        <div class="mt-3">
          Have Account
          <a href="signin.php">Login</a>
        </div>
      </form>
    </article>
  </main>
  <!-- Chart library -->
  <script src="./plugins/chart.min.js"></script>
  <!-- Icons library -->
  <script src="plugins/feather.min.js"></script>
  <!-- Custom scripts -->
  <script src="js/script.js"></script>
</body>

</html>