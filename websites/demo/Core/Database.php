<?php

namespace Core;

use PDO;

class Database
{
    protected $connection;

    protected $stmt;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = "mysql:" . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => Pdo::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }

    public function find()
    {
        return $this->stmt->fetch();
    }
    public function get()
    {
        return $this->stmt->fetchAll();
    }

    public function findOrFail($status = Response::NOT_FOUND)
    {
        $fetched = $this->find();
        if (!$fetched)
            abort($status);

        return $fetched;
    }

    public function display($data)
    {
        // Check if multidimensional
        if (isset($data[0]) && is_array($data[0])) {
            foreach ($data as $post) {
                echo "<li>{$post['title']}</li>";
            }
        } else {
            echo "<li>{$data['title']}</li>";
        }
    }
}
