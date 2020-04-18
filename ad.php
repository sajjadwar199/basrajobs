<?php include 'sesstion/sesstion.php';
include 'class/main_class.php';


?>
<?php
$crude = new main;
@$id = intval($_GET['id']);
@$del_id = intval($_GET['delete_id']);
$date = date('d/m/Y g:i A ');
$date_ago = time();
if (!isset($_GET['id'])) {

    //insert data part
    if (isset($_POST['title']) and isset($_POST['ad_post'])) {
        $title =      htmlentities($_POST['title']);
        $ad =  htmlentities($_POST['ad_post']);
    }
    $action = $_SERVER['PHP_SELF'];
    $method = 'post';
    if (isset($_POST['add'])) {
        if ($title != '' and $ad != '') {
            $crude->model("INSERT INTO `ad`( `title`, `ad_post`, `date`, `date_ago`,`views`) VALUES ('$title','$ad','$date','$date_ago','0')", 'تمت اضافة الاعلان بنجاح', $_SERVER['PHP_SELF']);
        } else {
            $error = '<Div class="alert alert-danger" style="text-align:center;"> لا تترك الحقول فارغة لم تتم الاضافة</Div>';
        }
    }

    //end insert data part
} else if (isset($_GET['id'])) {

    //edit data part
    if (isset($_POST['title']) and isset($_POST['ad_post'])) {
        $title =  htmlentities($_POST['title']);
        $ad =  htmlentities($_POST['ad_post']);
    }
    $action = $_SERVER['PHP_SELF'] . '?id=' . $id;
    $method = 'post';
    if (isset($_POST['edit'])) {
        if ($title != '' and $ad != '') {
            $crude->model("UPDATE `ad` SET `title`='$title',`ad_post`='$ad',`date_ago`=$date_ago WHERE id=$id", 'تم التعديل الاعلان بنجاح', $_SERVER['PHP_SELF'] . '?id=' . $id);
        } else {
            $error = '<Div class="alert alert-danger" style="text-align:center;"> لا تترك الحقول فارغة لم يتم  التعديل</Div>';
        }
    }

    //end edit data part
}
if (isset($_GET['delete_id'])) {

    $crude->model("delete from ad where id='$del_id'", 'تم حذف الاعلان بنجاح', $_SERVER['PHP_SELF']);
    //delete data part

    //end delete data part

}


?>
<html>

<head>
    <?php include 'inc/boot.php'; ?>
    <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Amiri',
                serif;
        }
    </style>
</head>

<body style="background-color:#d2dae2;">
    <!--nav part-->

    <nav class="navbar navbar-expand-lg navbar- bg-" style="background-color: rgb(77,114,160);">
        <a class="navbar-brand" href="ad" style="color: white;">لوحة التحكم </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

        </div>
    </nav>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb"><a href="index.php"> <i style="color:#4b6584" class="fas fa-home"> الرئيسية</i></a></li>
            <li class="breadcrumb"><a href="show.php"><i style="color:#4b6584" class="fas fa-ad"> تصفح الاعلانات</i> </a></li>
            <li class="breadcrumb"><a href="signout.php"><i style="color:#4b6584" class="fas fa-sign-out-alt"> تسجيل الخروج</i> </a></li>


        </ol>
    </nav>
    <!--end nav part-->
    <!--table side part-->
    <?php
    $ad = new main;
    echo  $ad->success_message();
    if (isset($error)) {
        echo $error;
    }



    ?>
    <Div class="container">
        <Div class="row">
            <div class=" col-lg-4    right ">
                <table id="sailorTable" class="table table-striped  table-dark">
                    <thead>
                        <tr>

                            <th>التسلسل</th>
                            <th>العنوان </th>

                            <th>تاريخ الاضافة </th>
                            <th>عرض </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $q = $crude->query("select * from ad order by id desc");


                        while ($row = $crude->fetch($q)) {




                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo   @$row['id']; ?></td>
                                <td style="text-align:center;"><?php echo   @$row['title']; ?></td>

                                <td style="text-align:center;"><?php echo   @$row['date']; ?></td>
                                <td style="text-align:center;"><a href="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $row['id']; ?>"><i class="fas fa-eye"></i></a></td>

                            </tr>
                        <?php
                        }

                        ?>



                    </tbody>
                </table>



                <style>
                    #sailorTableArea {
                        max-height: 100px;
                        overflow-x: auto;
                        overflow-y: auto;
                    }

                    #sailorTable {
                        white-space: normal;
                    }

                    tbody {
                        display: block;
                        height: 400px;
                        overflow: auto;
                    }

                    thead,
                    tbody tr {
                        display: table;
                        width: 100%;
                        table-layout: fixed;
                    }
                </style>





            </div>
            <div class=" col-lg-8  left" style="">

                <a href="ad.php" class="btn btn-info" style="">اعادة تشغيل الصفحة</a>

                <form action="<?php if (isset($action)) {
                                    echo @$action;
                                } ?> " method="<?php if (isset($method)) {
                                                    echo @$method;
                                                } ?>">
                    <?php
                    if (isset($id)) {


                        $q = $crude->query("select * from ad where id='$id'");
                        while ($row = $crude->fetch($q)) {
                            $tit = $row['title'];
                            $add = $row['ad_post'];
                            $idd = $row['id'];
                        }
                    }

                    ?>

                    <div class=" form-group">
                        <label for=""></label>
                        <input type="text" value="<?php echo @$tit;   ?>" class="form-control" name="title" aria-describedby="helpId" placeholder=" العنوان">

                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <textarea class="form-control" name="ad_post" rows="3" style="min-height: 300px;" placeholder="الاعلان"><?php echo @$add;   ?></textarea>
                    </div>
                    <Div class="row" style="margin-right:10%;">
                        <input name="add" class="btn btn-primary" type="submit" style="margin:1%;" value="اضافة">
                        <br>
                        <?php if (isset($_GET['id'])) {
                        ?>
                            <input name="edit" class="btn btn-success" type="submit" style="margin:1%;" value="تعديل">

                            <a onclick="return confirm('هل انت متاكد من الحذف?')" class="btn btn-danger" href='ad.php?delete_id=<?php echo @$idd; ?>' style="margin:1%;">حذف</a>
                        <?php } ?>
                    </Div>
                </form>
            </div>
        </Div>
    </Div>
    <!--end table side part-->
    <Style>
        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }
    </Style>
</body>

</html>