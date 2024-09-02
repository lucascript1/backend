<?php
$servername = "localhost";
$username = "root";
$dbname = "meubanco";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $conn = new PDO("mysql:host=$servername", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $conn->exec("CREATE DATABASE meubanco");
    $conn->exec("USE meubanco");
}

try {
    $stmt = $conn->prepare("SELECT count(*) FROM user");
    $stmt->execute();
} catch (PDOException $e) {
    $stmt = $conn->prepare("CREATE TABLE user (
        id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
        email VARCHAR(255) UNIQUE, 
        password CHAR(64)
    )");
    $stmt->execute();
}

try {
    $stmt = $conn->prepare("SELECT count(*) FROM uf");
    $stmt->execute();
} catch (PDOException $e) {
    $stmt = $conn->prepare("CREATE TABLE uf (
        id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        nome varchar(100) NOT NULL,   
        sigla char(2) NOT NULL
    )");
    $stmt->execute();
}

try {
    $stmt = $conn->prepare("SELECT count(*) FROM cliente");
    $stmt->execute();
} catch (PDOException $e) {
    $stmt = $conn->prepare("CREATE TABLE `cliente` (
        codigo int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        nome varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        id_uf INT NOT NULL,
        FOREIGN KEY (id_uf) REFERENCES uf(id)
    )");
    $stmt->execute();
}
?>