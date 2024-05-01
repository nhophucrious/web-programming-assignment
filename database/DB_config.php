<?php
    // DB_config.php
    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Read SQL file
    $sql = file_get_contents(__DIR__ . '/create_database.sql');

    // Execute SQL file
    if ($conn->multi_query($sql) === TRUE) {
        echo "SQL script executed successfully";
    } else {
        echo "Error executing SQL script: " . $conn->error;
    }

    $conn->close();
?>