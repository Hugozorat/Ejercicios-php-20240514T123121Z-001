<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $id = $_GET["id"];
        $url = "https://pokeapi.co/api/v2/pokemon/$id";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);
        $array = json_decode($respuesta, true);

        echo '<h1>'.$array['name'].'</h1>';
        echo '<img src="'.$array['sprites']['front_default'].'"alt="">';
        echo'<li><b> Habilidades: </b>';
        echo'<ul>';
        foreach($array['abilities'] as $ability){

            echo '<li>' . $ability['ability']['name'].'</li>';
        }
        echo '</ul>';
        echo '</li>';
        echo '</ul>';

    }

    ?>
</body>
</html>