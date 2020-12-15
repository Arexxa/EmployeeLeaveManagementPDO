
<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(isset($_POST['signin']))
    {
        $uname=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            foreach ($results as $result) 
            {
                $status=$result->Status;
                $_SESSION['eid']=$result->id;
            }
            if($status==0)
            {
                $msg="Your account is Inactive. Please contact admin";
            } else{
                $_SESSION['emplogin']=$_POST['username'];
                echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
            }
        }

        else{
          echo "<script>alert('Invalid Details');</script>";
        }

}

?><!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>ELMS | Home Page</title>
        <meta charset="UTF-8">

        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">

        <style>
            *{
                margin: 0;
                padding: 0;
            }
  
            
            ul {
              list-style-type: none;
              margin: 0;
              padding: 0;
              overflow: hidden;
              background-color: #23274d;
              opacity: 0.9;
            }

            li {
              float: right;
            }

            li a {
              display: block;
              color: white;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
            }

            li a:hover:not(.active) {
              background-color: #111;
            }

            .active {
              background-color: #4CAF50;
            }
            h1,h2{
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
				margin-left:-5%;
            }
            .form input[type=text], input[type=password]{
                display: block;
                margin-bottom: 25px;
                width: 100%;
                border:2px solid steelblue;
				transition:0.25;
				outline:none;
				border-radius: 24px;
            }
			label{
				font-size:20px;
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

			.form{
				
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
			
			}
			body{
				background: rgb(14,0,36);
                background: linear-gradient(90deg, rgba(14,0,36,1) 0%, rgba(28,58,66,1) 0%, rgba(11,246,215,1) 55%, rgba(49,52,93,1) 100%, rgba(49,52,93,1) 100%);
			}
			.logo{
				margin-left:2%;
			}
			

        </style>

    </head>
	
    <body>
	
        <header>
            <nav>
                <div class="row">
                    <ul  class="main-nav">
						<li class="logo" style="float:left"><img src ="logo.png" width="43" height="43">
                        <li><a href="index.php">Employee Login</a></li>
                        <li><a href="forgot-password.php">Emp Password Recovery</a></li>
                        <li><a href="admin/">Admin Login</a></li>
                        <li><a href="headadmin/">Head Admin Login</a></li>
                    </ul>
                </div>
            </nav>
			
            <main>
			
                <div class="hero">
                    <h1>EMPLOYEE LEAVE MANAGEMENT SYSTEM</h1><br>
                    
                    <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                    <form class="form" name="signin" method="post">
						<h2>Employee Login</h2>
                        <div class="col-form">
                            <label for="email">Email</label>
                            <input id="username" type="text" name="username" required>
                        </div>
                        <div class="col-form">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="validate" name="password" required>
                        </div>
                        <div>
                            <button type="submit" name="signin" value="Sign in">Sign In</button>
                        </div>
                    </form>
                </div>
            </main>
			
        </header>
		 
    </body>
		

</html>

    