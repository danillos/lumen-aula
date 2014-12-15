<?php

namespace Lumen\Model;

class Task
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
