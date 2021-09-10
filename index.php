<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            Team SF
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel='stylesheet' type='text/css' href='styles.css?v=20210817a'/>
        <script src='data.js?v=20210817'></script>
        <script src='index.js?v=20210817'></script>
        <script>

        </script>
    </head>
    <body onload='pageLoad()'>
        <img src='images/teamsf07logo.gif'/>

        <div>
            <ul>

                <li><a href='javascript:route(0)'>About Us</a> </li>
                <li><a href='javascript:route(1)'>Contact Us</a></li>
                <li><a href='javascript:route(2)'>Events</a></li>
                <li><a href='javascript:route(3)'>Sporting Groups</a> </li>
                <li><a href='javascript:route(4)'>Sign Up</a> </li>
                <li><a href='javascript:route(5)'>Links</a> </li>
            </ul>
        </div>

        <div id='divAboutUs'>
            <?php include ("includes/aboutus.html"); ?>

        </div>
        <div id='divContactUs' class='formStyle'>
            <?php include ("includes/contactus.html"); ?>
        </div>
        <div id='divClubs'>

        </div>
        <div id='divEvents'>

        </div>
        <div id='divSignUp' class='formStyle'>
            <?php include ("includes/signup.html"); ?>
        </div>
        <div id='divLinks'>
            <?php include ("includes/links.html"); ?>
        </div>

        <div id='divContent'>

        </div>
        <footer class="footer">(C) 2021 Team SF</footer>
    </body>

</html>
