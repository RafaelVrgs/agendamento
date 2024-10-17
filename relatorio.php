<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // Coloque a sua senha, se houver
$dbname = "agendamento";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se uma data foi passada pelo formulário
$dataFiltro = isset($_POST['dataFiltro']) ? $_POST['dataFiltro'] : date('Y-m-d');

// Consulta os agendamentos para a data selecionada, ordenando por horário
$sql = "SELECT * FROM agendamentos WHERE data_agendamento = '$dataFiltro' ORDER BY horario ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Agendamentos</title>
    <link rel="stylesheet" href="style.css"> <!-- Inclua seu CSS aqui -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Fonte mais moderna */
            background-color: #f4f4f4; /* Cor de fundo */
            margin: 20px;
        }

        h1 {
            color: #333; /* Cor do título */
        }

        table {
            width: 100%; /* Tabela ocupa toda a largura */
            border-collapse: collapse; /* Remove espaços entre as células */
            margin-top: 20px; /* Espaço acima da tabela */
        }

        th, td {
            padding: 12px; /* Espaçamento interno nas células */
            text-align: left; /* Alinhamento à esquerda */
            border-bottom: 1px solid #ddd; /* Linha inferior nas células */
        }

        th {
            background-color: #4CAF50; /* Cor de fundo do cabeçalho */
            color: white; /* Cor do texto do cabeçalho */
        }

        tr:hover {
            background-color: #f1f1f1; /* Cor de fundo ao passar o mouse */
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9; /* Cor de fundo em linhas pares */
        }
    </style>
</head>
<body>
    <h1>Relatório de Agendamentos</h1>
    
    <form method="POST" action="relatorio.php">
        <label for="dataFiltro">Selecione uma data:</label>
        <input type="date" id="dataFiltro" name="dataFiltro" value="<?php echo $dataFiltro; ?>" required>
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibe os dados em linhas da tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['placa']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['cpf']}</td>
                            <td>{$row['data_agendamento']}</td>
                            <td>{$row['horario']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum agendamento encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php">Voltar</a>
</body>
</html>

<?php
$conn->close();
?>
