<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');
if(isset($_POST['insert_record'])) {
    $Objective_Type=$_POST['Objective_Type'];
    $Objective=$_POST['Objective'];
    $Rover_ID=$_POST['rover'];


    $stmt = oci_parse($conn, 'INSERT INTO ROVER_OBJECTIVES (Objective_Type,Objective,ROVER_ID) VALUES(:objective_type,:objective,:rover_id)');
    oci_bind_by_name($stmt, ':objective_type', $Objective_Type);
    oci_bind_by_name($stmt, ':objective', $Objective);
    oci_bind_by_name($stmt, ':rover_id', $Rover_ID);
    $execute=oci_execute($stmt);

    if($execute){
        print "inserted";
        $commit = oci_parse($conn,'Commit');
        oci_execute($commit);
    }
    oci_free_statement($stmt);
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>
<body>
<!-------------------------content of the Rover objectives----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="RoverObjectives.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="label-default">Objective Type</label>
                                <input class="form-control" placeholder="Objective Type" name="Objective_Type" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Objective</label>
                                <textarea rows="4" cols="50" class="form-control"  name="Objective"> </textarea>
                            </div>
                            <div class="form-group">
                                <label class="label-default">Select Rover ID</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_ID,Rover_Name FROM ROVER');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){

                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_ID'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>

                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="insert_record" value="Add Rover Objectives">
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

