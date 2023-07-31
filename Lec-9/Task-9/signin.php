<?php
$errors = '';
if (isset($_POST['sign'])) {
  // Get Data From POST Request
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Connect To Database
  $conn = mysqli_connect('localhost', 'root', '', 'project');

  // Check If Email And Password Are Correct
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

  // Execute Query
  $result = mysqli_query($conn, $sql);

  // Fetch Data
  $user = mysqli_fetch_assoc($result);

  // Check if user is exist
  if ($user) {
    // Start Session
    session_start();

    // Set Session Data
    $_SESSION['user'] = $user;

    // Check If User Is Admin in column is_admin
    if ($user['is_admin'] == 1) {
      // Redirect To Dashboard
      header('location: dashboard.php');
    } else {
      // Redirect To Home Page
      header('location: home.php');
    }
    session_write_close();
    exit;
  } else {
    // Set Error Message
    $error = 'Email or Password is incorrect';
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Sign In</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-light">
  <div class="layer"></div>
  <main class="page-center shadow-lg">
    <article class="sign-up">
      <h1 class="sign-up__title">Welcome back!</h1>
      <p class="sign-up__subtitle">Sign in to your account to continue</p>
      <form class="sign-up-form form" action="" method="POST">
        <?php if (isset($error) && !empty($error)) : ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <label class="form-label-wrapper">
          <p class="form-label">Email</p>
          <input class="form-input" type="email" name="email" placeholder="Enter your email" required>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">Password</p>
          <input class="form-input" type="password" name="password" placeholder="Enter your password" required>
        </label>
        <button class="form-btn primary-default-btn transparent-btn" name="sign" value="sign">Sign in</button>
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