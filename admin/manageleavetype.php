<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{
        if(isset($_GET['del']))
        {
            $id=$_GET['del'];
            $sql = "delete from  tblleavetype  WHERE id=:id";
            $query = $dbh->prepare($sql);
            $query -> bindParam(':id',$id, PDO::PARAM_STR);
            $query -> execute();
            $msg="Leave type record deleted";

        }
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Manage Leave Type</title>
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
				color:black;
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
			
                    <h3>MANAGE LEAVE TYPE</h3>
                    <div>
                        <span class="card-title">Leave Type Info</span>
                        <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <br>
						<table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="120">Leave Type</th>
                                    <th width="120">Description</th>
                                    <th align="center">Creation Date</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>
                                     
                            <tbody>
                                <?php $sql = "SELECT * from tblleavetype";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    { ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->Description);?></td>
                                            <td><?php echo htmlentities($result->CreationDate);?></td>
                                            <td><a href="editleavetype.php?lid=<?php echo htmlentities($result->id);?>"><i style="color: black" class='fas'>&#xf044;</i></a>
                                            <a href="manageleavetype.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you want to delete');"> <i style="color: black" class='fas'>&#xf12d;</i></a> </td>
                                        </tr>
                                        <?php $cnt++;
                                    } 
                                }?>
                            </tbody>
                        </table>
						</center>
                    </div>
        </main>
    </body>
</html>
<?php } ?>