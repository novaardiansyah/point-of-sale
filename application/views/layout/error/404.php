<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Not Found</title>
  <!-- Memuat CSS Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">

  <style>
    /* CSS kustom */
    body, html {
      height: 100%;
      margin: 0;
      background-color: #f4f6f9;
      display: flex;
      font-family: 'Roboto', sans-serif;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="error-container">
    <div class="row d-flex justify-content-center ">
      <div class="col-md-6">
        <h1 class="display-1">404</h1>
        <p class="lead mb-0">We apologize, but the page you are looking for is currently unavailable. Our team is diligently working on its development to provide you with a better experience. Thank you for your patience and understanding.</p>
        <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Back</a>
      </div>
    </div>
  </div>
</body>
</html>
