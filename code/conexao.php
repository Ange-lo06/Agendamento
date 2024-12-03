<?php 

global $conn;

$servidor = "localhost";
$usuario = "pc";
$senha = "1234";
$banco = "agendamento";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// $sql = "SELECT * FROM AGENDAMENTOS where age_id = :id";

// $queryConsulta = $conn->query($sql);
// $linhas = $queryConsulta->fetch();


// $queryConsulta = $conn->prepare($sql);
// $queryConsulta->bindValue(':id', $id);
// $queryConsulta->execute();
// $linhas = $queryConsulta->fetchAll();
