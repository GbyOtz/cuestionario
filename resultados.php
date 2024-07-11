<?php
$correctAnswers = [
    'respuesta1' => 'Falso',
    'respuesta2' => 'Verdadero',
    'respuesta3' => 'Falso',
    'respuesta4' => 'Verdadero',
    'respuesta5' => 'Verdadero',
    'respuesta6' => 'Falso',
    'respuesta7' => 'Verdadero',
    'respuesta8' => 'Verdadero',
    'respuesta9' => 'Falso'
];

$userAnswers = [];
for ($i = 1; $i <= 9; $i++) {
    $userAnswers['respuesta'.$i] = $_GET['respuesta'.$i] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Cuestionario</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h1>Resultados del Cuestionario</h1>
    <?php
    foreach ($correctAnswers as $key => $value) {
        echo "<p>";
        echo "<strong>$key:</strong> ";
        if ($userAnswers[$key] === $value) {
            echo "Correcto";
        } else {
            echo "La respuesta correcta es: $value";
        }
        echo "</p>";
    }
    ?>
    <div class="button-container">
        <a href="index.html" class="button">Regresar al Inicio</a>
    </div>
</body>
</html>
