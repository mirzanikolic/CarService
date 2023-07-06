<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/UserDao.class.php";

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao);
    }

    public function getUserByFirstName($first_name) {
        return $this->dao->getUserByFirstName($first_name);
    }
    

}

?>