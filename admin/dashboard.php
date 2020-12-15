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
        <title>Admin | Dashboard</title>
        <meta charset="UTF-8">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

        

        <style type="text/css">
            h3{
                padding: 10px;
                margin: 10px;
                font-family: Impact,Charcoal,sans-serif;
                font-size: 30px;
                
            }
            .card-title{
                padding: 10px;
                margin: 10px;
                font-family: "Times New Roman", Times, serif;
                font-size: 18px;
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
                <div class="card-content">
				
                    <h3>LATEST LEAVE HISTORY</h3>
                    <table >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="200">Employee Name</th>
                                <th width="120">Leave Type</th>
                                <th width="170">Posting Date</th>                 
                                <th align="center">Status Head Admin</th>
                                <th align="center">Status</th>
                                <th align="center">Action</th>
                            </tr>
                        </thead>
                                 
                        <tbody>
                            <?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status,tblleaves.StatusHead from tblleaves join tblemployees on tblleaves.empid=tblemployees.id order by lid desc limit 6";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                { ?>  

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
            </main>       
    </body>
</html>
<?php } ?>