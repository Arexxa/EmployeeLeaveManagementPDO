<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{
        // code for Inactive  employee    
        if(isset($_GET['inid']))
        {
            $id=$_GET['inid'];
            $status=0;
            $sql = "update tblemployees set Status=:status  WHERE id=:id";
            $query = $dbh->prepare($sql);
            $query -> bindParam(':id',$id, PDO::PARAM_STR);
            $query -> bindParam(':status',$status, PDO::PARAM_STR);
            $query -> execute();
            header('location:manageemployee.php');
        }

        //code for active employee
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $status=1;
            $sql = "update tblemployees set Status=:status  WHERE id=:id";
            $query = $dbh->prepare($sql);
            $query -> bindParam(':id',$id, PDO::PARAM_STR);
            $query -> bindParam(':status',$status, PDO::PARAM_STR);
            $query -> execute();
            header('location:manageemployee.php');
        }
 ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            
            <!-- Title -->
            <title>Admin | Manage Employees</title>
            <meta charset="UTF-8">
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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
                    font-size: 30px;
                }
                .card-title{
                    padding: 10px;
                    margin: 10px;
                    font-family: Impact,Charcoal,sans-serif;
                    font-size: 30px;
                }
				table, th, td {
					border: 1px solid black;
				}
				th {
					background-color: #48C9B0;
					color: black;
				}
				body{
					font-size:20px;
					background-color:#AED6F1;
				}
				td{
					text-align:center;
				}
				
            </style>
        </head>
        <body>
		<center>
           <?php include('includes/sidebar.php');?>
                <main class="mn-inner">
                        <h3>MANAGE EMPLOYEES</h3>
                        <div>
                            <span class="card-title">Employees Info</span>
                            <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="120">Emp Id</th>
                                        <th width="120">Full Name</th>
                                        <th width="120">Department</th>
                                        <th align="center">Status</th>
                                        <th align="center">Reg Date</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>
                                     
                                <tbody>
                                    <?php $sql = "SELECT EmpId,FirstName,LastName,Department,Status,RegDate,id from  tblemployees";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        {  ?>  
                                            <tr>
                                                <td> <?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($result->EmpId);?></td>
                                                <td><?php echo htmlentities($result->FirstName);?>&nbsp;<?php echo htmlentities($result->LastName);?></td>
                                                <td><?php echo htmlentities($result->Department);?></td>
                                                <td><?php $stats=$result->Status;
                                                    if($stats)
                                                        {?>
                                                            <a>Active</a>
                                                            <?php 
                                                        } else 
                                                        { ?>
                                                            <a>Inactive</a>
                                                            <?php 
                                                        } ?>
                                                </td>
                                                <td><?php echo htmlentities($result->RegDate);?></td>
                                                <td>
                                                    <a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>"><i style="color: black" class='fas'>&#xf044;</i></a>
                                                    <?php if($result->Status==1)
                                                    {?>
                                                        <a href="manageemployee.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to inactive this Employe?');"" > <i style="color: black"  class='fas'>&#xf12d;</i>
                                                        <?php 
                                                    } else 
                                                    {?>
                                                        <a href="manageemployee.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to active this employee?');""><i>done</i>
                                                        <?php 
                                                    } ?> 
                                                </td>
                                            </tr>
                                            <?php $cnt++;
                                        } 
                                    }?>
                                </tbody>
                            </table>
							</center>
                        </div>
                    </div>
                </main>           
        </body>
    </html>
<?php } ?>