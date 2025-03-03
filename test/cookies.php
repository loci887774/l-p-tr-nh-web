<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie</title>
</head>
<body>
    <?php
        if(isset($__COOKIE['fname'])) {
            echo 'welcome '.$__COOKIE['fname'] ."!<br>";
        }
        else {
             echo 'welcome guest!<br>';
        } 
           
    ?>
   
</body>
</html>