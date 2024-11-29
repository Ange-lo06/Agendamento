<?php 
$servidor = "localhost";
$usuario = "pc";
$senha = "1234";
$banco = "agendamento";

//criando conexão
$conexao = new mysqli($servidor, $usuario,$senha, $banco);

//verificando conexao
if($conexao -> connect_error){
    die("Falha na conexão: " . $conexao->connect_error);
}
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
    $cliente = $_POST['cliente'];
    $servico = $_POST['servico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // Inserindo os dados no banco
    $sql = "INSERT INTO agendamentos (cliente, servico, data, horario) VALUES ('$cliente', '$servico', '$data', '$horario')";
    
    if ($conexao->query($sql) === TRUE) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao agendar: " . $conexao->error;
    }
}
//fechando a conexão
$conexao->close();
?>