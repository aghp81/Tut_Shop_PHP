<?php  
    include"../database/db.php";
    if(isset($_POST['submit'])){
        if(!empty($_POST['username'])){
            global $conn;

            $username = $_POST['username'];
            $phone = $_POST['phone'];
            $mail = $_POST['mail'];
            $pass = $_POST['pass'];

            $gt = $conn->prepare("INSERT INTO user SET username=?, phone=?, email=?, password=?");
            $gt->bindValue(1 , $username);
            $gt->bindValue(2 , $phone);
            $gt->bindValue(3 , $mail);
            $gt->bindValue(4 , $pass);
            $gt->execute();
        }
    }
    
?>

<form method="POST">
    <input type="text" name="username" placeholder="name">
    <input type="number" name="phone" placeholder="phone">
    <input type="email" name="mail" placeholder="mail">
    <input type="password" name="pass" placeholder="pass    ">
    <input name="submit" type="submit">
</form>

<a href="http://localhost/aghp.ir/pages/test.php">refresh</a>