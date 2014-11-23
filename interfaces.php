<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

interface Cache
{
    public function set($key, $value);
    public function get($key);
    public function delete($key);
}

class ArrayCache implements Cache
{
    private $cached = array();

    public function set($key, $value)
    {
        $this->cached[$key] = $value;
    }

    public function get($key)
    {
        if (isset($this->cached[$key])) {
            return $this->cached[$key];
        }
    }

    public function delete($key)
    {
        unset($this->cached[$key]);
    }
}

class SessionCache implements Cache
{
    public function set($key, $value)
    {
        // implementar
    }

    public function get($key)
    {
        // implementar
    }

    public function delete($key)
    {
        // implementar
    }
}

class App
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function run()
    {
       $this->cache->set('name', 'Danillo');
       echo $this->cache->get('name');
    }
}

$cache = new ArrayCache();
$app = new App($cache);
$app->run();



