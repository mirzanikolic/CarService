<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/ServicerDao.class.php";

class ServicerService extends BaseService {

    public function __construct() {
        parent::__construct(new ServicerDao);
    }
}

?>