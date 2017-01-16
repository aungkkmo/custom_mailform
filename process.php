<?php
 

call_user_func(function(){
  $data=[
  'name' => $_POST['name'],
  'email' => $_POST['email'],
  'image' => isset($_FILES['image']['tmp_name']),
  'email_to'=> "you@yourdomain.com",
  'email_subject'=>isset($_POST['subject']),
];


// $data=array_filter($data);
// echo $data['image'];
// var_dump($data);

confirmation($data);


});

function confirmation($data){
  include('confirmation.php');

  if(isset($_POST['submit'])){
    send_email($data);
  }

}

function send_email($data){

    $email_to = $data['email_to'];
 
    $email_subject = "Your email subject line";

    $headers = 'From: '.$email_from."\r\n".
 
    'Reply-To: '.$email_from."\r\n" .
     
    'X-Mailer: PHP/' . phpversion();
     
    @mail($email_to, $email_subject, $email_message, $headers);  
 
}