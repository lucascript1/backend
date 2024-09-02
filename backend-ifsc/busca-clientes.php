<?php
    require_once("conexao.php");

    try {
        if (empty($_REQUEST['expressaoBusca'])) {
            $stmt = $conn->prepare("SELECT cliente.codigo, cliente.nome, cliente.email, uf.sigla FROM cliente,uf WHERE cliente.id_uf = uf.id_uf ORDER BY cliente.nome");
        }else{
            $e = $_REQUEST['expressaoBusca'];
            $stmt = $conn->prepare("SELECT cliente.codigo, cliente.nome, cliente.email, uf.sigla FROM cliente,uf WHERE cliente.id_uf = uf.id_uf AND cliente.nome LIKE '%$e%' ORDER BY cliente.nome ");
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        print($json);
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $conn = null;
