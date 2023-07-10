<?php

require_once __DIR__ . '/BaseDao.class.php';

class ServicerDao extends BaseDao {

    protected $table_name = "servicers";

    public function __construct() {
        
        parent::__construct($this->table_name);
    }
}

?>