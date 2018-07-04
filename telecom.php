<!DOCTYPE HTML>
<?php
$conn = oci_connect("SYSTEM", "oracle", 'localhost/xe');
if(isset($_POST['insert_record'])) {
    $Telecommunication_Name=$_POST['Telecommunication_Name'];
    $Telecommunication_Type=$_POST['Telecommunication_Type'];
    $Rover_ID=$_POST['rover'];

    $stmt = oci_parse($conn, 'INSERT INTO TELECOMMUNICATION_MEAN (Telecommunication_Name,Telecommunication_Type,Rover_ID) VALUES (:Telecommunication_Name,:Telecommunication_Type,:Rover_ID)');
    oci_bind_by_name($stmt, ':Telecommunication_Name', $Telecommunication_Name);
    oci_bind_by_name($stmt, ':Telecommunication_Type', $Telecommunication_Type);
    oci_bind_by_name($stmt, ':Rover_ID', $Rover_ID);

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

<!-------------------------content of the add Telecomiunication Mean ----------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="telecom.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label>Rover</label>
                                <select class="form-control" name="rover">
                                    <option disabled selected>Select Rover</option>
                                    <?php
                                    $get = oci_parse($conn,'SELECT ROVER_ID, ROVER_Name FROM ROVER');
                                    oci_execute($get);
                                    while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){
                                        echo "<option value='" . $row['ROVER_ID'] . "'>" . $row['ROVER_NAME'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Telecommunication Name</label>
                                <input class="form-control" placeholder="Telecomiunication Mean Name" name="Telecommunication_Name" type="text">
                            </div>
                            <div class="form-group">
                                <label>Telecommunication Type</label>
                                <input class="form-control" placeholder="Telecomiunication Mean Type" name="Telecommunication_Type" type="text">
                            </div>
                            <input class="btn btn-lg btn-dark btn-block" type="submit" name="insert_record" value="TELECOMMUNICATION MEAN">
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

