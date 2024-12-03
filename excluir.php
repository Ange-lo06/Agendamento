<?php

require './code/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluindo o agendamento
    $sql_delete = "delete from agendamentos WHERE age_id = $id";

    if ($conn->query($sql_delete)) {
        echo "Agendamento excluído com sucesso!";
        header("Location: admin.php"); // Redireciona para a página do administrador
        exit;
    } else {
        echo "Erro ao excluir agendamento: " . $conexao->error;
    }
}
