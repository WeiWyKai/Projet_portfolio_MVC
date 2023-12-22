<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body>
    <h1 class="bg-primary text-white p-3 text-align">Page de contact</h1>

      <!-- Message de succès -->
    <?php if(isset($success)): ?>
        <div class="alert alert-success">
            <?php
              echo $success;
            ?>
        </div>
    <?php endif; ?>

    <!-- Messages d'erreurs -->
    <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <?php
              echo $error;
            ?>
        </div>
    <?php endif; ?>

    <form method="post" class="m-3">
      <div class="mb-3">
        <label class="form-check-label" for="nom" >Name</label>
        <input type="text" class="form-control" id="nom" name="name">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" class="form-control"></textarea>  
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
  </body>
</html>