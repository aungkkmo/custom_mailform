<?php

        if(empty($_POST['name'])){
          $errName="This Field is required";
        }else{
           $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
              $errName = "Only letters and white space allowed"; 
            }
        }

        if(empty($_POST['email'])){
          $errMail="This Field is required";
        }

        if(empty($_POST['subject'])){
          $errSubject="This Field is required";
        }

        if(empty($_POST['message'])){
          $errMessage="This Field is required";
        }

        if(empty($_POST['checkbox'])){
          $errCheckbox="This Field is required";
        }

        if(empty($_POST['radio1'])){
          $errRadio="This Field is required";
        }

        if(empty($_POST['radio2'])){
          $errRadio="This Field is required";
        }

        if(empty($_POST['radio3'])){
          $errRadio="This Field is required";
        }

        if(empty($_POST['option'])){
          $errOption="This Field is required";
        }
