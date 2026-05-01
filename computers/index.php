<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificación de Edad</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Quicksand', sans-serif;
    background-color: #3335FF;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .content-wrapper {
    display: flex;
    flex-direction: column;
    width: 80%;
    max-width: 400px;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  .header {
    background-color: #34495e;
    padding: 20px;
    text-align: center;
    color: white;
    font-size: 1.5em;
  }
  .image-container {
    background-color: #55a087;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
  }
  .image-container img {
    max-width: 100%;
    height: auto;
    border-radius: 50%;
  }
  .text-container {
    padding: 20px;
    text-align: center;
    color: #333;
  }
  .text {
    font-weight: bold;
    font-size: 1.2em;
    margin-bottom: 10px;
  }
  .bottom-row {
    padding: 20px;
    text-align: center;
  }
  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 1.2em;
    transition: background-color 0.3s ease;
  }
  .button:hover {
    background-color: #2980b9;
  }
.background-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: -1;
  }
  .shape {
    position: absolute;
    border-radius: 50%;
  }
  .circle {
    background-color: rgba(255, 171, 64, 0.6);
  }
  .rectangle {
    background-color: rgba(97, 175, 255, 0.6);
  }
  .triangle {
    background-color: rgba(76, 209, 55, 0.6);
  }
</style>
</head>
<body>
<div class="background-shapes">
  <!-- Randomly generate between 9 and 15 shapes -->
  <?php
    $shapeCount = mt_rand(9, 15);
    for ($i = 0; $i < $shapeCount; $i++) {
      $shapeType = mt_rand(1, 3); // 1: Circle, 2: Rectangle, 3: Triangle
      $left = mt_rand(0, 100);
      $top = mt_rand(0, 100);
      $size = mt_rand(50, 150);
      echo '<div class="shape ';
      if ($shapeType === 1) {
        echo 'circle';
      } elseif ($shapeType === 2) {
        echo 'rectangle';
      } else {
        echo 'triangle';
      }
      echo '" style="left: ' . $left . '%; top: ' . $top . '%; width: ' . $size . 'px; height: ' . $size . 'px;"></div>';
    }
  ?>
</div>
<div class="content-wrapper">
  <div class="header">
    Verificación de Edad
  </div>
  <div class="image-container">
    <img src="art.png">
  </div>
  <div class="text-container">
    <div class="text">
      Por favor, confirme que tienes al menos 21 años.
    </div>
  </div>
  <div class="bottom-row">
    <a href="ref.html" class="button">Tengo 21 años o más</a>
  </div>
</div>

</body>
</html>
