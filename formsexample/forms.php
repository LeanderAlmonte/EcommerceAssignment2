<html lang="en">
<head>
</head>
<body>

<form method="POST" action="http://localhost/app/index.php?employees">
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname"><br>
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title">
    <input type="submit" value="Create">
</form>  

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST)){
        echo $_POST['fname']." - ".$_POST['lname']." - ".$_POST['title'];
    }
    else {
        echo "THe HTTP request method is: ".$_SERVER["REQUESTION_METHOD"];
    }
}

?>
    
</body>
</html>