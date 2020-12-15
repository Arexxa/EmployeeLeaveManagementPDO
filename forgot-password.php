
<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    // Code for change password 
    if(isset($_POST['change']))
    {
        $newpassword=md5($_POST['newpassword']);
        $empid=$_SESSION['empid'];

        $con="update tblemployees set Password=:newpassword where id=:empid";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1-> bindParam(':empid', $empid, PDO::PARAM_STR);
        $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $msg="Your Password succesfully changed";
    }

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ELMS | Password Recovery</title>
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
		margin-left:-5%;
    }
    input[type=text]{
        display: block;
        margin-bottom: 25px;
        width: 100%;
        border:2px solid steelblue;
		outline:none;
		border-radius: 24px;
    }
    input[type=password]{
        display: block;
        margin-bottom: 25px;
        width: 100%;
        border:2px solid steelblue;
		outline:none;
		border-radius: 24px;
    }
    button{
        width: 150px;
        height: 45px;
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
    
	.cols12{
		position:relative;
		box-sizing:border-box;
		padding:60px 40px;
		transition: 0.5s;
		background: rgba(255,255,255,0.1);
		box-shadow: 0 0 20px rgba(0,0,0,0.2);
		border-radius: 30px;
	}
	body{
		background: rgb(14,0,36);
        background: linear-gradient(90deg, rgba(14,0,36,1) 0%, rgba(59,28,66,1) 0%, rgba(11,246,156,1) 55%, rgba(93,49,89,1) 100%, rgba(93,49,80,1) 100%);
	}
	label{
		font-size:20px;
	}
	.logo{
		margin-left:2%;
	}

    </style>
        
    </head>
    <body>       
            <nav>     
                <ul>
                    <li>&nbsp;</li>
					<li class="logo" style="float:left"><img src ="logo.png" width="40" height="40">
                    <li><a href="index.php">Employee Login</a></li>
                    <li><a href="forgot-password.php">Emp Password Recovery</a></li>
                    <li><a href="admin/">Admin Login</a></li>
                </ul>
            </nav>
				
            <main class="mn-inner">
                <h3>Employee Password Recovery</h3>
                <div class="card-content ">
                    
                    <?php if($msg){?><div class="succWrap"><strong>Success </strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                    <div class="row">
					
                        <form class="cols12" name="signin" method="post">
						<h3>Employee Details</h3>
                            <div class="col-form">
                                <label for="email">Employee Id</label>
                                <input id="empid" type="text" name="empid">
                                
                            </div>
                            <div class="col-form">
                                <label for="password">Email id</label>
                                <input id="password" type="text" name="emailid" >
                                
                            </div>
                            <div class="button">
                                <button type="submit" name="submit" value="Sign in">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if(isset($_POST['submit']))
                {
                    $empid=$_POST['empid'];
                    $email=$_POST['emailid'];
                    $sql ="SELECT id FROM tblemployees WHERE EmailId=:email and EmpId=:empid";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':email', $email, PDO::PARAM_STR);
                    $query-> bindParam(':empid', $empid, PDO::PARAM_STR);
                    $query-> execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                        foreach ($results as $result) 
                        {
                            $_SESSION['empid']=$result->id;
                        } 
                        ?>

                        <div class="row">
                            <h3>change your password </h3>                        
                            <form class="col s12" name="udatepwd" method="post">
                                <div class="col-form">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" name="newpassword">
                                    
                                </div>

                                <div class="col-form">
                                    <label for="password">Confirm Password</label>
                                    <input id="password" type="password" name="confirmpassword" >
                                    
                                </div>

                                <div class="col-form">
                                    <button type="submit" name="change" onclick="return valid();">Change</button>
                                </div>
                            </form>
                        </div>
                            <?php 
                    } else
                    { ?>
                        <div class="errorWrap" style="margin-left: 2%; font-size:22px;">
                            <strong>ERROR</strong> : <?php echo htmlentities("Invalid details");
                    }?>
                        </div>
                        <?php 
                } ?>
            </main>  
			
    </body>
</html>