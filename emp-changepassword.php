<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['emplogin'])==0)
    {   
        header('location:index.php');
    }
    else{
    // Code for change password 
        if(isset($_POST['change']))
        {
            $password=md5($_POST['password']);
            $newpassword=md5($_POST['newpassword']);
            $username=$_SESSION['emplogin'];
            $sql ="SELECT Password FROM tblemployees WHERE EmailId=:username and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':username', $username, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query -> rowCount() > 0)
            {
                $con="update tblemployees set Password=:newpassword where EmailId=:username";
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
    <title>Employee | Change Password</title>
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
			margin-left:-2%;
        }
        input[type=password]{
            display: block;
            margin-bottom: 25px;
            width: 100%;
            border:2px solid steelblue;
			outline:none;
			border-radius: 24px;
			position:center;
        }
        select{
            display: block;
            margin-bottom: 25px;
            width: 100%;
            border:2px solid steelblue;
        }
		label{
				font-size:20px;
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
		.chngpwd{
			position:center;
			box-sizing:border-box;
			padding:60px 40px;
			transition: 0.5s;
			background: rgba(255,255,255,0.1);
			box-shadow: 0 0 20px rgba(0,0,0,0.2);
			border-radius: 30px;
			
		}
		body{
			font-size:20px;
			background: rgb(14,0,36);
            background: linear-gradient(90deg, rgba(14,0,36,1) 0%, rgba(28,58,66,1) 0%, rgba(11,246,215,1) 55%, rgba(49,52,93,1) 100%, rgba(49,52,93,1) 100%);
		}
        

    </style>    
</head>
<body>
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                    <h3>Change Password</h3>
                    <form class="chngpwd" method="post"  style="text-align: center;">
                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                        
                        <div class="col-form">
                            <label for="password">Current Password</label>
                            <input id="password" type="password" name="password" required>
                            
                        </div>

                        <div class="col-form">
                            <label for="password">New Password</label>
                            <input id="password" type="password" name="newpassword" required>
                        </div>

                        <div class="col-form">
                            <label for="password">Confirm Password</label>
                            <input id="password" type="password" name="confirmpassword" required>        
                        </div>


                        <div class="col">
                            <button type="submit" name="change" onclick="return valid();">Change</button>
                        </div>   
                    </form>
            </main>
</body>
</html>
<?php } ?> 