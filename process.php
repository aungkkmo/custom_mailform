<?php
 
// $data=[];
   
$data=[
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'checkbox' => $_POST['checkbox'],
    'email_to'=> "you@yourdomain.com",
    'email_subject'=>$_POST['subject'],
  ];

call_user_func(function(){

  if(isset($_FILES['image'])){
    if(!file_upload()){
      die('11');
    }
   }
  prepare();
  
});


function prepare(){
  // echo "prepare";

  $data=$GLOBALS['data'];
  foreach ($data['checkbox'] as $value) {
    echo $value;
  }


  // var_dump($GLOBALS['data']);
}

function file_upload(){
  $target_dir = "uploads/";
  $target_file = $target_dir . uniqid()."_".basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
      
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $GLOBALS['data']['image']=$target_file;
        return true;
      } else {
          echo "File is not an image.";
          return false;
      }
  
}

function confirmation($data){
  include('confirmation.php');

}

function send_email($data){

    $email_to = $data['email_to'];
 
    $email_subject = "Your email subject line";

    $headers = 'From: '.$email_from."\r\n".
 
    'Reply-To: '.$email_from."\r\n" .
     
    'X-Mailer: PHP/' . phpversion();
     
    @mail($email_to, $email_subject, $email_message, $headers);  
 
}