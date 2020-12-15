<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else{
        $eid=intval($_GET['empid']);
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
            $sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Position=:position,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where id=:eid";
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
        <title>Admin | Update Employee</title>
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
            h2{
                padding: 10px;
                margin: 10px;
                font-family: Impact,Charcoal,sans-serif;
                font-size: 30px;
            }
            h3{
                padding: 10px;
                margin: 10px;
                font-family: Impact,Charcoal,sans-serif;
                font-size: 30px;
            }
            form{
                text-align: center;
                margin: 30px auto;
                width: 320px;

            }
			form{
				position:center;
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
			}
            input{
                padding: 10px;  
            }
            input[type=text], input[type=email], input[type=tel],input[type=date]{
                display: block;
                margin-bottom: 25px;
                width: 100%;
                border:2px solid steelblue;
            }
            select{
                display: block;
                margin-bottom: 25px;
                width: 100%;
                border:2px solid steelblue;
            }
            button{
                width: 200px;
                height: 45px;
                border:none;
                background:steelblue;
                color: white;
            }
            button:focus{
                width: 200px;
                height: 45px;
                border:solid steelblue;
                background:white;
                color: steelblue;
            }
			body{
		      background: linear-gradient(to bottom, #00ffff 0%, #0099cc 100%);
		      background-size: cover;
		      background-attachment: fixed;
		      font-size: 20px;
			}
			
        </style>

    </head>
    <body>   
        <?php include('includes/sidebar.php');?>
        <main class="mn-inner">
                <h2>Update Employee</h2>
                <div class="card-content">
                    <form id="form" method="post" name="updatemp">
                        <div>
                        <h3>Update Employee Info</h3>
                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                        <section>

                            <div class="row">
                                <?php 
                                $eid=intval($_GET['empid']);
                                $sql = "SELECT * from  tblemployees where id=:eid";
                                $query = $dbh -> prepare($sql);
                                $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    {               ?> 
                                        <div class="col-form">
                                            <label for="empcode">Employee Code(Must be unique)</label>
                                            <input  name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" >
                                            <span id="empid-availability" style="font-size:12px;"></span> 
                                        </div>


                                        <div class="col-form">
                                            <label for="firstName">First name</label>
                                            <input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" >
                                        </div>

                                        <div class="icol-form">
                                            <label for="lastName">Last name </label>
                                            <input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text">
                                        </div>

                                        <div class="col-form">
                                            <label for="email">Email</label>
                                            <input  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>">
                                            <span id="emailid-availability" style="font-size:12px;"></span> 
                                        </div>

                                        <div class="col-form">
                                            <label for="phone">Mobile number</label>
                                            <input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10">
                                        </div>


                                        <div class="col-form">
                                            <select  name="gender">
                                                <option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>                                          
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-form">
                                            <label for="birthdate">Date of Birth</label>
                                            <input id="birthdate" name="dob" type="date" class="datepicker" value="<?php echo htmlentities($result->Dob);?>" >
                                        </div>

                                                                                        
                                        <div class="col-form">
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
                                        </div>

                                        <div class="col-form">
                                            <label for="position">Position</label>
                                            <input id="position" name="position" type="text"  value="<?php echo htmlentities($result->Position);?>" >
                                        </div>

                                        <div class="col-form">
                                            <label for="address">Address</label>
                                            <input id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" >
                                        </div>

                                        <div class="col-form">
                                            <label for="city">City/Town</label>
                                            <input id="city" name="city" type="text"  value="<?php echo htmlentities($result->City);?>" >
                                        </div>
                                       
                                        <div class="col-form">
                                            <label for="country">Country</label>
                                            <input id="country" name="country" type="text"  value="<?php echo htmlentities($result->Country);?>" >
                                        </div>                                                                                        
                                        <?php 
                                    }
                                }?>
                                                                                            
                                <div class="col">
                                    <button type="submit" name="update"  id="update">UPDATE</button>
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
        </main>       
    </body>
</html>
<?php } ?> 