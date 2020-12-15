<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Approved Leave leaves </title>
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
                    <h3>PENDING LEAVE HISTORY</h3>
                    <div>
                        <span class="card-title">Leave History</span>
                        <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="200">Employee Name</th>
                                    <th width="120">Leave Type</th>
                                    <th width="180">Posting Date</th>                 
                                    <th>Status Head Admin</th>
                                    <th>Status</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>
                                 
                            <tbody>
                                <?php 
                                $status=0;
                                $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status,tblleaves.StatusHead from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.Status=:status order by lid desc";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':status',$status,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    {  ?>        
                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                            <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                            <td><?php $stats=$result->StatusHead;
                                                if($stats==1)
                                                {?>
                                                    <span style="color: green">Approved</span>
                                                    <?php 
                                                } if($stats==2)  
                                                { ?>
                                                    <span style="color: red">Not Approved</span>
                                                    <?php 
                                                } if($stats==0)  
                                                { ?>
                                                    <span style="color: blue">waiting for approval</span>
                                                    <?php 
                                                } ?>
                                            </td>
                                            <td><?php $stats=$result->Status;
                                                if($stats==1)
                                                {?>
                                                    <span style="color: green">Approved</span>
                                                    <?php 
                                                } if($stats==2)  
                                                { ?>
                                                    <span style="color: red">Not Approved</span>
                                                    <?php 
                                                } if($stats==0)  
                                                { ?>
                                                    <span style="color: blue">waiting for approval</span>
                                                    <?php 
                                                } ?>
                                            </td>

                                            <td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" style="color: black" class='fas'>&#xf06e;</a></td>
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