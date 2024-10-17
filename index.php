<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Vistoria de Veículo</title>
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
            max-width: 600px;
            width: 100%;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .date-selector {
            margin-bottom: 20px;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Escolha uma data e horário para a vistoria</h2>
        <form id="agendamentoForm" method="GET" action="formulario.php">
           <div class="date-selector">
                <label for="data">Selecione uma data (mínimo hoje e máximo 7 dias à frente):</label>
                <input type="date" id="data" name="data" required 
           min="<?php echo date('Y-m-d'); ?>" 
           max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
            </div>


            <table>
                <thead>
                    <tr>
                        <th>Horário</th>
                        <th>Vagas Disponíveis</th>
                        <th>Selecionar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>08:20</td>
                        <td id="vagas-08-20">1 vaga</td>
                        <td><button type="button" class="btn" onclick="escolherHorario('08:20')">Agendar</button></td>
                    </tr>
                    <tr>
                        <td>08:40</td>
                        <td id="vagas-08-40">1 vaga</td>
                        <td><button type="button" class="btn" onclick="escolherHorario('08:40')">Agendar</button></td>
                    </tr>
                    <tr>
                        <td>09:00</td>
                        <td id="vagas-09-00">2 vagas</td>
                        <td><button type="button" class="btn" onclick="escolherHorario('09:00')">Agendar</button></td>
                    </tr>
                    <tr>
                    <td>09:30</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('09:30')">Agendar</button></td>
                </tr>
                <tr>
                    <td>10:00</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('10:00')">Agendar</button></td>
                </tr>
                <tr>
                    <td>10:30</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('10:30')">Agendar</button></td>
                </tr>
                <tr>
                    <td>11:00</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('11:00')">Agendar</button></td>
                </tr>
                <!-- Horários da tarde -->
                <tr>
                    <td>13:30</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('13:30')">Agendar</button></td>
                </tr>
                <tr>
                    <td>14:00</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('14:00')">Agendar</button></td>
                </tr>
                <tr>
                    <td>14:30</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('14:30')">Agendar</button></td>
                </tr>
                <tr>
                    <td>15:00</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('15:00')">Agendar</button></td>
                </tr>
                <tr>
                    <td>15:30</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('15:30')">Agendar</button></td>
                </tr>
                <tr>
                    <td>16:00</td>
                    <td>2 vagas</td>
                    <td><button type="button" class="btn" onclick="escolherHorario('16:00')">Agendar</button></td>
                </tr>
                    
                </tbody>
            </table>
            <input type="hidden" id="horarioSelecionado" name="horario">
            <button type="submit" style="display:none;" id="submitForm">Submit</button>
        </form>
    </div>


<!-- Botão para acessar o relatório -->
<div>
    <a href="relatorio.php">
        <button type="button">Ver Relatório de Agendamentos</button>
    </a>
</div>

    <script>

        function escolherHorario(horario) {
            // Preenche o campo oculto com o horário selecionado
            document.getElementById('horarioSelecionado').value = horario;
            // Submete o formulário
            document.getElementById('submitForm').click();
        }
    </script>
</body>
</html>

               
