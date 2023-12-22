<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body>
    <div class="container p-3 pt-5 d-flex flex-column justify-content-center">
      <article class="pb-5">
        <!-- Titre de l'article -->
        <h1><?php echo $project->getTitle(); ?></h1>

        <!-- Informations sur l'article -->
        <small class="d-block text-secondary pb-2">
          Posté le <?php echo $project->getCreatedAt()->format('d.m.Y'); ?>
        </small>

        <!-- Image de couverture -->
        <img
          src="../<?php echo $project->getFolderPreview(); ?>"
          alt="<?php echo $project->getTitle(); ?>"
          class="img-fluid rounded"
        >
        <p><?php echo $project->getDescription(); ?></p>   
      </article>
    </div>
  </body>
</html>