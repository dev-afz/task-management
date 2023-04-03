<?php
require_once('../connection/worker.php');

session_start();


$deletables = require_once('deleteable_tables.php');

try {
    $w = new Worker('post');
} catch (Exception $e) {
    print_r($e->getMessage());
    die();
}

$user = $w->query("SELECT * FROM users WHERE id=:id")->bind(['id' => $_SESSION['kfabfdnf4534tddfnskjfdi'][0]['id']])->fetch();
$w->query('DELETE FROM tasks where id=:id AND user_id=:user_id')
    ->bind(['id' => $_POST['id'], 'user_id' => $user[0]['id']])->fetch();
