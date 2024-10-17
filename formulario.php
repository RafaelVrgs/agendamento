
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

// Recebe os dados da data e horário
$data = $_GET['data'];
$horario = $_GET['horario'];

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

// Verifica quantos agendamentos já existem para o horário e data selecionados
$sql = "SELECT COUNT(*) as total_agendamentos FROM agendamentos WHERE data_agendamento = '$data' AND horario = '$horario'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_agendamentos = $row['total_agendamentos'];

// Verifica se ainda há vagas disponíveis
if ($total_agendamentos >= $vagas_disponiveis[$horario]) {
    echo "Não há mais vagas disponíveis para o horário $horario no dia $data.";
    exit();
}

// Continua com o formulário se houver vagas
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Vistoria</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Agendar Vistoria</h2>
        <form action="agendamento.php" method="POST">
            <div class="form-group">
                <label for="data">Data Selecionada</label>
                <input type="text" id="data" name="data" value="<?php echo $data; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="horario">Horário Selecionado</label>
                <input type="text" id="horario" name="horario" value="<?php echo $horario; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="placa">Placa do Veículo</label>
                <input type="text" id="placa" name="placa" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <button type="submit" class="btn">Confirmar Agendamento</button>
        </form>
    </div>
</body>
</html>
