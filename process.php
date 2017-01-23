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
  $image=$formData['image'];
 
  require 'PHPMailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;


  $mail->From = "walter@killer.com";
  $mail->FromName = $from_name;
  $mail->addAddress($mail_to);     // Add a recipient
  // $mail->addAddress('ellen@example.com');               // Name is optional
  $mail->addReplyTo($from_mail, $from_name);
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  // $mail->addAttachment('');         // Add attachments
  $mail->addAttachment($image, 'attachment.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = $subject;
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      // echo 'Message has been sent';
    clearFiles();
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