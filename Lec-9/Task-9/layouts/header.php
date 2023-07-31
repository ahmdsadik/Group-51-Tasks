<?php
// Start Session
global $page_title;
session_start();


// Check If User Is Logged In
if (!isset($_SESSION['user'])) {
    header('location:signin.php');
    exit();
}
require_once 'db_config.php';

if (!$_SESSION['user']['is_admin']) {
    // Redirect Back
    header('location:home.php');
    exit();
}

// Get User Data From Session
$user = $_SESSION['user'];

// Get Username
$user_name = $user['user_name'];

// Get Username
$name = $user['name'];

// Get User Email
$email = $user['email'];

// IF User Click Logout Button Delete Session And Redirect To Signin Page
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:signin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body>
<div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
    <?php require_once 'sidebar.php'; ?>
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