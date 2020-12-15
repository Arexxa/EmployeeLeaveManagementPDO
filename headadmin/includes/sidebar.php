                    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                        }
                        
                        ul, .profile-info{
                            list-style-type: none;
                            margin: 0;
                            padding: 0;
                            overflow: hidden;
                            background-color: #23274d;
                            opacity: 0.9;
                            color: white;
                        }

                        li {
                            float: left;
                        }
                        li.dropdown1{
                            float: right;
                        }

                        li a, .dropbtn {
                            display: inline-block;
                            color: white;
                            text-align: center;
                            padding: 14px 16px;
                            text-decoration: none;
                        }

                        li a:hover, .dropdown:hover .dropbtn {
                            background-color: red;
                        }

                        li.dropdown {
                            display: inline-block;
                        }

                        .dropdown-content {
                            display: none;
                            position: absolute;
                            background-color: #f9f9f9;
                            min-width: 160px;
                            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                            z-index: 1;
                        }

                        .dropdown-content a {
                            color: black;
                            padding: 12px 16px;
                            text-decoration: none;
                            display: block;
                            text-align: left;
                        }

                        .dropdown-content a:hover {
                            background-color: #f1f1f1;
                        }

                        .dropdown:hover .dropdown-content {
                            display: block;
                        }
                        .notification-text{
                            color: black;
                        }
						
                    </style>

                    <div>
                        <ul>
                            <li class="logo"><img src="logo.png" width="50" height="43">
                            <li><a href="dashboard.php">Dashboard</a></li>                           
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropbtn">Leave Management</a>
                                <div class="dropdown-content">
                                    <a href="leaves.php">All Leaves </a>
                                    <a href="pending-leavehistory.php">Pending Leaves </a>
                                    <a href="approvedleave-history.php">Approved Leaves</a>
                                    <a href="notapproved-leaves.php">Not Approved Leaves</a>
                                </div>
                            </li>
                            
                            <li class="no-padding">
                                <a href="logout.php">Sign Out</a>
                            </li>

                            
                        
                            <li class="dropdown">
                                <ul>
                                        <?php 
                                        $isread=0;
                                        $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblleaves.PostingDate from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.IsReadHead=:isread";
                                        $query = $dbh -> prepare($sql);
                                        $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                            {               ?>  
                                                <li>
                                                    <a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>"><i style="color: white"class='fas'>&#xf0f3;</i>
                                                    <div class="dropdown-content">
                                                        
                                                        <div class="notification-text"><p><b><?php echo htmlentities($result->FirstName." ".$result->LastName);?><br/>(<?php echo htmlentities($result->EmpId);?>)</b> applied for leave</p><span>at <?php echo htmlentities($result->PostingDate);?></b></span></div>
                                                    </div>
                                                    </a>
                                                </li>
                                               <?php 
                                           }
                                        } ?>
                                </ul>
                            </li>
                            
                            <li class="dropdown">
                                <?php 
                                $isread=0;
                                $sql = "SELECT id from tblleaves where IsReadHead=:isread";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $unreadcount=$query->rowCount();?>
                                <span class="badge"><?php echo htmlentities($unreadcount);?></span></a>
                            </li>
                        </ul>
                    </div>  
