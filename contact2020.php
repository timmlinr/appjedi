<?php

include_once "util/Database.php";

/* Error handling function */

function error_exit($s) {
    echo "ERROR: $s\n";
    exit();
}

@extract($_POST);
/* If Submit Button Clicked */
if ($realname && $email) {
    $dojoList = Array("", "Alameda (MSAC)", "Harbor Bay", "Orinda", "Corpuz", "Earhart", "Mission College", "Marin", "San Francisco");
    $sendToArray = array("webmaster@wadokikai.com", "bob@timlin.net", "a.corpuz@comcast.net", "donald@stasenka.com", "a.corpuz@comcast.net",
        "david.okeefe@gmail.com", "bob@timlin.net", "zac12.zip@gmail.com");
    $dojoName = $dojoList[$dojoId];

    $headers = "From: Web Master <webmaster@wadokikai.com>\r\n"
            . "Reply-To: Web Master <webmaster@wadokikai.com>\r\n"
            . "Bcc: Bob Timlin <bob@timlin.net>\r\n"
            . "X-Mailer: 'PHP/' " . phpversion() . "\r\n";

    $sendTo = "timlinr@outlook.com";
    $msg = "From: $email\nName: $realname\nPhone: $phone\nDojo: $dojoId - $dojoName\n\n$message\n\n\nadd2list: $add2list\nstudent: $student";
    // echo $msg;
    //return;
    $Result = mail($sendTo, "Contact message from WadoKiKai.com", $msg, $headers);
    /*
      $Result = mail("timlinr@outlook.com", "Contact message from WadoKiKai.com",
      "From: $email\nName: $realname\nPhone: $phone\nAddress: $address\n\n$message\n\n",
      "Bcc: timlinr@yahoo.com\n");
     */
    //echo "Message sent";

    if ($Result) {
        echo "THANKS!  Message Sent Successfully!\n";
        echo "Someone will contact you as soon as we can.";
    } else {
        echo "Status: Message Failed!";
        echo "\nPlease try again later.  If the problem persist, send an email webmaster contactus@wadokikai.com.";
    }
    $msg = str_replace("'", "`", $msg);
    $realname = str_replace("'", "`", $realname);
    $realname = str_replace(" ", "-", $realname);
    $subject = "Contact Us";

    $id=0;

    $url = "http://timlin.net/wkk/send2wkk.php?token=1819Market1976&email=$email&phone=$phone&dojo=$dojoId&about=ContactUs&fullname=$realname";

   // echo $url;

    $msg = file_get_contents($url);

    $insert = "INSERT INTO contact_us(contact_id, send_to, subject, message, full_name, email, phone, dojo_id, stamp)"
            . "VALUES (1,'$sendTo', '$subject', '$msg', '$realname','$email','$phone', '$dojoId', SYSDATE())";


    $dao = new Database(1);
//echo $insert;
    $id = $dao->execute($insert);

    //echo "ID: $id";
} else {
    echo "Data Missing";
}
?>

