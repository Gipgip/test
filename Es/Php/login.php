<?php

/*

Write a simple (no formatting, no design) HTML « login » form displaying an email
texbox, a password textbox and a submit button. This form must send the data to the
current PHP file using the appropriate HTTP method. You are required to write a proper
HTML structure of your choice for the document displaying the form (but no CSS!).

*/


?>
<html>
 <head>
 </head>
 <body>
 <?php
 if (isset($_POST) && count($_POST)>0) {
   print_r($_POST);
 }
 ?>
  <form name="login" method="POST" >
   <input type="text" name="email" value="" />
   <input type="password" name="password"  />
   <input type="submit" name="submit" value="Submit" />
  </form>
 </body>
</html>