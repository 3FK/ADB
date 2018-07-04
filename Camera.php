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
    $camera_id=$_POST['camera_id'];
    $rover=$_POST['rover'];
    $camera=$_POST['camera'];
    $FocalLength=$_POST['FocalLength'];
    $FieldOfView=$_POST['FieldOfView'];
    $NoOfPixel=$_POST['NoOfPixel'];
    $Memory=$_POST['Memory'];

    $stmt = oci_parse($conn, 'INSERT INTO camera ("camera_id","Rover_ID","Camera_Type","Focal_Length","FieldOfView","No_Of_Pixels","Memory") VALUES (:camera_id,:Rover_ID,:Camera_Type,:Focal_Length,:FieldOfView,:No_Of_Pixels,:Memory)');
    oci_bind_by_name($stmt, ':camera_id', $camera_id);
    oci_bind_by_name($stmt, ':Rover_ID', $rover);
    oci_bind_by_name($stmt, ':Camera_Type', $camera);
    oci_bind_by_name($stmt, ':Focal_Length', $FocalLength);
    oci_bind_by_name($stmt, ':FieldOfView', $FieldOfView);
    oci_bind_by_name($stmt, ':No_Of_Pixels', $NoOfPixel);
    oci_bind_by_name($stmt, ':Memory', $Memory);
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

<!-------------------------content of the add Camera----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="Camera.php" method="post">
                        <fieldset>

                            <div class="form-group">

                                <input class="form-control" placeholder="Camera ID" name="camera_id" type="text">

                            </div>

                            <div class="form-group">
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover ID</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT "ROVER_ID" FROM ROVER');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){
                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_ID'] . "</option>";

                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">

                                <select class="form-control" name="camera">
                                    <option value=""disabled selected>Camera type</option>
                                    <option value="Pancam">Pancam</option>
                                    <option value="Navcam">Navcam</option>
                                    <option value="Hazcams">Hazcams</option>
                                </select>
                            </div>

                            <div class="form-group">

                                 <input class="form-control" placeholder="Focal Length" name="FocalLength" type="text">

                            </div>

                            <div class="form-group">

                                <input class="form-control" placeholder="Field Of View" name="FieldOfView" type="text">

                            </div>

                            <div class="form-group">

                                <input class="form-control" placeholder="Number of Pixels" name="NoOfPixel" type="text">

                            </div>

                            <div class="form-group">

                                <input class="form-control" placeholder="Memory" name="Memory" type="text">

                            </div>

                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="insert_record" value="Add Camera">
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

