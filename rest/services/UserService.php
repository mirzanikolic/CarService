<?php

require_once __DIR__ . "../BaseService.php";

class UserService extends BaseService {

    private $dao = new UserDao;

    public function __construct() {
        parent::__construct($this->dao);
    }

    public function getUserByFirstName($first_name) {
        return $this->dao->getUserByFirstName($first_name);
    }

}

?>