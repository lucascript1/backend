<?php  
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "meubanco";

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM cliente");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    print($json);
    

} catch(PDOexception $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>