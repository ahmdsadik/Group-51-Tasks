<?php

// Start Session
global $conn;
session_start();

// Check If User Is Logged In
if (!isset($_SESSION['user'])) {
    header('location:signin.php');
}

require_once 'db_config.php';

// Get User Data From Session
$user = $_SESSION['user'];

// Get User Name
$user_name = $user['user_name'];

// Get User Name
$name = $user['name'];

// Get User Email
$email = $user['email'];


// Get All Categories Data From Database
$sql = "SELECT * FROM categories";
// Execute Query
$result = mysqli_query($conn, $sql);

// Fetch All Data
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);


// IF User Click Logout Button Delete Session And Redirect To Signin Page
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:signin.php');
    exit;
}

// If User Click Add product Button
if (isset($_POST['add-category'])) {

    $name = $_POST['name'];

    $file = $_FILES['image_url'];
    $file_error = $file['error'];
    if ($file_error != 4) {
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];


        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = 'uploads/images/' . $file_name_new;
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        $file_destination = null;
    }


    // Check Name Contains only letters the name may contain space
    if (empty(!$title)) {
        if (!preg_match('/^[a-zA-Z ]+$/', $title)) {

            $errors['title'] = 'Title should contains only letters.';
        }
    } else {
        $errors['title'] = 'Title should not be empty.';
    }

    // Check Quantity
    if (!empty($quantity)) {
        if (!preg_match('/^[0-9]+$/', $quantity)) {
            $errors['quantity'] = 'Quantity should contains only numbers.';
        }
    } else {
        $quantity = 1;
    }
    // Store the data in database

    $sql = "INSERT INTO categories (name, image_url) VALUES ('$name','$file_destination')";
    mysqli_query($conn, $sql);

    // Add Success Message To Session
    $_SESSION['success'] = ['Category Added Successfully'];

    // Reload the page
    header('location:categories.php');
    exit;
}

// If User Click Edit User Button
if (isset($_POST['edit_category'])) {


    $id = $_POST['category_id'];
    $name = $_POST['name'];

    // Check Name Contains only letters the name may contain space
    if (empty(!$name)) {
        if (!preg_match('/^[a-zA-Z ]+$/', $name)) {
            $errors['name'] = 'Name should contains only letters.';
        }
    } else {
        $errors['name'] = 'Name should not be empty.';
    }

    $file = $_FILES['image_url'];
    $file_error = $file['error'];
    if ($file_error != 4) {
        // Get category image url
        $sql = "SELECT image_url FROM categories WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $category = mysqli_fetch_assoc($result);
        $image_url = $category['image_url'];
        // Delete category image
        if ($image_url != null) {
            unlink($image_url);
        }
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];


        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = 'uploads/images/' . $file_name_new;
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }
        move_uploaded_file($file_tmp, $file_destination);
    } else {
        $file_destination = null;
    }

//    echo $file_destination;
//    exit();


    // Store the data in database

    $sql = "UPDATE categories SET name='$name', image_url='$file_destination' WHERE id='$id'";
    mysqli_query($conn, $sql);

    // Add Success Message To Session
    $_SESSION['success'] = ['Category Updated Successfully'];

    // Reload the page
    header('location:categories.php');
    exit;
}

// If User Click Delete User Button
if (isset($_POST['delete_category'])) {

//    echo  "<pre>";
//    print_r($_POST);
//    echo  "</pre>";
//    exit;

    $id = $_POST['category_id'];

    // Get product image url
    $sql = "SELECT image_url FROM products WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    $image_url = $product['image_url'];
    // Delete product image


    // Store the data in database

    $sql = "DELETE FROM categories WHERE id='$id'";
    mysqli_query($conn, $sql);

    if ($image_url != null) {
        unlink($image_url);
    }

    // Add Success Message To Session
    $_SESSION['success'] = ['Category Deleted Successfully'];

    // Reload the page
    header('location:categories.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
          integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body>
<div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
    <?php include_once 'layouts/sidebar.php'; ?>
    <div class="main-wrapper">
        <!-- ! Main nav -->
        <nav class="main-nav--bg">
            <div class="container main-nav">
                <div class="main-nav-start">
                    <div class="search-wrapper">
                        <i data-feather="search" aria-hidden="true"></i>
                        <input type="text" placeholder="Enter keywords ..." required>
                    </div>
                </div>
                <div class="main-nav-end">
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                    </button>
                    <div class="lang-switcher-wrapper">
                        <button class="lang-switcher transparent-btn" type="button">
                            EN
                            <i data-feather="chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="lang-menu dropdown">
                            <li><a href="##">English</a></li>
                            <li><a href="##">French</a></li>
                            <li><a href="##">Uzbek</a></li>
                        </ul>
                    </div>
                    <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                        <span class="sr-only">Switch theme</span>
                        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                    </button>
                    <div class="notification-wrapper">
                        <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
                            <span class="sr-only">To messages</span>
                            <span class="icon notification active" aria-hidden="true"></span>
                        </button>
                        <ul class="users-item-dropdown notification-dropdown dropdown">
                            <li>
                                <a href="##">
                                    <div class="notification-dropdown-icon info">
                                        <i data-feather="check"></i>
                                    </div>
                                    <div class="notification-dropdown-text">
                                        <span class="notification-dropdown__title">System just updated</span>
                                        <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                                                here.</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="##">
                                    <div class="notification-dropdown-icon danger">
                                        <i data-feather="info" aria-hidden="true"></i>
                                    </div>
                                    <div class="notification-dropdown-text">
                                        <span class="notification-dropdown__title">The cache is full!</span>
                                        <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                                                interfere ...</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="##">
                                    <div class="notification-dropdown-icon info">
                                        <i data-feather="check" aria-hidden="true"></i>
                                    </div>
                                    <div class="notification-dropdown-text">
                                        <span class="notification-dropdown__title">New Subscriber here!</span>
                                        <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="link-to-page" href="##">Go to Notifications page</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-user-wrapper">
                        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                            <span class="sr-only">My profile</span>
                            <span class="nav-user-img">
                                    <picture>
                                        <source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp"><img
                                                src="./img/avatar/avatar-illustrated-02.png" alt="User name">
                                    </picture>
                                </span>
                        </button>
                        <ul class="users-item-dropdown nav-user-dropdown dropdown">
                            <li><a href="##">
                                    <i data-feather="user" aria-hidden="true"></i>
                                    <span>Profile</span>
                                </a></li>
                            <li><a href="##">
                                    <i data-feather="settings" aria-hidden="true"></i>
                                    <span>Account settings</span>
                                </a></li>
                            <li>
                                <div class="d-flex py-2 ">
                                    <form action="" method="post" id="logout" style="display:none;"></form>
                                    <i data-feather="log-out" class="" aria-hidden="true"></i>
                                    <button class="bg-white" name="logout" value="logout" form="logout">Log out</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- ! Main -->
        <main class="main users chart-page" id="skip-target">
            <div class="container">
                <h2 class="main-title">All Categories</h2>
                <div class="row stat-cards">
                    <?php if (isset($_SESSION['success'])) : ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['success'][0] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']);
                    endif; ?>
                    <div>
                        <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal"
                                data-bs-target="#add-category">
                            Add Category
                        </button>
                    </div>


                    <div class=" mt-5">
                        <div class="table-responsive">
                            <table class="table  table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                if (!empty($categories)) :
                                    foreach ($categories as $category) : ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $category['name'] ?></td>
                                            <td class="text-center d-flex justify-content-evenly">
                                                <button type="button" class="btn btn-success rounded-0 edit-btn"
                                                        data-category-id="<?= $category['id'] ?>"
                                                        data-category-name="<?= $category['name'] ?>"
                                                        data-category-image="<?= $category['image_url'] ?>"
                                                        data-bs-toggle="modal" data-bs-target="#edit-category">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger rounded-0 del-btn"
                                                        category-id="<?= $category['id'] ?>"
                                                        data-bs-toggle="modal" data-bs-target="#delete-user">
                                                    Delete
                                                </button>
                                        </tr>
                                        <?php $i++;

                                    endforeach;
                                else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No Users Found</td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Product Modal -->
            <div class="modal fade" id="add-category" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addModal">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-dark">Name</label>
                                    <input type="text" class="form-control rounded-0 border" name="name" id="name">
                                </div>
                                <div>
                                    <label for="add-category-image" class="form-label">Product Image</label>
                                    <input class="form-control" type="file" name="image_url" id="add-category-image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add-category" value="add-category">
                                    Add
                                    Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Category Modal -->
            <div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModal">Edit User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="modal-body">
                                <input type="hidden" name="category_id" class="c-edit-id">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-dark">Name</label>
                                    <input type="text" class="form-control rounded-0 border" name="name" id="name">
                                </div>
                                <div>
                                    <label for="edit-category-image" class="form-label">Product Image</label>
                                    <div class="w-50">
                                        <img src="" alt="" id="edit-category-image">
                                    </div>
                                    <div>
                                        <input class="form-control" type="file" name="image_url"
                                               id="new-category-image">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="edit_category"
                                        value="edit_category">Update
                                    User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Category Modal -->
            <div class="modal fade " data-easein="bounceIn" id="delete-user" tabindex="-1" aria-labelledby="deleteModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="delete-modal">Delete User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="category_id" class="u-delete-id">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="delText"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="delete_category"
                                        value="delete_category">
                                    Delete Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        <!-- ! Footer -->
        <footer class="footer">
            <div class="container footer--flex">
                <div class="footer-start">
                    <p>2021 © Elegant Dashboard - <a href="elegant-dashboard.com" target="_blank"
                                                     rel="noopener noreferrer">elegant-dashboard.com</a></p>
                </div>
                <ul class="footer-end">
                    <li><a href="##">About</a></li>
                    <li><a href="##">Support</a></li>
                    <li><a href="##">Puchase</a></li>
                </ul>
            </div>
        </footer>
    </div>
</div>
<!-- Chart library -->
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('.del-btn').click(function () {
            var id = $(this).attr('category-id');
            $('.u-delete-id').val(id);

            $('.delText').html(`Are you sure you want to delete ?`);
        });
    });

    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var id = $(this).attr('data-category-id');
            var name = $(this).attr('data-category-name');
            var image = $(this).attr('data-category-image');
            $('#edit-category .c-edit-id').val(id);
            $('#edit-category #name').val(name);
            $('#edit-category #edit-category-image').attr('src', image);
        });
    });

    // Preveiw Image Before Upload in edit modal
    $(document).ready(function () {
        $('#new-category-image').change(function (e) {
            var file = e.target.files[0];
            var fileReader = new FileReader();
            fileReader.onload = function (e) {
                $('#edit-category-image').attr('src', e.target.result);
            }
            fileReader.readAsDataURL(file);
        });
    });
</script>

</body>

</html>