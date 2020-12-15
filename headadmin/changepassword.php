<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{
    // Code for change password 
        if(isset($_POST['change']))
        {
            $password=md5($_POST['password']);
            $newpassword=md5($_POST['newpassword']);
            $username=$_SESSION['alogin'];
                $sql ="SELECT Password FROM headadmin WHERE UserName=:username and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':username', $username, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query -> rowCount() > 0)
            {
                $con="update headadmin set Password=:newpassword where UserName=:username";
                $chngpwd1 = $dbh->prepare($con);
                $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
                $chngpwd1->execute();
                $msg="Your Password succesfully changed";
            }
            else {
                $error="Your current password is wrong";    
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Head Admin | Change Password</title>
        <meta charset="UTF-8">
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            .succWrap{
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            h3{
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
				margin-left:-4%;
            }
            input[type=password]{
                display: block;
                margin-bottom: 25px;
                width: 100%;
                border:2px solid steelblue;
				outline:none;
				border-radius: 24px;
            }
            select{
                display: block;
                margin-bottom: 25px;
                width: 100%;
                border:2px solid steelblue;
            }
            button{
                width: 200px;
                height: 45px;
                border:none;
                background:steelblue;
                color: white;
				outline:none;
				border-radius: 24px;
            }
            button:focus{
                width: 344px;
                height: 45px;
                border:solid steelblue;
                background:white;
                color: steelblue;
				
            }

            body{
              background: linear-gradient(to bottom, #00ffff 0%, #0099cc 100%);
              background-size: cover;
              background-attachment: fixed;
              font-size: 20px;
            }
			.form{
			position:center;
			box-sizing:border-box;
			padding:60px 40px;
			transition: 0.5s;
			background: rgba(255,255,255,0.1);
			box-shadow: 0 0 20px rgba(0,0,0,0.2);
			border-radius: 30px;
			
			}
        </style>

    </head>
    <body>   
        <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                    <h3>Change Password</h3>  
                    <div class="row">
                        <form class="form" name="chngpwd" method="post">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

                            <div class="col-form">
                                <label for="password">Current Password</label>
                                <input id="password" type="password" name="password" required >
                            </div>

                            <div class="col-form">
                                <label for="password">New Password</label>
                                <input id="password" type="password" name="newpassword" required>
                            </div>

                            <div class="col-form">
                                <label for="password">Confirm Password</label>
                                <input id="password" type="password" name="confirmpassword" required>
                            </div>

                            <div class="input-field col s12">
                                <button type="submit" name="change"  onclick="return valid();">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main> 
    </body>
</html>
<?php } ?> 