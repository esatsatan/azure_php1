<?php
session_start();

$number = $_SESSION['number'];
$attempts = $_SESSION['attempts'];
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];

$data_file = 'data.json';
$data = [];

if (file_exists($data_file)) {
    $data = json_decode(file_get_contents($data_file), true);
}

$new_entry = ['name' => $name, 'surname' => $surname, 'attempts' => $attempts];
$data[] = $new_entry;

usort($data, function($a, $b) {
    return $a['attempts'] - $b['attempts'];
});

$data = array_slice($data, 0, 3);
file_put_contents($data_file, json_encode($data));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayı Bulma Oyunu Sonucu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Oyun Bitti!</h1>
    <p><?php echo $name . ' ' . $surname; ?>, oyun bitti. Tuttuğum sayı: <?php echo $number; ?></p>
    <p>Tahmin sayınız: <?php echo $attempts; ?></p>
    
    <h2>En İyi 3 Oyuncu</h2>
    <ul>
        <?php foreach ($data as $entry): ?>
            <li><?php echo $entry['name'] . ' ' . $entry['surname'] . ': ' . $entry['attempts'] . ' tahmin'; ?></li>
        <?php endforeach; ?>
    </ul>
    
    <a href="index.php">Yeniden Oyna</a>
</body>
</html>
