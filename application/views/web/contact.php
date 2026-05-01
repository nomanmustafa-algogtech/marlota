<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #main-container {
               display: flex;
    width: 100vw;
    height: 100vh;
    padding: 5%;
        }

        #left {
            flex: 50%;
            /*padding: 1%;*/
            /*background-color: #095473;*/
        }

        #right {
            flex: 50%;
            padding: 0% 5% 0% 0%;
            /*padding-top:1% !important;*/
            background-color: #fffff1;
            
        }

        h2 {
            color: #fff;
        }
        
          .pp {
            color: #fff;
        }
        
        .icon-text{
            display:flex;
            padding:0px;
            margin:0px;
                gap: 5%;
        }
        
        
        .icon-text p{
            color: #fff; 
        }

        .formm {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333333;
        }

        .inputt, .ttextarea {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 0px;
            box-sizing: border-box;
        }

        input[type="submit"] {
           background-color: #095473;
    color: #ffffff;
    cursor: pointer;
    padding: 21px;
    border-radius: 0px;
    border: 1px solid;
        }
        
         .h3{
            
            padding:0px;
            margin:0px;
            
        }
        
        
        .input-css-outer{
                    display: flex;
    flex-direction: row;
    gap: 1%;

        }
        
        .input-css{
            width:50%;
             display: flex;
             flex-direction: column;
        }
        
        .banner-section{
                   background-image: linear-gradient(0deg, #095473, #e7aa3c);
    padding: 5%;
    text-align: center;

        }
        
        
         .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
            
            margin: auto;
        }
        .grid-item {
                  /* background-color: lightgray; */
    padding: 5% 0% 0% 0%;
    text-align: center;
    padding: 5%;
    box-shadow: #095473 0px 6px 0px -2px, #095473 0px 3px 0px 1px;
    gap: 16px;
    display: flex;
    flex-direction: column;
        }
        
         .contact-text{
             margin:0%;
             padding:0%;
         }
         .contact-headings{
              margin:0%;
             padding:0%;
         }
        @media  screen and (max-width: 800px) {
  #main-container {
                     display: flex;
        width: 100vw;
        height: 100vh;
        padding: 5%;
        flex-direction: column;
        }
#right {
    flex: 50%;
    padding: 0% 0% 0% 0%;
    /* padding-top: 1% !important; */
    background-color: #fffff1;
}
    </style>
</head>
<body>
 <div class="banner-section">
 <h2>Contact Us</h2>
 <p class="pp">
     Reach out to us for any queries or support
 </p>
     </div>
    <div id="main-container">
            <div id="right">
            <h3 id="contact-form-title">Contact Us</h3>
            <p id="tagline">Have questions? Fill out the form below and we'll get back to you.</p>

            <!-- Contact Form -->
            <form class="formm"action="#" method="post">
               <div class="input-css-outer" >
                <div class="input-css">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required class="inputt">
</div>
<div class="input-css">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required class="inputt">
</div>
</div>
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required class="inputt">

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="3" required class="inputt"></textarea>

                <input type="submit" value="Submit">
            </form>
        </div>
        <div id="left">
              <!--<h2>Contact Information</h2>-->
            <!--<p class="pp">Please get in touch with our customer support team for detailed information</p>-->
             <div class="grid-container">
        <div class="grid-item">
      
<!-- Generator: Adobe Illustrator 18.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 276.188 276.188" style="enable-background:new 0 0 276.188 276.188;     height: 40px;
    width: 100%;" xml:space="preserve">
<g>
	<path d="M138.096,0c-51.606,0-93.59,41.984-93.59,93.589c0,47.124,24.622,93.947,45.276,124.928
		c22.249,33.374,44.158,55.41,45.08,56.331c0.857,0.858,2.021,1.34,3.234,1.34c1.213,0,2.376-0.482,3.234-1.34
		c0.922-0.921,22.83-22.958,45.078-56.331c20.654-30.981,45.274-77.804,45.274-124.928C231.683,41.984,189.7,0,138.096,0z
		 M138.096,264.992c-15.854-16.984-84.443-94.909-84.443-171.403c0-46.562,37.881-84.442,84.443-84.442
		c46.56,0,84.439,37.88,84.439,84.442C222.535,170.083,153.949,248.008,138.096,264.992z"/>
	<path d="M141.327,45.846c-1.786-1.787-4.682-1.787-6.468,0L82.715,97.987c-1.786,1.786-1.786,4.682,0,6.468
		c1.786,1.786,4.682,1.786,6.468,0l7.468-7.467v41.105c0,2.526,2.048,4.574,4.574,4.574h73.743c2.526,0,4.574-2.048,4.574-4.574
		v-41.1l7.462,7.461c0.893,0.893,2.064,1.34,3.234,1.34s2.341-0.447,3.234-1.34c1.786-1.786,1.786-4.682,0-6.468L141.327,45.846z
		 M170.393,133.52h-64.596V87.841l32.295-32.293l32.301,32.299V133.52z"/>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

            <h4  class="contact-headings">Address</h4>
            <p  class="contact-text">Unit N/1/23,Nortex Business Centre 105 Chorley Old Road Bolton,BL1 3AS,United Kingdom</p>
        </div>
        <div class="grid-item">
           
<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="100%" height="40px"><path d="M12,24C5.383,24,0,18.617,0,12S5.383,0,12,0s12,5.383,12,12-5.383,12-12,12ZM12,1C5.935,1,1,5.935,1,12s4.935,11,11,11,11-4.935,11-11S18.065,1,12,1Zm1,10.329l-3.605-4.636-.789,.614,3.395,4.364v7.329h1v-7.671Z"/></svg>
  
            <h4  class="contact-headings" >OPENING HOURS</h4>
            <p  class="contact-text">Mon to Fri: 9:00 – 17:00</p></div>
        <div class="grid-item">
      
<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;     height: 40px;
    width: 100%;" xml:space="preserve">
<g>
	<g>
		<path d="M505.448,138.386c-5.344-6.369-13.117-9.877-21.887-9.877H190.596c-17.459,0-33.565,13.779-36.667,31.369L120.522,349.34
			c-1.584,8.987,0.612,17.842,6.026,24.294c5.334,6.356,13.116,9.858,21.913,9.858h293.808c16.987,0,32.657-13.404,35.675-30.516
			l33.558-190.316C513.08,153.7,510.874,144.852,505.448,138.386z M190.596,144.531h292.966c0.592,0,1.166,0.044,1.732,0.109
			L330.949,269.523c-12,9.709-27.758,10.115-35.875,0.924L184.75,145.543C186.653,144.899,188.622,144.531,190.596,144.531z
			 M136.3,352.122l33.407-189.461c0.432-2.45,1.352-4.806,2.637-6.962l87.738,99.335L136.037,355.401
			C136.018,354.343,136.102,353.246,136.3,352.122z M442.269,367.471H148.46v-0.001c-0.593,0-1.169-0.043-1.735-0.107
			l123.973-100.309l12.367,14.001c7.057,7.989,17.149,12.003,27.831,12.003c10.226,0,20.99-3.682,30.131-11.078l18.446-14.926
			l87.967,99.594C445.751,367.179,444.011,367.471,442.269,367.471z M495.722,159.878l-33.558,190.315
			c-0.389,2.208-1.205,4.329-2.326,6.29l-87.899-99.517l124.04-100.363C496.002,157.662,495.92,158.757,495.722,159.878z"/>
	</g>
</g>
<g>
	<g>
		<path d="M110.549,248.137H8.011c-4.424,0-8.011,3.587-8.011,8.011s3.587,8.011,8.011,8.011h102.538
			c4.424,0,8.011-3.587,8.011-8.011S114.973,248.137,110.549,248.137z"/>
	</g>
</g>
<g>
	<g>
		<path d="M119.094,205.413H42.19c-4.424,0-8.011,3.587-8.011,8.011s3.587,8.011,8.011,8.011h76.904
			c4.424,0,8.011-3.587,8.011-8.011S123.518,205.413,119.094,205.413z"/>
	</g>
</g>
<g>
	<g>
		<path d="M102.004,290.861H25.1c-4.424,0-8.011,3.587-8.011,8.011c0,4.424,3.587,8.011,8.011,8.011h76.904
			c4.424,0,8.011-3.587,8.011-8.011C110.015,294.448,106.428,290.861,102.004,290.861z"/>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
  
            <h4  class="contact-headings">Email</h4>
            <p  class="contact-text">info@oxijan.co.uk</p></div>
        <div class="grid-item">
            <svg id="Capa_1" enable-background="new 0 0 511.5 511.5" height="40px" viewBox="0 0 511.5 511.5" width="100%" xmlns="http://www.w3.org/2000/svg"><g><path d="m351.387 434.881 13.945-13.945c6.557-6.557 10.168-15.275 10.168-24.548s-3.611-17.99-10.168-24.547l-37.46-37.46-10.606 10.606 37.46 37.46c3.724 3.724 5.775 8.674 5.775 13.94s-2.051 10.217-5.775 13.941l-13.945 13.945-79.2-79.2 13.946-13.945c3.723-3.724 8.674-5.775 13.94-5.775s10.217 2.051 13.941 5.775l3.252 3.252 10.606-10.606-3.252-3.252c-6.557-6.557-15.275-10.168-24.548-10.168s-17.99 3.611-24.547 10.168l-19.245 19.244c-15.985 15.985-28.509 23.756-38.286 23.756-3.921 0-7.603-1.23-11.585-3.872-11.359-7.535-67.339-63.514-74.872-74.873-2.642-3.982-3.872-7.664-3.872-11.585 0-9.777 7.771-22.3 23.756-38.286l19.244-19.244c6.557-6.557 10.168-15.274 10.168-24.548 0-9.272-3.611-17.99-10.168-24.547l-51.318-51.318c-6.557-6.557-15.275-10.168-24.548-10.168-9.272 0-17.99 3.611-24.547 10.168l-19.244 19.244c-26.85 26.851-39.902 53.609-39.902 81.804 0 26.347 11.283 53.387 35.51 85.095l11.919-9.106c-22.124-28.958-32.429-53.104-32.429-75.989 0-22.199 9.934-43.779 30.309-65.789l79.187 79.187c-15.615 16.76-22.937 30.695-22.937 43.498 0 6.91 2.084 13.412 6.371 19.876 8.841 13.33 65.75 70.24 79.082 79.082 6.464 4.288 12.966 6.372 19.877 6.372 12.802 0 26.736-7.321 43.494-22.934l79.187 79.187c-22.009 20.372-43.587 30.305-65.785 30.305-49.473 0-100.135-50.662-149.129-99.656-21.204-21.205-41.6-41.877-58.058-61.664l-11.532 9.592c16.863 20.275 37.523 41.217 58.983 62.678 51.154 51.154 104.049 104.049 159.735 104.049 26.304 0 51.357-11.365 76.401-34.69l22.691 22.691c5.748 5.748 5.617 13.058 3.577 17.982s-7.115 10.186-15.244 10.186h-291.709c-6.893 0-12.5-5.607-12.5-12.5s5.607-12.5 12.5-12.5h26c15.164 0 27.5-12.336 27.5-27.5s-12.336-27.5-27.5-27.5h-56v15h56c6.893 0 12.5 5.607 12.5 12.5s-5.607 12.5-12.5 12.5h-26c-15.164 0-27.5 12.336-27.5 27.5s12.336 27.5 27.5 27.5h291.709c12.983 0 24.134-7.451 29.103-19.446 4.968-11.994 2.351-25.148-6.829-34.328zm-295.075-295.084 13.941-13.941c3.724-3.724 8.675-5.775 13.941-5.775s10.217 2.051 13.941 5.775l51.317 51.318c3.724 3.724 5.775 8.675 5.775 13.941 0 5.267-2.051 10.218-5.774 13.941l-13.941 13.941z"/><path d="m0 416.25h15v15h-15z"/><path d="m363.5 36.75v75.5h47.5v-15h-32.5v-60.5z"/><path d="m427.5 36.75v75.5h47.5v-15h-32.5v-60.5z"/><path d="m414.019 161.25-12.519 18.506v-45.006h-15v75.5h12.481l20.019-29.593 20.019 29.593h12.481v-75.5h-15v45.006l-12.519-18.506z"/><path d="m344 135.25c-15.164 0-27.5 12.336-27.5 27.5v20c0 15.164 12.336 27.5 27.5 27.5s27.5-12.336 27.5-27.5v-20c0-15.164-12.336-27.5-27.5-27.5zm12.5 47.5c0 6.893-5.607 12.5-12.5 12.5s-12.5-5.607-12.5-12.5v-20c0-6.893 5.607-12.5 12.5-12.5s12.5 5.607 12.5 12.5z"/><path d="m251 52.25c6.893 0 12.5 5.607 12.5 12.5h15c0-15.164-12.336-27.5-27.5-27.5s-27.5 12.336-27.5 27.5v20c0 15.164 12.336 27.5 27.5 27.5s27.5-12.336 27.5-27.5h-15c0 6.893-5.607 12.5-12.5 12.5s-12.5-5.607-12.5-12.5v-20c0-6.893 5.607-12.5 12.5-12.5z"/><path d="m321.167 37.25c-15.164 0-27.5 12.336-27.5 27.5v48h15v-14.5h25v14.5h15v-48c0-15.164-12.337-27.5-27.5-27.5zm12.5 46h-25v-18.5c0-6.893 5.607-12.5 12.5-12.5s12.5 5.607 12.5 12.5z"/><path d="m286.5 178.47-27.373-43.22h-12.627v75.5h15v-43.72l27.373 43.22h12.627v-75.5h-15z"/><path d="m474 .25h-211.981v15h211.981c12.407 0 22.5 10.093 22.5 22.5v141.875h15v-141.875c0-20.678-16.822-37.5-37.5-37.5z"/><path d="m496.5 209.75c0 12.407-10.093 22.5-22.5 22.5h-77.249l-41.751 44.534-41.751-44.534h-89.249c-12.407 0-22.5-10.093-22.5-22.5v-172c0-12.407 10.093-22.5 22.5-22.5h23.019v-15h-23.019c-20.678 0-37.5 16.822-37.5 37.5v172c0 20.678 16.822 37.5 37.5 37.5h82.751l48.249 51.466 48.249-51.466h70.751c20.678 0 37.5-16.822 37.5-37.5v-15.125h-15z"/><path d="m363.201 309.25h39.598v15h-39.598z" transform="matrix(.707 -.707 .707 .707 -111.798 363.596)"/><path d="m393.5 344.453h15v30.594h-15z" transform="matrix(.196 -.981 .981 .196 -30.407 682.41)"/><path d="m30 209.25h15v15h-15z"/><path d="m41 239.25h15v15h-15z"/></g></svg>  
            <h4  class="contact-headings"> Phone</h4>
            <p  class="contact-text">01204 934158 <br>+44 7862 130262</p></div>
    </div>
          

<!--            <div class="icon-text">-->
<!--                <div class="icon">📍</div>-->
<!--                <p>Unit N/1/23,Nortex Business Centre 105 Chorley Old Road Bolton,BL1 3AS,United Kingdom</p>-->
<!--            </div>-->

<!--            <div class="icon-text">-->
<!--                <div class="icon">✉️</div>-->
<!--                <p> -->
<!--info@oxijan.co.uk-->
<!-- </p>-->
<!--            </div>-->

<!--            <div class="icon-text">-->
<!--                <div class="icon">📞</div>-->
<!--                <p>+44 7862 130262</p>-->
<!--            </div>-->
           
<!--            <div class="icon-text">-->
                
<!--                <div class="icon">☎️</div>-->
<!--                <p>01204 934158</p>-->
<!--            </div>-->
        </div>

    
    </div>

</body>
</html>




