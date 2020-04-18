<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>فرصة عمل في البصرة</title>
  <link rel="icon" href="images/basrajobs.jpg" />
  <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css" />
  <link rel="stylesheet" href="assets/css/Article-List.css" />
  <link rel="stylesheet" href="assets/css/best-carousel-slide.css" />
  <link rel="stylesheet" href="assets/css/Features-Boxed.css" />
  <link rel="stylesheet" href="assets/css/Footer-Basic.css" />
  <link rel="stylesheet" href="assets/css/Highlight-Phone.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css" />
  <link rel="stylesheet" href="assets/css/Navigation-Clean.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <style>
    * {
      font-family: 'Amiri',
        serif;
    }
  </style>
</head>

<body>
  <div>
    <nav class="navbar navbar-light navbar-expand-md shadow-lg bounce animated navigation-clean" style="background-color: rgb(77,114,160);">
      <div class="container">
        <a class="navbar-brand" href="index.php" style="color: rgb(255,255,255);">فرصة عمل في البصرة</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
          <span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
          <ul class="nav navbar-nav ml-auto">

            <li class="nav-item" role="presentation">

              <?php

              include 'class/main_class.php';

              $views = new main;
              ?>
              <?php
              // Should always be on top
              if (!isset($_SESSION['counter'])) { // It's the first visit in this session
                $handle = fopen("counter.txt", "r");
                if (!$handle) {
                  echo "Could not open the file";
                } else {
                  $counter = (int) fread($handle, 20);
                  fclose($handle);
                  $counter++;
                  $handle = fopen("counter.txt", "w");
                  fwrite($handle, $counter);
                  fclose($handle);
                  $_SESSION['counter'] = $counter;
                }
              } else { // It's not the first time, do not update the counter but show the total hits stored in session
              $handle = fopen("counter.txt", "r");
                $count = (int) fread($handle, 20);
                fclose($handle);
                $counter = $_SESSION['counter'];
                
              }
              ?>




             <h6 align="right" style="color:white;"> اجمالي زيارات الموقع : <?php if (!isset($count)) {
                                                                                echo $counter;
                                                                              } else {
                                                                                echo $count;
                                                                              } ?> مرة </h6>
            </li>

            <li class="nav-item" role="presentation">

            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <section id="carousel">

  </section>

  <div data-aos="fade-down" data-aos-once="true" class="highlight-phone" style="background-repeat: no-repeat;background-attachment: fixed;background-size: cover;height: 517px;">
    <div class="container">
      <div class="row">
        <div class="col-md-8">

          <div class="intro">

            <h2 align="center">حول</h2>
            <p style="color: #35264f;">
              <br />يقدم لك هذا الموقع فرص العمل في البصرة-العراق في كافة
              المجالات وكافة &nbsp;الاصناف &nbsp;لا تضيع وقتك في البحث عن العمل
              بعد الان هنا تجد كل ما تتمناه<br /><br /><br />
            </p>


            <a class="btn btn-primary" role="button" href="show.php">تصفح الاعلانات</a><a class="btn btn-primary" role="button" href="login.php" style="margin-left: 24px;">لوحة التحكم</a>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="d-none d-md-block iphone-mockup">
            <img src="assets/img/iphone.svg" class="device" />
            <div class="screen" style='background-image: url("assets/img/٢٠٢٠٠١٠٨_٠٩٤١٥٠.jpg");font-size: 9px;'></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bounce animated footer-basic" style="background-color: #465765;color: rgb(255,255,255);">
    <footer>
      <div class="social">
        <a href="https://www.instagram.com/basrajob/"><i title="instagram" class="icon ion-social-instagram"></i></a><a href="https://t.me/basra_job" ><i  title="telegram" class="icon ion-android-send"></i></a><a href="https://www.facebook.com/basra.job/"><i title="facebook" class="icon ion-social-facebook"></i></a>
      </div>
      <ul class="list-inline"></ul>
      <p class="copyright" style="font-size:18px;">جميع الحقوق محفوظة لفرصه عمل في البصرة © <?php echo date('Y'); ?></p>
       <p  style="font-size:20px;" class="copyright">design and developer by <a  style="color:white;" href="https://www.instagram.com/sajjad780/">sajjad</a></p>
    </footer>
  </div>
  <div class="article-list" style="background-color: rgb(255,255,255);filter: blur(0px) brightness(98%);color: rgb(159,39,32);"></div>
  <div class="features-boxed" style="background-color: rgb(255,255,255);"></div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/bs-animation.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
</body>

</html>