<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .hero-banner {
            position: relative;
            display: flex;
            height: 300px; /* Adjust the height as needed */
            background: url('https://cdn.shopify.com/s/files/1/0070/7032/files/wholesale_20marketplace.png?format=webp&v=1697500795&width=1024') center/cover no-repeat; /* Replace 'hero-image.jpg' with the path to your hero image */
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero-text {
            max-width: 600px;
        }

        .hero-text h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero-text h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .hero-text p {
            font-size: 18px;
            line-height: 1.5;
        }

        .main-section {
            display: flex;
            height: 400px; /* Adjust the height as needed */
            padding:5%;
        }

        .left-section, .right-section {
            flex: 1;
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .image-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .image-container img {
            width: 100px; /* Adjust the width of the images as needed */
            height: 100px; /* Adjust the height of the images as needed */
            border-radius: 50%;
            margin-right: 10px;
            transform: rotate(-15deg); /* Adjust the rotation angle as needed */
        }
        
        
        * {
  box-sizing: border-box;
}

body,
html {
  overflow-x: hidden;
}

body {
  margin: 0;
  width: 100%;
  font-family: "Oswald", sans-serif;
  font-size: 12pt;
  font-weight: 400;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Bebas Neue", cursive;
}

a {
  text-decoration: none;
  transition: all 0.5s ease-in-out;
}

a:hover {
  transition: all 0.5s ease-in-out;
}

.we-are-block {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-wrap: nowrap;
  width: 100%;
  height: 900px;
}

@media screen and (max-width: 860px) {
  .we-are-block {
    height: 2200px;
  }
}

@media screen and (max-width: 500px) {
  .we-are-block {
    height: 2300px;
  }
}

#about-us-section {
  background: #0c4c91;
  width: 100%;
  height: 50%;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: center;
  position: relative;
}

@media screen and (max-width: 860px) {
  #about-us-section {
    flex-direction: column;
    justify-content: space-between;
  }
}

.about-us-image {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  overflow: hidden;
}

@media screen and (max-width: 860px) {
  .about-us-image {
    position: relative;
    width: 100%;
    height: 45%;
  }
}

@media screen and (max-width: 747px) {
  .about-us-image {
    height: 35%;
  }
}

@media screen and (max-width: 644px) {
  .about-us-image img {
    position: absolute;
    left: -220px;
  }
}

.about-us-info {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-evenly;
  width: 40%;
  height: 80%;
  margin-right: 850px;
  margin-left: 12px;
  z-index: 2;
}

@media screen and (max-width: 1353px) {
  .about-us-info {
    margin-right: 400px;
    width: 60%;
    background: #0c4c9199;
    padding: 0px 25px 0px 0px;
  }
}

@media screen and (max-width: 1238px) {
  .about-us-info {
    margin-right: 340px;
    width: 100%;
  }
}

@media screen and (max-width: 1111px) {
  .about-us-info {
    margin-right: 270px;
  }
}

@media screen and (max-width: 910px) {
  .about-us-info {
    margin-right: 150px;
  }
}

@media screen and (max-width: 860px) {
  .about-us-info {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 20px 0px 20px !important;
    width: 100%;
    height: 55%;
    align-items: center;
  }
}

@media screen and (max-width: 747px) {
  .about-us-info {
    height: 65%;
  }
}

.about-us-info h2 {
  color: white;
  font-size: 40pt;
  text-align: right;
}

@media screen and (max-width: 860px) {
  .about-us-info h2 {
    text-align: center;
  }
}

.about-us-info p {
  color: white;
  font-size: 14pt;
  text-align: right;
}

@media screen and (max-width: 860px) {
  .about-us-info p {
    text-align: center;
  }
}

.about-us-info a {
  background-color: white;
  color: #0c4c91;
  width: 180px;
  text-align: center;
  padding: 15px 0px 15px 0px;
  font-size: 14pt;
  box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
}

.about-us-info a:hover {
  background: #404140;
  color: white;
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  transform: translateY(10px);
}

#history-section {
  width: 100%;
  height: 50%;
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: center;
  position: relative;
}

@media screen and (max-width: 860px) {
  #history-section {
    flex-direction: column;
    justify-content: space-between;
  }
}

.history-image {
  position: absolute;
  top: 0;
  left: 0;
  max-width: 820px;
  height: 100%;
  overflow: hidden;
}

@media screen and (max-width: 860px) {
  .history-image {
    position: relative;
    width: 100%;
    height: 40%;
  }
}

@media screen and (max-width: 747px) {
  .history-image {
    height: 35%;
  }
}

@media screen and (max-width: 644px) {
  .history-image img {
    position: absolute;
    right: -220px;
  }
}

.history-info {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: space-evenly;
  width: 40%;
  height: 80%;
  margin-left: 850px;
  margin-right: 12px;
  z-index: 2;
}

@media screen and (max-width: 1353px) {
  .history-info {
    margin-left: 400px;
    width: 60%;
    background: #ffffff99;
    padding: 0px 0px 0px 25px;
  }
}

@media screen and (max-width: 1238px) {
  .history-info {
    margin-left: 340px;
    width: 100%;
  }
}

@media screen and (max-width: 1111px) {
  .history-info {
    margin-left: 270px;
  }
}

@media screen and (max-width: 910px) {
  .history-info {
    margin-left: 150px;
  }
}

@media screen and (max-width: 860px) {
  .history-info {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 40px 0px 40px !important;
    width: 100%;
    height: 60%;
    align-items: center;
  }
}

@media screen and (max-width: 747px) {
  .history-info {
    height: 65%;
  }
}

.history-info h2 {
  color: #0c4c91;
  font-size: 40pt;
  text-align: left;
}

@media screen and (max-width: 860px) {
  .history-info h2 {
    text-align: center;
  }
}

.history-info p {
  color: #0c4c91;
  font-size: 14pt;
  text-align: left;
}

@media screen and (max-width: 860px) {
  .history-info p {
    text-align: center;
  }
}

.history-info a {
  background-color: #0c4c91;
  color: white;
  width: 180px;
  text-align: center;
  padding: 15px 0px 15px 0px;
  font-size: 14pt;
  box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
}

.history-info a:hover {
  background: #404140;
  color: white;
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  transform: translateY(10px);
}



.containerrrrr {
    margin: 50px auto;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background-image: url("https://i.ibb.co/jVL0zvC/section-img.jpg");
    background-size: cover;
    background-position: 43%;
    opacity: .8;
    position: relative;    
}

.center-div {
   position: absolute;
   top: 45%;
   margin-top: -30px;
   width: 80%;
   left: 50%;
   transform: translate(-50%,-50%); 
}

.center-div h2 {
    font-weight: bold;
    font-size: 20px;
    color: #fff;
    text-align: center;
    margin-top: 100px;
}

.center-div p {
    margin-top: 30px;
    text-align: center;
    font-size: 15px;
    font-weight: bold;
    color: #ccc;
    line-height: 1.8;

}

.choices {
    display: flex;
}

.left-topp,
.right-top,
.right-bottom,
.left-bottom {
    position: absolute;
    display: flex;
    transition: .6s;
    cursor: pointer;
    width: 100%;
    user-select: none;
}

.left-topp:hover,
.right-top:hover,
.right-bottom:hover,
.left-bottom:hover {
    transform: scale(1.1);
}

.left-topp {
    left: -70%;
    top:  3%;
}

.right-top {
    left: 70%;
    top: 3%;
}

.right-bottom {
    left: 70%;
    top: 80%;
}

.left-bottom {
    left: -70%;
    top: 80%;
}

.left-topp-circle,
.right-top-circle,
.right-bottom-circle,
.left-bottom-circle {
    position: relative;   
    background-color: #fff;
    width: 100px;
    height: 100px;
    border-radius: 50%;
   
}

.left-topp-circle{
    left: 81%;    
}


.left-bottom-circle {
    left: 81%;
}

.left-topp-circle img,
.right-top-circle img,
.right-bottom-circle img,
.left-bottom-circle img {
    width: 70%;
    display: block;
    position: absolute;
    top: 15%;
    left: 12%;
}

.left-topp-text,
.right-top-text,
.right-bottom-text,
.left-bottom-text {
    position: relative;
    padding: 8px;
    width: 80%;
   
}

.left-topp-text {
    left: -27%;
        padding-left: 10%;
}

.right-top-text {
    left: 7.5%;
        padding-right: 10%;
}

.right-bottom-text {
    left: 7.5%;
    top: 80%;
        padding-right: 10%;
}

.left-bottom-text {
    left: -27%;
        padding-left: 10%;
}

.left-topp-text h3,
.right-top-text h3,
.right-bottom-text h3,
.left-bottom-text h3 {
    text-align: right;
    color: #263c41;
    opacity: .9;
    font-size: 22px;
}

.right-top-text h3,
.right-bottom-text h3{
    text-align: left;
}

.left-topp-text p,
.right-top-text p,
.right-bottom-text p,
.left-bottom-text p {
    margin-top: 30px;
    color: #979dac;
    font-weight: bold;
    line-height: 1.4;
    text-align: justify;
    font-size: 16px;
}

    </style>
</head>
<body>

    <div class="hero-banner">
        <div class="hero-text">
            <h1>Welcome to Oxijen </h1>
            <h2>Your Wholesale Partner</h2>
           
        </div>
    </div>

    <div class="main-section">
        <div class="left-section">
          
            <h2>Our Products</h2>
             <p>At Oxijen, we understand the importance of quality products and seamless transactions in the wholesale industry. As your dedicated wholesale partner, we are committed to providing you with a wide range of high-quality products, exceptional service, and competitive pricing.</p>
            <p>Explore our extensive catalog of wholesale products, carefully curated to meet the diverse needs of your business. From [Product Category 1] to [Product Category 2], we source only the finest goods to ensure your shelves are stocked with products your customers will love.</p>
       <p>At Oxijen, we take pride in offering more than just products; we provide solutions to enhance your wholesale experience. Explore our two main features that set us apart from the rest:</p>
        </div>

        <div class="right-section">
            <div class="image-container">
                <img src="https://cdn.shopify.com/s/files/1/0070/7032/files/wholesale_20marketplace.png?format=webp&v=1697500795&width=1024" alt="Image 1">
                <img src="https://cdn.shopify.com/s/files/1/0070/7032/files/wholesale_20marketplace.png?format=webp&v=1697500795&width=1024" alt="Image 2">
                <img src="https://cdn.shopify.com/s/files/1/0070/7032/files/wholesale_20marketplace.png?format=webp&v=1697500795&width=1024" alt="Image 3">
            </div>
        </div>
    </div>











<div class="we-are-block">

  <div id="about-us-section">

    <div class="about-us-image">

      <img src="https://digitalupgrade.com/images/lobbyimage_1.jpg" width="808" height="458" alt="Lobby Image">

    </div>

    <div class="about-us-info">

      <h2>Direct Amazon Shipment</h2>

      <p>Streamline your business operations with Oxijen's direct Amazon shipment feature. We understand the importance of efficiency in the e-commerce landscape, and that's why we offer a seamless integration with Amazon. Simply choose the products you need, and we'll ensure they are shipped directly to your Amazon fulfillment center. Benefit from reduced lead times, cost-effective logistics, and the ease of managing your Amazon inventory with precision.</p>

      <!--<a href="#" title="About Us Button">ABOUT US</a>-->

    </div>

  </div>

  <div id="history-section">

    <div class="history-image">

      <img src="https://digitalupgrade.com/images/building_pic.jpg" width="951" height="471" alt="Building Pic">

    </div>

    <div class="history-info">

      <h2>Warehouse Shipment</h2>

      <p>For those who prefer to manage their own distribution network, Oxijen offers a flexible warehouse shipment option. Choose the products you need, and we'll coordinate the shipment directly to your warehouse. Whether you're a retailer with multiple locations or a distributor with specific storage requirements, our warehouse shipment feature provides the adaptability your business demands.</p>

      <!--<a href="#" title="History Button">HISTORY</a>-->

    </div>

  </div>

</div>

 <section class="containerrrrr">
            <div class="center-div">
               <h2>Why you choice Us ?</h2>
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> 
            </div>
            

            <div class="choices">
                <div class="left-topp">
                    <div class="left-topp-circle">
                        <img src="https://i.ibb.co/VJmZKFj/high-quality.png" alt="highquality"/>
                    </div>

                    <div class="left-topp-text">
                        <h3>Quality Assurance</h3>
                        <p> Our commitment to quality is unwavering. Each product undergoes rigorous quality checks to meet the highest standards.
 </p>
                    </div>
                    
                </div>
                

                <div class="right-top">
                    <div class="right-top-circle">
                        <img src="https://i.ibb.co/qgKNr59/backup.png"alt="backup"/>
                    </div>

                    <div class="right-top-text">
                        <h3>Competitive Pricing</h3>
                        <p>We believe in fair and transparent pricing. Benefit from our competitive rates, allowing you to maximize your profits.</p>
                    </div>
                </div>
                <div class="right-bottom">
                    <div class="right-bottom-circle">
                        <img src="https://i.ibb.co/Kbd0xbp/smart.png" alt="smart"/>
                    </div>

                    <div class="right-bottom-text">
                        <h3>Reliable Supply Chain</h3>
                        <p> Count on Oxijen to deliver your orders on time, every time. Our efficient supply chain ensures a seamless flow of products to your business. </p>
                    </div>
                </div>


                <div class="left-bottom">
                    <div class="left-bottom-circle">
                        <img src="https://i.ibb.co/G53sbGK/customer.png" alt="customer"/>
                    </div>

                    <div class="left-bottom-text">
                        <h3>Dedicated Support</h3>
                        <p>Have a question or need assistance? Our customer support team is here to help. We pride ourselves on providing excellent customer service to address your concerns promptly.</p>
                       


                    </div>
                </div>
            </div>

        </section>


</body>
</html>







