<?php
session_start();

$conn = mysqli_connect(
    'localhost:3306',
    'badqmdlx_test_ss',
    'seashepherd',  
    'badqmdlx_test_ss');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "db connection error";
} else {

    $email = $_POST['email'];
    
    $sql = "SELECT * FROM account WHERE email = '{$email}'";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_array($result);
    $row['email'];

    foreach($row as $key => $r) {
        echo "{$key} : {$r} <br>";
    }
    
    if ($row['email'] == $email) {
        // session_start();
        $_SESSION['userId'] = $row['email'];
        print_r($_SESSION);
        echo "<br>";
        echo $_SESSION['userId'];

    ?>
        <script>
            alert("로그인에 성공하였습니다.");
            location.href = "../index.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("로그인에 실패하였습니다.");
        </script>
    <?php
    }
}
?>
