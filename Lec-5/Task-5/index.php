<?php
$errors = [];
$msgs = [];
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = ['txt', 'jpg', 'jpeg', 'png', 'pdf', 'docx'];

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size <= 1000000) {
                $file_name_new = uniqid('', true) . '.' . $file_ext;
                $file_destination = 'uploads/' . $file_name_new;
                if (!is_dir('uploads')) {
                    mkdir('uploads');
                }
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $msgs[] = 'File uploaded successfully';
                } else {
                    $errors[] = 'There was an error uploading your file';
                }
            } else {
                $errors[] = 'Your file is too large. The maximum size is 1MB';
            }
        } else {
            $errors[] = 'There was an error uploading your file';
        }
    } else {
        $errors[] = 'File type not allowed. Allowed types are '. implode(', ', $allowed);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

</head>

<body class="bg-primary">
    <div class="container  ">
        <div class="d-flex justify-content-center align-items-center vh-100  row">
            <form method="post" class="bg-white p-5 rounded-1" enctype="multipart/form-data">
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?= $error ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>
                <?php foreach ($msgs as $msg) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $msg ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input class="form-control" required type="file" name="file" id="file">
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

</html>