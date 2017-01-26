<?php
  /*
  
  Developer : Aung Ko Ko Myint Oo
  Company   : SEA Dream Company株式会社
  Github    : http://github.com/daarioautumn
  Twitter   : @DaarioAutumn

   */

  // For User
  //Set your options here


  // Administrator email 

  $admin_email="";          // Email will be sent to this email


  // Redirect URL after mail sent successfully
  $redirectTo="/";        //e.g http://www.yourdomain.com/home/

   



   ####################################
    ##  ## ## ##  ##  ##  ##  ##  ##


  /* For Developers */


    ##  ## ## ##  ##  ##  ##  ##  ##
  ####################################
  //Sources And Just Change code only if needed


  // Accpet Action From Confirmation.php

    $action=isset($_POST['action']);

    if(isset($_POST['formData'])){
      $formData=$_POST['formData'];
    }
    
    if(isset($action) && $action=="send_email"){
      send_email($formData);
       
      die('Success');
    }


  // Prepare Data
    
    if(isset($_POST['name']) && !empty($_POST['name'])){
      $data['name']=$_POST['name'];
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
      $data['email']=$_POST['email'];
    }

    if(isset($_POST['subject']) && !empty($_POST['subject'])){
      $data['subject']=$_POST['subject'];
    }

    if(isset($_POST['message']) && !empty($_POST['message'])){
      $data['message']=$_POST['message'];
    }

    if(isset($_POST['checkbox']) && !empty($_POST['checkbox'])){
      $data['checkbox']=$_POST['checkbox'];
    }

    if(isset($_POST['radio1']) && !empty($_POST['radio1'])){
      $data['radio1']=$_POST['radio1'];
    }

    if(isset($_POST['radio2']) && !empty($_POST['radio2'])){
      $data['radio2']=$_POST['radio2'];
    }

    if(isset($_POST['radio3']) && !empty($_POST['radio3'])){
      $data['radio3']=$_POST['radio3'];
    }

    if(isset($_POST['option']) && !empty($_POST['option'])){
      $data['option']=$_POST['option'];
    }
    $data['email_to']=$admin_email;
    $data['redirectTo']=$redirectTo;


  // Initial Function
    call_user_func(function(){

        if(isset($_FILES['image'])){

            if(!file_upload()){
              die('Oops Something wrong !!!!');
            }

         }

        $data=$GLOBALS['data'];
         confirmation($data);
        
      });

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

  /* Email Details */
  // var_dump($formData);die();

    $mail_to = $formData['email'];
    $from_mail = $formData['email'];
    $from_name = $formData['name'];
    $reply_to = $formData['email'];
    $subject = $formData['subject'];
    $message = $formData['message'];
    $image=$formData['image'];
   
    require 'PHPMailerAutoload.php';

    $mail = new PHPMailer;


    $mail->From =$from_mail;
    $mail->FromName = $from_name;
    $mail->addAddress($mail_to);     // Add a recipient
                                    // Name is optional
    $mail->addReplyTo($from_mail, $from_name);

    $mail->addAttachment($image, 'attachment.jpg');    // Optional name
    $mail->isHTML(true);                              // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;
   

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;

    } else {
        // echo 'Message has been sent';
      clearFiles();
    }
  }


  // Clear Tmp Upload files after mail success
  function clearFiles(){

    $files= glob('uploads/*');

    foreach($files as $file)
    { 
        // iterate files
        if(is_file($file))
          unlink($file); // delete file
    }
  }

  /* Thanks for using */