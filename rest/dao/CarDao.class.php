<?php

require_once __DIR__ . '/BaseDao.class.php';

class CarDao extends BaseDao {

    protected $table_name = "cars";

    public function __construct() {
        
        parent::__construct($this->table_name);
    }

    public function getCarsByUserId($userId) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE userId = :userId",
        ["userId" => $userId]);
    }
}

?>