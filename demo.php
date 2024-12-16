<!DOCTYPE html>
<html lang="en">

<?php
include __DIR__."/includes/header.php";
?>

<body>

    <?php
    include __DIR__."/includes/nav.php";
    ?>
    
    
    <main>
    <?php
        include __DIR__."/components/intro.component.html";
        include __DIR__."/components/services.component.html";
        include __DIR__."/components/gallery.component.html";
        include __DIR__."/components/about.component.html";
        include __DIR__."/components/contact.component.html";
    
    ?>

    </main>
</body>


<?php
include __DIR__."/includes/footer.php";
?>

</html>

