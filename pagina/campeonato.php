<?php
error_reporting(E_ERROR | E_PARSE);
$id = $_GET['id'];

$uri = 'http://api.football-data.org/v2/competitions/'.$id.'/teams';
$reqPrefs['http']['method'] = 'GET';
$reqPrefs['http']['header'] = 'X-Auth-Token: c710e33b71fe486c949abef77404ed69';
$stream_context = stream_context_create($reqPrefs);
$response = file_get_contents($uri, false, $stream_context);
$matches = json_decode($response);

if(!empty($response)){
    $existe = 1;
}else{
    $existe = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Campeonato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/icon.png">
</head>
<body>
    <div>
        <div class="px-4 py-5 my-2 text-center">
            <img class="d-block mx-auto mb-4" src="https://imagepng.org/wp-content/uploads/2017/10/bola.png" alt="" width="65" height="65">
            <h3 class="display-5 fw-bold"><?=$matches->competition->area->name?></h3>
            <h1 class="display-3 fw-bold"><?=$matches->competition->name?></h1>
        </div>
        <div class="b-example-divider"></div>
        <div class="container marketing">
            <div class="row">
                <?php 
                    if($existe==1){
                        for ($i=0;$i<$matches->count;$i++){ ?>
                    <div class="col-lg-4">
                        <img src="<?=$matches->teams[$i]->crestUrl?>" alt="Logo Time" width="65" height="65">
                        <h2><?php echo $matches->teams[$i]->shortName ?></h2>
                        <p><?php echo $matches->teams[$i]->tla ?></p>
                        <p><a class="btn btn-success" href="time.php?id=<?=$matches->teams[$i]->id ?>">Informações</a></p>
                    </div>
                <?php 
                        }
                    }else{ ?>
                    <h1 class="display-5 fw-bold text-center my-5">Nenhuma informação encontrada.</h1>
                <?php } ?>
          </div>
        </div>
    </div>
</body>
</html>