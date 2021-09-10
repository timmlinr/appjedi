<?php
if (isset($_GET['tbl'])) {
    include_once "../util/Database.php";
    // EDIT THE 2 LINES BELOW AS REQUIRED
    //$email_to = "supp.team007@gmail.com";
   
        $dao = new Database(1);
        $tbl = $_GET['tbl'];
        //echo $tbl;
        $query="";
        if ($tbl==1)
            $query="SELECT full_name, email FROM contact_teamsf";
        else
           $query="SELECT full_name, email_address FROM teamsf_signup"; 
        $json = $dao->json($query);
        
      //  echo $json;

        //$dao->execute($insert);
        $dao->close();    
        
}
else
    echo "missing data";
?>
<html>
    <head><title>List II</title>
    
        <script>
            const data = <?php echo $json?>;
            function pageLoad ()
            {
                   var cont = "";
                data.forEach ((row)=>{
                    cont += "<p>" + row.full_name + "</p>";
                });
                document.getElementById("divContent").innerHTML=cont; 
            }
        
        </script>
    </head>
    <body onload="pageLoad()">
        <div id="divContent">
            
        </div>
    </body>
</html>