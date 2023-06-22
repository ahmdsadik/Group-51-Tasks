<?php
$pageTitle = 'Login';
$errors = [];
include 'layouts/header.php';

$users = [
    'user1' => ['name' => 'mohamed', 'email' => 'a@g.com', 'password' => 'red123'],
    'user2' => ['name' => 'kamal', 'email' => 'a@g.com', 'password' => 'blue123'],
    'user3' => ['name' => 'ahmed1', 'email' => 'ahmed@gmail.com', 'password' => 'ahmed123'],
    'user4' => ['name' => 'sayed', 'email' => 'a@g.com', 'password' => 'green123'],
];
if (isset($_POST['login'])) {
    $flag = 0;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty(!$username)) {
        if (preg_match('/^.{4,}$/', $username)) {
            if (preg_match('/^[A-Za-z0-9]+$/', $username)) {
                $flag++;
            } else {
                $errors['username'] = 'Username should contains only letters and numbers.';
            }
        } else {
            $errors['username'] = 'Username should be longer than 6 characters.';
        }
    } else {
        $errors['username'] = 'Username should not be empty.';
    }

    if (empty(!$email)) {
        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $flag++;
        } else {
            $errors['email'] = 'Email address is invalid.';
        }
    } else {
        $errors['email'] = 'Email should not be empty.';
    }
    if (empty(!$password)) {
        if (preg_match('/^.{4,}$/', $password)) {
            $flag++;
        } else {
            $errors['password'] = 'Password at least 4.';
        }
    } else {
        $errors['password'] = 'Password should not be empty.';
    }

    if ($flag == 3) {
        if ($username == 'admin' && $password == 'admin123' && $email = 'admin@web.com') {
            header('location:dashboard.php?username=' . urlencode($username));
            exit;
        } else {

            foreach ($users as $user) {
                if ($user['name'] == $username && $user['email'] == $email && $user['password'] == $password) {
                    header('location:index.php?username=' . urlencode($username));
                    exit;
                }
            }
            $wrongData = 1;
        }
    }
}
?>

<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class='w-50'>
        <?php
        if (isset($wrongData)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Wrong Email or Password.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <form method="post">
            <div class="form-floating mb-3 ">
                <input type="text" class="form-control <?php if (array_key_exists('username', $errors)) : ?> is-invalid  <?php endif;  ?>" name="username" id="floatingUser" placeholder="username">
                <label for="floatingUser">Username</label>
                <div class="invalid-feedback">
                    <?php if (array_key_exists('username', $errors)) : ?>
                        <?= $errors['username'] ?>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="form-floating mb-3 ">
                <input type="email" class="form-control <?php if (array_key_exists('email', $errors)) : ?> is-invalid <?php endif;  ?>" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <?= $errors['email'] ?>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control <?php if (array_key_exists('password', $errors)) : ?> is-invalid <?php endif;  ?>" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <?= $errors['password'] ?>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="rem" id="rem">
                <label for="rem" class="form-label">Remember me</label>
            </div>
            <div class="mb-3">
                <label for="col">Color</label>
                <input type="color" name="col" id="col">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date">
            </div>
            <select class="form-select mb-3" aria-label="Default select example">
                <option selected>Example</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="mb-3">
                <label for="data" class="form-label" name='data'>Example textarea</label>
                <textarea class="form-control" id="data" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login" value='log'>Login</button>
        </form>
    </div>
</div>
<?php
include 'layouts/footer.php'
?>