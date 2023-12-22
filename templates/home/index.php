<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <a href="/portfolio/login" class="btn btn-primary rounded-2 m-3 p-1 ">Connexion</a>
  <h1>Mes supers Projets</h1>

  <div class="container p-3 pt-5 d-flex flex-column justify-content-center">
    <?php foreach($projects as $project): ?>
      <article class="pb-5">
        <!-- Titre de l'article -->
        <h1><?php echo $project->getTitle(); ?></h1>
        <?php if($isLogged):?>
          <div class="alert alert-success">
          Bonjour <?php echo $_SESSION['user']->getUsername(); ?>!
        </div>
        <?php endif; ?>

        <!-- Informations sur l'article -->
        <small class="d-block text-secondary pb-2">
          Posté le <?php echo $project->getCreatedAt()->format('d.m.Y'); ?>
        </small>

        <!-- Image de couverture -->
          <img
            src="imgs/<?php echo $project->getPreview(); ?>"
            alt="<?php echo $project->getTitle(); ?>"
            class="img-fluid rounded"
          >

        <!-- Contenu tronqué de l'article -->
        <p><?php echo mb_strimwidth($project->getDescription(), 0, 60, '...'); ?></p>

        <a href="/portfolio/projet/details?id=<?php echo $project->getId();?>" class="btn btn-sm btn-primary">
            Lire la suite...
        </a>
      </article>
    <?php endforeach; ?>
  </div>
</body>
</html>