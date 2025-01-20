<?php 
include_once __DIR__."/../includes/conn.php";
include_once __DIR__."/users_util.php";



//Create
function create_product(int $owner, string $name, float $price, string $image){
    global $Connection; 
    $Query = "INSERT INTO `products` (`owner`, `name`, `price`, `img`) VALUES (?, ?, ?, ?)";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$owner, $name, $price, $image]);
    if($result){
        return true;
    }

    return false;
}

//Update
function update_product(int $id,int $owner ,PRODUCT_FIELD $field,$new_value ){
    global $Connection;
    $field_str = "";
    switch($field){
        case PRODUCT_FIELD::NAME:
            $field_str = "name";
            break; 
        case PRODUCT_FIELD::IMAGE:
            $field_str = "img";
            break;
        case PRODUCT_FIELD::PRICE:
            $field_str = "price";
            break; 
        default:
            throw new InvalidArgumentException("The Product Field Cannot Be Updated");
    }
    $Query = "UPDATE `products` SET `$field_str` = ? WHERE `id` = ? AND `owner` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$new_value, $id, $owner]);
    if($result){
        if($stmt->affected_rows){
            return true;
        }
        throw new InvalidArgumentException("User Not Found");
    }
    
}
enum PRODUCT_FIELD{
    case NAME;
    case IMAGE;
    case PRICE;
}


//Delete

function delete_product_by_id(int $id){
    global $Connection;
    $Query = "DELETE from `products` where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$id]);
    if($result){
        return true;
    }
    return;
}
//GetAll
function get_products(){
    global $Connection;
    $Query = "SELECT * from `products` WHERE 1";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute();
    if($result){
        $sqlres = $stmt->get_result();
        return $sqlres->fetch_all(MYSQLI_ASSOC);
    }
    return;
}

//GetById
function get_product_by_id(int $id){
    global $Connection;
    $Query = "SELECT * from `products` where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([$id]);
    if($result){
        $sqlres = $stmt->get_result();
        return $sqlres->fetch_assoc();
    }
    return;
}

//AddToCart

function add_product_to_cart(int $id,int $user_id){
    global $Connection;
    $product = get_product_by_id($id);
    
    if($product == null){
        throw new InvalidArgumentException("Product Not Found");
    }
    $user= get_user_by_id($user_id);
    if($user == null){
        throw new InvalidArgumentException("User Not Found");
    }
    $cart = json_decode($user["cart"]??"[]");
    
    $cart[] = $id;

    $Query = "UPDATE `users` SET `cart` = ?  where `id` = ?";
    $stmt = $Connection->prepare($Query);
    $result = $stmt->execute([json_encode($cart), $user_id]);
    if($result){
        if($stmt->affected_rows){
            return true;
        }
        throw new InvalidArgumentException("User Not Found");
    }
    return;
}
