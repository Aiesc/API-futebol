<?php
    error_reporting(E_ERROR | E_PARSE);
    $uri = 'http://api.football-data.org/v2/competitions/';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: c710e33b71fe486c949abef77404ed69';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $matches = json_decode($response);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API -Futebol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/icon.png">
</head>
<body>
    <div>
      <div class="px-4 py-5 my-2 text-center">
        <img class="d-block mx-auto mb-4" src="https://imagepng.org/wp-content/uploads/2017/10/bola.png" alt="" width="65" height="65">
        <h1 class="display-5 fw-bold">Competições</h1>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">football-data.org</p>
        </div>
      </div>
        <div class="b-example-divider"></div>  
        <div class="list-group">
        <?php 
            if ($matches->count>0){
                for ($i=0;$i<$matches->count;$i++){ ?>
                <a href="pagina/campeonato.php?id=<?=$matches->competitions[$i]->id ?> " class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                  <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                      <h6 class="mb-0"><?=$matches->competitions[$i]->name?></h6>
                      <p class="mb-0 opacity-75"><?=$matches->competitions[$i]->area->name?></p>
                    </div>
                    <small class="opacity-50 text-nowrap"><img class="d-block mx-auto mb-4" src="img/<?=$matches->competitions[$i]->plan?>.png" alt="" width="35" height="35"></small>
                  </div>
                </a>
        <?php
                }
            }else{?>
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h6 class="mb-0">Não esta ocorrendo nenhuma competição.</h6>
              </div>
            </div>
        <?php } ?>
        </div>
    </div>
</body>
</html>