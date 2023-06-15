<?php

$employee = ['Ahmed', 'Mohamed', 'Sadik', 'Ali'];
$salary = ['Ahmed' => 5000, 'Mohamed' => 4800, 'Sadik' => 4500, 'Ali' => 4000];
$role = ['Ahmed' => 'Boss', 'Mohamed' => 'Security', 'Sadik' => 'Worker', 'Ali' => 'Worker'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2</title>
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
    <div class="bg-primary">
        <div class="container py-3">
            <table class="table table-success table-striped table-hover table-bordered caption-top fs-3">
                <caption class="text-center text-white fs-3 fw-bold ">Employee Salaries</caption>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Salary without taxes</th>
                        <th scope="col">Salary with taxes</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <tr>
                        <td><?= $employee[0] ?></td>
                        <td><?= $salary[$employee[0]] ?></td>
                        <td><?= $role[$employee[0]] != 'Boss' ? $salary[$employee[0]] - $salary[$employee[0]] * 0.1 : $salary[$employee[0]]   ?></td>
                    </tr>
                    <tr>
                        <td><?= $employee[1] ?></td>
                        <td><?= $salary[$employee[1]] ?></td>
                        <td><?= $role[$employee[1]] != 'Boss' ? $salary[$employee[1]] - $salary[$employee[1]] * 0.1 : $salary[$employee[1]]   ?></td>
                    </tr>
                    <tr>
                        <td><?= $employee[2] ?></td>
                        <td><?= $salary[$employee[2]] ?></td>
                        <td><?= $role[$employee[2]] != 'Boss' ? $salary[$employee[2]] - $salary[$employee[2]] * 0.1 : $salary[$employee[2]]   ?></td>
                    </tr>
                    <tr>
                        <td><?= $employee[3] ?></td>
                        <td><?= $salary[$employee[3]] ?></td>
                        <td><?= $role[$employee[3]] != 'Boss' ? $salary[$employee[3]] - $salary[$employee[3]] * 0.1 : $salary[$employee[3]]  ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="bg-dark-subtle p-2 fs-3 text-black">
                <p class="text-center fw-bold">Employee Array with var_dump()</p>
                <pre class='mb-0'>
<?php var_dump($employee) ?></pre>
            </div>
            <div class="bg-dark-subtle p-2 fs-3 text-black mt-3">
                <p class="text-center fw-bold">Employee Array with print_r()</p>
                <pre class='mb-0'>
<?php print_r($employee) ?></pre>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>

</html>