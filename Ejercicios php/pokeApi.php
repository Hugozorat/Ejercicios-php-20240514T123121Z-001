<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poke api</title>
</head>
<body>
        <h1>Api de pokemons</h1>
        <form method="post" action="pokeApi.php">
            <label for="">Introduce un número del 1 al 20</label>
            <input type="text" id="numero" name="numero">
            <input type="submit"values="buscar">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $numero = $_POST['numero'];
            if($numero >=1 && $numero <=20){
                $apiurl = "https://pokeapi.co/api/v2/pokemon/";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiurl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                $arraypokemon = json_decode($respuesta,true);

                echo"<h1>Pokemons</h1>";
                for($i = 0; $i < $numero; $i++){
                    echo '<b>Nombre: </b>' . $nombre = $arraypokemon['results'][$i]['name'];?>  
                    <p><a href="infoPokemons.php?id=<?php echo $nombre?>">Más información</a></p>
                <?php
                }
            }elseif($numero == ""){
                echo"<p>Error: Campo obligatorio";
                
            }elseif(!filter_var($numero, FILTER_VALIDATE_INT)){
            echo"<p>Error: Debe introducirse un número natural entre el 1 y el 20";
        
            }elseif(($numero < 1) || ($numero > 20)) {
                echo "<p>Error: El número debe estar entre 1 y 20</p>";
            }
        }
        ?>
</body>
</html>