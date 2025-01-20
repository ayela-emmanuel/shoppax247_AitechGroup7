<?php 
session_start();
include __DIR__."/db/users_util.php";


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

var_dump($_POST);


?>


<form name="login" method="post">

</form>
<form  method="post">
    <div>
        <label>Username</label>
        <input type="Text" name="name" />
    </div>
    <div>
        <label>Email</label>
        <input type="Email" name="email" />
    </div>
    <div>
        <label>Password</label>
        <input type="Password" name="pwd" />
    </div>
    <button name="register" >submit</button>
</form>



