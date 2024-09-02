<?php
require_once("conexao.php");

if (!empty($_REQUEST)){
    try{
        $email = $_REQUEST['email'];
        $password = hash('sha256' ,$_REQUEST['password']);
        print("$email<br>");
        print("$password<br>");

        $stmt = $conn->prepare("SELECT count(*) FROM user  WHERE email=? AND password=?");
        $stmt->execute([$email,$password]);
        $rs = $stmt->fetchALL()[0];
        print_r($rs);
        if($rs['count(*)'] == 0){
            print("Erro no login");
            $_SESSION = [];
            session_destroy();
        }
        else{
            session_start();
            $_SESSION['email'] = $email;
            header("location: menu.php");
        }
    }
        catch(PDOException $e){
            print("Error: " . $e->getMessage());
        

    }
}