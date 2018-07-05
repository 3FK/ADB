<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');

//----------------------update record--------------------
if(isset($_POST['Update_record'])) {
    //$rover=$_POST['rover'];

    $rovers=$_POST['rovers'];
    $Rovers_Computers_Ids=$_POST['rovers_computers_ids'];
    $Computer_Os=$_POST['computer_Os'];
    $Computer_Purpose=$_POST['computer_Purpose'];



    $stmt = oci_parse($conn, 'UPDATE  ROVER_COMPUTER_ELEMENT SET COMPUTER_OS = :computer_Os,COMPUTER_PURPOSE =:computer_Purpose WHERE Rover_ID = :rovers AND ROVER_COMPUTER_ID = :rovers_computers_ids');
    oci_bind_by_name($stmt,':rovers',$rovers);
    oci_bind_by_name($stmt,':rovers_computers_ids',$Rovers_Computers_Ids);
    oci_bind_by_name($stmt, ':computer_Os', $Computer_Os);
    oci_bind_by_name($stmt, ':computer_Purpose', $Computer_Purpose);

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
//////----------delete------
if(isset($_POST['Del_record'])) {
    $rover = $_POST['rovers'];
    $Rover_Computer_Ids = $_POST['rovers_computers_ids'];

    $sql2 = "DELETE FROM ROVER_COMPUTER_ELEMENT WHERE ROVER_ID = '$rover' AND ROVER_COMPUTER_ID = '$Rover_Computer_Ids' ";
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
    $Rover_Objective_Id = $_POST['rover_computer_id'];
    $get = oci_parse($conn, 'SELECT * FROM ROVER_COMPUTER_ELEMENT WHERE Rover_ID = :rover AND ROVER_COMPUTER_ID = :rover_computer_id ');
    oci_bind_by_name($get,':rover',$rover);
    oci_bind_by_name($get,':rover_computer_id',$Rover_Objective_Id);
    oci_execute($get);
    while ($row = oci_fetch_array($get, OCI_ASSOC + OCI_RETURN_NULLS)) {

        $rOID= $row['ROVER_ID'];
        $rCID = $row['ROVER_COMPUTER_ID'];
        $rOS= $row['COMPUTER_OS'];
        $rCP= $row['COMPUTER_PURPOSE'];


        echo  $rOID;
        echo  $rCID;
        echo  $rOS;
        echo  $rCP;


    }
}else{
    $rOID= "Select Rover ID & Rover Computer ID";
    $rCID = "Select Rover ID & Rover Computer ID";
    $rOS= "Select Rover ID & Rover Computer ID";
    $rCP= "Select Rover ID & Rover Computer ID";


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
                    <form accept-charset="UTF-8" role="form" action="RoverComputerUpdate.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="label-default">Select Rover ID</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_ID FROM ROVER_COMPUTER_ELEMENT');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_ID'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="label-default">Select Rover Computer Id</label>
                                <select class="form-control" name="rover_computer_id">
                                    <option disabled selected>Select Rover Objective Id</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_COMPUTER_ID FROM ROVER_COMPUTER_ELEMENT');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_COMPUTER_ID'] . "'>" . $row['ROVER_COMPUTER_ID'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div>
                                <input class="btn btn-lg btn-danger btn-block" type="submit" name="Select_record" value="Get Rover Computer Details"  >
                            </div>





                            <div class="form-group">
                                <label class="label-default">Rover ID</label>
                                <input class="form-control"  placeholder="Rover Name" name="rovers" type="text"  value="<?php echo htmlentities($rOID); ?>">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Rover Computer Id</label>
                                <input class="form-control"  placeholder="rover_computer_id" name="rovers_computers_ids" type="text"  value="<?php echo htmlentities($rCID); ?>">
                            </div>

                            <div class="form-group">
                                <label class="label-default">Computer Os</label>
                                <input class="form-control" placeholder="Computer Os" name="computer_Os" type="text" value="<?php echo htmlentities($rOS); ?> ">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Computer Purpose</label>
                                <textarea rows="4" cols="50" class="form-control"  name="computer_Purpose"> <?php echo htmlentities($rCP); ?> </textarea>
                            </div>



                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="Update_record" value="Update Rover Computer">
                            <input class="btn btn-lg btn-danger btn-block" type="submit" name="Del_record" value="Delete Rover Computer" >



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

