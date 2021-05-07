<?php $url = "http://127.0.0.1:8001/blog/redacteurs";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$dataredacteur = json_decode($response);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Rédacteurs</title>
</head>
<body>
    <h1 class="center">Liste de tous les rédacteurs</h1>
    <div class="row">
        <div class="col-7">
            <table class="table">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                </thead>
                <tbody>
                <?php
                foreach($dataredacteur as $redacteur)
                {
                ?>
                <tr>
                <td><?=$redacteur->id;?></td>
                <td><?=$redacteur->nom;?></td>
                <td><?=$redacteur->prenom;?></td>
                <td><?=$redacteur->email;?></td>
                <td><a href="./update_redacteur.php?id=<?=$redacteur->id;?>"><div class="btn" type="submit"><i class="fas fa-edit"></i></div></a></td>
                <td><a href="./delete_redacteur.php?id=<?=$redacteur->id;?>"><div class="btn" type="submit"><i class="far fa-trash-alt"></i></div></a></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="./add_redacteur.php"><button type="button" class="btn btn-success btn-lg">Ajouter une rédacteur</button></a>
    <a href="./index.php"><button type="button" class="btn btn-dark btn-lg">Retour à l'accueil</button></a>
</body>
</html>
