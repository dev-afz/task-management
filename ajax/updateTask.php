<?php
require_once('../connection/worker.php');
require_once('../helpers/Validator.php');
require_once('../helpers/Request.php');

session_start();

// print_r($_POST);
// exit;

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
    'due_date' => 'required',
]);

$user = $w
    ->query("SELECT * FROM users WHERE id = :id")
    ->bind(['id' => $_SESSION['kfabfdnf4534tddfnskjfdi'][0]['id']])
    ->fetch();

$task = $w
    ->query("UPDATE tasks SET taskname=:taskname,start_date=:start_date,due_date=:due_date,updated_at=:updated_at WHERE id=:id AND user_id=:user_id")
    ->type('update')
    ->bind([
        "taskname" => $_POST['taskname'],
        "start_date" => $_POST['start_date'],
        "due_date" => $_POST['due_date'],
        "updated_at" => $datetime,
        'user_id' => $user[0]['id'],
        'id' => $_POST['id'],
    ])
    ->fetch();

if ($task) {
    echo 'success';
} else {
    echo "Error";
}
