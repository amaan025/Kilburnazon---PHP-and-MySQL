<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data Form</title>
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
                
                $Department_Name= $_POST['Department_Name'] ?? '';
                
                $Relationship= $_POST['Relationship'] ?? '';

                $result = NULL;
                
                if($Department_Name == 'Driver')
                    {$fk_em = $db->prepare("SELECT `Driver_ID` FROM Drivers WHERE (SELECT Relationship FROM Emergency_Contact WHERE Emergency_Contact_ID =(SELECT Emergency_Contact_ID FROM Employee where Employee_ID= Drivers.Employee_Number)) = ? ORDER BY `Driver_ID`;");
                    $fk_em->execute([$Relationship]);
                    $fk_em->setFetchMode(PDO::FETCH_ASSOC);
                    $driver_no = [];
                    $driver_name = [];
                    $manager_no = [];
                    while($row = $fk_em->fetch()){
                        $fk_em1 = $db->prepare("SELECT NIN_info.Name FROM NIN_info WHERE NIN_info.nin = (SELECT Employee.nin FROM Employee WHERE Employee_ID =(SELECT Employee_Number FROM Drivers WHERE Drivers.`Driver_ID` = ?))");
                        $fk_em1->execute([$row['Driver_ID']]);
                        $l = $fk_em1->fetch();
                        array_push($driver_name, $l[0]);
                        array_push($driver_no, $row['Driver_ID']);
                    }
                    for($x =0; $x < sizeof($driver_no); $x++){
                    $fk_em = $db->prepare("SELECT Manager_Number FROM (Drivers INNER JOIN Manager ON Drivers.Manager_Number = Manager.`Manager_ID`) WHERE (SELECT Emergency_Contact.Relationship FROM Emergency_Contact WHERE Emergency_Contact.Emergency_Contact_ID =(SELECT Emergency_Contact_ID FROM Employee where Employee.Employee_ID=Drivers.Employee_Number)) = ? AND `Driver_ID` = ? ORDER BY RAND() LIMIT 1;");
                        $fk_em->execute([$Relationship,$driver_no[$x]]);
                        $manager_no1 = $fk_em->fetch();
                        $fk_em = $db->prepare("SELECT NIN_info.Name FROM NIN_info WHERE NIN_info.nin = (SELECT Employee.nin FROM Employee WHERE Employee_ID =(SELECT Employee_ID FROM Manager WHERE `Manager_ID` = ?));");
                        $result=$fk_em->execute([$manager_no1[0]]);

                        $manager_no1 = $fk_em->fetch();
                        
                        array_push($manager_no, $manager_no1[0]);
                        
                    }
                    echo "<table>";
                    echo "<tr>";
                        echo "<th>Driver Name</th>";
                        echo "<th>Department</th>";
                        echo "<th>Relationship</th>";
                        echo "<th>Manager</th>";
                    echo "</tr>";
                    for ($x=0; $x < sizeof($driver_no); $x++) { 
                        echo ("<tr><td>$driver_name[$x]</td><td>Driver</td><td>$Relationship</td><td>$manager_no[$x]</td></tr>");
                    }
                }
                
                

                if($Department_Name == 'HR')
                    {$fk_em = $db->prepare("SELECT `HR_ID` FROM HR_Table WHERE (SELECT Relationship FROM Emergency_Contact WHERE Emergency_Contact_ID =(SELECT Emergency_Contact_ID FROM Employee where Employee_ID= HR_Table.Employee_ID)) = ? ORDER BY `HR_ID`;");
                    $fk_em->execute([$Relationship]);
                    $fk_em->setFetchMode(PDO::FETCH_ASSOC);
                    $driver_no = [];
                    $driver_name = [];
                    $manager_no = [];
                    while($row = $fk_em->fetch()){
                        $fk_em1 = $db->prepare("SELECT NIN_info.Name FROM NIN_info WHERE NIN_info.nin = (SELECT Employee.nin FROM Employee WHERE Employee_ID =(SELECT Employee_ID FROM HR_Table WHERE HR_Table.`HR_ID` = ?))");
                        $fk_em1->execute([$row['HR_ID']]);
                        $l = $fk_em1->fetch();
                        array_push($driver_name, $l[0]);
                        array_push($driver_no, $row['HR_ID']);
                    }
                    for($x =0; $x < sizeof($driver_no); $x++){
                    $fk_em = $db->prepare("SELECT Manager_Number FROM (HR_Table INNER JOIN Manager ON HR_Table.Manager_Number = Manager.`Manager_ID`) WHERE (SELECT Emergency_Contact.Relationship FROM Emergency_Contact WHERE Emergency_Contact.Emergency_Contact_ID =(SELECT Emergency_Contact_ID FROM Employee where Employee.Employee_ID=HR_Table.`Employee_ID`)) = ? AND `HR_ID` = ? ORDER BY RAND() LIMIT 1;");
                        $fk_em->execute([$Relationship,$driver_no[$x]]);
                        $manager_no1 = $fk_em->fetch();
                        $fk_em = $db->prepare("SELECT NIN_info.Name FROM NIN_info WHERE NIN_info.nin = (SELECT Employee.nin FROM Employee WHERE Employee_ID =(SELECT Employee_ID FROM Manager WHERE `Manager_ID` = ?));");
                        $result=$fk_em->execute([$manager_no1[0]]);

                        $manager_no1 = $fk_em->fetch();
                        
                        array_push($manager_no, $manager_no1[0]);
                        
                    }
                    echo "<table>";
                    echo "<tr>";
                        echo "<th>  HR Name</th>";
                        echo "<th>Department</th>";
                        echo "<th>Relationship</th>";
                        echo "<th>Manager</th>";
                    echo "</tr>";
                    for ($x=0; $x < sizeof($driver_no); $x++) { 
                        echo ("<tr><td>$driver_name[$x]</td><td>HR</td><td>$Relationship</td><td>$manager_no[$x]</td></tr>");
                    }
                }


                
                
                if($result){
                    echo "<p style='color:white;'>". "Displayed" . "</p>";
                }else{
                    echo "<p style='color:white;'>". "Not Displayed" . "</p>";
                }
            }
        ?>

    <div class="container">

                <h1 class="heading">Display Data Form</h1>

                <form class="form-horizontal" action="displayTask4.php" method="post">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Department_Name" style="color:white">Department Name:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Department Name" name="Department_Name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Relationship" style="color:white">Emergency Relationship:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Emergency Relationship" name="Relationship" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="create" value="Display" style="margin-left: 50%">
                
                </form>
            </div>
            <br><br>
            <a href='index.php'><button style="margin-left: 49%"  class="btn btn-primary" >Home Page</button></a><br><br><br>
</body>
</html>
