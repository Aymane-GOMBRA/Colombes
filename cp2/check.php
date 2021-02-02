<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Identité:
<?php
$area[] = $_POST['area'];
echo "<p>".$_POST['fname']." né le ".$_POST['dob']."</p>";
echo "<p> Email : ".$_POST['mail']."</p>";
echo "<p> Site : ".$_POST['site']."</p>";
echo "<p> Tel : ".$_POST['phone']."</p>";
echo "<p> Pays : ".$_POST['land']."</p>";
echo "<p> Genre : ".$_POST['sex']."</p>";
echo "<p> Expérience : ".$_POST['exp']." ans</p>";
echo "<p> Préférence : ".$_POST['pref']."</p>";
var_dump($area);
?>    
</body>
</html>
