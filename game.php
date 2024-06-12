<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email'])) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['surname'] = $_POST['surname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['number'] = rand(1, 1000);
    $_SESSION['attempts'] = 0;
    $_SESSION['max_attempts'] = 10;
    $_SESSION['guesses'] = [];
}

if (!isset($_SESSION['name']) || !isset($_SESSION['surname']) || !isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$remaining_attempts = $_SESSION['max_attempts'] - $_SESSION['attempts'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guess'])) {
    $guess = (int)$_POST['guess'];
    $_SESSION['attempts']++;
    $_SESSION['guesses'][] = $guess;

    if ($guess < $_SESSION['number']) {
        $message = "Daha büyük bir sayı söyle.";
    } elseif ($guess > $_SESSION['number']) {
        $message = "Daha küçük bir sayı söyle.";
    } else {
        header("Location: result.php");
        exit();
    }

    if ($_SESSION['attempts'] >= $_SESSION['max_attempts']) {
        header("Location: result.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayı Bulma Oyunu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sayı Bulma Oyunu</h1>
    <p>Merhaba, <?php echo htmlspecialchars($_SESSION['name']) . ' ' . htmlspecialchars($_SESSION['surname']); ?>!</p>
    <p>1 ile 1000 arasında bir sayı tuttum. Tahmin et bakalım!</p>
    <p>Kalan hakkınız: <?php echo $remaining_attempts; ?></p>

    <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <form action="" method="post">
        <label for="guess">Tahmininiz:</label>
        <input type="number" id="guess" name="guess" min="1" max="1000" required><br>
        <button type="submit">Tahmin Et</button>
    </form>
</body>
</html>
