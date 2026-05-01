<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Home Page</title>
    <style>
        body {
    margin: 0;
    padding: 0;
}

.background-image {
    background-image: url('pexels-chama-691901.jpg');  
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    /*    background-color: black;*/
    /*opacity: 0.6;*/
}



.content {
 text-align: center;
    color: #fff;
    background: #f4f4f4;
    display: flex;
    flex-direction: column;
    padding-top: 6%;
    padding-bottom: 6%;
    padding-left: 2%;
    padding-right: 2%;
    border-radius:4%;
}

.logo img {
    /*width: 100px;  Adjust the size of your logo */
    height: 50px; /* Adjust the size of your logo */
}

.hidden-text {
    /*display: none;  Initially hide the text */
    color:black;
    font-size: 26px;
    font-weight: bold;
}

.buttons {
    display: flex;
    flex-direction: column;
}

.buttons a{
    padding: 10px 20px;
    margin: 10px;
    font-size: 16px;
    background-color: #2a3855;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration:none;
    transition: background-color 0.3s ease;
}

.buttons a:hover {
    background-color: #fdd428;
        color: #2a3855;
}


@media screen and (max-width: 395px) {
        body {
    margin: 0;
    padding: 0;
}


.background-image {
    background-image: url('pexels-chama-691901.jpg'); /* Add the path to your background image */
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.content {
 text-align: center;
    color: #fff;
    background: #f4f4f4;
    display: flex;
    flex-direction: column;
    padding-top: 6%;
    padding-bottom: 6%;
    padding-left: 2%;
    padding-right: 2%;
    border-radius:4%;
        width: 80%;
}

.logo img {
    /*width: 100px;  Adjust the size of your logo */
    height: 60px; /* Adjust the size of your logo */
}

.hidden-text {
    /*display: none;  Initially hide the text */
    color:black;
     font-size: 20px;
    font-weight: bold;
}

.buttons {
    display: flex;
    flex-direction: column;
}

.buttons a{
    padding: 10px 20px;
    margin: 10px;
    font-size: 16px;
  background-color: #2a3855;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.buttons a:hover {
      background-color: #fdd428;
        color: #2a3855;
}


}

    </style>
</head>
<body>
    <div class="background-image">
        <div class="content">
            <div class="logo">
                <img src="logo_1653158675 (3).png" alt="Logo">
                <p class="hidden-text">Order Confirmation</p>
            </div>
            <div class="buttons">
          
                    <a href="form.php">Click Here</a>
                <!--<a href="https://smartfuturekings.com/course_register.php">Course Registration</a>-->
                <!--<a href="https://smartfuturekings.com/contact.php">Contact Us</a>-->
            </div>
        </div>
    </div>
</body>
</html>
