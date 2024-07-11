<?php
// Mostrar todos los errores de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    
    $respuesta1 = $_POST['respuesta1'];
    $respuesta2 = $_POST['respuesta2'];
    $respuesta3 = $_POST['respuesta3'];
    $respuesta4 = $_POST['respuesta4'];
    $respuesta5 = $_POST['respuesta5'];
    $respuesta6 = $_POST['respuesta6'];
    $respuesta7 = $_POST['respuesta7'];
    $respuesta8 = $_POST['respuesta8'];
    $respuesta9 = $_POST['respuesta9'];

    $userAnswers = [];
    for ($i = 1; $i <= 9; $i++) {
        $userAnswers['respuesta'.$i] = $_POST['respuesta'.$i] ?? '';
    }

    // Inserta el nombre en la base de datos
    $sql = "INSERT INTO respuestas (respuesta1, respuesta2, respuesta3, respuesta4, respuesta5, respuesta6, respuesta7, respuesta8, respuesta9) 
            VALUES ('$respuesta1', '$respuesta2', '$respuesta3', '$respuesta4', '$respuesta5', '$respuesta6', '$respuesta7', '$respuesta8', '$respuesta9')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Respuestas guardadas con éxito.');
        window.location.href = 'resultados.php';
      </script>";
} else {
echo "<script>
        alert('Error: " . $sql . "<br>" . $conn->error . "');
        window.history.back();
      </script>";
}
}

$conn->close();
?>
