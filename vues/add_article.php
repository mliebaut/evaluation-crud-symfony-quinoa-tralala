<?php
    $url = "http://127.0.0.1:8001/blog/addnewarticle";
    $data = array(
        'titre' => $_POST['titre'],
        'resumecourt' => $_POST['resumecourt'],
        'description' => $_POST['description'],
        'categorie' => $_POST['categorie'],
        'redacteur' => $_POST['redacteur'],
        'apikey' => 'keytest'
    );

    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // var_dump($data->categorie);

    $url = "http://127.0.0.1:8001/blog/categories";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $datacat = json_decode($response);
    // var_dump($datacat);

    $url = "http://127.0.0.1:8001/blog/redacteurs";
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
    <title>Ajouter un article</title>
</head>
<body>
    <div class="container">
        <h1>Poster un nouvel article:</h1>
        <form method="POST">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Veuillez saisir un titre">
        </div>
        <div class="form-group">
            <label for="resumecourt">Resumé court</label>
            <input type="text" class="form-control" id="resumecourt" name="resumecourt" placeholder="Veuillez résumer l'article">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select class="form-control" id="categorie" name="categorie" selected="1">
            <?php 
                foreach($datacat as $cat) {
                    ?>
                    <option value="<?php print($cat->id);?>"><?=$cat->libelle;?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="redacteur">Rédacteur</label>
            <select multiple class="form-control" id="redacteur" name="redacteur" selected="1">
            <?php 
                foreach($dataredacteur as $redacteur) {
                    ?>
                    <option value="<?php print($redacteur->id);?>"><?=$redacteur->nom . " " . $redacteur->prenom . " " . $redacteur->email;?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-lg mt-2">Poster l'article</button>
        <a href="./index.php"><button type="button" class="btn btn-dark btn-lg mt-2">Retourner à l'accueil</button></a>
        </form>
    </div>
</body>
</html>