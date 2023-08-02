<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        .error {color: rgb(47, 36, 119);}

.x{
    background-color : rgb(201, 113, 113);
    height:100vh;
    margin-left: 0;
    padding-top:20px;
    padding-left: 300px;
    border:5px solid rgb(0, 0, 0);
}
</style>
</head>
<body>
    
<?php
// define variables and set to empty values
$nameErr = $emailErr =  $passwordErr =  "";
$name = $email = $password = "";
$validate = True;
    

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
} 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
?>


<div class = "x">
<h1>Login Form</h1>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <span><b>Enter your details</b></span><br><br>
  Username <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
  <input type="reset" name = "reset" value="Reset"> 
</form>
</div>

<?php
if(isset($_POST['submit'])){
if($name !=''&&  $email !=''&& $password !='')
{
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $database = "details";

  // Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);
  // Die if connection was not successful
  if (!$conn){
      die("Sorry we failed to connect: ");
  }
  else{ 
    // Submit these to a database
    // Sql query to be executed 
    $sql = "INSERT INTO `login_details` (`first_name`, `email`, `pwd`, `dt`)
    VALUES ('$name', '$email', '$password', current_timestamp())";
    $result = mysqli_query($conn,$sql);
  }
  header("Location:login_signup.php");
}
else{
?><span><?php echo "Please fill all details";?></span> <?php
}
}
?>
</body>
</html>
