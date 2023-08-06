<?php

namespace App\DB;
use PDO;
use PDOException;
class UsersQueries extends DBModel
{
    public function __construct($db_config)
    {
        parent::__construct($db_config);
    }

    public function getUserQueries($userID) {
        $res = $this->dbHandler->prepare(
        'SELECT query_name, query
               FROM queries
               JOIN users ON queries.user_id=users.id
               WHERE users.id = :userID',
               [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $res->execute(['userID' => $userID]);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUsers() {
        $res = $this->dbHandler->prepare(
            'SELECT *
               FROM users',
            [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }


}