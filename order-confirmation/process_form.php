<?php
$servername = "localhost";
$username = "dordkimy_orderform23423";
$password = "NrT5qLtNU+nI";
$dbname = "dordkimy_orderform23423";



// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registrationMessage = ''; // Initialize an empty variable for the registration message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize your form data
    $fullName = mysqli_real_escape_string($conn, htmlspecialchars($_POST["fullName"]));
    $email = mysqli_real_escape_string($conn, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST["phone"]));
    $shippingaddress = mysqli_real_escape_string($conn, htmlspecialchars($_POST["shippingaddress"]));
    $city = mysqli_real_escape_string($conn, htmlspecialchars($_POST["city"]));
    $state = mysqli_real_escape_string($conn, htmlspecialchars($_POST["state"]));
    $qty = intval($_POST["qty"]);
    $lop = mysqli_real_escape_string($conn, htmlspecialchars($_POST["lop"]));
    $specifiers = mysqli_real_escape_string($conn, htmlspecialchars($_POST["specifiers"]));
    $transactionID = intval($_POST["transactionID"]);
    $additionalInfo = mysqli_real_escape_string($conn, htmlspecialchars($_POST["additionalInfo"]));

    // Handle file upload
    $targetDir = "uploads/";  // Specify the directory where you want to store uploaded files
    $fileUpload = basename($_FILES["fileUpload"]["name"]);
    $targetFilePath = $targetDir . $fileUpload;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is a valid image
    $uploadOk = 1;

    // Check file size (you can customize this size)
    if ($_FILES["fileUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (you can customize these formats)
    if ($fileType !== "pdf" && $fileType !== "docx" && $fileType !== "doc" && $fileType !== "png" && $fileType !== "jpg" && $fileType !== "jpeg") {
        echo "Sorry, only PDF, DOC, DOCX, PNG, JPG, and JPEG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully, proceed with database insertion
            $sql = "INSERT INTO `orderform` (fullName, email, phone, shippingaddress, city, state, qty, lop, specifiers, transactionID, fileUpload, additionalInfo) VALUES ('$fullName', '$email', '$phone', '$shippingaddress', '$city', '$state', $qty, '$lop', '$specifiers', $transactionID, '$fileUpload', '$additionalInfo')";

            if ($conn->query($sql) === TRUE) {
                $registrationMessage = "Registration successful!";
                // Redirect user to a success page
                header("Location: form.php");
                exit();
            } else {
                $registrationMessage = "Error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file was not uploaded.";
    }
}

$conn->close();
?>
