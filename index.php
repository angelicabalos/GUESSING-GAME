<!-- BALOS, BOBIS, MODESTO, ESPALLARDO -->

<?php
session_start();
if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = 3; 
}

if (!isset($_SESSION['attempt'])) {
    $_SESSION['attempt'] = 0;
}

if (isset($_POST['submit'])) {
    $guess = intval($_POST['guess']);
    $number = $_SESSION['number'];
    $_SESSION['attempt']++;

    if ($guess == $number) {
        $message = "Congratulations! You guessed the secret number!";
        session_destroy(); 
    } elseif ($_SESSION['attempt'] >= 3) {
        $message = "Sorry, you've used all attempts. The secret number was $number.";
        session_destroy(); 
    } else {
        $message = $guess > $number ? "Too high!" : "Too low!";
    }
}

$attempt = $_SESSION['attempt'];
$attempts_left = 3 - $attempt;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>
</head>
<body>

<h1>Number Guessing Game</h1>

<p>  Attempts left: <?= $attempts_left; ?></p>

<?php if (isset($message)): ?>
    <p><?= $message; ?></p>
<?php endif; ?>

<?php if ($attempt < 3 && (!isset($message) || $message != "Congratulations! You guessed the number!")): ?>
    <form action="" method="POST">
        <label for="guess">Enter your guess (1-10):</label>
        <input type="number" name="guess" id="guess" min="1" max="10" required>
        <input type="submit" value="Submit Guess" name="submit">
    </form>
<?php elseif ($attempt >= 3): ?>
    <p style="color:red;">No more attempts left! The number was <?= $_SESSION['number']; ?>. Refresh the page to play again.</p>
<?php endif; ?>

</body>
</html>
