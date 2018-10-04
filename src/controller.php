<?php

session_start();

function generateToken( $formName )
{

return $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));

}

function checkToken( $token)
{

    return $token ===$_SESSION['csrf_token'];

}


if (!$_SESSION["loged"]) {

    header('Location: index.php');
    exit();

} else {

    echo '<div class="container">  <div class="alert alert-success alert-dismissible fade in"> <strong>Welcome!</strong> </div></div>';

}

if (isset($_POST['csrf_token']) && isset($_POST['fname']) && isset($_POST['lname'])) {

    if (checkToken($_POST['csrf_token'])) {

      echo '<div class="container">  <div class="alert alert-success alert-dismissible fade in"> Settings updated </div></div>';

    } else {

      echo '<div class="container">  <div class="alert alert-danger alert-dismissible fade in"> invalid csrf token </div></div>';
    
    }

}

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<div class="panel panel-info" >

<div class="panel-heading">
   <div class="panel-title">Update User Settings</div>
</div>

<div style="padding-top:30px" class="panel-body" >

<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

<form id="loginform" class="form-horizontal" role="form" method="post" action="controller.php">
  
   <div style="margin-bottom: 25px" class="input-group">
      <span class="input-group-addon">First Name</span>
      <input id="login-username" type="text" class="form-control" name="fname" value="" placeholder="First Name">
   </div>
   
   <div style="margin-bottom: 25px" class="input-group">
      <span class="input-group-addon">Last name Name</span>
      <input id="login-username" type="text" class="form-control" name="lname" value="" placeholder="Last Name">
   </div>
   
   <div style="margin-bottom: 25px" class="input-group">
      <input id="login-username" type="hidden" class="form-control" name="csrf_token" value=<?php echo '"' . generateToken('sec') . '"';?>>
   </div>
   
   <div style="margin-top:10px" class="form-group">
      <div class="col-sm-12 controls">
         <input id="btn-login"   class="btn btn-success" type="submit" value="update"><br>
         <a href="logout.php">Logout</a> 
      </div>
   </div>

</form>