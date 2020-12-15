<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['emplogin'])==0)
    {   
        header('location:index.php');
    }
    else{
        $eid=$_SESSION['emplogin'];
        if(isset($_POST['update']))
        {

            $fname=$_POST['firstName'];
            $lname=$_POST['lastName'];   
            $gender=$_POST['gender']; 
            $dob=$_POST['dob']; 
            $department=$_POST['department'];
            $position=$_POST['position']; 
            $address=$_POST['address']; 
            $city=$_POST['city']; 
            $country=$_POST['country']; 
            $mobileno=$_POST['mobileno']; 
            $sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Position=:position,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmailId=:eid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname',$fname,PDO::PARAM_STR);
            $query->bindParam(':lname',$lname,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':dob',$dob,PDO::PARAM_STR);
            $query->bindParam(':department',$department,PDO::PARAM_STR);
            $query->bindParam(':position',$position,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':city',$city,PDO::PARAM_STR);
            $query->bindParam(':country',$country,PDO::PARAM_STR);
            $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
            $query->bindParam(':eid',$eid,PDO::PARAM_STR);
            $query->execute();
            $msg="Employee record updated Successfully";
        }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Update Employee</title>
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
			.form-inline button:hover {
				background-color: royalblue;
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
                    <div class="row">
                        <div class="col">
						
                            <form class="form-inline" method="post" name="updatemp"><center>		
								
                                <div>
                                    <h3>Update Employee Info</h3>									
                                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                    <section>
                                        <div class="row">
                                            <?php 
                                            $eid=$_SESSION['emplogin'];
                                            $sql = "SELECT * from  tblemployees where EmailId=:eid";
                                            $query = $dbh -> prepare($sql);
                                            $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                                foreach($results as $result)
                                                {  ?> 
												<table>
                                                    <tr>
                                                        <td><label for="empcode">Employee Code</label></td>
                                                        <td><input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text"></td>
                                                        <td><span id="empid-availability" style="font-size:12px;"></span></td>
                                                    </tr>


                                                    <tr>
                                                        <td><label for="firstName">First name</label></td>
                                                        <td><input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text"></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="lastName">Last name </label></td>
                                                        <td><input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text"></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="email">Email</label></td>
                                                        <td><input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>"></td>
                                                        <td><span id="emailid-availability" style="font-size:12px;"></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="phone">Mobile number</label></td>
                                                        <td><input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="gender">Gender</label></td>
                                                        <td><select  name="gender">
                                                            <option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>                                      
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td><label for="birthdate">Date of Birth</label></td>
                                                        <td><input type="date" id="birthdate" name="dob"  class="datepicker" value="<?php echo htmlentities($result->Dob);?>" ></td>
                                                    </tr>
                                                                            
                                                    <!--<div class="col-form">
                                                        <label for="department">Department</label>
                                                        <select  name="department">
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
                                                                    <option value="<?php echo htmlentities($resultt->DepartmentName);?>"><?php echo htmlentities($resultt->DepartmentName);?></option>
                                                                        <?php 
                                                                }
                                                            } ?>
                                                        </select>
                                                    </div>-->

                                                    <tr>
                                                        <td><label for="position">Position</label></td>
                                                        <td><input id="position" name="position" type="text"  value="<?php echo htmlentities($result->Position);?>" ></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="address">Address</label></td>
                                                        <td><input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" ></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="city">City/Town</label></td>
                                                        <td><input id="city" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" ></td>
                                                    </tr>
                                                                                                       
                                                    <tr>
                                                        <td><label for="country">Country</label></td>
                                                        <td><input id="country" name="country" type="text"  value="<?php echo htmlentities($result->Country);?>"></td>
                                                    </tr>                                                               
                                                    <?php 
                                                }
                                            }?>
                                                                                                                        
                                            
                                        </div>
                                    </section>
                                </div>
								</table>
                                <div class="col">
                                        <button class="button1" type="submit" name="update"  id="update">UPDATE</button>
                                    </div>  
							
                            </form>
								
                        </div>
                    </div>
            </main>       
    </body>
</html>
<?php } ?> 