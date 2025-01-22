<?php 
session_start();
include __DIR__."/db/users_util.php";
var_dump($_SESSION);

if(isset($_POST["login"])){
    $email = $_POST["email"]?? null;
    $pwd = $_POST["pwd"]?? null;
    try{
        $user = get_user_by_email($email);
        if($user != null){
            $result= verify_user_pwd_by_id($user["id"],$pwd);
            if($result){
                
                $_SESSION["user"] = $user;
                header("Location: /manage_products.php");

            }else{
                throw new InvalidArgumentException('Incorrect Password');

            }
        }else{
            throw new InvalidArgumentException('User Not Found');
        }
    }catch(InvalidArgumentException $e){
        echo $e->getMessage();
    }
}


if(isset($_POST["register"])){
    $name = $_POST["name"]?? null;
    $email = $_POST["email"]?? null;
    $pwd = $_POST["pwd"]?? null;

    // Validation 
    try{
        $result = create_user($name, $email, $pwd);
        if($result ){
            echo "Created"; 
        }else{
            echo "Failed To Create";
        }
    }catch(InvalidArgumentException $e){
        echo $e->getMessage();
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/custom.css">

</head>
<body>
    <?php include __DIR__."/components/nav.php"?>
    
    <div class="container">
    <form class="main_form" method="POST">
        <h1>Login</h1>
        <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
        <label  for="exampleInputPassword1">Password</label>
        <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button name="login" type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>


    <div class="container">
    <form class="main_form" method="POST">
        <h1>Register</h1>
        <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
        <label for="UserName">User Name</label>
        <input name="name" type="text" id="UserName" class="form-control" placeholder="Enter User Name">
        </div>
        
        <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button name="register" type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>





