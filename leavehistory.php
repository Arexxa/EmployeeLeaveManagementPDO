<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['emplogin'])==0)
    {   
        header('location:index.php');
    }
    else{

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Leave History</title>
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
                text-align:center;
                font-family: Impact,Charcoal,sans-serif;
                font-size: 30px;
                
            }
			table, th, td{
				border:1px solid black;
			}
			th {
				background-color: #5DADE2;
				color: white;
			}
			td{
				text-align:center;
			}
			body{
				font-size:20px;
				background: rgb(238,174,202);
				background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
			}
        </style>
    </head>
        <body>  
            <?php include('includes/sidebar.php');?>
                <main class="mn-inner">
                            <div>
                                <h3>Leave History</h3>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <center><table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th width="120">Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                             <th>Description</th>
                                             <th width="120">Posting Date</th>
                                            <th width="200">Admin Remark</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                        <?php 
                                        $eid=$_SESSION['eid'];
                                        //$sql = "SELECT LeaveType,ToDate,FromDate,Description,PostingDate,AdminRemarkDate,AdminRemark,Status from tblleaves where empid=:eid";
                                        $sql = "SELECT tblleaves.id as eid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.empid=:eid";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                            {    ?>  
                                                <tr>
                                                    <td> <?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($result->LeaveType);?></td>
                                                    <td><?php echo htmlentities($result->ToDate);?></td>
                                                    <td><?php echo htmlentities($result->FromDate);?></td>
                                                    <td><?php echo htmlentities($result->Description);?></td>
                                                    <td><?php echo htmlentities($result->PostingDate);?></td>
                                                    <td>
                                                        <?php 
                                                        if($result->AdminRemark=="")
                                                        {
                                                            echo htmlentities('waiting for approval');
                                                        }else
                                                        {
                                                            echo htmlentities(($result->AdminRemark)." "."at"." ".$result->AdminRemarkDate);
                                                        }?>
                                                    </td>
                                                    <td>
                                                        <?php $stats=$result->Status;
                                                        if($stats==1)
                                                        { ?>
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
                                                     <td><a href="form.php?leaveid=<?php echo htmlentities($result->eid);?>" class="waves-effect waves-light btn blue m-b-xs"  > View Details</a></td>
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