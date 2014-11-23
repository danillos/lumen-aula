<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

Class Database
{
    private $array =  array();

    public function getTasks()
    {
        for ($i=1; $i <= 5; $i++) { 

            $task = new Task('Tarefa' . $i);

            if ($i % 2 == 0) {
                $task->finished();
            }

            $this->array[] = $task;

        }

        return $this->array;
    }

    public function addTask(Task $task)
    {
        $this->array[] = $task;
    }
}

Class Task 
{
    private $name;
    private $is_done = false;
    private $created_at;
    private $done_at;

    public function __construct($name)
    {
        $this->name = $name;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getName()
    {
        $name = '[' . $this->created_at . '] ' . $this->name;
        return $name;
    }
    
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getIsDone()
    {
        return $this->is_done;
    }

    public function getDoneAt()
    {
        return $this->done_at;
    }

    public function finished()
    {
        if ($this->is_done == false) {
            $this->finish();
            $this->notifyFinished();
        }
    }

    public function open()
    {
        $this->is_done = false;
        $this->done_at = null;
    }

    private function finish()
    {
        $this->is_done = true;
        $this->done_at = date('Y-m-d H:i:s');
    }

    private function notifyFinished()
    {
        // enviar email
    }
}

$database = new Database();

$task = new Task('Pagar a conta');
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
