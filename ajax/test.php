<?php

require_once('../connection/worker.php');

$w= new Worker('project-slug');

$data = $w->query("SELECT * FROM users WHERE id=:id")

    ->bind(['id' => 1])->fetch();

print_r($data);