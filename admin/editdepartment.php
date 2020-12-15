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
            $did=intval($_GET['deptid']);    
            $deptname=$_POST['departmentname'];
            $deptshortname=$_POST['departmentshortname'];
            $deptcode=$_POST['deptcode'];   
            $sql="update tbldepartments set DepartmentName=:deptname,DepartmentCode=:deptcode,DepartmentShortName=:deptshortname where id=:did";
            $query = $dbh->prepare($sql);
            $query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
            $query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
            $query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
            $query->bindParam(':did',$did,PDO::PARAM_STR);
            $query->execute();
            $msg="Department updated Successfully";
        }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update Department</title>
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
			form{
				position:center;
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
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
			input[type=text], input[type=email], input[type=tel], input[type=password], input[type=date]{
				display: block;
				margin-bottom: 25px;
				width: 100%;
				border:2px solid steelblue;
				border-radius: 30px;
			}
			.title{
				text-align:center;
				font-size:20px;
			}
			button{
				width: 200px;
				height: 45px;
				border:none;
				background:steelblue;
				color: white;
				border-radius: 30px;
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
                        <div class="title" >Update Department</div>
                    </div>       
                    <div class="row">
                        <form class="cols12" name="chngpwd" method="post">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                            <?php 
                            $did=intval($_GET['deptid']);
                            $sql = "SELECT * from tbldepartments WHERE id=:did";
                            $query = $dbh -> prepare($sql);
                            $query->bindParam(':did',$did,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                { ?>  
                                    <div class="col-form">
										<label for="deptname">Department Name</label>
                                        <input id="departmentname" type="text" name="departmentname" value="<?php echo htmlentities($result->DepartmentName);?>">
                                        
                                    </div>

                                    <div class="col-form">
										<label for="deptshortname">Department Short Name</label>
                                        <input id="departmentshortname" type="text" value="<?php echo htmlentities($result->DepartmentShortName);?>" name="departmentshortname">
                                        
                                    </div>
                                    <div class="col-form">
										<label for="password">Department Code</label>
                                        <input id="deptcode" type="text" name="deptcode" value="<?php echo htmlentities($result->DepartmentCode);?>">
                                        
                                    </div>

                                    <?php 
                                }
                            } ?>


                            <div class="input-field col s12">
                                <button type="submit" name="update">UPDATE</button>
                            </div>
                        </form>
                    </div>
            </main>
    </body>
</html>
<?php } ?> 