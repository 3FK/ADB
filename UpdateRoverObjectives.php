<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');

//----------------------update record--------------------
if(isset($_POST['Update_record'])) {
    //$rover=$_POST['rover'];

    $rovers=$_POST['rovers'];
    $Rover_Objectives_Ids=$_POST['Rover_Objectives_Ids'];
    $Objective_Type=$_POST['Objective_Type'];
    $Objective=$_POST['Objective'];



    $stmt = oci_parse($conn, 'UPDATE  ROVER_OBJECTIVES SET OBJECTIVE_TYPE = :objective_type,OBJECTIVE=:objective WHERE  ROVER_ID = :rovers AND  ROVER_OBJECTIVE_ID = :Rover_Objectives_Ids');
    oci_bind_by_name($stmt,':rovers',$rovers);
    oci_bind_by_name($stmt,':Rover_Objectives_Ids',$Rover_Objectives_Ids);
    oci_bind_by_name($stmt, ':objective_type', $Objective_Type);
    oci_bind_by_name($stmt, ':objective', $Objective);

    $execute=oci_execute($stmt);
    if($execute){
        print "updated";
        $commit = oci_parse($conn,'Commit');
        oci_execute($commit);
    }
    else{
        print "Faill";
    }
    oci_free_statement($stmt);
}
////----------delete------
if(isset($_POST['Del_record'])) {
    $rover = $_POST['rovers'];
    $Rover_Objectives_Ids = $_POST['Rover_Objectives_Ids'];

    $sql2 = "DELETE FROM ROVER_OBJECTIVES WHERE ROVER_ID = '$rover' AND ROVER_OBJECTIVE_ID = '$Rover_Objectives_Ids' ";
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
    $Rover_Objective_Id = $_POST['Rover_Objective_Id'];
    $get = oci_parse($conn, 'SELECT * FROM ROVER_OBJECTIVES WHERE ROVER_ID = :rover AND ROVER_OBJECTIVE_ID = :rover_objective_id ');
    oci_bind_by_name($get,':rover',$rover);
    oci_bind_by_name($get,':rover_objective_id',$Rover_Objective_Id);
    oci_execute($get);
    while ($row = oci_fetch_array($get, OCI_ASSOC + OCI_RETURN_NULLS)) {

        $rOID= $row['ROVER_ID'];
        $rOBID = $row['ROVER_OBJECTIVE_ID'];
        $rObType= $row['OBJECTIVE_TYPE'];
        $rOB= $row['OBJECTIVE'];


//        echo  $rOID;
//        echo  $rOBID;
//        echo  $rObType;
//        echo  $rOB;


    }
}else{
    $rOBID= "Select Rover ID";
    $rObType = "Select Rover ID";
    $rOB= "Select Rover ID";
    $rOID= "Select Rover ID";


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
                    <form accept-charset="UTF-8" role="form" action="UpdateRoverObjectives.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="label-default">Select Rover ID</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_ID FROM ROVER_OBJECTIVES');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_ID'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="label-default">Select Rover Objective Id</label>
                                <select class="form-control" name="Rover_Objective_Id">
                                    <option disabled selected>Select Rover Objective Id</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_OBJECTIVE_ID FROM ROVER_OBJECTIVES');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_OBJECTIVE_ID'] . "'>" . $row['ROVER_OBJECTIVE_ID'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div>
                                <input class="btn btn-lg btn-danger btn-block" type="submit" name="Select_record" value="Get Rover Details"  >
                            </div>





                            <div class="form-group">
                                <label class="label-default">Rover ID</label>
                                <input class="form-control"  placeholder="Rover Name" name="rovers" type="text"  value="<?php echo htmlentities($rOID); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Rover Object ID</label>
                                <input class="form-control"  placeholder="Rover Name" name="Rover_Objectives_Ids" type="text"  value="<?php echo htmlentities($rOBID); ?>">
                            </div>

                            <div class="form-group">
                                <label class="label-default">Objective Type</label>
                                <input class="form-control" placeholder="Objective Type" name="Objective_Type" type="text" value="<?php echo htmlentities($rObType); ?> ">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Objective</label>
                                <textarea rows="4" cols="50" class="form-control"  name="Objective"> <?php echo htmlentities($rOB); ?> </textarea>
                            </div>



                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="Update_record" value="Update Rover Objectives ">
                            <input class="btn btn-lg btn-danger btn-block" type="submit" name="Del_record" value="Delete Rover Objectives" >



                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>




<!---------------------------END of Add Rover--------------------------------------------->

</body>
</html>

