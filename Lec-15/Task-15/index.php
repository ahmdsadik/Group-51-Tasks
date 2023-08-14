<?php



require_once "Database.php";

$newuser = new Database();

// Select All Data From Table Users Where id = 1
$newuser->select('users', ['id', 'name', 'email'])->where('id', '=', 1)->allData();

// Insert New User To Table Users
$newuser->insert('users', [
    'name' => 'ahmed',
    'email' => 'test@test.com',
    'password' => '123456',
])->excut();

// Update User Data Where id = 1
$newuser->update(
    'users',
    [
        'name' => 'ahmed'
    ]
)->where('id', '=', 1)->excut();

// Delete User Where id = 1
$newuser->delete('users')->where('id', '=', 1)->excut();
