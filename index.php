<link rel="stylesheet" href="/assets/style/main.css">
<?php
session_start();

$tasks = $_SESSION["tasks"] ?? [];

if(isset($_POST["form"])){
    
    
    $tasks[] = $_POST["task"];

    $_SESSION["tasks"] = $tasks;
}

if(isset($_GET["clear"])){
    session_destroy();
    header("Location: index.php");
}

if(isset($_GET["delete"])){
    $index = $_GET["delete"]?? -1; 
    array_splice($tasks,$index,1);
    $_SESSION["tasks"] = $tasks;
    header("Location: index.php");
}


?>

<section>
    <?php
    foreach($tasks as $key => $task){
    ?>
        <div>
            <a style="color: red;" href="index.php?delete=<?php echo $key?>">Delete</a>
            
            <?php echo $task?>
            
        </div>
    <?php
    }
    ?>
</section>





<form method="post">
    <input type="text" name="task">
    <button name="form" value="todo">submit</button>
</form>

<a href="index.php?clear=1">Clear Data</a>