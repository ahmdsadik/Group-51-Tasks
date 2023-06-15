<?php

// Page title
$page_title = 'Compilers VS Interpreters';

// Comparison between Compiler and Interpreter
$table_caption = 'Comparison table between Compilers and Interpreters';

//  Compiler
$com = 'Compiler';
$compiler = 'Converts the entire source code into machine code before execution.';
$compiler_example_languages = 'C, C++, Java';

//  Interpreter
$inter = 'Interpreter';
$interpreter = 'Translates and executes the source code line by line.';
$interpreter_example_languages = 'Python, Ruby, JavaScript';

// Print data using var_dump
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
                        <th scope="col"><?= $com ?></th>
                        <th scope="col"><?= $inter ?></th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <tr>
                        <th scope="row">Execution</th>
                        <td><?= $compiler ?></td>
                        <td><?= $interpreter ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Examples</th>
                        <td><?= $compiler_example_languages ?></td>
                        <td><?= $interpreter_example_languages ?></td>
                    </tr>
                </tbody>
            </table>
            <p class='text-center fs-3 fw-bold text-white'>Print data using var_dump</p>
            <div class="bg-dark-subtle p-2 fs-3">
                <?php
                var_dump($name);
                echo '<br>';
                var_dump($age);
                echo '<br>';
                var_dump($height);
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
</html>