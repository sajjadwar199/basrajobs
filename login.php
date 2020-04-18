<?php
//create login system
include 'class/main_class.php';
$check2 = new main;
if (isset($_SESSION['login'])) {
    $check2->redir('ad');
}

if (isset($_POST['enter'])) {

    if (isset($_POST['username']) and  isset($_POST['password'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
    }
    $login = new main;
    if ($username != '' and $password != '') {
        $q = $login->query("select * from users where u_name='$username' and password='$password'");
        $num = $login->number_query($q);
        if ($num >= 1) {
            //get info about user and enter to website 
            while ($row = $login->fetch($q)) {
                $userid = $row['u_id'];
                $u_name = $row['u_name'];
                $pass = $row['password'];
                $u_date = $row['u_date'];
                $number_post = $row['number_post'];
            }
            $_SESSION['login'] = array($userid, $u_name, $u_date, $pass, $number_post);
            $_SESSION['success_message'] =  'اهلا بك يا ' . $_SESSION['login'][1] . ' ' . 'في لوحة التحكم';
            $login->redir('ad');



            //get info about user and enter to website 
        } else {
            $error = '<Div class="alert alert-danger">هناك خطا في اسم المستخدم او كلمة المرور</Div>';
        }
    } else {
        $empty = '<Div class="alert alert-danger">لا تترك الحقول فارغة !</Div>';
    }
}









?>
<?php include 'inc/boot.php'; ?>

<body>

    <a href="index.php" style="margin-top:2px;" class=" ">الرجوع</a>

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="images/basrajobs.jpg" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php
                        if (isset($error)) {
                            echo @$error;
                        }
                        if (isset($empty)) {
                            echo @$empty;
                        }


                        ?>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" placeholder="اسم المستخدم">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" placeholder="كلمة المرور">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <input type="submit" name="enter" value="دخول" class="btn login_btn">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Coded with love by Mutiullah Samim */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;

        }

        .user_card {
            height: 400px;
            width: 350px;
            margin-top: auto;
            margin-bottom: auto;
            background: #60a3bc;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;

        }

        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 170px;
            top: -75px;
            border-radius: 50%;
            background: #60a3bc;
            padding: 10px;
            text-align: center;
        }

        .brand_logo {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .form_container {
            margin-top: 100px;
        }

        .login_btn {
            width: 100%;
            background: #c0392b !important;
            color: white !important;
        }

        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .login_container {
            padding: 0 2rem;
        }

        .input-group-text {
            background: #c0392b !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
        }

        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #c0392b !important;
        }
    </style>