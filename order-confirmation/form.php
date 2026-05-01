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
                $success = true;
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
<!DOCTYPE html>
<html lang="en">
  <head>
  

    
    <title>Oxijin | Order Form</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  
  <style>
      .div{
          background-color: #f5f5f5;
          padding : 2% 0% 2% 0%;
         
      }
  </style>
  <body>
        <img src="order-now.jpg" style="width: 100%;" />
        <div class="div">
        <div class="container">
            <!-- Button trigger modal -->
             <h2 style=" text-align:center;">Order Confirmation Form</h2>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bank Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

<p><strong>Account Holder:</strong> Martola Ltd</p>
<p><strong>Sort Code:</strong> 23-14-70</p>
<p><strong>Account No:</strong> 91162316</p>

<p style="color:red;">Note: Kindly ensure to use the provided account details for the payment reference.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
     
      </div>
    </div>
  </div>
</div>
<form id="orderForm" action="#" method="post" class="event-form .eve-form" enctype="multipart/form-data">
   

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required />
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required />
        </div>
    </div>

    <div class="form-group">
        <label for="shippingaddress">Shipping Address:</label>
        <input type="text" class="form-control" id="shippingaddress" name="shippingaddress" required />
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" required />
        </div>
        <div class="form-group col-md-6">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state" required />
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required />
        </div>
        <div class="form-group col-md-6">
            <label for="qty">Quantity:</label>
            <input type="number" class="form-control" id="qty" name="qty" required />
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="lop">Link of Products (copy the URL to specify your order):</label>
            <textarea class="form-control" id="lop" name="lop" rows="4"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="specifiers">Specifiers (color, size, etc.):</label>
            <textarea class="form-control" id="specifiers" name="specifiers" rows="4"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="transactionID">Transaction ID:</label>
        <input type="number" class="form-control" id="transactionID" name="transactionID" required/>
    </div>

    <div class="form-group">
        <label for="fileUpload">Payment Slip Submission:</label>
        <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".jpg, .jpeg, .png, .gif" required onchange="handleFileInputChange(event)"/>
        <input type="hidden" id="ImgData" name="ImgData" />
    </div>

    <div class="form-group">
        <label for="additionalInfo">Additional Information:</label>
        <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="4"></textarea>
    </div>

    <p><strong>Important Note:</strong> Order confirmation will not be processed until payment is received.</p>

    <button type="submit" class="btn btn-primary">Order Now</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  For Bank Details Click Here
</button>
</form>
</div>
    <!--<section>-->
    <!--    <div class="containerr logo">-->
    <!--        <form id="orderForm" action="process_form.php" method="post" class="event-form .eve-form" enctype="multipart/form-data">-->

    <!--            <h2>Order Form</h2>-->
        
         
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="fullName">Full Name:</label>-->
    <!--          <input type="text" id="fullName" name="fullName" required />-->
    <!--        </div>-->
    <!--        <div class="first-f">-->
    <!--          <label for="email">Email:</label>-->
    <!--          <input type="email" id="email" name="email" required />-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="shippingaddress">Shipping Address</label>-->
    <!--          <input-->
    <!--            type="text" id="shippingaddress" name="shippingaddress" required />-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="city">City</label>-->
    <!--          <input type="text" id="city" name="city" required />-->
    <!--        </div>-->
    <!--        <div class="first-f">-->
    <!--          <label for="state">State</label>-->
    <!--          <input type="text" id="state" name="state" required />-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="phone">Phone Number:</label>-->
    <!--          <input type="tel" id="phone" name="phone" required />-->
    <!--        </div>-->
    <!--        <div class="first-f">-->
    <!--          <label for="qty">Quantity</label>-->
    <!--          <input type="number" id="qty" name="qty" required />-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="lop" >Link of Products(copy the URL to specify your order)</label >-->
    <!--          <textarea id="lop" name="lop" rows="4"></textarea>-->
    <!--        </div>-->
    <!--        <div class="first-f">-->
    <!--          <label for="specifiers">Specifiers (color, size, etc.)</label>-->
    <!--          <textarea id="specifiers" name="specifiers" rows="4"></textarea>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="first">-->
    <!--        <div class="first-f">-->
    <!--          <label for="transactionID">Transaction ID:</label>-->
    <!--          <input type="number" id="transactionID" name="transactionID" required/>-->
    <!--        </div>-->
            <!--<div class="first-f">-->
            <!--  <label for="fileUpload">Payment Slip Submission</label>-->
               <!--<input type="file" id="fileUpload" name="fileUpload" required  />-->
            <!--    <input type="file" id="fileUpload" name="fileUpload" accept=".jpg, .jpeg, .png, .gif"  required onchange="handleFileInputChange(event)" />-->
            <!--     <input type="hidden" id="ImgData" name="ImgData" />-->
            <!--</div>-->
            
            
    <!--         <div class="first-f">-->
    <!--                <label for="fileUpload">Payment Slip Submission</label>-->
    <!--                <input type="file" id="fileUpload" name="fileUpload" accept=".jpg, .jpeg, .png, .gif" required onchange="handleFileInputChange(event)"/>-->
    <!--                <input type="hidden" id="ImgData" name="ImgData" />-->
    <!--            </div>-->
         
    <!--      </div>-->
    <!--      <label for="additionalInfo">Additional Information:</label>-->
    <!--      <textarea  id="additionalInfo" name="additionalInfo" rows="4" ></textarea>-->
    <!--      <p>  <strong>Important Note:</strong> <span style="text-align: center; color: red">-->
    <!--          Order confirmation will not be processed until payment is-->
    <!--          received.</span>  </p>-->
     
          <!--<p>After submitting the form, download your PDF receipt: <a href="path/to/your/paid_challan_form_receipt.pdf" download>Download PDF</a></p>-->
   

    <!--            <input type="submit" value="Order Now" />-->
    <!--        </form>-->
    <!--    </div>-->
        
        
        
        
    <!--</section>-->
     <?php if(isset($success) && $success): ?>
    <script>
      $(document).ready(function(){
        alert("Your order has been submitted successfully!");
      });
    </script>
  <?php endif; ?>
   </div>
</body>

</html>
