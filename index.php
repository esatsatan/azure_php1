<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayı Bulma Oyunu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sayı Bulma Oyununa Hoş Geldiniz! (güncellendi)</h1>
    <form action="game.php" method="post">
        <label for="name">Ad:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="surname">Soyad:</label>
        <input type="text" id="surname" name="surname" required><br>
        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">Oyuna BAŞLA</button>
    </form>
</body>
</html>
