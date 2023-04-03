<?php
require_once('../connection/worker.php');
require_once('../helpers/Validator.php');
require_once('../helpers/Request.php');

session_start();

$w = new Worker();

$r = new Request();
try {
    $w = new Worker('post');
} catch (Exception $e) {
    print_r($e->getMessage());
    die();
}

$error = $r->validate([
    'taskname' => 'required|string|max:255',
    'start_date' => 'required',
    'due_date' => 'required',
]);

$user = $w->query("SELECT * FROM users WHERE id = :id")->bind(['id' => $_SESSION['kfabfdnf4534tddfnskjfdi'][0]['id']])->fetch();

$task = $w->query("insert into tasks(user_id,taskname,start_date,due_date,created_at) VALUES (:user,:taskname,:start_date,:due_date,:created_at)")
    ->type('insert')
    ->bind(["user" => $user[0]['id'], "taskname" => $_POST['taskname'], "start_date" => $_POST['start_date'], "due_date" => $_POST['due_date'], "created_at" => $datetime])->fetch();
