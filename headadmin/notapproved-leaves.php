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
        <title>Head Admin | Not Approved Leaves </title>
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

            table, th, td {
              border: 1px solid black;
          }

            body{
              background: linear-gradient(to bottom, #00ffff 0%, #0099cc 100%);
              background-size: cover;
              background-attachment: fixed;
              font-size: 20px;
          }

            th{
            background-color: #3342FF;
            color: black;
          }

            td{
                text-align: center;
            }

        </style>
    </head>
    <body>  
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                    <center><h3> Not Approved Leave History</h3>
                    <div class="content">
                        <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="200">Employe Name</th>
                                    <th width="120">Leave Type</th>

                                    <th width="180">Posting Date</th>                 
                                    <th>Status</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>
                                 
                            <tbody>
                                <?php 
                                $status=2;
                                $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.StatusHead from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.StatusHead=:status order by lid desc";
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
                                            <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?>(<?php echo htmlentities($result->EmpId);?>)</a></td>
                                            <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->PostingDate);?></td>
                                            <td><?php $stats=$result->StatusHead;
                                                if($stats==1)
                                                {?>
                                                    <span style="color: green"><b>Approved</b></span>
                                                    <?php 
                                                } if($stats==2)  
                                                { ?>
                                                    <span style="color: red"><b>Not Approved</b></span>
                                                    <?php 
                                                } if($stats==0)  
                                                { ?>
                                                    <span style="color: blue"><b>Waiting For Approval</b></span>
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
                    </div>
                </div>
            </main>
    </body>
</html>
<?php } ?>