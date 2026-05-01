<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Form Details</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

   <style>
       *{
               margin: 0px;
    padding: 0px;

       }
       
       .container{
               padding-top: 2%;
               padding-left:2%;
               padding-right:2%;
    align-items: center;
    text-align: center;
       }
       .text{
               padding-bottom: 2%;
       }
       /*.inner-contaner{*/
       /*    padding:1% 1% 1% 1% ;*/
       /*    border: 1px solid #f7f7f7;*/
       /*}*/
       
        
        #table th, #table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
       
   </style>
</head>
<body>
<div class="container">
    <img src="logo_1653158675 (3).png" style="width: 10%"  class="text"/>
<h2 class="text"> Order Form Details</h2>
<div class="inner-contaner container">
    

<table id="table"  class="display" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Shipping Address</th>
            <th>City</th>
            <th>State</th>
            <th>Qty</th>
            <th>Products Link</th>
            <th>Specifiers</th>
            <th>T-ID</th>
            <th>Message</th>
            <th>Recipet</th>
        </tr>
    </thead>
    <tbody>
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

        // Retrieve form data from the database
        $sql = "SELECT * FROM `orderform`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                 echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["fullName"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["shippingaddress"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>" . $row["lop"] . "</td>";
                echo "<td>" . $row["specifiers"] . "</td>";
                echo "<td>" . $row["transactionID"] . "</td>";
                echo "<td>" . $row["additionalInfo"] . "</td>";
                echo "<td><a href='uploads/" . $row["fileUpload"] . "'>" . $row["fileUpload"] . "</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No form data available</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
<script>
  $(document).ready( function () {
    $('#table').DataTable(
        
        
        
        );
} );



new DataTable('#table', {
    layout: {
        topRight: {
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    }
});




</script>
</body>
</html>
