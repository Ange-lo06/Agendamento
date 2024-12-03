<?php

require './code/conexao.php';
/*
//consulta SQL
$sql = "SELECT agendamento_id, agendamento_serviços, agendamento_data, agendamento_horário, agendamento_nome_cliente, agendamento_celular from agendamentos ";
$resultado = $conexao-> query($sql);

if($resultado->num_rows > 0){
    //exibindo os dados
    while($linha = $resultado->fetch_assoc()){
        echo "id: " .$linha["agendamento_id"]. " - serviço: " .$linha["agendamento_serviços"]. " - data: " .$linha["agendamento_data"]. 
        "- horario: " .$linha["agendamento_horário"] . "- nome: " .$linha["agendamento_nome_cliente"] . "- celular: " . $linha["agendamento_celular"]. "<br>";
    }
} else{
    echo "Nenhum resultado encontrado!";
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário foi enviado via POST
    $nome = $_POST['nome'];
    $celular = $_POST['celular'];
    $servico = $_POST['servico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // Inserindo os dados no banco
    $sql = "update agendamentos set age_nome_cliente = '$nome', age_celular = '$celular' where age_servico = '$servico' and age_data = '$data' and age_horario = '$horario'";
    
    try {
        if ($conn->query($sql)) {
            //echo "Agendamento realizado com sucesso!";
            //echo  $sql;
            header("Location: index.php?success=1"); // Redireciona para a página inicial
        }
    } catch (Exception $e) {
        echo 'Erro: ',  $e->getMessage(), "\n";
    }
}