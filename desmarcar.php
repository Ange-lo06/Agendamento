<?php

require './code/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluindo o agendamento
    $sql_delete = "update agendamentos set age_nome_cliente = '', age_celular = '' WHERE age_id = $id";

    if ($conn->query($sql_delete)) {
        echo "Agendamento desmarcado com sucesso!";
        header("Location: admin.php"); // Redireciona para a página do administrador
        exit;
    } else {
        echo "Erro ao excluir agendamento: " . $conexao->error;
    }
}
