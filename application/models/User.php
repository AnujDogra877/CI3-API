<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends BaseModel {
    const DB_TBL = 'tbl_users';

    public function __construct(){
        parent::__construct();
    }

    public function getList(){
        $users = $this->getAll(self::DB_TBL);
        return $users;
    }

    public function getUserData($username, $password){
        $users = $this->selectRowWhere(self::DB_TBL,[
            'user_email' => trim($username),
            'user_password' => $password
        ]);
        return $users;
    }
}
