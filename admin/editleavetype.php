<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{
        if(isset($_POST['update']))
        {
            $lid=intval($_GET['lid']);
            $leavetype=$_POST['leavetype'];
            $description=$_POST['description'];
            $sql="update tblleavetype set LeaveType=:leavetype,Description=:description where id=:lid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
            $query->bindParam(':description',$description,PDO::PARAM_STR);
            $query->bindParam(':lid',$lid,PDO::PARAM_STR);
            $query->execute();
            $msg="Leave type updated Successfully";
        }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Edit Leave Type</title>
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
			form{
				position:center;
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
			}
            input{
                padding: 10px; 
				margin-left:-2%;
            }
            input[type=text],textarea{
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
            }
            button:focus{
                width: 200px;
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
			
        </style>
    </head>
    <body>  
    <?php include('includes/sidebar.php');?>
        <main class="mn-inner">
                <h3>Edit Leave Type</h3>   
                <div class="row">
                    <form class="col s12" name="chngpwd" method="post">
                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } 
                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <?php
                        $lid=intval($_GET['lid']);
                        $sql = "SELECT * from tblleavetype where id=:lid";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':lid',$lid,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            { ?>  
                                <div class="col-form">
                                    <label for="leavetype">Leave Type</label>
                                    <input id="leavetype" type="text" name="leavetype" value="<?php echo htmlentities($result->LeaveType);?>" required>
                                </div>


                                <div class="col-form">
                                    <label for="deptshortname">Description</label>
                                    <textarea id="textarea1" name="description" name="description" length="500" reequired><?php echo htmlentities($result->Description);?></textarea>  
                                </div>
 
                                <?php 
                            }
                        } ?>

                        <div class="col">
                            <button type="submit" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>       
    </body>
</html>
<?php } ?> 