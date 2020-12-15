<?php
  session_start();
  error_reporting(0);
  include('includes/config.php');
  /*if(strlen($_SESSION['alogin'])==0)
  {   
    header('location:index.php');
  }
  else{*/

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Leave Application Form </title>
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
          h3,h4{
              padding: 10px;
              margin: 10px;
              font-family: Impact,Charcoal,sans-serif;
              font-size: 30px;
          }
          select,textarea{
              display: block;
              margin-bottom: 25px;
              width: 100%;
              border:2px solid steelblue;
          }
          input[type=submit]{
              width: 200px;
              height: 45px;
              border:none;
              background:steelblue;
              color: white;
          }
          input[type=submit]:focus{
              width: 200px;
              height: 45px;
              border:solid steelblue;
              background:white;
              color: steelblue;
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

		  td{
                text-align: center;
            }

        </style>
    </head>
    <body>  
      <?php include('includes/sidebar.php');?>
        <main class="mn-inner">
            <div class="content">
              <center><h3>Leave Application Form</h3>
              <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
              <table>          
                <tbody>
                  <?php 
                  $eid=intval($_GET['leaveid']);
                  $sql = "SELECT tblleaves.id as eid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblemployees.Department,tblemployees.Position,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:eid";
                  $query = $dbh -> prepare($sql);
                  $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    { ?>  
                      <tr>
                        <td style="font-size:16px;"> <b>Employee Name:</b></td>
                        <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?></td>
                        <td style="font-size:16px;"><b>Emp Id :</b></td>
                        <td><?php echo htmlentities($result->EmpId);?></td>
                        <td style="font-size:16px;"><b>Gender :</b></td>
                        <td><?php echo htmlentities($result->Gender);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Emp Email id:</b></td>
                        <td><?php echo htmlentities($result->EmailId);?></td>
                        <td style="font-size:16px;"><b>Emp Contact No. :</b></td>
                        <td><?php echo htmlentities($result->Phonenumber);?></td>
                        <td style="font-size:16px;"><b>Position :</b></td>
                        <td><?php echo htmlentities($result->Position);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Leave Type:</b></td>
                        <td><?php echo htmlentities($result->LeaveType);?></td>
                        <td style="font-size:16px;"><b>Leave Date .:</b></td>
                        <td>From <?php echo htmlentities($result->FromDate);?> to <?php echo htmlentities($result->ToDate);?></td>
                        <td style="font-size:16px;"><b>Posting Date</b></td>
                        <td><?php echo htmlentities($result->PostingDate);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Department: </b></td>
                        <td colspan="5"><?php echo htmlentities($result->Department);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Position: </b></td>
                        <td colspan="5"><?php echo htmlentities($result->Position);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Employe Leave Description: </b></td>
                        <td colspan="5"><?php echo htmlentities($result->Description);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>leave Status:</b></td>
                        <td colspan="5"><?php $stats=$result->Status;
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
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Admin Remark: </b></td>
                        <td colspan="5"><?php
                        if($result->AdminRemark==""){
                          echo "waiting for Approval";  
                        }
                        else{
                        echo htmlentities($result->AdminRemark);
                        }
                        ?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Admin Action taken date: </b></td>
                        <td colspan="5"><?php
                          if($result->AdminRemarkDate=="")
                          {
                            echo "NA";  
                          }
                          else{
                            echo htmlentities($result->AdminRemarkDate);
                          }?>
                        </td>
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
<?php  ?>
