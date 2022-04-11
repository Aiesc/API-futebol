<?php
error_reporting(E_ERROR | E_PARSE);
$id = $_GET['id'];

$uri = 'http://api.football-data.org/v2/teams/'.$id;
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: c710e33b71fe486c949abef77404ed69';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$matches = json_decode($response);

if(!empty($matches) || empty($matches->crestUrl)){
    $existe = 1;
   // print_r($matches);
}else{
    $existe = 0;
    echo "nao";
}

$count = count($matches->squad);
if($count != 0){
    for($i=0;$i<$count;$i++){
        if($matches->squad[$i]->role == "COACH"){
            $tecnico = $matches->squad[$i]->name;
        }else{
            $tecnico = "Sem Técnico!";
        }
    }
}else{
    $tecnico = "Sem técnico definido!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/icon.png">
</head>
<body>
    <div>
        <div class="px-4 py-5 my-2 text-center">
            <img class="d-block mx-auto" src="<?=$matches->crestUrl ?>" alt="" width="85" height="85">
            <h1 class="display-5 fw-bold"><?=$matches->name?></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead"><?=$tecnico?></p>
            </div>
        </div>
        <div class="b-example-divider"></div>
        <div class="container marketing">
            <div class="row">
            <?php if($existe==1){ ?>
                <?php for ($i=0;$i<$count;$i++){ ?>
                  <div class="col-lg-4">
                    <div>
                    <h4 class="fw-bold mb-3"><?=$matches->squad[$i]->name?></h4>
                    <p><?=$matches->squad[$i]->position?></p>
                    <p><?=$matches->squad[$i]->nationality?></p>
                    <p><?php
                            $aniversario = date('Y', strtotime($matches->squad[$i]->dateOfBirth ));
                            print_r(date('Y') - $aniversario);
                        ?></p>
                    </div>
                  </div>
                <?php } ?>
            <?php }else{ ?>
                <h1 class="display-5 fw-bold text-center my-5">Nenhuma informação encontrada.</h1>
            <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>