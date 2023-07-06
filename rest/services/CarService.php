<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CarDao.class.php";

class CarService extends BaseService {

    public function __construct() {
        parent::__construct(new CarDao);
    }

    public function getCarsByUserId($userId) {
        return $this->dao->getCarsByUserId($userId);
    }
}

?>