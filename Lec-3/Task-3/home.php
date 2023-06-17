<?php

$pageTitle = "Home";
include 'layouts/header.php';
require 'data.php';
foreach ($users as $user) :
?>
    <div class="card" style="width: 18rem;background-color:<?= $user['clr'] ?>;">
        <div class="card-body">
            <h5 class="card-title"><?= $user['name'] ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $user['age'] ?></h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
<?php
endforeach;
?>
<br>
<?php
$arr1 = [1, 2, 3, 4, 5];
$arr2 = [4, 5, 6];

echo in_array(3, $arr1) ? 'Found' : 'Not Found'; // => Found


echo '<pre>';
print_r(array_merge($arr1, $arr2)); //   [1, 2, 3, 4, 5, 4, 5, 6]
echo '</pre>';
echo '<pre>';
print_r(array_diff($arr1, $arr2)); // [1, 2, 3]
echo '</pre>';
echo '<pre>';
print_r(array_diff_assoc($arr1, $arr2)); // [1, 2, 3, 4, 5]
echo '</pre>';

?>
<?php
include 'layouts/footer.php';
?>