<?php
require_once('../boson/connection/worker.php');

session_start();

$w = new Worker();

try {
    $w = new Worker('post');
} catch (Exception $e) {
    print_r($e->getMessage());
    die();
}

// print_r($_POST);
// exit;
$admin = $w->query("SELECT * FROM users WHERE username=:username AND password=:password")
    ->bind(['username' => $_POST['username'], 'password' => $_POST['password']])->fetch();

if ($admin) {
    if ($admin) {
        $_SESSION["kfabfdnf4534tddfnskjfdi"] = $admin;
        header('Location: dashboard.php');
    } else {
        header('Location: invalidcred.php');
    }
}


// $admin = $conn->prepare("SELECT * from users where binary username= :username AND binary password= :password");

// $admin->execute(array("username" => $_POST['username'], "password" => $_POST['password']));

// $result = $admin->fetchAll(\PDO::FETCH_ASSOC);

// $count = $admin->rowCount();

// if ($count > 0) {
//     $_SESSION["kfabfdnf4534tddfnskjfdi"] = $_POST["username"];
//     header('Location: dashboard.php');
// } else {
//     header('Location: invalidcred.php');
// }
