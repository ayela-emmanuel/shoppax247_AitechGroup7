<?php
include_once __DIR__."/../includes/conn.php";


//Create User
function create_user(string $name, string $email, string $pwd){
    global $Connection;

    $data = get_user_by_email($email);
    if($data??false){
        throw new InvalidArgumentException("The Email $email Is Not Available");
        return false;
    }

    $Query = "INSERT INTO `users` (`name`,`email`,`password`) VALUES
    (?,?,?)";
    $pwd = password_hash($pwd,PASSWORD_DEFAULT);

    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$name, $email,$pwd]);
    if($result){
        return true;
    }

    return false;
}

///
//Update User

function update_user_email(int $id,string $new_email){
    global $Connection;
    $Query = "UPDATE `users` SET `email` = ?  where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$new_email,$id]);
    if($result){
        if($stmt->affected_rows){
            return true;
        }
        throw new InvalidArgumentException("User Not Found");
        
    }
    return false;
}

function update_user_name(int $id, string $new_name){
    global $Connection;
    $Query = "UPDATE `users` SET `name` = ?  where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$new_name, $id]);
    if($result){
        if($stmt->affected_rows){
            return true;
        }
        throw new InvalidArgumentException("User Not Found");
    }
    return;
}


function update_user_password(int $id, string $new_pwd, $old_pwd){
    global $Connection;
    $Query = "UPDATE `users` SET `password` = ?  where `id` = ?";
    $stmt = $Connection->prepare($Query);
    if(!verify_user_pwd_by_id($id,$old_pwd)){
        throw new InvalidArgumentException("Incorrect Password");

        return false;
    }
    $result = $stmt->execute([$new_pwd,$id]);
    if($result){
        if($stmt->affected_rows){
            return true;
        }
        throw new InvalidArgumentException("User Not Found");
    }
    return false;
}


function verify_user_pwd_by_id(int $id,$pwd){
    $user = get_user_by_id($id);
    if(!$user){
        return false;
    }
    if(!password_verify($pwd, $user["password"])){
        return false;
    }
    return true;
}

//Delete User
function delete_user_by_id(int $id){
    global $Connection;
    $Query = "DELETE from `users` where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$id]);
    if($result){
        return true;
    }
    return;
}
//Get User

function get_user_by_id(int $id){
    global $Connection;
    $Query = "SELECT * from `users` where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$id]);
    if($result){
        $sqlres = $stmt->get_result();
        return $sqlres->fetch_assoc();
    }
    return;
}



function get_user_by_email(string $email){
    global $Connection;
    $Query = "SELECT * from `users` where `email` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$email]);
    if($result){
        $sqlres = $stmt->get_result();
        return $sqlres->fetch_assoc();
    }
    return;
}
