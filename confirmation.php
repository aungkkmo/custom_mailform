<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="well">Confirmation</div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Values</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Name</td>
              <td><?= $data['name'];?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><?= $data['email']; ?></td>
            </tr>
            <tr>
              <td>Name</td>
              <td>Name</td>
            </tr>
            <tr>
              <td>Name</td>
              <td>Name</td>
            </tr><tr>
              <td>Name</td>
              <td><img src="" alt=""></td>
            </tr>

            <tr>
              <td>Name</td>
              <td>Name</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>