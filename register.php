<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration Form</title>
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
            if(isset($_POST['create'])){
                $Employee_ID = $_POST['Employee_ID'] ?? '';
                $Department_Name = $_POST['Department_Name'] ?? '';
                $Name = $_POST['Name'] ?? '';
                $DOB = $_POST['DOB'] ?? '';
                $Salary = $_POST['Salary'] ?? '';
                $nin = $_POST['nin'] ?? '';
                $address = $_POST['address'] ?? '';
                $Emergency_Name = $_POST['Emergency_Name'] ?? '';
                $Relationship = $_POST['Relationship'] ?? '';
                $Phone_Number = $_POST['Phone_Number'] ?? '';
                
                $sql = "INSERT INTO NIN_info(nin,Name,DOB,address) VALUES(?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$nin,$Name,$DOB,$address]);

                $sql = "INSERT INTO Emergency_Contact(Emergency_Name,Relationship, Phone_Number) VALUES(?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$Emergency_Name,$Relationship,$Phone_Number]);
                

                $fk_em = $db->prepare("SELECT MAX(Emergency_Contact_ID) FROM Emergency_Contact");
                $fk_em->execute();
                $id_details = $fk_em->fetch();

                
             
                $sql = "INSERT INTO Employee(Employee_ID,Emergency_Contact_ID,Salary,nin,Department_Name) VALUES(?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$Employee_ID, $id_details[0],$Salary,$nin,$Department_Name]);


                if($Department_Name == 'Manager')
                {
                    $sql = "INSERT INTO Manager(Employee_ID) VALUES(?)";
                    $stmtinsert = $db->prepare($sql);
                    $result = $stmtinsert->execute([$Employee_ID]);
                }

                if($Department_Name == 'HR')
                {
                    $sql = "INSERT INTO HR_Table(Employee_ID,Manager_Number) VALUES(?,?)";
                    $stmtinsert = $db->prepare($sql);
                    $result = $stmtinsert->execute([$Employee_ID, rand(1,14)]);
                }

                if($Department_Name == 'Driver')
                {
                    $sql = "INSERT INTO Drivers(Employee_Number,Manager_Number) VALUES(?,?)";
                    $stmtinsert = $db->prepare($sql);
                    $result = $stmtinsert->execute([$Employee_ID, rand(1,14)]);
                }

                if($Department_Name == 'Packager')
                {
                    $sql = "INSERT INTO Packagers(Employee_Number,Manager_Number) VALUES(?,?)";
                    $stmtinsert = $db->prepare($sql);
                    $result = $stmtinsert->execute([$Employee_ID,rand(1,14)]);
                }

            

      

                if($result){
                    echo "<p style='color:white;'>". "Saved" . "</p>";
                }else{
                    echo "<p style='color:white;'>". "Not Saved" . "</p>";
                }
            }
        ?>
    </div>


            <div class="container">

                <h1 class="heading">Registration Form</h1>

                <form class="form-horizontal" action="register.php" method="post">

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
                         <input type="text" class="form-control" id="text" placeholder="Enter Name" name="Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="address" style="color:white">Address:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Address" name="address" required>
                    </div>
                </div>

                <!-- <label for="Name"><b>Name</b></label>
                <input type="text" name="Name" required>

                <label for="address"><b>Address</b></label>
                <input type="text" name="address" required> -->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Salary" style="color:white">Salary:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Salary" name="Salary" required>
                    </div>
                </div>

                <!-- <label for="Salary"><b>Salary</b></label>
                <input type="text" name="Salary" required> -->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="DOB" style="color:white">Date of Birth:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Date of Birth" name="DOB" required>
                    </div>
                </div>
                <!-- <label for="DOB"><b>Date of birth</b></label>
                <input type="date" name="DOB" required> -->

                <div class="form-group">
                    <label class="control-label col-sm-2" for="nin" style="color:white">National Insurance Number:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter NIN" name="nin" required>
                    </div>
                </div>
                <!-- <label for="nin"><b>NIN</b></label>
                <input type="text" name="nin" required> -->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Department_Name" style="color:white">Department Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Department Name" name="Department_Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Emergency_Name" style="color:white">Emergency Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Emergency Name" name="Emergency_Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Relationship" style="color:white">Relationship:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Relationship" name="Relationship" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Phone_Number" style="color:white">Emergency Contact:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Phone number" name="Phone_Number" required>
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
                <input type="submit" class="btn btn-primary" name="create" value="Submit" style="margin-left: 50%">
                
                </form>
            </div>
            <br><br>
            <a href='index.php'><button style="margin-left: 49%"  class="btn btn-primary" >Home Page</button></a><br><br><br>
</body>
</html>