<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');
if(isset($_POST['Update_record'])) {
    //$rover=$_POST['rover'];

    $rovers=$_POST['rovers'];
    $Rover_Name=$_POST['Rover_Name'];
    $Launched_Date=$_POST['Launched_Date'];
    $Launched_From=$_POST['Launched_From'];
    $Mass=$_POST['Mass'];
    $Landed_Date=$_POST['Landed_Date'];
    $Landed_To=$_POST['Landed_To'];

    $stmt = oci_parse($conn, 'UPDATE  ROVER SET ROVER_Name = :Rover_Name,Launched_Date=:Launched_Date,Launched_From= :Launched_From,Mass= :Mass,Landed_Date= :Landed_Date,Landed_to=:Landed_To WHERE ROVER_ID = :rovers ');
    oci_bind_by_name($stmt, ':Rover_Name', $Rover_Name);
    oci_bind_by_name($stmt, ':Launched_Date', $Launched_Date);
    oci_bind_by_name($stmt, ':Launched_From', $Launched_From);
    oci_bind_by_name($stmt, ':Mass', $Mass);
    oci_bind_by_name($stmt, ':Landed_Date', $Landed_Date);
    oci_bind_by_name($stmt, ':Landed_To', $Landed_To);
    oci_bind_by_name($stmt,':rovers',$rovers);
    $execute=oci_execute($stmt);
    if($execute){
        print "updated";
        $commit = oci_parse($conn,'Commit');
        oci_execute($commit);
    }
    oci_free_statement($stmt);
}
//----------delete------
if(isset($_POST['Del_record'])) {
    $rover = $_POST['rover'];

    $sql2 = "DELETE FROM ROVER WHERE ROVER_ID = '$rovers'";
    $compiled1 = oci_parse($conn, $sql2);
    $ex = oci_execute($compiled1, OCI_DEFAULT);
    if ($ex) {
        print "Deleted";
    }
}
//------------------------


//---------select----------
if(isset($_POST['Select_record'])) {
    $rover = $_POST['rover'];
    $get = oci_parse($conn, 'SELECT * FROM ROVER WHERE ROVER_ID = :rover');
    oci_bind_by_name($get,':rover',$rover);
    oci_execute($get);
    while ($row = oci_fetch_array($get, OCI_ASSOC + OCI_RETURN_NULLS)) {

        $roid = $row['ROVER_ID'];
        $roname= $row['ROVER_NAME'];
        $roLdate= $row['LAUNCHED_DATE'];
        $roLfrom= $row['LAUNCHED_FROM'];
        $roMass= $row['MASS'];
        $roLandedDATE= $row['LANDED_DATE'];
        $roLandedTO= $row['LANDED_TO'];


        echo  $roid;


        echo  $roname;
        echo  $roLdate;
        echo  $roLfrom;
        echo  $roMass;
        echo  $roLandedDATE;
        echo  $roLandedTO;
        //echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_ID'] . "</option>";
//        echo"<tr>";
//    echo"<td><input type=\"text\" name=\"user_id\" value=\".$row['user_id']."\"></td>";
//    echo"</tr>";
    }
}else{
    $roid= "Select Rover ID";
    $roname = "Select Rover ID";
    $roLdate= "Select Rover ID";
    $roLfrom= "Select Rover ID";
    $roMass = "Select Rover ID";
    $roLandedDATE= "Select Rover ID";
    $roLandedTO= "Select Rover ID";


}




//--------------------------





?>
<html>
<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>
<!-------------------------content of the Rover----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="UpdateRover.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="label-default">Select Rover ID</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_ID,Rover_Name FROM ROVER');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_NAME'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div>
                                <input class="btn btn-lg btn-danger btn-block" type="submit" name="Select_record" value="Get Rover Details" >
                            </div>


                            <div class="form-group">
                                <label class="label-default">Rover Name</label>
                                <input class="form-control" placeholder="Rover Name" name="rovers" type="text"  value="<?php echo htmlentities($roid); ?>">
                            </div>

                            <div class="form-group">
                                <label class="label-default">Rover Name</label>
                                <input class="form-control" placeholder="Rover Name" name="Rover_Name" type="text"  value="<?php echo htmlentities($roname); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Launched Date</label>
                                <input class="form-control" placeholder="Launched Date" name="Launched_Date" type="date" value="<?php echo htmlentities($roLdate); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Launched From</label>
                                <input class="form-control" placeholder="Launched From" name="Launched_From" type="text" value="<?php echo htmlentities($roLfrom); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Mass</label>
                                <input class="form-control" placeholder="Mass" name="Mass" type="text" value="<?php echo htmlentities($roMass); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Landed Date</label>
                                <input class="form-control" placeholder="Landed Date" name="Landed_Date" type="date" value="<?php echo htmlentities($roLandedDATE); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Landed To</label>
                                <input class="form-control" placeholder="Landed To" name="Landed_To" type="text" value="<?php echo htmlentities($roLandedTO); ?>">
                            </div>
                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="Update_record" value="Update Rover Details">
                            <input class="btn btn-lg btn-danger btn-block" type="submit" name="Del_record" value="Delete Rover Details" >



                        </fieldset>
                    </form>
<!--                    <form accept-charset="UTF-8" role="form" action="getinfoR.php" method="post">-->
<!--                        <input class="btn btn-lg btn-danger btn-block" type="button" name="Del_record" value="Delete Rover Details" >-->
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</div>




<!---------------------------END of Add Rover--------------------------------------------->

</body>
</html>

