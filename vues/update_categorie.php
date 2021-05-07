<?php
    if(!empty($_POST))
    {
        $url = "http://127.0.0.1:8001/blog/updatecategorie/".$_GET['id'];
        $data = array(
            'libelle' => $_POST['libelle']
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
        <h1>Modifier une catégorie:</h1>
        <form method="POST">
        <div class="form-group">
            <label for="libelle">Libellé</label>
            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Veuillez une catégorie">
        </div>
        <button type="submit" class="btn btn-success btn-lg mt-2">Modifier le libellé</button>
        <a href="./index.php"><button type="button" class="btn btn-dark btn-lg mt-2">Retourner à l'accueil</button></a>
        </form>
    </div>
</body>
</html>