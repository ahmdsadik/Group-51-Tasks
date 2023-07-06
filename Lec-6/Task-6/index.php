<?php
$errors = [];
$msgs = [];
if (isset($_FILES['files'])) {
    $file = $_FILES['files'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_count = count($file_name);

    for ($i = 0; $i < $file_count; $i++) {
        $file_ext = explode('.', $file_name[$i]);
        $file_ext = strtolower(end($file_ext));
        $allowed = ['jpg', 'pdf', 'docx'];

        if ($file_error[$i] == 0) {
            if (in_array($file_ext, $allowed)) {
                if ($file_error[$i] === 0) {
                    if ($file_size[$i] <= 8388608) {
                        $file_new_name = uniqid('', true) . '.' . $file_ext;
                        $file_destination = 'uploads/' . $file_new_name;
                        if (!is_dir('uploads')) {
                            mkdir('uploads');
                        }
                        if (move_uploaded_file($file_tmp[$i], $file_destination)) {
                            $msgs[] = 'File ' . $file_name[$i] . ' uploaded successfully';
                        } else {
                            $errors[] = 'File ' . $file_name[$i] . ' not uploaded';
                        }
                    } else {
                        $errors[] = 'File ' . $file_name[$i] . ' is too large. Max allowed size is 8MB';
                    }
                } else {
                    $errors[] = 'File ' . $file_name[$i] . ' not uploaded due to error';
                }
            } else {
                $errors[] = 'File ' . $file_name[$i] . ' not allowed. Allowed  files extension are ' . implode(', ', $allowed);
            }
        } else {
            if ($file_error[$i] == 4) {
                $errors[] = 'Select at least file to upload';
            } else {
                $errors[] = 'Error in uploading file try again';
            }
        }
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

<body class="bg-primary ">
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
                    <label for="file" class="form-label">Upload File or Files</label>
                    <input class="form-control" multiple type="file" name="files[]" id="file">
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
</html>