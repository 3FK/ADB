<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');
if(isset($_POST['insert_record'])) {
    $Rover_Name=$_POST['Rover_Name'];
    $Rover_Long=$_POST['Rover_Long'];
    $Rover_Wide=$_POST['Rover_Wide'];
    $Rover_Height=$_POST['Rover_Height'];
    $Launched_Date=$_POST['Launched_Date'];
    $Launched_Time=$_POST['Launched_Time'];
    $Launched_From=$_POST['Launched_From'];
    $Mass=$_POST['Mass'];
//    $Landed_Date=$_POST['Landed_Date'];
//    $Landed_Time=$_POST['Landed_Time'];
//    $Landed_To=$_POST['Landed_To'];
//    ,Landed_Date,Landed_Time,Landed_to    ,:Landed_Date,:Landed_Time,:Landed_To

    $stmt = oci_parse($conn, 'INSERT INTO ROVER (ROVER_Name,Rover_Long,Rover_Wide,Rover_Height,Launched_Date,Launched_Time,Launched_From,Mass) VALUES(:Rover_Name,:Rover_Long,:Rover_Wide,:Rover_Height,:Launched_Date,:Launched_Time,:Launched_From,:Mass)');
    oci_bind_by_name($stmt, ':Rover_Name', $Rover_Name);
    oci_bind_by_name($stmt, ':Rover_Long', $Rover_Long);
    oci_bind_by_name($stmt, ':Rover_Wide', $Rover_Wide);
    oci_bind_by_name($stmt, ':Rover_Height', $Rover_Height);
    oci_bind_by_name($stmt, ':Launched_Date', $Launched_Date);
    oci_bind_by_name($stmt, ':Launched_Time', $Launched_Time);
    oci_bind_by_name($stmt, ':Launched_From', $Launched_From);
    oci_bind_by_name($stmt, ':Mass', $Mass);
//    oci_bind_by_name($stmt, ':Landed_Date', $Landed_Date);
//    oci_bind_by_name($stmt, ':Landed_Time', $Landed_Time);
//    oci_bind_by_name($stmt, ':Landed_To', $Landed_To);
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
<!-------------------------content of the Rover----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="Rover.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="label-default">Rover Name</label>
                                <input class="form-control" placeholder="Rover Name" name="Rover_Name" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Rover Long</label>
                                <input class="form-control" placeholder="Rover Long" name="Rover_Long" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Rover Wide</label>
                                <input class="form-control" placeholder="Rover Wide" name="Rover_Wide" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Rover Height</label>
                                <input class="form-control" placeholder="Rover Height" name="Rover_Height" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Launched Date</label>
                                <input class="form-control" placeholder="Launched Date" name="Launched_Date" type="date">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Launched Time</label>
                                <input class="form-control" placeholder="Launched Time" name="Launched_Time" type="time">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Launched From</label>
                                <input class="form-control" placeholder="Launched From" name="Launched_From" type="text">
                            </div>
                            <div class="form-group">
                                <label class="label-default">Mass</label>
                                <input class="form-control" placeholder="Mass" name="Mass" type="text">
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label class="label-default">Landed Date</label>-->
<!--                                <input class="form-control" placeholder="Landed Date" name="Landed_Date" type="date">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label class="label-default">Landed Time</label>-->
<!--                                <input class="form-control" placeholder="Landed Time" name="Landed_Time" type="time">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label class="label-default">Landed To</label>-->
<!--                                <input class="form-control" placeholder="Landed To" name="Landed_To" type="text">-->
<!--                            </div>-->
                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="insert_record" value="Add Rover">
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

