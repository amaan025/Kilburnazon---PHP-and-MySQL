<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        h1 {text-align: center; color:white}
    </style>
</head>
<body style="background-color:#5a189a;">

    <div>
        <?php
            if(isset($_POST['update'])){
                $Employee_ID = $_POST['Employee_ID'] ?? '';
                $Department_Name = $_POST['Department_Name'] ?? '';
                $Name = $_POST['Name'] ?? '';
                $Salary = $_POST['Salary'] ?? '';
                $address = $_POST['address'] ?? '';
                $Emergency_Name = $_POST['Emergency_Name'] ?? '';
                $Relationship = $_POST['Relationship'] ?? '';
                $Phone_Number = $_POST['Phone_Number'] ?? '';
                $result = NULL;

                    if($Name != '')
                    {
                        $sql = "SELECT nin FROM Employee WHERE Employee_ID=?;";
                        $sqlprep = $db->prepare($sql);
                        $sqlprep->execute([$Employee_ID]);
                        $line = $sqlprep->fetch();
                        $new_sql = "UPDATE NIN_info SET Name=? WHERE nin=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Name,$line[0]]);
                    }
                    if(!empty($address))
                    {
                        $sql = "SELECT nin FROM Employee WHERE Employee_ID=?;";
                        $sqlprep = $db->prepare($sql);
                        $sqlprep->execute([$Employee_ID]);
                        $line = $sqlprep->fetch();
                        $new_sql = "UPDATE NIN_info SET address=? WHERE nin=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$address,$line[0]]);
                    }
                    if(!empty($Salary))
                    {
                        $new_sql = "UPDATE Employee SET Salary=? WHERE Employee_ID=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Salary,$Employee_ID]);
                    }
                    if(!empty($Department_Name))
                    {
                        $new_sql = "UPDATE Employee SET Department_Name=? WHERE Employee_ID=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Department_Name,$Employee_ID]);
                    }
                    if(!empty($Emergency_Name))
                    {
                        $sql = "SELECT Emergency_Contact_ID FROM Employee WHERE Employee_ID=?;";
                        $sqlprep = $db->prepare($sql);
                        $sqlprep->execute([$Employee_ID]);
                        $line = $sqlprep->fetch();
                        $new_sql = "UPDATE Emergency_Contact SET Emergency_Name=? WHERE Emergency_Name=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Emergency_Name,$line[0]]);
                    }
                    if(!empty($Relationship))
                    {
                        $sql = "SELECT Emergency_Contact_ID FROM Employee WHERE Employee_ID=?;";
                        $sqlprep = $db->prepare($sql);
                        $sqlprep->execute([$Employee_ID]);
                        $line = $sqlprep->fetch();
                        $new_sql = "UPDATE Emergency_Contact SET Relationship=? WHERE Relationship=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Relationship,$line[0]]);
                    }
                    if(!empty($Phone_Number))
                    {
                        $sql = "SELECT Emergency_Contact_ID FROM Employee WHERE Employee_ID=?;";
                        $sqlprep = $db->prepare($sql);
                        $sqlprep->execute([$Employee_ID]);
                        $line = $sqlprep->fetch();
                        $new_sql = "UPDATE Emergency_Contact SET Phone_Number=? WHERE Phone_Number=?;";
                        $stmtinsert = $db->prepare($new_sql);
                        $result = $stmtinsert->execute([$Phone_Number,$line[0]]);
                    }
                //$sql = "UPDATE employee SET e_age=42 WHERE e_name=’sam’";
                // $sql = "INSERT INTO Department_Table(Department_Name) VALUES(?)";
                // $stmtinsert = $db->prepare($sql);
                // $result = $stmtinsert->execute([$Department_Name]);
                
                // $sql = "INSERT INTO NIN_info(nin,Name,DOB,address) VALUES(?,?,?,?)";
                // $stmtinsert = $db->prepare($sql);
                // $result = $stmtinsert->execute([$nin,$Name,$DOB,$address]);

                // $sql = "INSERT INTO Emergency_Contact(Emergency_Name,Relationship, Phone_Number) VALUES(?,?,?)";
                // $stmtinsert = $db->prepare($sql);
                // $result = $stmtinsert->execute([$Emergency_Name,$Relationship,$Phone_Number]);

             
                // $sql = "INSERT INTO Employee(Employee_ID,Salary,nin,Department_Name) VALUES(?,?,?,?)";
                // $stmtinsert = $db->prepare($sql);
                // $result = $stmtinsert->execute([$Employee_ID,$Salary,$nin,$Department_Name]);

            

      

                if($result){
                    echo 'Updated';
                }else{
                    echo 'Not updated';
                }
            }
        ?>
    </div>

    <div class="container">

                <h1 class="heading">Update Your Details Form</h1>

                <form class="form-horizontal" action="update.php" method="post">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Employee_ID" style="color:white">Employee ID:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Employee ID" name="Employee_ID" required>
                    </div>
                </div>

                <!-- <label for="Employee_ID"><b>Employee ID</b></label>
                <input type="String" name="Employee_ID" required> -->

                <!-- <label for="Department_Number"><b>Department Number</b></label>
                <input type="text" name="Department_Number" required>

                <label for="Emergency_Contact_ID"><b>Emergency Contact ID</b></label>
                <input type="text" name="Emergency_Contact_ID" required> -->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Name" style="color:white">Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Name" name="Name" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address" style="color:white">Address:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Address" name="address">
                    </div>
                </div>

                <!-- <label for="Name"><b>Name</b></label>
                <input type="text" name="Name" required>

                <label for="address"><b>Address</b></label>
                <input type="text" name="address" required> -->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Salary" style="color:white">Salary:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Salary" name="Salary" >
                    </div>
                </div>

                <!-- <label for="Salary"><b>Salary</b></label>
                <input type="text" name="Salary" required> -->
                <!-- <label for="DOB"><b>Date of birth</b></label>
                <input type="date" name="DOB" required> -->
                <!-- <label for="nin"><b>NIN</b></label>
                <input type="text" name="nin" required> -->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Department_Name" style="color:white">Department Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Department Name" name="Department_Name" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Emergency_Name" style="color:white">Emergency Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Emergency Name" name="Emergency_Name" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Relationship" style="color:white">Relationship:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Relationship" name="Relationship" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Phone_Number" style="color:white">Emergency Contact:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Phone number" name="Phone_Number">
                    </div>
                </div>
                <!-- 
                <label for="Department_Name"><b>Department</b></label>
                <input type="text" name="Department_Name" required>

                <label for="Emergency_Name"><b>Emergency Name</b></label>
                <input type="text" name="Emergency_Name" required>

                <label for="Relationship"><b>Emergency Relationship</b></label>
                <input type="text" name="Relationship" required>

                <label for="Phone_Number"><b>Emergency Phone</b></label>
                <input type="text" name="Phone_Number" required> -->
                <input type="submit" class="btn btn-primary" name="update" value="Submit" style="margin-left: 50%">
                </form>
            </div>
            <br><br>
            <a href='index.php'><button style="margin-left: 49%"  class="btn btn-primary" >Home Page</button></a><br><br><br>
        
</body>
</html>