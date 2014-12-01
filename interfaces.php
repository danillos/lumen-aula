<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Interface Cache
 */
interface Cache
{
    public function set($key, $value);
    public function get($key);
    public function exists($key);
    public function delete($key);
}

/**
 * Implementação concreta de uma interface cache utilizando arrays.
 */
class ArrayCache implements Cache
{
    private $cached = array();

    public function set($key, $value)
    {
        $this->cached[$key] = $value;
    }

    public function get($key)
    {
        if (!$this->exists($key)) {
            return null;
        }

        echo '<br>Acessou o cache<br><br>';
        return $this->cached[$key];
    }

    public function exists($key)
    {
       return isset($this->cached[$key]);
    }

    public function delete($key)
    {
        unset($this->cached[$key]);
    }
}

/**
 * Implementação concreta de uma interface cache utilizando Session.
 */
class SessionCache implements Cache
{
    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        if ($this->exists($key)) {
            echo '<br>Acessou o cache<br><br>';
            return $_SESSION[$key];
        }
    }

    public function exists($key)
    {
       return isset($_SESSION[$key]);
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
}

/**
 * Implementação concreta de uma interface cache para não utilizar cache.
 */
class NoCache implements Cache
{
    private $cached = array();

    public function set($key, $value) { }

    public function get($key)  { }

    public function exists($key)
    {
       return false;
    }

    public function delete($key) { }
}

/**
 * Padrão Proxy que adiciona cache a classe UserRepository sem tem que alterar
 * a lógica dela.
 */
class UserRepositoryProxyCache extends UserRepository
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getUser($id)
    {
        $key = 'user_' . $id;

        if ($this->cache->exists($key)) {
            return $this->cache->get($key);
        }

        $user = parent::getUser($id);;

        $this->cache->set($key, $user);

        return $user;
    }
}

/**
 * Classe responsável para fazer consultas aos dados dos usuários
 *
 * Todo: É ideal usar interface para manter um contrato
 */
class UserRepository
{
    public function getUser($id)
    {
        // SELECT * FROM users where id = $id;
        // ...

        echo '<br>Acessou o banco de dados<br><br>';
        return 'User ' . $id;
    }
}

/**
 * Classe para trabalhar com os dados do usuários como por exemplo, obter dados
 * do usuário, validar usuário, salvar usuário...
 */
class UsersModel
{
    private $user_repository;

    public function __construct(UserRepository $u_repo)
    {
        $this->user_repository = $u_repo;
    }

    public function getByUserId($id)
    {
        return $this->user_repository->getUser($id);
    }
}

$cache = new SessionCache();
$u_repo = new UserRepositoryProxyCache($cache);
$user_model = new UsersModel($u_repo);

echo $user_model->getByUserId(1);
echo $user_model->getByUserId(1);
