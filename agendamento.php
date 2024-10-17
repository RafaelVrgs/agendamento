<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";  // Insira o usuário do seu banco de dados
$password = "";      // Insira a senha do seu banco de dados
$dbname = "agendamento"; // Nome do banco de dados

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Define o número máximo de vagas para cada horário
$vagas_disponiveis = [
    "08:20" => 1,
    "08:40" => 1,
    "09:00" => 2,
    "09:30" => 2,
    "10:00" => 2,
    "10:30" => 2,
    "11:00" => 2,
    "13:30" => 2,
    "14:00" => 2,
    "14:30" => 2,
    "15:00" => 2,
    "15:30" => 2,
    "16:00" => 2
];

// Recebe os dados
$data = $_POST['data'];
$horario = $_POST['horario'];
$placa = $_POST['placa'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

// Verifica quantos agendamentos já existem para o horário e data selecionados
$sql = "SELECT COUNT(*) as total_agendamentos FROM agendamentos WHERE data_agendamento = '$data' AND horario = '$horario'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_agendamentos = $row['total_agendamentos'];

// Verifica se ainda há vagas disponíveis
if ($total_agendamentos >= $vagas_disponiveis[$horario]) {
    echo "Erro: Não há mais vagas para o horário $horario no dia $data.";
    exit();
}

// Insere o agendamento no banco de dados se houver vagas
$sql = "INSERT INTO agendamentos (data_agendamento, horario, placa, nome, cpf) VALUES ('$data', '$horario', '$placa', '$nome', '$cpf')";

if ($conn->query($sql) === TRUE) {
    echo "Agendamento realizado com sucesso!";
    echo '<a href="index.php"><button type="button">Voltar para o Agendamento</button></a>';
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
    echo '<a href="index.php"><button type="button">Voltar para o Agendamento</button></a>';
}

// Fecha a conexão
$conn->close();
?>
