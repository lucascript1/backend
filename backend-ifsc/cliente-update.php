<?php
require_once("conexao.php");

print_r($_REQUEST);
$request = (object) $_REQUEST;

try {
    $stmt = $conn->prepare("UPDATE cliente SET nome = :nome, email = :email WHERE codigo = :codigo");
    $stmt->execute($_REQUEST);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>