<?php

/*

Write a simple (no formatting, no design) HTML « login » form displaying an email
texbox, a password textbox and a submit button. This form must send the data to the
current PHP file using the appropriate HTTP method. You are required to write a proper
HTML structure of your choice for the document displaying the form (but no CSS!).

*/
/*
3. Add to the previous form a Javascript Validation check (email should contain an @ and
a dot). Password must not be empty. In case of errors, do not use the alert() function but
display an error message above the form using JavaScript.
4. Javascript can be disabled on the browser. So add to the previous form a PHP validation
once the user submits the form. This validation is the same than the JavaScript one. In
case of error, display an error message above the HTML form.
 */

?>
<?php

$emailErrorMessage    = "";
$passwordErrorMessage = "";

if (isset($_POST) && count($_POST)>0) {
  $emailReg = '/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/';

  $emailVal    = isset($_POST["email"])    ? $_POST["email"]    : "";
  $passwordVal = isset($_POST["password"]) ? $_POST["password"] : "";

  if ($emailVal == "") {
	$emailErrorMessage    = '<span class="error">Please enter your email address.</span>';
  } else if ( !preg_match($emailReg, $emailVal) ) {
	  $emailErrorMessage    = '<span class="error">Enter a valid email address.</span>';
  }

  if($passwordVal == '') {
	  $passwordErrorMessage = '<span class="error">Please enter your password.</span>';
  }
}

?>
<html>
 <head>
  <script type="text/javascript"  src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
 </head>
 <body>
  <form name="login" method="POST" >
   <input type="text" name="email" value="" />
   <?php  echo $emailErrorMessage;?>
   <br/>
   <input type="password" name="password"  />
   <?php  echo $passwordErrorMessage;?>
   <br/>
   <input type="submit" id="btn-submit" name="submit" value="Submit" />
  </form>
  <script type="text/javascript" >

  $(document).ready(function() {

    $('#btn-submit').click(function() {

      $(".error").hide();
      var hasError = false;
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

      var emailVal = $("input[name=email]").val();
      if(emailVal == '') {
    	  $("input[name=email]").after('<span class="error">Please enter your email address.</span>');
        hasError = true;
      } else if(!emailReg.test(emailVal)) {
    	  $("input[name=email]").after('<span class="error">Enter a valid email address.</span>');
        hasError = true;
      }

      var passwordVal = $("input[name=password]").val();
      if(passwordVal == '') {
    	  $("input[name=password]").after('<span class="error">Please enter your password.</span>');
        hasError = true;
      }

      if(hasError == true) { return false; }

    });

  });
  </script>
 </body>
</html>