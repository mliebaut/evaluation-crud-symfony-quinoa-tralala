<?php
    if(!empty($_POST))
    {
        $url = "http://127.0.0.1:8001/blog/updatearticle/".$_GET['id'];
        $data = array(
            'titre' => $_POST['titre'],
            'resumeCourt' => $_POST['resumecourt'],
            'description' => $_POST['description'],
            'categorie' => $_POST['categorie'],
            'redacteur' => $_POST['redacteur'],
            'apikey' => 'keytest'
        );
        $data_json = json_encode($data);
        // var_dump($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Modifier</title>
</head>
<body>
    <div class="container">
        <h1>Modifier un article:</h1>
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
            <select class="form-control" id="categorie" name="categorie">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="redacteur">Rédacteur</label>
            <select multiple class="form-control" id="redacteur" name="redacteur">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-lg mt-2">Modifier l'article</button>
        <a href="./index.php"><button type="button" class="btn btn-dark btn-lg mt-2">Retourner à l'accueil</button></a>
        </form>
    </div>
</body>
</html>