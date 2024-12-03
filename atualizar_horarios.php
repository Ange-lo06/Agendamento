<?php

require './code/conexao.php';

$horarios = $_POST['horarios'];
$data = $_POST['data'];
$servico = $_POST['servico'];

if(!empty($horarios)) {
 $horarios = explode(',', str_replace(" ","",$horarios)); //['09:00', '10:00', '14:30']	
}

foreach ($horarios as $horario) {

    //VALIDAR SE EXISTE
    $queryValidar = $conn->query("SELECT * FROM agendamentos WHERE age_data = '$data' AND age_horario = '$horario' and age_servico = '$servico'");
    $linhas = $queryValidar->fetchAll();

    if (sizeof($linhas) > 0) {
        //SE EXISTE
        echo "Horário $horario ja cadastrado para o dia $data e serviço $servico<br>";
    } else {
        //SE NÃO EXISTE
        //09:00
        echo "Horário $horario inserido para o dia $data e serviço $servico<br>";
        $sql = "INSERT INTO agendamentos (age_nome_cliente, age_celular, age_data, age_servico, age_horario) VALUES ('', '', '$data', '$servico', '$horario')";
        try {
            $conn->query($sql);
        } catch (Exception $e) {
            echo 'Erro ao inserir horário: ',  $e->getMessage(), "\n";
        }
    }
}
header("Location: admin.php?success=1");
exit;
