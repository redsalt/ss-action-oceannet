<?php

$conn = mysqli_connect(
    'localhost:3306',
    'badqmdlx_test_ss',
    'seashepherd',  
    'badqmdlx_test_ss');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "db connection error";

} else {

    // $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // echo $hashedPassword;
    
    // $sql = "
    //     INSERT INTO account
    //     (email, password)
    //     VALUES('{$_POST['email']}, '{$hashedPassword}'
    //     )";

    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    if ($nickname == null) { $nickname = $email; }

    $sql = "
        INSERT INTO account
        (email, nickname)
        VALUES('{$email}', '{$nickname}')";
    
    echo $sql;
    $result = mysqli_query($conn, $sql);
    
    if ($result === false) {
        echo "계정 생성에 문제가 생겼습니다. 관리자에게 문의해주세요.";
        echo mysqli_error($conn);
    } else {
    ?>
        <script>
            alert("계정이 등록되었습니다.");
            location.href = "login.html";
        </script>
    <?php
    }
}
?>
