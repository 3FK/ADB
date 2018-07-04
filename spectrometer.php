<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Vanni Kotiyaa-->
<!-- * Date: 6/28/2018-->
<!-- * Time: 7:36 PM-->
<!-- */-->
<!DOCTYPE HTML>
<?php
//include 'main.php';
//$id=1;
//$name="aaaa";
//$age=18;
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');
if(isset($_POST['insert_record'])) {
    $spectrometer_id=$_POST['spectrometer_id'];
    $rover=$_POST['rover'];
    $spectrometer_Name=$_POST['spectrometer_Name'];
    $Spectrometer_type=$_POST['Spectrometer_type'];

    $stmt = oci_parse($conn, 'INSERT INTO SPECTROMETER ("SPECTROMETER_ID","Rover_ID","SPECTROMETER_NAME","SPECTROMETER_TYPE") VALUES (:SPECTROMETER_ID,:Rover_ID,:SPECTROMETER_NAME,:SPECTROMETER_TYPE)');
    oci_bind_by_name($stmt, ':SPECTROMETER_ID', $spectrometer_id);
    oci_bind_by_name($stmt, ':Rover_ID', $rover);
    oci_bind_by_name($stmt, ':SPECTROMETER_NAME', $spectrometer_Name);
    oci_bind_by_name($stmt, ':SPECTROMETER_TYPE', $Spectrometer_type);

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

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="./images/nasa.png" width="150" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!---------------------------END of Navigation--------------------------------------------->


<br><br><br><br><br><br>

<!-------------------------content of the add spectrometer----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="spectrometer.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <label class="label-default">Spectrometer ID</label>
                                <input class="form-control" placeholder="spectrometer ID" name="spectrometer_id" type="text">

                            </div>

                            <div class="form-group">
                                <label class="label-default">Select Rover ID</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT "Rover_ID" FROM rover');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){
                                        echo "<option value='" . $row['rover'] . "'>" . $row['Rover_ID'] . "</option>";

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="label-default">Spectrometer Name</label>
                                <input class="form-control" placeholder="Spectrometer Name" name="spectrometer_Name" type="text">

                            </div>


                            <div class="form-group">
                                <label class="label-default">Spectrometer type</label>
                                <select class="form-control" name="Spectrometer_type">
                                    <option value=""disabled selected>spectrometer type</option>
                                    <option value="Miniature Thermal Emission Spectrometer">Miniature Thermal Emission Spectrometer </option>
                                    <option value="Mössbauer spectrometer">Mössbauer spectrometer </option>
                                    <option value="Alpha Particle X-ray Spectrometer">Alpha Particle X-ray Spectrometer </option>
                                </select>
                            </div>

                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="insert_record" value="Add Spectrometer">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!---------------------------END of Add camera--------------------------------------------->


</body>
</html>

