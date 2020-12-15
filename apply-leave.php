<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['emplogin'])==0)
    {   
        header('location:index.php');
    }
    else
    {
        if(isset($_POST['apply']))
        {
            $empid=$_SESSION['eid'];
            $leavetype=$_POST['leavetype'];
            $fromdate=$_POST['fromdate'];  
            $todate=$_POST['todate'];
            $description=$_POST['description'];  
            $status=0;
            $isread=0;
            if($fromdate > $todate)
            {
                $error=" ToDate should be greater than FromDate ";
            }
            $sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid) VALUES(:leavetype,:fromdate,:todate,:description,:status,:isread,:empid)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
            $query->bindParam(':description',$description,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="Leave applied successfully.You can check in 2 days later.";
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
    <title>Employee | Apply Leave</title>
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
        .form-inline{
				  display: flex;
				  flex-flow: row wrap;
				  align-items: center;
				  flex-direction: column;
				  align-items: stretch;
            }
			.form-inline label {
				margin: 5px 10px 5px 0;
			}
            .form-inline input {
				vertical-align: middle;
				margin: 5px 10px 5px 0;
				padding: 10px;
				background-color: #fff;
				border: 1px solid #ddd;
			}
			.form-inline button {
			padding: 10px 20px;
				background-color: dodgerblue;
				border: 1px solid #ddd;
				color: white;
			}
			@media (max-width: 800px) {
				.form-inline input {
				margin: 10px 0;
				}
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
        <div>
			
            <form class="form-inline" method="post" name="addemp"><center>
                <div>
                    <h3>Apply for Leave</h3>
                    <section>
                        <div class="row">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


                            <div class="input-field col  s12">
                                <select  name="leavetype" autocomplete="off" >
                                    <option value="" >Select leave type...</option>
                                    <?php $sql = "SELECT  LeaveType from tblleavetype";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        {   ?>                                            
                                            <option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
                                                    <?php 
                                        }
                                    } ?>
                                </select>
                            </div>

							<table>
                            <tr>
                                <td><label for="fromdate">From  Date</label></td>
                                <td><input placeholder="" id="mask1" name="fromdate" type="date" data-inputmask="'alias': 'date'" required></td>
                            </tr>
                            <tr>
                                <td><label for="todate">To Date</label></td>
                                <td><input placeholder="" id="mask1" name="todate" type="date" data-inputmask="'alias': 'date'" required></td>
                            </tr>
                            <tr>
                                <td><label for="description">Description</label></td>    
                                <td><textarea id="textarea1" name="description" length="500" required></textarea></td>
                            </tr>
                            <tr>
                                <td><label for="position">Position</label></td>    
                                <td><input type="text" name="position" required></td>
                            </tr>
                            <tr>
                                <td><label for="department">Department</label></td>
                                <td><select  name="department">
                                    <option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
                                    <?php $sql = "SELECT DepartmentName from tbldepartments";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $resultt)
                                        {   ?>                                            
                                            <option value="<?php echo htmlentities($resultt->DepartmentName);?>" ><?php echo htmlentities($resultt->DepartmentName);?></option>
                                            <?php 
                                        }
                                    } ?>
                                </select></td>
                            </tr><br>
                        </div></table>
						<br>
                        <button type="submit" name="apply" id="apply">Apply</button>                                             
                    </section>             
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php } ?> 