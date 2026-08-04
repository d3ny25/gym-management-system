<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=gimnasio_db;charset=utf8mb4', 'root', 'd3ny2004');
foreach (['usuarios','membresias','inscripciones','pagos'] as $table) {
    echo 'TABLE ' . $table . PHP_EOL;
    $stmt = $pdo->query('SHOW COLUMNS FROM ' . $table);
    foreach ($stmt as $row) {
        echo $row['Field'] . ' | ' . $row['Type'] . PHP_EOL;
    }
    echo '---' . PHP_EOL;
}
