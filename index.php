<!-- Descrizione
Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale.
Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel. -->


<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

$parking = $_GET['parking'];
$vote = $_GET['vote'];

$filteredArray = array_filter($hotels, function ($elem) use ($vote, $parking) {
    if ($elem['vote'] >= $vote && $elem['parking'] == ($parking === 'true')) {
        return true;
    }
    return false;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <form action="index.php" method="GET">
        <div class="d-flex">
            <div>
               <label for="parking" class="d-block">Parcheggio:</label>
                <select name="parking" id="parking" class="d-block">
                    <option selected="true" value="">tutti gli hotel</option>
                    <option value="true">SI</option>
                    <option value="false">NO</option>
                </select> 
            </div>
            <div class="mx-3">
                <label for="vote" class="d-block">Stelle:</label>
                <select name="vote" id="vote" class="d-block">
                    <option selected="true" value="">tutti gli hotel</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>   
        </div>
        <button type="submit">submit</button>
    </form>

    <table class="table">
        <thead>
            <th scope="col">Name</th>
            <th scope="col">Info</th>
            <th scope="col">Parcheggio</th>
            <th scope="col">Voto</th>
            <th scope="col">Distanza dal centro</th>
        </thead>
        <tbody>

            <?php 
            
            if ($vote == '' && $parking == '') {
                foreach ($hotels as $elem){
                    echo "<tr>" . 
                            "<td>" . $elem['name'] . "</td>" . 
                            "<td>" . $elem['description'] . "</td>" . 
                            "<td>" . ($elem['parking'] ? 'si' : 'no') . "</td>" . 
                            "<td>" . $elem['vote'] . "</td>" . 
                            "<td>" . $elem['distance_to_center'] . "</td>" . 
                        "</tr>";
                };
            } else if ($vote != '' && $parking == '' ) {
                foreach ($hotels as $elem){
                    if ($elem['vote'] >= $vote){
                      echo "<tr>" . 
                            "<td>" . $elem['name'] . "</td>" . 
                            "<td>" . $elem['description'] . "</td>" . 
                            "<td>" . ($elem['parking'] ? 'si' : 'no') . "</td>" . 
                            "<td>" . $elem['vote'] . "</td>" . 
                            "<td>" . $elem['distance_to_center'] . "</td>" . 
                        "</tr>";  
                    }
                    
                };
            }
            else{

                foreach ($filteredArray as $elem) {
                    echo "<tr>" . 
                        "<td>" . $elem['name'] . "</td>" . 
                        "<td>" . $elem['description'] . "</td>" . 
                        "<td>" . ($elem['parking'] ? 'si' : 'no') . "</td>" . 
                        "<td>" . $elem['vote'] . "</td>" . 
                        "<td>" . $elem['distance_to_center'] . "</td>" . 
                    "</tr>";
                };
            }
            ?>

        </tbody>
            
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>