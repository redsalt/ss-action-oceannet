<?php

// ==================================================================
// variables

$conn;
$arr_loc;
$db;

$arr_loc = array(array());

$count = 0;

// DB information
// $db_host = 'localhost:3306';
// $db_username = 'badqmdlx_test_ss';
// $db_password = 'seashepherd';
$db_host = 'localhost';
$db_username = 'badqmdlx_test_ss';
$db_password = 'seashepherd';
$db_dbname = 'badqmdlx_test_ss';

// ==================================================================
// Check connection

$conn = mysqli_connect($db_host,$db_username,$db_password,$db_dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $sql = "SELECT * FROM location";
    $result = mysqli_query($conn, $sql);
    
    $count = 0;
    while($row = mysqli_fetch_array($result)) {
        
        $arr_loc[$count++] = array($row['id'], $row['loc_lat'], $row['loc_lon'], $row['registered']);
    
        /*
        echo '<h2>'.$row['id'].'</h2>';
        echo $row['loc_lat'];
        echo $row['loc_lon'];
        echo $row['registered'];
        */
    }
    // echo $count . " locations are registered.";
    
    $conn->close();
}

function getLocationDB() {
    
    $conn = mysqli_connect($db_host,$db_username,$db_password,$db_dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        $sql = "SELECT * FROM location";
        $result = mysqli_query($conn, $sql);
        
        $count = 0;
        while($row = mysqli_fetch_array($result)) {
            
            $arr_loc[$count++] = array($row['id'], $row['loc_lat'], $row['loc_lon'], $row['registered']);
        
            /*
            echo '<h2>'.$row['id'].'</h2>';
            echo $row['loc_lat'];
            echo $row['loc_lon'];
            echo $row['registered'];
            */
        }
        echo $count . " locations are registered.";
        
        $conn->close();
    }
}
// getLocationDB();
// echo "<p>" . $count . " locations are registered.</p>";
// echo "<p>" . $arr_loc.length() . "</p>";

//var_dump($arr_loc);


// ==================================================================
// init. db

function initDB() {
    
}

// initDB();

// db disconnection -- TODO



// ==================================================================
// register a location

function registerLocation($data) {
    
    // $db = new mysqli($db_host,$db_username,$db_password,$db_dbname);
    
    // // Check connection
    // if ($db -> connect_errno) {
    //     echo "Failed to connect to MySQL: " . $db -> connect_error;
    //     exit();
    // } else {
    //     echo "Connected to MySQL ... ";
    // }

    $con = mysqli_connect($db_host,$db_username,$db_password,$db_dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    } else {
        echo "Connected to MySQL (2) ... ";
    }

    // $db = mysqli_select_db($con, $db_dbname);
    
    $lat = $data[0];
    $lon = $data[1];
    
    $sql_insert = "INSERT INTO location(loc_lat, loc_lon) VALUES($lat, $lon)";
    $result = $con->query($sql_insert);
    // echo "sql result: " . $result  . " ... ";

    if ($result === TRUE) {
        echo "register_location: " . $lat . ", " . $lon . " ... ";
        echo "New record created successfully ... ";
        $con->close();
        return 0;
    } elseif ($result === FALSE) {
        echo "[Error] sql: " . $sql_insert . " ... ";
        echo "[Error] code: " . $con->error . " ... ";
        return 1;
    }

    // Perform query 
    // if ($result = $db -> query("SELECT * FROM location")) {
    //     echo "Returned rows are: " . $result->loc_lat;
    // }
    return 2;
}

/*
header('Content-Type: application/json');

$aResult = array();

if( !isset($_POST['functionname']) ) { 
    $aResult['error'] = 'No function name!'; 
}

if( !isset($_POST['arguments']) ) { 
    $aResult['error'] = 'No function arguments!';
}

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'register_location':
           if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
               $aResult['error'] = 'Error in arguments!';
           }
           else {
               $aResult['result'] = register_location(floatval($_POST['arguments'][0]), floatval($_POST['arguments'][1]));
           }
           break;

        default:
           $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
           break;
    }

}

echo json_encode($aResult);
*/


// if(isset($_POST['action']) && !empty($_POST['action'])) {
//     $action = $_POST['action'];
//     switch($action) {
//         case 'test' : register_location(1,2);break;
//         case 'blah' : blah();break;
//         // ...etc...
//     }
// }

// function func1($data){
//     return 0;
// }

if (isset($_POST['callFunc1'])) {
    $result = registerLocation($_POST['callFunc1']);
    echo "_POST['callFunc1'], result: ";
    echo $result . " ... ";
}

?>