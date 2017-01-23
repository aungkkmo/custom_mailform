<?php
    
    // Accpet Action From Confirmation.php

    $action=isset($_POST['action']);
    $status=isset($_POST['status']);

    if(isset($_POST['formData'])){
      $formData=$_POST['formData'];
    }
    
    if(isset($action) && $action=="send_email"){
   
      send_email($formData);
     
      die();
    }


// Prepare Data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkbox = $_POST['checkbox'];
    $radio1 = isset($_POST['radio1']);
    $radio2 = isset($_POST['radio2']);
    $radio3 =isset($_POST['radio3']);
    $email_to= "aungkoko.aidma@gmail.com";
    $email_subject=$_POST['subject'];
    $option=$_POST['option'];
    $message="This is Test";
   
$data=[
    'name' => $name,
    'email' => $email,
    'checkbox' => $checkbox,
    'radio1' => $radio1,
    'radio2' => $radio2,
    'radio3' => $radio3,
    'email_to'=> $email_to,
    'email_subject'=>$email_subject,
    'option'=>$option,
    'message'=>$message
  ];


// Initial Function
call_user_func(function(){

  if(isset($_FILES['image'])){
    if(!file_upload()){
      die('11');
    }
   }
  prepare();
  
});

// Set Data
function prepare(){
  // echo "prepare";
  $data=$GLOBALS['data'];

confirmation($data);
}


// File Check
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

// Confirmation
function confirmation($data){
  include('confirmation.php');

}

// Mail Send
function send_email($formData){
  
/* Email Detials */

  $mail_to = $formData['email_to'];
  $from_mail = $formData['email'];
  $from_name = $formData['name'];
  $reply_to = $formData['email'];
  $subject = $formData['email_subject'];
  $message = $formData['message'];
 
/* Attachment File */
  // Attachment location
  $file_name = $formData['image'];
  // $path = $file_name;
   
  // Read the file content
  $file = $file_name;
  $file_size = filesize($file);
  $handle = fopen($file, "r");
  $content = fread($handle, $file_size);
  fclose($handle);
  $content = chunk_split(base64_encode($content));
   
/* Set the email header */
  // Generate a boundary
  $boundary = md5(uniqid(time()));
   
  // Email header
  $header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
  $header .= "Reply-To: ".$reply_to.PHP_EOL;
  $header .= "MIME-Version: 1.0".PHP_EOL;
   
  // Multipart wraps the Email Content and Attachment
  $header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
  $header .= "This is a multi-part message in MIME format.".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Email content
  // Content-type can be text/plain or text/html
  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
  $header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
  $header .= "$message".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Attachment
  // Edit content type for different file extensions
  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
  $header .= $content.PHP_EOL;
  $header .= "--".$boundary."--";
   
  // Send email
  if (mail($mail_to, $subject,$message, $header)) {
    clearFiles();
  } else {
    echo "Error";
  }
}

function clearFiles(){
  $files= glob('uploads/*');

  foreach($files as $file)
  { 
      // iterate files
      if(is_file($file))
        unlink($file); // delete file
  }
}