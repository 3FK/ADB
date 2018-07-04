<!DOCTYPE html>

<?php
//include 'main.php';
//$id=1;
//$name="aaaa";
//$age=18;
$conn = oci_connect("system", "oracle", "localhost/XE");
if(isset($_POST['insert_record'])) {

//    $id=$_POST['id'];ID,:ID,oci_bind_by_name($stmt, ':ID', $id);
    $name=$_POST['name'];
    $age=$_POST['age'];

    $stmt = oci_parse($conn, 'INSERT INTO admin (NAME,AGE) VALUES (:NAME,:AGE)');

    oci_bind_by_name($stmt, ':NAME', $name);
    oci_bind_by_name($stmt, ':AGE', $age);

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
    <title>gggggg</title>
</head>
<body>
    <div>
        <form action="user.php" method="post" >
<!--            <label>id</label>-->
<!--            <input type="text" name="id">-->
            <label>name</label>
            <input type="text" name="name">
            <label>age</label>
            <input type="text" name="age">

            <input type="submit" name="insert_record"/>
        </form>
    </div>
    <div>
        <?php
            $get = oci_parse($conn,'SELECT * FROM admin');
            oci_execute($get);
            echo "<table>\n";
            while ($row = oci_fetch_array($get,OCI_ASSOC+OCI_RETURN_NULLS)){
                echo "<tr>\n";
                foreach ($row as $item){
                    echo "<td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        ?>
    </div>
</body>
</html>

