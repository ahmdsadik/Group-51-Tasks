<?php

// Page title
$page_title = 'echo VS var_dumb';

// Comparison between echo and var_dumb
$table_caption = 'Comparison between echo and var_dumb';

// echo
$echo = 'echo()';
$echo_dataType = 'Supports strings, numbers, booleans, and other basic data types.';
$echo_output = 'Prints the specified string or variable directly to the output.';
$echo_formatting = 'Can concatenate strings using the concatenation operator (.) or comma (,).';

// var_dump
$var_dump = 'var_dump()';
$var_dump_dataType = 'Supports all data types including arrays, objects, and complex structures.';
$var_dump_output = 'Prints a structured representation of the variable to the output.';
$var_dump_formatting = 'Does not concatenate strings; each variable is displayed on a separate line.';
$test_string = 'Test Data';

// Print data using echo
$name = 'Ahmed Mohamed';
$age = 23;
$height = 1.75;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Raleway', sans-serif;
    }
</style>

<body>
    <div class="bg-primary vh-100">
        <div class="container">
            <table class="table table-success table-striped table-hover table-bordered caption-top fs-3">
                <caption class="text-center text-white fs-3 fw-bold text-dark"><?= $table_caption ?></caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= $echo ?></th>
                        <th scope="col"><?= $var_dump ?></th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <tr>
                        <th scope="row">Data Types</th>
                        <td><?= $echo_dataType ?></td>
                        <td><?= $var_dump_dataType ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Output</th>
                        <td><?= $echo_output ?></td>
                        <td><?= $var_dump_output ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Formatting</th>
                        <td><?= $echo_formatting ?></td>
                        <td><?= $var_dump_formatting ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Example</th>
                        <td>Variable has 'Test Data' Value printed by echo<br> <?= $test_string ?></td>
                        <td>Variable has 'Test Data' Value printed by var_dump()<br> <?php var_dump($test_string); ?></td>
                    </tr>
                </tbody>
            </table>

            <p class='text-center fs-3 fw-bold text-white'>Print data using echo</p>
            <div class="bg-dark-subtle p-2 fs-3">
                <?php
                echo 'My name is: ' . $name . '<br>';
                echo "My age is: $age <br>";
                echo "My height is: $height <br>";
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
</html>