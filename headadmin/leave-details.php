<?php
  session_start();
  error_reporting(0);
  include('includes/config.php');
  if(strlen($_SESSION['alogin'])==0)
  {   
    header('location:index.php');
  }
  else{

    // code for update the read notification status
    $isread=1;
    $did=intval($_GET['leaveid']);  
    date_default_timezone_set('Asia/Kolkata');
    $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
    $sql="update tblleaves set IsReadHead=:isread where id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isread',$isread,PDO::PARAM_STR);
    $query->bindParam(':did',$did,PDO::PARAM_STR);
    $query->execute();

    // code for action taken on leave
    if(isset($_POST['update']))
    { 
      $did=intval($_GET['leaveid']);
      $description=$_POST['description'];
      $status=$_POST['status'];   
      date_default_timezone_set('Asia/Kolkata');
      $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
      $sql="update tblleaves set AdminRemark=:description,StatusHead=:status,AdminRemarkDate=:admremarkdate where id=:did";
      $query = $dbh->prepare($sql);
      $query->bindParam(':description',$description,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
      $query->bindParam(':did',$did,PDO::PARAM_STR);
      $query->execute();
      $msg="Leave updated Successfully";
    }
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Head Admin | Leave Details </title>
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
              <center><h3>LEAVE DETAILS</h3>
              <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
              <table>          
                <tbody>
                  <?php 
                  $lid=intval($_GET['leaveid']);
                  $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.StatusHead,tblleaves.AdminRemark,tblleaves.AdminRemarkDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
                  $query = $dbh -> prepare($sql);
                  $query->bindParam(':lid',$lid,PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    { ?>  
                      <tr>
                        <td style="font-size:16px;"> <b>Employe Name:</b></td>
                        <td><?php echo htmlentities($result->FirstName." ".$result->LastName);?></td>
                        <td style="font-size:16px;"><b>Employee ID:</b></td>
                        <td><?php echo htmlentities($result->EmpId);?></td>
                        <td style="font-size:16px;"><b>Gender:</b></td>
                        <td><?php echo htmlentities($result->Gender);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Employee Email ID:</b></td>
                        <td><?php echo htmlentities($result->EmailId);?></td>
                        <td style="font-size:16px;"><b>Employee Contact No:</b></td>
                        <td colspan="3"><?php echo htmlentities($result->Phonenumber);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Leave Type:</b></td>
                        <td><?php echo htmlentities($result->LeaveType);?></td>
                        <td style="font-size:16px;"><b>Leave Date:</b></td>
                        <td>From <?php echo htmlentities($result->FromDate);?> to <?php echo htmlentities($result->ToDate);?></td>
                        <td style="font-size:16px;"><b>Posting Date</b></td>
                        <td><?php echo htmlentities($result->PostingDate);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Employee Leave Description: </b></td>
                        <td colspan="5"><?php echo htmlentities($result->Description);?></td>
                      </tr>

                      <tr>
                        <td style="font-size:16px;"><b>Leave Status:</b></td>
                        <td colspan="5"><?php $stats=$result->StatusHead;
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
                        <td style="font-size:16px;"><b>Admin Action Taken Date: </b></td>
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
                      <?php 
                      if($stats==0)
                      {?>
                        <tr>
                          <td colspan="6">
                            <form name="adminaction" method="post"><center>
                              <div id="modal1" style="height: 60%">
                                <div class="col-form" style="width:90%">
                                  <h4>LEAVE TAKE ACTION</h4>
                                  <select class="browser-default" name="status" required="">
                                    <option value="">Choose your option</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Not Approved</option>
                                  </select>
                                  <p><textarea id="textarea1" name="description" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                  <div class="submit" style="width:90%">
                                     <input type="submit" name="update" value="Submit">
                                  </div> 
                                </div> 
                              </div>
                            </form>
                          </td>
                        </tr>
                        <?php 
                      } ?>
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