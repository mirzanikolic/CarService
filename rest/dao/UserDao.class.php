<?php

require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao {

    protected $table_name = "users";

    public function __construct() {

        parent::__construct($this->table_name);
    }

    public function getUserByFirstName($first_name) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE first_name = :first_name",
        ["first_name" => $first_name]);
    }

    public function getUserByEmail($email) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE email = :email",
        ["email" => $email]);
    }
}

?>
