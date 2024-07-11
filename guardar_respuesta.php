<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si tienes un usuario diferente
$password = ""; // Cambia esto si tienes una contraseña diferente
$dbname = "cuestionario_prueba"; // Asegúrate de que esta base de datos exista

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos<br>";
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir las respuestas del formulario
    $userAnswers = [];
    for ($i = 1; $i <= 9; $i++) {
        $userAnswers['respuesta'.$i] = $_POST['respuesta'.$i] ?? '';
    }

    // Guardar respuestas del usuario en la base de datos
    $sql = "INSERT INTO respuestas (respuesta1, respuesta2, respuesta3, respuesta4, respuesta5, respuesta6, respuesta7, respuesta8, respuesta9) 
            VALUES ('" . $userAnswers['respuesta1'] . "', '" . $userAnswers['respuesta2'] . "', '" . $userAnswers['respuesta3'] . "', '" . $userAnswers['respuesta4'] . "', '" . $userAnswers['respuesta5'] . "', '" . $userAnswers['respuesta6'] . "', '" . $userAnswers['respuesta7'] . "', '" . $userAnswers['respuesta8'] . "', '" . $userAnswers['respuesta9'] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Respuestas guardadas con éxito.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
    }

    // Respuestas correctas
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

    // Calcular puntuación
    $score = 0;
    foreach ($correctAnswers as $key => $value) {
        if ($userAnswers[$key] === $value) {
            $score += 10;
        }
    }

    // Mostrar puntuación y respuestas correctas
    echo "<h1>Resultados del Cuestionario</h1>";
    foreach ($correctAnswers as $key => $value) {
        echo "<p><strong>$key:</strong> ";
        if ($userAnswers[$key] === $value) {
            echo "Correcto";
        } else {
            echo "La respuesta correcta es: $value";
        }
        echo "</p>";
    }
    echo "<p><strong>Puntuación final:</strong> $score puntos.</p>";

    echo '<div class="button-container"><a href="index.html" class="button">Regresar al Inicio</a></div>';
}

$conn->close();
?>