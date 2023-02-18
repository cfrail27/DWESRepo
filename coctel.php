<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url(estilo.css);
        </style>
    </head>
    <body>
        <header>
        <h1>Buscador de cócteles</h1>
        </header>
        <hr>
        <nav>
            <ul>
                <li><a href=>Inicio</a></li>
                <li><a href="coctel.php">Buscador de cócteles</a></li>
                <li><a href=>Contacto</a></li>
                <li><a href=>Dónde estamos</a></li>
            </ul>
        </nav>
    
        <h2>Buscar un Cóctel:</h2>
        <h3>En esta sección vas a poder buscar información sobre el cóctel que desees.</h3> 
                  
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="get">
            <label for="id">Introduzca el id del cóctel (11000 - 11029) (11015, 11017 y 11018 NO DISPONIBLES): </label>
            <input id="id" name="id" type="text">
            <input type="submit" value="Buscar">
        </form>
        <div>
        <?php
        $url = "";
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            if($id==11015 || $id==11017 || $id==11018){
                echo "Este cóctel actualmente no está disponible";
            }
            if ($id > 10999 && $id < 11030){
                $url = "https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=".$id;
                $infoCoctel = file_get_contents($url);
                $infoCoctel = json_decode($infoCoctel,true);

                foreach($infoCoctel["drinks"] as $coctel){
                    echo "<img src = '" . $coctel["strDrinkThumb"] . "' /> <br>";
                    echo "<div id='info'>";
                    echo "<strong>ID: </strong>" . $coctel["idDrink"] . "<br><br>";
                    echo "<strong>Nombre: </strong>" . ucfirst($coctel["strDrink"]) . "<br><br>";
                    echo "<strong>Categoría: </strong>" . $coctel["strAlcoholic"] . "<br><br>";
                    echo "<strong>Modo de preparación: </strong>" . $coctel["strInstructions"] . "<br><br>";
                    echo "<strong>Tipo de vaso: </strong>" . $coctel["strGlass"] . "<br><br>";
                    echo "</div>";
                }
                
            } 
            else {
                echo "No hay ningun cóctel con ese ID";
            }            
        }         
    ?>
        </div>
    </body>
</html>