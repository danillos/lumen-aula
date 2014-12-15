<?php

namespace Lumen\Repository;

use \Lumen\Model\Task;

use \Datetime as DT;

class FakeTasksDatabase
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
        $date = new DT('now');
        echo $date->format('Y-m-d H:i');

        $this->array[] = $task;
    }
}
