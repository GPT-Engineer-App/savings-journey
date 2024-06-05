<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');

$email = $_SESSION['email'];
$sql = "SELECT * FROM transacao WHERE tipo='Débito'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Gastos</h1>
        <canvas id="gastosChart"></canvas>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['descricao']; ?></td>
                    <td><?php echo $row['valor']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                    <td><?php echo $row['categoria_nome']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='add_gasto.php'">Adicionar Gasto</button>
    </div>
    <script>
        var ctx = document.getElementById('gastosChart').getContext('2d');
        var gastosChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
                datasets: [{
                    label: 'Gastos',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderColor: 'rgba(255, 99, 132, 1)',
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