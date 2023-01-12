<?php
error_reporting(0);
$req = $_POST["request"];

require_once "../config/conn.php";
    $sql = "SELECT id,name, img, sex, age FROM `animals` WHERE `status` = 'в питомнике'";
    if (!empty($req["type"])) {
        $sql = $sql." AND type LIKE '{$req['type']}'";
    }

    if (!empty($req["sex"])) {
        $sql = $sql." AND sex LIKE '{$req['sex']}'";
    }

    if (!empty($req["breed"])) {
        $sql = $sql." AND (breed";
        for ($i=0; $i < count($req["breed"]); $i++) { 
            if ($i+1 === count($req["breed"])) {
                $sql = $sql." LIKE '{$req['breed'][$i]}')";
                continue;
            }
            $sql = $sql." LIKE '{$req['breed'][$i]}' OR breed";
        }
    }

    if (intval($req["age"]["min"]) < intval($req["age"]["max"])) {
        
        if (!empty($req["age"]["max"]) && !empty($req["age"]["min"])) {

            $sql = $sql." AND age BETWEEN {$req["age"]["min"]} AND {$req["age"]["max"]}";
            $query = mysqli_query($conn, $sql);

            exit(json_encode(mysqli_fetch_all($query)));
        }

        if (!empty($req["age"]["min"])) {

            $sql = $sql." AND age >= {$req["age"]["min"]}";
            $query = mysqli_query($conn, $sql);
            // echo "$sql";
            exit(json_encode(mysqli_fetch_all($query)));
        }

        if (!empty($req["age"]["max"])) {

            $sql = $sql." AND age <= {$req["age"]["max"]}";
            $query = mysqli_query($conn, $sql);
            // echo "$sql";
            exit(json_encode(mysqli_fetch_all($query)));
        }
    }
    
    

    $query = mysqli_query($conn, $sql);

    echo(json_encode(mysqli_fetch_all($query)));
?>