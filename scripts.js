document.getElementById('quiz-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    const formData = new FormData(this);

    fetch('guardar_respuesta.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let result = "";
        let allCorrect = true;

        for (const [key, value] of Object.entries(data)) {
            if (value.correct) {
                result += `<p>${key}: Correcto</p>`;
            } else {
                result += `<p>${key}: Incorrecto (Respuesta correcta: ${value.correctAnswer})</p>`;
                allCorrect = false;
            }
        }

        if (allCorrect) {
            result += "<p>¡Todas las respuestas son correctas!</p>";
        }

        document.getElementById('result').innerHTML = result;
    })
    .catch(error => console.error('Error:', error));
});
