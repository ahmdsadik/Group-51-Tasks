<?php
global $conn;
$signed = false;
// Start Session
session_start();

// Check If User Is Logged In
if (!isset($_SESSION['user'])) {
    header('location:signin.php');
}

$signed = true;

// Include Database Connection
include_once('db_config.php');

// Get All products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get User Data From Session
$user = $_SESSION['user'];

// User Id
$user_id = $user['id'];
// Get User Name
$user_name = $user['user_name'];

// Get User Name
$name = $user['name'];

// Get User Email
$email = $user['email'];

// IF User Click Logout Button Delete Session And Redirect To Signin Page
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:signin.php');
}


// Get User Cart
$sql = "SELECT user_cart.id, p.title FROM user_cart JOIN products p on user_cart.product_id = p.id WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$cart = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Remove Item From Cart
if (isset($_POST['delete-item'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM user_cart WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    header('location:cart.php');
}

if (isset($_POST['selected'])) {
    echo "<pre>";
    print_r($_POST['selected']);
    echo "</pre>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <title>My Cart</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-tale-seo-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <!--

  TemplateMo 582 Tale SEO Agency

  https://templatemo.com/tm-582-tale-seo-agency

  -->
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Pre-Header Area Start ***** -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-9">
                <div class="left-info">
                    <ul>
                        <li><a href="#"><i class="fa fa-phone"></i><?= $name ?></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i><?= $email ?></a></li>
                        <!-- <li><a href="#"><i class="fa fa-map-marker"></i>St. London 54th Bull</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-3">
                <div class="social-icons">
                    <ul>
                        <li>
                            <form action="" method="post" id="logout" style="display: none;"></form>
                            <?php if ($signed) : ?>
                                <button form="logout" name="logout" value="logout"
                                        class="btn btn-primary text-white rounded-0">logout
                                </button>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Pre-Header Area End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo.png" alt="" style="max-width: 112px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="home.php" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="#services">Services</a></li>
                        <li class="scroll-to-section"><a href="#projects">Projects</a></li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="faqs.html">FAQs</a></li>
                            </ul>
                        </li>
                        <li class="scroll-to-section"><a href="#infos">Infos</a></li>
                        <li class="scroll-to-section"><a href="#contact">Contact</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<div class="main-banner" id="top">
    <div class="container">
        <div class="row">

            <div class="col-lg-7">
                <div class="table-responsive">
                    <div class="mb-3">
                        Your Cart has <?= count($cart) ?> items
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="selectAll" id="selectAll"
                                       class="form-check-input rounded-0"></th>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <form method="post" id="selectedItems">
                            <tbody>
                            <?php if (count($cart) > 0):
                                $i = 1;
                                ?>
                                <?php foreach ($cart as $item): ?>
                                <tr>
                                    <th><input name="selected[]" value="<?= $item['id'] ?>" type="checkbox"
                                               class="form-check-input rounded-0"></th>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $item['title'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger rounded-0 del-btn"
                                                data-item-id="<?= $item['id'] ?>"
                                                data-bs-toggle="modal" data-bs-target="#delete-item">
                                            Remove
                                        </button>
                                    </td>
                                </tr>

                                <?php $i++; endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">No Items</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>

                        </form>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <button form="selectedItems" class="btn btn-success text-white rounded-0">Make the Deal</button>
                </div>
            </div>

            <!-- Delete Item Modal -->
            <div class="modal fade " data-easein="bounceIn" id="delete-item" tabindex="-1" aria-labelledby="deleteModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="delete-modal">Delete Item</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="id" id="delete-item-id">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="delText"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="delete-item"
                                        value="delete-item">
                                    Delete Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/popup.js"></script>
<script src="assets/js/custom.js"></script>

<script>
    $(document).ready(function () {
        $('.del-btn').click(function () {
            var id = $(this).data('item-id');
            $('#delete-item-id').val(id);

            $('.delText').html(`Are you sure you want to delete ?`);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#selectAll').click(function () {
            if ($(this).is(':checked')) {
                $('input[name="selected[]"]').prop('checked', true);
            } else {
                $('input[name="selected[]"]').prop('checked', false);
            }
        });
    });
</script>

</body>

</html>