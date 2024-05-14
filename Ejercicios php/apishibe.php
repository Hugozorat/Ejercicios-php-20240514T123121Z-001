<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">API de Shibes</h1>
        <form method="post" class="mt-3">
            <div class="form-group">
                <label for="numero">Introduce el número de shibes que quieres ver</label>
                <input type="text" class="form-control" id="numero" name="numero">
            </div>
            <button type="submit" class="btn btn-primary">Enseñame Shibes</button>
        </form>
        
        <div class="mt-5">
            <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $numero = $_POST["numero"];
                $apiurl = "http://shibe.online/api/shibes?count=$numero";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $apiurl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $respuesta = curl_exec($curl);
                $array = json_decode($respuesta,true);

                
                foreach($array as $perros){?>
                    <img src="<?php echo $perros ?>" class="img-fluid rounded m-2" alt="Shibe">
                <?php }
                
            }
            ?>
        </div>
    </div>
</body>
</html>