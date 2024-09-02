<?php
require_once("conexao.php");
if($_SERVER['REQUEST_METHOD']=='GET'){
    $stmt = $conn->prepare("SELECT * FROM uf ORDER BY nome");
    $stmt->execute();
    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print(json_encode($rs));
}
?>