<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');

$email = $_SESSION['email'];
$sql = "SELECT * FROM investimentos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investimentos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Investimentos</h1>
        <canvas id="investimentosChart"></canvas>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor Atual</th>
                    <th>Retorno</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['valor_atual']; ?></td>
                    <td><?php echo $row['retorno']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='add_investimento.php'">Adicionar Investimento</button>
    </div>
    <script>
        var ctx = document.getElementById('investimentosChart').getContext('2d');
        var investimentosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
                datasets: [{
                    label: 'Investimentos',
                    data: [10, 20, 30, 40, 50, 60, 70],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>