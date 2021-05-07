<?php
    $url = "http://127.0.0.1:8001/blog/articles";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);
    // var_dump($data);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Menu</title>
</head>
<body>
    <h1 class="center">Liste de tous les articles</h1>
    <div class="row">
        <div class="col-9">
            <table class="table">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Résumé</th>
                    <th scope="col">Description</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Rédacteur</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </thead>
                <tbody>
                <?php
                foreach($data as $article)
                {
                ?>
                <tr>
                <td><?=$article->id;?></td>
                <td><?=$article->titre;?></td>
                <td><?=$article->resumecourt;?></td>
                <td><?=$article->description;?></td>
                <td><?=$article->idcategorie;?></td>
                <td><?=$article->idredacteur;?></td>
                <td><a href="./update_article.php?id=<?=$article->id;?>"><div class="btn" type="submit"><i class="fas fa-edit"></i></div></a></td>
                <td><a href="./delete_article.php?id=<?=$article->id;?>"><div class="btn" type="submit"><i class="far fa-trash-alt"></i></div></a></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="./add_article.php"><button type="button" class="btn btn-primary btn-lg">Ajouter un article</button></a>
    <a href="./get_categories.php"><button type="button" class="btn btn-success btn-lg">Editer les catégories</button></a>
    <a href="./get_redacteurs.php"><button type="button" class="btn btn-success btn-lg">Editer les rédacteurs</button></a>
</body>
</html>