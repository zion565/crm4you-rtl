<?php

namespace DB;

class DBConnection {
    protected $connection;
    public function __construct($host, $user, $password, $database) {
        try {
            $this->connection = new \PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $this->connection;
    }

    public function Query($sql, array $params = array()) {
        if ($this->connection == null) {
            return null;
        }

        // if (empty($params)) {
        //     return $this->connection->query($sql);
        // }

        $smth = $this->connection->prepare($sql);
        $smth->execute($params);

        return $smth;
    }

    public function Set_charset($chr) {
        return $this->connection->set_charset($chr);
    }
    
    public function GetLastInsertId() {
        return $this->connection->lastInsertId();
    }

    public function BeginTransaction() {
        $this->connection->beginTransaction();
    }

    public function CommitTransaction() {
        $this->connection->commit();
    }

    public function CancelTransaction() {
        $this->connection->rollback();
    }
}