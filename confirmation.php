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
      <div class="alert alert-success">Confirmation</div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Field Name</th>
              <th>Field Value</th>
            </tr>
          </thead>
          <tbody>

          <?php if(isset($data['name'])): ?>
            <tr>
              <td>Name</td>
              <td><?= $data['name']?></td>
            </tr>
          <?php endif; ?>
          
          <?php if(isset($data['email'])): ?>
            <tr>
              <td>Email</td>
              <td><?= $data['email'];?></td>
            </tr>
          <?php endif; ?>

          <?php if(isset($data['image'])): ?>
            <tr>
              <td>Image</td>
              <td>
                  <a href="#" class="thumbnail">
                    <img src="<?= $data['image']; ?>" alt="">
                  </a>
              </td>
            </tr>

          <?php endif; ?>

          <?php if(isset($data['email_subject'])): ?>
            <tr>
              <td>Subject</td>
              <td><?= $data['email_subject']; ?></td>
            </tr>
          <?php endif; ?>

            <?php if($data['checkbox']): ?>
              <tr>
                <td>Checkbox</td>
                <td>
                  <?php foreach($data['checkbox'] as $value): ?>
                     <?= $value ."." . "<br>"; ?>   
                  <?php endforeach; ?>
                </td>
            </tr>
            <?php endif; ?>

           <?php if(isset($_POST['radio1'])):?>
               <tr>
                <td>Radio 1</td>
                <td><?= $data['radio1'];?></td>
              </tr>
           <?php endif; ?>

          <?php if(isset($_POST['radio2'])):?>
               <tr>
                <td>Radio 2</td>
                <td><?= $data['radio2'];?></td>
              </tr>
           <?php endif; ?>

          <?php if(isset($_POST['radio3'])):?>
               <tr>
                <td>Radio 3</td>
                <td><?= $data['radio3'];?></td>
              </tr>
          <?php endif; ?>
            
          <?php if(isset($_POST['option'])): ?>
            <tr>
              <td>Option</td>
              <td><?= $data['option'];?></td>
            </tr>
          <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
             
              <td class="btn-footer" colspan="2">
                <button id="confirm" class="btn btn-info">Confirm</button>
                <button class="btn btn-danger" onclick="history.back();">Back</button>
              </td>
      
            </tr>
          </tfoot>
        </table>
      </div><!--col-md-8 col-md-offset-->
    </div><!--row -->
  </div><!-- Container　-->
  <input type="hidden" value="<?php echo $_SERVER['PHP_SELF'];?>" id="url">
  <input type="hidden" value="<?php echo $data['redirectTo'];?>" id="redirect">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery-redirect.js"></script>
  <script> 

    $('#confirm').click(function(){
      var url= $("#url").val();
      var formData=<?php echo json_encode($data) ?>;
      var redirect=$("#redirect").val();
    
      $.ajax({
        url: url,
        data:{action:"send_email",formData:formData},
        type:"post",  
        success:function(response){
          $.redirect(redirect, {'state': 'success'});
        }
      });
    });

  </script>
</body>
</html>