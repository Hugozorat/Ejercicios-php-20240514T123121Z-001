<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Rick and Morty</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Api Rick and Morty</h1>
        <form method="POST" action="" class="mt-3">
            <div class="form-group">
                <label for="cantidad_personajes">Cantidad de personajes:</label>
                <input type="text" class="form-control" id="cantidad_personajes" name="cantidad_personajes">
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="seleccionar_genero">Seleccionar Género</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
            </div>
            <div class="form-group">
                <label for="especie">Especie:</label>
                <select class="form-control" id="especie" name="especie">
                    <option value="seleccionar_especie">Seleccionar Especie</option>
                    <option value="human">Human</option>
                    <option value="alien">Alien</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Personajes</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cantidad_personajes = $_POST["cantidad_personajes"];
            $genero = $_POST["genero"];
            $especie = $_POST["especie"];
        
            if (!filter_var($cantidad_personajes, FILTER_VALIDATE_INT)) {
                echo "<span style='color: red;'>El valor no es un número entero válido</span>";
            } elseif ($genero == "seleccionar_genero" || $especie == "seleccionar_especie") {
                echo "<span style='color: red;'>Selecciona una opción válida para género y especie</span>";
            } else {
                $url = "https://rickandmortyapi.com/api/character/?gender=$genero&species=$especie&limit=$cantidad_personajes";

        
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                curl_close($curl);
                $personajes = json_decode($respuesta, true);
                $count = 0;
                if (!empty($personajes['results'])) {
                    echo "<h2 class='mt-5'>Personajes:</h2>";
                    foreach ($personajes['results'] as $character) {
                        if($count < $cantidad_personajes){
                            echo "<div class='card mt-3'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'><strong>Nombre:</strong> " . $character['name'] . "</h5>";
                            echo "<p class='card-text'><strong>Género:</strong> " . $character['gender'] . "</p>";
                            echo "<p class='card-text'><strong>Especie:</strong> " . $character['species'] . "</p>";
                            echo "<p class='card-text'><strong>Origen:</strong> " . $character['origin']['name'] . "</p>";
                            echo "<img src='" . $character['image'] . "' class='card-img-top' alt='Character Image'>";
                            echo "</div>";
                            echo "</div>";
                            $count++;
                        } else {
                            break;
                        }
                    } 
                } else {
                    echo "<p>No se encontraron los personajes.</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>