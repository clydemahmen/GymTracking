<?php

class Auth {
    private $user;

    public function __construct($user){
        $this->user = $user;
    }

    public function login($username, $password){
        $record = $this->user->findByUsername($username);

        if($record){
            if($password == $record['password']){
                $_SESSION['user_id']   = $record['id'];
                $_SESSION['user_name'] = $record['name'];
                $_SESSION['user_role'] = $record['role'];
                return true;
            }
        }

        return false;
    }

    public function logout(){
        session_destroy();
        header("Location: login.php");
        exit();
    }

    public function check(){
        if(!isset($_SESSION['user_id'])){
            header("Location: login.php");
            exit();
        }
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
        return false;
    }
}

?>