<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else
    {
        if(isset($_POST['add']))
        {
            $deptname=$_POST['departmentname'];
            $deptshortname=$_POST['departmentshortname'];
            $deptcode=$_POST['deptcode'];   
            $sql="INSERT INTO tbldepartments(DepartmentName,DepartmentCode,DepartmentShortName) VALUES(:deptname,:deptcode,:deptshortname)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
            $query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
            $query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="Department Created Successfully";
            }
            else 
            {
                $error="Something went wrong. Please try again";
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Add Department</title>
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
				margin-left:-5%;
            }
            input[type=text]{
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
			.cols12{
				position:relative;
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
			}
            
        </style>
    </head>
    <body style="background-color:#AED6F1">  
           <?php include('includes/sidebar.php');?>
                <main class="mn-inner">
                        <h3>ADD DEPARTMENT</h3>
						
                        <div>
                            <form class="cols12" name="chngpwd" method="post">
                                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <div class="col-form">
                                    <label for="deptname">Department Name</label>
                                    <input id="departmentname" type="text" name="departmentname">
                                </div>

                                <div class="col-form">
                                    <label for="deptshortname">Department Short Name</label>
                                    <input id="departmentshortname" type="text" name="departmentshortname">
                                </div>
                                <div class="col-form">
                                    <label for="password">Department Code</label>
                                    <input id="deptcode" type="text" name="deptcode">
                                    
                                </div>
                                <div class="col">
                                    <button type="submit" name="add">ADD</button>
                                </div>    
                            </form>
							
                        </div>
                </main>      
    </body>
</html>
<?php } ?> 