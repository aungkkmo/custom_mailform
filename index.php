<?php 

if(isset($_POST['state']) && $_POST['state']="success"){
  $state=1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />

  <title>MAIL FORM</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
  <style>
    #error{
      color: #f00;
      font-style: italic;
    }
   textarea {
        resize: none;
    }
    .checkbox label.error {
      display: none !important;
    }
    .error{
      /*line-height: 1.5em;*/
      padding-top: 5px;
      color:#f00;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-2">
           <div class="panel panel-primary">
             <div class="panel panel-heading">Send Email</div>
             <div class="panel panel-body">
                <form action="process.php" method="post" enctype="multipart/form-data">


                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Name" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" >
                  </div>

              

                  <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                        <img src="http://placehold.it/200x150" alt="">
                      </div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputSubject">Subject</label>
                    <input type="text" name="subject" class="form-control" id="exampleInputName" placeholder="Name" required>

                  </div>

                  <div class="form-group">
                    <label for="exampleInputSubject">Message</label>
                    <textarea class="form-control" rows="3" name="message" placeholder="Something Here..."></textarea>

                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="checkbox[]" value="A"> Check me out
                    </label>
                  </div>

                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="checkbox[]" value="B"> Check me out
                    </label>
                  </div>

                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="checkbox[]" value="C" > Check me out
                    </label>
                  </div>

                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="checkbox[]" value="D"> Check me out
                    </label>
                  </div>

                  <div class="form-group">
                    <span id="error"></span>                
                  </div>

                  <div class="radio">
                    <label for="">
                      <input type="radio" name="radio1" value="A"> Radio
                    </label>
                  </div>

                  <div class="radio">
                    <label for="">
                      <input type="radio" name="radio2" value="B"> Radio
                    </label>
                  </div>

                  <div class="radio">
                    <label for="">
                      <input type="radio" name="radio3" value="C"> Radio
                    </label>
                  </div>

                  <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select class="form-control" id="sel1" name="option">
                      <option>--Select Here--</option>
                      <option value="1">Option 1</option>
                      <option value="2">Option 2</option>
                      <option value="3">Option 3</option>
                      <option value="4">Option 4</option>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <input type="hidden" value="<?php echo $state; ?>" id="state">
                </form>
             </div>
        </div>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert alert-success">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Success</h4>
                </div>
                <div class="modal-body">
                  <p>Your Email Has Successfully Sent.</p>
                </div>
               
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
<script>
  $(document).ready(function(){
    var success=$("#state").val();
    // $('.modal').modal('show');

    if(success==1){
      $('.modal').modal('show');
    }
    
  });
</script>
<script>
  $('form').validate({
  rules : {
    name: "required",
    email:{
      required:true,
      email:true,
    },
    subject:"required",
    message:"required",
    "checkbox[]": { 
      required: true, 
      minlength: 1 
    }
  },
   messages: {            
        'checkbox[]': {
            required: function(){
              $('#error').html("&#8657; Please Check At Least One");
            }
        },
    }
});
</script>
</body>
</html>