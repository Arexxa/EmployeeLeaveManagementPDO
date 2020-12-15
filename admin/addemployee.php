<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
    {   
        header('location:index.php');
    }
    else
    {
        if(isset($_POST['add']))
        {
            $empid=$_POST['empcode'];
            $fname=$_POST['firstName'];
            $lname=$_POST['lastName'];   
            $email=$_POST['email']; 
            $password=md5($_POST['password']); 
            $gender=$_POST['gender']; 
            $dob=$_POST['dob']; 
            $department=$_POST['department']; 
            $position=$_POST['position']; 
            $address=$_POST['address']; 
            $city=$_POST['city']; 
            $country=$_POST['country']; 
            $mobileno=$_POST['mobileno']; 
            $status=1;

            $sql="INSERT INTO tblemployees(EmpId,FirstName,LastName,EmailId,Password,Gender,Dob,Department,Position,Address,City,Country,Phonenumber,Status) VALUES(:empid,:fname,:lname,:email,:password,:gender,:dob,:department,:position,:address,:city,:country,:mobileno,:status)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
            $query->bindParam(':fname',$fname,PDO::PARAM_STR);
            $query->bindParam(':lname',$lname,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':password',$password,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':dob',$dob,PDO::PARAM_STR);
            $query->bindParam(':department',$department,PDO::PARAM_STR);
            $query->bindParam(':position',$position,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':city',$city,PDO::PARAM_STR);
            $query->bindParam(':country',$country,PDO::PARAM_STR);
            $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="Employee record added Successfully";
            }
            else 
            {
                $error="Something went wrong. Please try again";
            }
        }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Add Employee</title>
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
            padding: 10px;
            margin: 10px;
            font-family: Impact,Charcoal,sans-serif;
            text-align: center;
            font-size: 30px;
            align-content: center;
        }
        form{
            text-align: center;
            margin: 30px auto;
            width: 320px;

        }
        input{
            padding: 10px;  
			margin-left:-5%;
        }
        input[type=text], input[type=email], input[type=tel], input[type=password], input[type=date]{
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
		form{
			position:center;
				box-sizing:border-box;
				padding:60px 40px;
				transition: 0.5s;
				background: rgba(255,255,255,0.1);
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				border-radius: 30px;
		}
    </style>
    <script type="text/javascript">
        function valid()
        {
            if(document.addemp.password.value!= document.addemp.confirmpassword.value)
            {
                alert("New Password and Confirm Password Field do not match  !!");
                document.addemp.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

    <script>
        function checkAvailabilityEmpid() 
        {
            $("#loaderIcon").show();
            jQuery.ajax(
            {
                url: "check_availability.php",
                data:'empcode='+$("#empcode").val(),
                type: "POST",
                success:function(data)
                {
                    $("#empid-availability").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>

    <script>
        function checkAvailabilityEmailid() 
        {
            $("#loaderIcon").show();
            jQuery.ajax(
            {
                url: "check_availability.php",
                data:'emailid='+$("#email").val(),
                type: "POST",
                success:function(data)
                {
                    $("#emailid-availability").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>



    </head>
    <body style="background-color:#AED6F1">    
    <?php include('includes/sidebar.php');?>
       <main class="mn-inner">
                <h3>ADD EMPLOYEE</h3>
                <div>
				
                    <form id="col-form" method="post" name="addemp">
                        <div>
                            <h3>EMPLOYEE INFO</h3>
                            <section>
                            <div class="row">
                                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

                                <div class="col-form">
                                    <label for="empcode">Employee Code(Must be unique)</label>
                                    <input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text">
                                    <span id="empid-availability" style="font-size:12px;"></span> 
                                </div>


                                <div class="col-form">
                                    <label for="firstName">First name</label>
                                    <input id="firstName" name="firstName" type="text">
                                </div>

                                <div class="col-form">
                                    <label for="lastName">Last name</label>
                                    <input id="lastName" name="lastName" type="text">
                                </div>

                                <div class="col-form">
                                    <label for="email">Email</label>
                                    <input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()">
                                    <span id="emailid-availability" style="font-size:12px;"></span> 
                                </div>

                                <div class="col-form">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password">
                                </div>

                                <div class="input-field col s12">
                                    <label for="confirm">Confirm password</label>
                                    <input id="confirm" name="confirmpassword" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="col-form">
                            <select  name="gender">
                                <option value="">Gender...</option>                                          
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-form">
                            <label for="birthdate">Birthdate</label>
                            <input id="birthdate" name="dob" type="date" class="datepicker" >
                        </div>
                                                                       

                        <div class="col-form">
                            <select  name="department">
                                <option value="">Department...</option>
                                <?php $sql = "SELECT DepartmentName from tbldepartments";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    {   ?>                                            
                                        <option value="<?php echo htmlentities($result->DepartmentName);?>"><?php echo htmlentities($result->DepartmentName);?></option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="col-form">
                            <label for="position">Position</label>
                            <input id="position" name="position" type="text">
                        </div>

                        <div class="col-form">
                            <label for="address">Address</label>
                            <input id="address" name="address" type="text">
                        </div>

                        <div class="col-form">
                            <label for="city">City/Town</label>
                            <input id="city" name="city" type="text">
                        </div>
                                                               
                        <div class="col-form">
                            <label for="country">Country</label>
                            <input id="country" name="country" type="text">
                        </div>

                                                                                                                        
                        <div class="col-form">
                            <label for="phone">Mobile number</label>
                            <input id="phone" name="mobileno" type="tel" maxlength="10">
                        </div>

                                                                                                                    
                        <div class="col-form">
                            <button type="submit" name="add" onclick="return valid();" id="add">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>     
    </body>
</html>
<?php } ?> 