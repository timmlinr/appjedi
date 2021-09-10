<?php
if (isset($_POST['email'])) {
    include_once "../util/Database.php";
    // EDIT THE 2 LINES BELOW AS REQUIRED
    //$email_to = "supp.team007@gmail.com";
    $email_to = "bob@timlin.net";
    $email_subject = "Contact Us from Team SF";

    $token = $_POST['token'];
    //echo $token;
    if ($token!="TeamSF2HK22!")
        die ("Invalid token");
    // validation expected data exists
    if (!isset($_POST['fullname']) ||
            !isset($_POST['email']) ||
           
            !isset($_POST['comments'])) {
       echo ('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $fullName = $_POST['fullname']; // required
   
    $email_from = $_POST['email']; // required
    
    $comments = $_POST['comments']; // required
    $subject ="Contact TeamSF"; // required
  
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

    if (strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    if (strlen($error_message) > 0) {
       // died($error_message);
        die ($error_message);
    }

    $email_message = "Contact message from: TeamSF.\n\n";

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Full Name: " . clean_string($fullname) . "\n";
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
        INSERT INTO `appjedin_timslist`.`contact_teamsf`
            (`full_name`,
            `email`,
            `message`,
            `entered`,
            `status`)
            VALUES(?,?,?,SYSDATE(),1)";
  

/*
  /**/  
       //echo $insert;
           
      @mail($email_to, $email_subject, "$email_message\n", $headers);
       echo "Your message has been sent "; 
  //*VALUES (?,?,?,?,?,1,1,SYSDATE())";
//echo "sent to: $email_to";
       
        $dao = new Database(1);
        $dao->prepare($insert);
        $dao->setString(1, $fullName);
        $dao->setString(2,$email_from );
        $dao->setString(3, $email_message);
        echo $dao->exec();

        //$dao->execute($insert);
        $dao->close();
        
        //$url = "https://timlin.net/timsmail.php?token=Limerick&email=$email_from&lname=$last_name,$first_name&phone=$telephone";

        //$status = file_get_contents($url);
        
        echo "and logged!";
     
        
        
}
else
    echo "missing data";
?>