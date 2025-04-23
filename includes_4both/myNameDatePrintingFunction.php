<?php include('ch03/includes/header.html');?>

<h1>See output of function below!</h1>
<?php

function writeMsg($name, $year) {
  echo "Your name is $name, and you were born in $year!";
}

writeMsg("Timothy", "2004"); // Replace this with your function call
?>
<?php include ('ch03/includes/footer.html');?>