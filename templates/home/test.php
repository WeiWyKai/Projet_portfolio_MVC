<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test</title>
</head>
<body>
  <h1>Page de test</h1>

  <?php
    //SI la variable $error existe, on l'affiche
    if(isset($error)){
      echo $error;
    }
  ?>
  <form method="post">
    <label for="name">Nom</label>
    <input type="text" id="name" name="name">
    <label for="avis">Avis</label>
    <textarea name="avis" id="avis" ></textarea>
    <button>Envoyer</button>
  </form>
</body>
</html>