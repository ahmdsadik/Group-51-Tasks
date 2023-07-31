<?php

// Start Session
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


// Get All Users Data From Database
$sql = "SELECT * FROM users WHERE is_admin = 0";
// Execute Query
$result = mysqli_query($conn, $sql);

// Fetch All Data
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);


// IF User Click Logout Button Delete Session And Redirect To Signin Page
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:signin.php');
    exit;
}

// If User Click Add User Button
if (isset($_POST['add_user'])) {
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

    // Store the data in database

    $sql = "INSERT INTO users (name, user_name, email, password) VALUES ('$name', '$user_name', '$email', '$password')";
    mysqli_query($conn, $sql);

    // Add Success Message To Session
    $_SESSION['success'] = ['User Added Successfully'];

    // Reload the page
    header('location:users.php');
    exit;
}

// If User Click Edit User Button
if (isset($_POST['edit_user'])) {
    $id = $_POST['u-edit-id'];
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];

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

    // Store the data in database

    $sql = "UPDATE users SET name='$name', user_name='$user_name', email='$email' WHERE id='$id'";
    mysqli_query($conn, $sql);

    // Add Success Message To Session
    $_SESSION['success'] = ['User Updated Successfully'];

    // Reload the page
    header('location:users.php');
    exit;
}

// If User Click Delete User Button
if (isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];

    // Store the data in database

    $sql = "DELETE FROM users WHERE id='$id'";
    mysqli_query($conn, $sql);

    // Add Success Message To Session
    $_SESSION['success'] = ['User Deleted Successfully'];

    // Reload the page
    header('location:users.php');
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                        <source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name">
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
                    <h2 class="main-title">All Users</h2>
                    <div class="row stat-cards">
                        <?php if (isset($_SESSION['success'])) : ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $_SESSION['success'][0] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php unset($_SESSION['success']);
                        endif; ?>
                        <div>
                            <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#add-user">
                                Add User
                            </button>
                        </div>


                        <div class=" mt-5">
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Type</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($users)) :
                                            foreach ($users as $userInfo) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $userInfo['name'] ?></td>
                                                    <td><?= $userInfo['user_name'] ?></td>
                                                    <td><?= $userInfo['email'] ?></td>
                                                    <td><?= ($userInfo['is_admin'] == 1) ? 'Admin' : 'User' ?></td>
                                                    <td class="text-center d-flex justify-content-evenly">
                                                        <button type="button" user-id=<?= $userInfo['id'] ?> user-name=<?= $userInfo['name'] ?> user-user-name=<?= $userInfo['user_name'] ?> user-email="<?= $userInfo['email'] ?>" class="btn btn-success rounded-0 edit-btn" data-bs-toggle="modal" data-bs-target="#edit-user">
                                                            Edit
                                                        </button>
                                                        <button type="button" user-id=<?= $userInfo['id'] ?> user-name="<?= $userInfo['name'] ?>" class="btn btn-danger rounded-0 del-btn" data-bs-toggle="modal" data-bs-target="#delete-user">
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
                <!-- Add User Modal -->
                <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModal">Add User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label text-dark">Name</label>
                                        <input type="text" class="form-control rounded-0 border" name="name" id="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_name_add" class="form-label text-dark">User Name</label>
                                        <input type="text" class="form-control rounded-0 border" name="user_name" id="user_name_add">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label text-dark">Email address</label>
                                        <input type="email" class="form-control rounded-0 border" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label text-dark">Password</label>
                                        <input type="password" name="password" class="form-control rounded-0 border" id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add_user" value="add-user">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit User Modal -->
                <div class="modal fade" id="edit-user" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModal">Edit User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="u-edit-id">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name_edit" class="form-label text-dark">Name</label>
                                        <input type="text" class="form-control rounded-0 border" name="name" id="name_edit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_name_edit" class="form-label text-dark">User Name</label>
                                        <input type="text" class="form-control rounded-0 border" name="user_name" id="user_name_edit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label text-dark">Email address</label>
                                        <input type="email" class="form-control rounded-0 border" name="email" id="editEmail" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="edit_user" value="edit-user">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete User Modal -->
                <div class="modal fade " data-easein="bounceIn" id="delete-user" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="delete-modal">Delete User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="user_id" class="u-delete-id">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <div class="delText"></div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="delete_user" value="delete-user">Delete User</button>
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
                        <p>2021 © Elegant Dashboard - <a href="elegant-dashboard.com" target="_blank" rel="noopener noreferrer">elegant-dashboard.com</a></p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.del-btn').click(function() {
                var id = $(this).attr('user-id');
                var name = $(this).attr('user-name');
                $('.u-delete-id').val(id);

                $('.delText').html(`Are you sure you want to delete ${name} ?`);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                var id = $(this).attr('user-id');
                var name = $(this).attr('user-name');
                var user_name = $(this).attr('user-user-name');
                var email = $(this).attr('user-email');
                console.log(email);
                $('input[name="u-edit-id"]').val(id);
                $('#name_edit').val(name);
                $('#user_name_edit').val(user_name);
                $('#editEmail').val(email);
            });
        });
    </script>


</body>

</html>