<?php

header('Content-Type: application/json');
require './code/conexao.php';

$horariosDisponiveis = $conn->query("SELECT * FROM agendamentos WHERE age_nome_cliente = '' and age_celular = ''")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($horariosDisponiveis);

?>