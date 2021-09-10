<?php
if (isset($_POST['email'])) {
    include_once "../util/Database.php";
    // EDIT THE 2 LINES BELOW AS REQUIRED
    //$email_to = "supp.team007@gmail.com";
    $email_to = "bob@timlin.net";
    $email_subject = "Signup for TeamSF";

    $token = $_POST['token'];
    //echo $token;
    if ($token!="TeamSF2HK22!")
        die ("Invalid token: $token");
    // validation expected data exists
    if (!isset($_POST['fullname']) ||
            !isset($_POST['email'])) {
       die ('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $fullName = $_POST['fullname']; // required
   
    $email_from = $_POST['email']; // required
    $birthdate = $_POST['birthdate']; // required
    $comments = ""; // required
    $subject ="Signup for TeamSF"; // required
  
//echo "full name: $fullname";
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $fullName)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if (strlen($error_message) > 0) {
       // died($error_message);
        die ($error_message);
    }

    $email_message = "sign up details below from: Team SF.\n\n";

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Full Name: " . clean_string($fullName) . "\n";
    //$email_message .= "Last Name: " . clean_string($last_name) . "\n";
    $email_message .= "Email: " . clean_string($email_from) . "\n";
  
    $email_message .= "Subject: " . clean_string($subject) . "\n";
    $email_message .= "Comments: " . clean_string($comments) . "\n";

// create email headers
    $headers = 'From: bob@timslist.com (' .
            'Reply-To: bob@timslist.com)' .
            'X-Mailer: PHP/' . phpversion();
    $email_message=str_replace("'","`", $email_message);
    $email_subject=str_replace("'","`", $email_subject);
    $telephone="";
    $insert = "
        INSERT INTO `appjedin_timslist`.`teamsf_signup`
            (`email_address`,
            `full_name`,
            `birthdate`,
            `location`,
            `joined`,
            `status`)
        VALUES(?,?,?,0,SYSDATE(),1)";
  

/*
  /**/  
       //echo $insert;
           
      @mail($email_to, $email_subject, "$email_message\n", $headers);
       echo "Your signup has been sent "; 
  //*VALUES (?,?,?,?,?,1,1,SYSDATE())";
//echo "sent to: $email_to";
       
        $dao = new Database(1);
        $dao->prepare($insert);
        $dao->setString(1, $email_from);
        $dao->setString(2, $fullName);
        $dao->setString(3, $birthdate);

        echo $dao->exec();

        //$dao->execute($insert);
        $dao->close();
        
        echo "and logged!";
        //$url = "https://timlin.net/timsmail.php?token=Limerick&email=$email_from&lname=$last_name,$first_name&phone=$telephone";

}
else
    echo "missing data";
?>