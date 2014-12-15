<?php

define('APP_PATH', __DIR__);

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'autoloader.php';


$database = new \Lumen\Repository\FakeTasksDatabase();
$task = new \Lumen\Model\Task('Pagar a conta');

$database->addTask($task);
$tasks = $database->getTasks();


?>

<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <input type="checkbox" <?= ($task->getIsDone()) ? 'checked' : ''; ?> >
            <strong><?= $task->getName(); ?></strong>
            <br>

            <?php if ($task->getIsDone()): ?>
                Concluido em: <?= $task->getDoneAt(); ?>
            <?php endif ?>

            <br><br>
        </li>
    <?php endforeach ?>
</ul>
