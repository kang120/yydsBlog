<?php

namespace App\Libraries;

class Hash{
    public static function hash_password($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check_password($password, $db_password){
        if(password_verify($password, $db_password)){
            echo "valid <br>";
            return true;
        }else{
            echo "invalid <br>";
            return false;
        }
    }
}

?>