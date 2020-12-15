<?php
  session_start();
  include('includes/config.php');
  if(isset($_POST['signin']))
  {
    $uname=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT UserName,Password FROM headadmin WHERE UserName=:uname and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      $_SESSION['alogin']=$_POST['username'];
      echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
    } else
    {
      echo "<script>alert('Invalid Details');</script>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee leave management system |  Head Admin</title>
        <meta charset="UTF-8">
        <style>
          h3, h4{
            padding: 10px;
            margin: 10px;
            font-family: Impact,Charcoal,sans-serif;
            text-align: center;
            font-size: 30px;
            align-content: center;
          }

          form{
              text-align: center;
              margin: 30px auto;
              width: 320px;

          }
          input{
              padding: 10px; 
			  margin-left:-2%;
          }
          input[type=password], input[type=text]{
              display: block;
              margin-bottom: 25px;
              width: 100%;
              border:2px solid steelblue;
			  transition:0.25;
			  outline:none;
			  border-radius: 24px;
          }

          body{
              background: linear-gradient(to bottom, #00ffff 0%, #0099cc 100%);
              background-size: cover;
              background-attachment: fixed;
              font-size: 20px;
        }
	    .form{
				
			box-sizing:border-box;
			padding:60px 40px;
			transition: 0.5s;
			background: rgba(255,255,255,0.1);
			box-shadow: 0 0 20px rgba(0,0,0,0.2);
			border-radius: 30px;
			
		}
		button{
            width: 100px;
            height: 40px;
            border:none;
            background:steelblue;
            color: white;
			outline:none;
			border-radius: 24px;
        }
		button:focus{
                width: 100px;
                height: 40px;
                border:solid steelblue;
                background:white;
                color: steelblue;
        }
		

        </style>
    </head>
    <body class="signin-page">
        <div class="content">
            <main class="mn-content">
              <h4 align="center"><a href="../index.php">Employee Leave Management System | Head Admin Login</a></h4>
              <div class="card-content ">
                  <h3>Sign In</h3>
                  <div class="row">
                    <form class="form" name="signin" method="post">
                      <div class="col-form">
                        <label for="email">Username</label>
                        <input id="username" type="text" name="username" required>         
                      </div>
                      <div class="col-form">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="validate" name="password" required>
                      </div>
                      <div class="col">
                        <button type="submit" name="signin" value="Sign in">Sign In</button>
                      </div>
                    </form>
                  </div>
              </div>
            </main>
        </div>
             
    </body>
</html>