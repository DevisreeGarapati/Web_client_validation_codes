<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: rgb(47, 36, 119);}
.x{
    background-color : rgb(201, 113, 113);
    height:100vh;
    margin-left: 0;
    padding-top:10px;
    padding-left: 300px;
    border:5px solid rgb(0, 0, 0);
    margin:0%;
}

</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $contactErr = $passwordErr = $cpasswordErr = $commentErr =  "";
$name = $email = $gender = $comment = $contact = $password = $cpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  
  if (empty($_POST["email"])) { 
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }


  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    if (strlen($password)<8 ) {
      $passwordErr = "Password is not Valid";
    }
  }


  if (empty($_POST["cpassword"])) {
    $cpasswordErr = "Confirm Password is required";
  } else {
    $cpassword = test_input($_POST["cpassword"]);
    if ($password!= $cpassword) {
      $cpasswordErr = "Password and Confirm password are not same";
    }
  }



  if (empty($_POST["contact"])) {
    $contact = "";
  } else {
    $contact = test_input($_POST["contact"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\d{10}/",$contact)) {
      $contactErr = "Invalid Number";
    }
  }


  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
    if(str_word_count($comment > 50)){
      $commentErr = "Message is too Long";
    }
  }



  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div class = "x">
<h1>Registration Form </h1>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Confirm Password <input type="password" name="cpassword" value="<?php echo $cpassword;?>">
  <span class="error">* <?php echo $cpasswordErr;?></span>
  <br><br>
  Date of Birth:
  <input type="date" id="birthday" name="birthday">
  <br><br>
  Gender
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male 
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Contact No <input type="number" name="contact" value="<?php echo $contact;?>">
  <span class="error"><?php echo $contactErr;?></span>
  <br><br>
  Message <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <span class="error"><?php echo $commentErr;?></span>
  <br><br>
  File Upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
  <input type="reset" name = "reset" value="Reset">
  
</form>
</div>

<?php
if(isset($_POST['submit'])){
if($name !=''&&  $email !=''&& $password !=''&&  $cpassword !=''&& $contact !='' && $comment !='' && $gender !=='')
{
header("Location:login_signup.php");
}
else{
?><span><?php echo "Please fill all details";?></span> <?php
}
}
?>

</body>
</html>