<?php
    
    $action=isset($_POST['action']);
    $status=isset($_POST['status']);

    if(isset($action) && $action=="send_email"){
      // $data=$GLOBALS['data'];
      send_email();
      die();
    }



    $name = isset($_POST['name']);
    $email = isset($_POST['email']);
    $checkbox = $_POST['checkbox'];
    $radio1 = isset($_POST['radio1']);
    $radio2 = isset($_POST['radio2']);
    $radio3 =isset($_POST['radio3']);
    $email_to= "aungkoko.aidma@gmail.com";
    $email_subject=isset($_POST['subject']);
    $option=isset($_POST['option']);
   
$data=[
    'name' => $name,
    'email' => $email,
    'checkbox' => $checkbox,
    'radio1' => $radio1,
    'radio2' => $radio2,
    'radio3' => $radio3,
    'email_to'=> $email_to,
    'email_subject'=>$email_subject,
    'option'=>$option
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

confirmation($data);


  // var_dump($GLOBALS['data']);
}

function file_upload(){
  $target_dir = $_SERVER['SERVER_NAME']."/uploads/";
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



function send_email(){

  $files= glob('uploads/*');

  foreach($files as $file)
  { 
      // iterate files
      if(is_file($file))
        unlink($file); // delete file
  }



    // $email_to = $data['email_to'];
 
    // $email_subject = "Your email subject line";

    // $headers = 'From: '.$email_from."\r\n".
 
    // 'Reply-To: '.$email_from."\r\n" .
     
    // 'X-Mailer: PHP/' . phpversion();
     
    // @mail($email_to, $email_subject, $email_message, $headers);  
 
}