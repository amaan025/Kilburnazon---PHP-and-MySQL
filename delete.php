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
<body  style="background-color:#5a189a;">

    <div>
        <?php
            if(isset($_POST['create']))
            {
                $Employee_ID = $_POST['Employee_ID'] ?? '';
                $Employee_ID1 = $_POST['Employee_ID1'] ?? '';


                $sql = "INSERT INTO Employee_Who_Deleted(Employee_ID) VALUES(?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$Employee_ID1]);


                

            $query = "SELECT nin FROM Employee WHERE Employee_ID=?;";
            $sqlprep = $db->prepare($query);
            $sqlprep->execute([$Employee_ID]);
            $lineNIN = $sqlprep->fetch();

            $query = "SELECT Emergency_Contact_ID FROM Employee WHERE Employee_ID=?;";
            $sqlprep = $db->prepare($query);
            $sqlprep->execute([$Employee_ID]);
            $lineECI = $sqlprep->fetch();


            $emp_sql="DELETE FROM Manager WHERE Employee_ID=?;";
                $emp_sql_insert= $db->prepare($emp_sql);
                $result1=$emp_sql_insert->execute([$Employee_ID]); 

                $emp_sql="DELETE FROM Drivers WHERE Employee_Number=?;";
                $emp_sql_insert= $db->prepare($emp_sql);
                $result1=$emp_sql_insert->execute([$Employee_ID]); 

                $emp_sql="DELETE FROM Packagers WHERE Employee_Number=?;";
                $emp_sql_insert= $db->prepare($emp_sql);
                $result1=$emp_sql_insert->execute([$Employee_ID]); 

                $emp_sql="DELETE FROM HR_Table WHERE Employee_ID=?;";
                $emp_sql_insert= $db->prepare($emp_sql);
                $result1=$emp_sql_insert->execute([$Employee_ID]); 
                
            $emp_sql="DELETE FROM Employee WHERE Employee_ID=?;";
            $emp_sql_insert= $db->prepare($emp_sql);
            $result1=$emp_sql_insert->execute([$Employee_ID]);
            $nin_sql="DELETE FROM NIN_info  WHERE `nin`=?;";
		    $nin_sql_insert=$db->prepare($nin_sql);
            $result2=$nin_sql_insert->execute([$lineNIN[0]]);
            $eci_sql="DELETE FROM Emergency_Contact WHERE Emergency_Contact_ID=?;";
            $eci_sql_insert=$db->prepare($eci_sql);
            $result3=$eci_sql_insert->execute([$lineECI[0]]);
		    
            
            
                
		        

            if($result1 && $result2 && $result3){
                echo 'Successfully Deleted' ;
            }
            else
            {
                echo 'Unsuccessful';
            }

        }




            ?>
    </div>

    <div class="container">

                <h1 class="heading"> Deletion Form</h1>
                <form class="form-horizontal" action="delete.php" method="post">
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Employee_ID1" style="color:white">Enter Your Employee ID:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Employee ID" name="Employee_ID1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Employee_ID" style="color:white">Enter Employee ID you want to delete:</label>
                    <div class="col-sm-10">
                         <input type="text" class="form-control" id="text" placeholder="Enter Employee ID" name="Employee_ID" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="create" value="Submit" style="margin-left: 50%">
               
                </form>
        </div>

        <br><br>
            <a href='index.php'><button style="margin-left: 49%"  class="btn btn-primary" >Home Page</button></a><br><br><br>
</body>
</html>