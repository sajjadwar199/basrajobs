<?php
/*
 الكلاس من برمجة سجاد عبد الكريم محسن 
*/
session_start();
class main    
{
    public $con;


    public
        $image;
    // auto connect  function to database
    public function connect()
    {

        $con = mysqli_connect("sql211.eb2a.com", "eb2a_23950498", "naroto1998", "eb2a_23950498_basrajob"); 
        if (!$con) {
            echo "لم يتم الاتصال";
        } else {
            echo "";
        }
        return $con;
    }
    //redirect the page
    public static function redir($page)

    {
        return header('location:' . $page . '.php');
    }
    //error massage function
    public static function error_massage()
    {
        if (isset($_SESSION['error_massage'])) {
            @$error = "<div style='text-align:right' class='alert alert-danger'>";
            @$error .= strip_tags($_SESSION['error_massage']);
            @$error .= '</div>';
        }
        $_SESSION['error_massage'] = null;

        return @$error;
    }
    //success massage function

    public static function success_message()
    {
        if (isset($_SESSION['success_message'])) {
            @$success = "<div style='text-align:right' class='alert alert-success'>";
            @$success .= strip_tags($_SESSION['success_message']);
            @$success .= '</div>';
        }
        $_SESSION['success_message'] = null;

        return @$success;
    }

    //query function 
    function query($sql)
    {
        $c = new main;
        $conn = $c->connect();
        $query = mysqli_query($conn, $sql);
        if (!$query) {

            $_SESSION['error_massage'] = 'هناك خطا في الاستعلام';
        } else {
            echo "";
        }
        return $query;
    }
    //fetch array of all information from database 
    public static function  fetch($q)
    {
        $row = mysqli_fetch_array($q);
        return $row;
    }
    //insert,delete,update,..
    public static function model($sql2, $alert = null, $page = null)
    {
        $c = new main;
        $conn = $c->connect();
        @$query = mysqli_query($conn, $sql2);
        if ($query and $alert != "" and $page != "") {
            echo "<script>alert('$alert')</script>";
            echo "<Script>window.open('$page','_self')</Script>";
        } else if ($alert != "" and $page != "") {
            echo "<script>alert('هناك خطا ')</script>";
            echo "<Script>window.open('$page','_self')</Script>";
        }
    }
    //function for upload images 
    function upload_image($image, $file_upload_to, $page)
    {
        $rand = substr(md5(uniqid(rand(), true)), 3, 10);
        if (isset($image)) {
            $image = $image;
        }
        $file_name = $_FILES["$image"]["name"];
        $file_tmp_name = $_FILES["$image"]["tmp_name"];
        $file_size = $_FILES["$image"]["size"];
        $file_type = $_FILES["$image"]["type"];
        $file_error = $_FILES["$image"]["error"];
        $folder = "$file_upload_to /";
        $path = $folder . $rand . $file_name;
        $tmp = explode('.', $file_name);
        $test_type = end($tmp);
        $type = array('jpeg', 'jpg', 'png', 'gif', 'jfif');

        if (in_array($test_type, $type) and $file_size < 1000000) {
            move_uploaded_file($file_tmp_name, $path);
            return $path;
        } else {
            echo "<script>alert(' لرجاء اضافة صورة بصيغة مدعومة اقل من 1 ميغا بايت!لم تتم اضافة ')</script>";
            echo "<Script>window.open('$page','_self')</Script>";
        }
    }



    //arabic function ago 


    function arabic_date_format($timestamp)
    {
        $periods = array(
            "second"  => "ثانية",
            "seconds" => "ثواني",
            "minute"  => "دقيقة",
            "minutes" => "دقائق",
            "hour"    => "ساعة",
            "hours"   => "ساعات",
            "day"     => "يوم",
            "days"    => "أيام",
            "month"   => "شهر",
            "months"  => "شهور",
        );

        $difference = (int) abs(time() - $timestamp);

        $plural = array(3, 4, 5, 6, 7, 8, 9, 10);

        $readable_date = "منذ ";

        if ($difference < 60) // less than a minute
        {
            $readable_date .= $difference . " ";
            if (in_array($difference, $plural)) {
                $readable_date .= $periods["seconds"];
            } else {
                $readable_date .= $periods["second"];
            }
        } elseif ($difference < (60 * 60)) // less than an hour
        {
            $diff = (int) ($difference / 60);
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["minutes"];
            } else {
                $readable_date .= $periods["minute"];
            }
        } elseif ($difference < (24 * 60 * 60)) // less than a day
        {
            $diff = (int) ($difference / (60 * 60));
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["hours"];
            } else {
                $readable_date .= $periods["hour"];
            }
        } elseif ($difference < (30 * 24 * 60 * 60)) // less than a month
        {
            $diff = (int) ($difference / (24 * 60 * 60));
            $readable_date .= $diff . " ";
            if (in_array($diff, $plural)) {
                $readable_date .= $periods["days"];
            } else {
                $readable_date .= $periods["day"];
            }
        } elseif ($difference < (365 * 24 * 60 * 60)) // less than a year
        {
            $diff = (int) ($difference / (30 * 24 * 60 * 60));
            $readable_date .= $diff . " ";

            if (in_array($diff, $plural)) {
                $readable_date .= $periods["months"];
            } else {
                $readable_date .= $periods["month"];
            }
        } else {
            $readable_date = date("d-m-Y", $timestamp);
        }

        return $readable_date;
    }


    //  دالة توليد ملفات الرفع اوتماتيكيا
    function create_upload_file($folder_name)
    {
        if (!is_dir($folder_name)) {
            mkdir($folder_name);
        }
    }
    public  static function number_query($q)
    {
        $num = mysqli_num_rows($q);
        return $num;
    }

    //دالة لحذف الملفات 
    public static function delete_file($url)
    {

        $filename = dirname(__FILE__) . "$url";
        chmod($filename, 0777);
        unlink($filename);
    }



    // main parination 
    public static function pagination($query, $per_page = 10, $page = 1, $url = '?')
    {
        $c = new main;
        $conn = $c->connect();

        $query = "SELECT COUNT(*) as `num` FROM {$query}";
        $row = mysqli_fetch_array(mysqli_query($conn, $query));
        $total = $row['num'];
        $adjacents = "3";

        $prevlabel = "&lsaquo; السابق";
        $nextlabel = "التالي &rsaquo;";
        $lastlabel = "الاخيرة &rsaquo;&rsaquo;";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $lastpage = ceil($total / $per_page);

        $lpm1 = $lastpage - 1; // //last page minus 1

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination'>";
            $pagination .= "<li class='page_info'>صفحة {$page} من {$lastpage}</li>";

            if ($page > 1) $pagination .= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {

                if ($page < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='dot'>...</li>";
                    $pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $pagination .= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination .= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='dot'>..</li>";
                    $pagination .= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";
                } else {

                    $pagination .= "<li><a href='{$url}page=1'>1</a></li>";
                    $pagination .= "<li><a href='{$url}page=2'>2</a></li>";
                    $pagination .= "<li class='dot'>..</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li><a class='current'>{$counter}</a></li>";
                        else
                            $pagination .= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $pagination .= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination .= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }

            $pagination .= "</ul>";
        }

        return $pagination;
    }
    //parination use
    public static function paginationshow($per_page, $statement, $u = null, $loop = null)
    {

        $c = new main;
        $conn = $c->connect();

        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        if ($page <= 0) $page = 1;

        //$per_page = 1; // Set how many records do you want to display per page.

        $startpoint = ($page * $per_page) - $per_page;

        // $statement = "`ad` "; // Change `records` according to your table name.

        $results = mysqli_query($conn, "SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");

        if (mysqli_num_rows($results) != 0) {

            // displaying records.


            while ($row = mysqli_fetch_object($results)) {


                // PHP code to get the MAC address of Client 
             

            $id = $row->id;
               


               

                    mysqli_query($c->connect(), "UPDATE ad SET views =views +1 where id=$id");
                















?>


                <div class="box" style="display: none; style=" border-left: 5px solid rgb(77,114,160);">

                    <div class="plan-selection" style="text-align:center;">

                        <div class="plan-data" > 

                            <h5 align="right"><label for="question1"><?php echo $row->title; ?> </label></h5>
                            <p class="plan-text">
                                تاريخ الاضافة :<?php echo $row->date; ?></p><br> اخر تحديث :<?php $a = new main;
                                                                                            echo $a->arabic_date_format($row->date_ago); ?> </p>
                            <span class="plan-price"></span>



                        </div>
                        <?php
                        if (strlen($row->ad_post) >= 0 and  strlen($row->ad_post) <= 150) {

                            $flag = true;
                        } else {
                            $flag = false;
                        }
                        ?>
                        <?php
                        if ($flag == true) {
                        ?>
                            <h4> <span><?php echo $row->ad_post; ?></span></h4>
                        <?php
                        }

                        ?>

                        <?php
                        if ($flag == false) {


                        ?>

                            <h3 style="overflow: auto;"> <span class='dotdot'> <?php echo substr($row->ad_post, 0, 150); ?>...</span><span class='readmore'><?php echo $row->ad_post; ?></span><a class='clickmore' style="color:red; cursor: pointer;"> عرض المزيد </a></h3>
                        <?php
                        }
                        ?>
                        <i class="fas fa-eye"></i> <?php







                                                    echo $row->views;





                                                    ?> مشاهدة

                    </div>

                </div>

        <?php





            }
        } else {
            echo "<div class='alert alert-warning'>لا توجد اي بيانات</div>";
        }
        ?>
        
           <Style>
            .box {
                display: none;
              
            }
        </style>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
           $(document).ready(function() {
               
                $('.box').show('1000');
                $(".readmore").hide();
                $(".clickmore").click(function() {
                    $(this).prev().prev(".dotdot").hide(); //<<<<<<<<<<<<<<<
                    $(this).prev(".readmore").slideDown('slow'); //<<<<<<<<<<<<<<<
                    $(this).hide();

                });
            });
        </script>


<?php



        echo '
        <Style>
ul.pagination {
	text-align:center;
	color:#829994;
}
ul.pagination li {
	display:inline;
	padding:0 3px;
}
ul.pagination a {
	color:rgb(77,114,160);
	display:inline-block;
	padding:5px 10px;
	border:1px solid #cde0dc;
	text-decoration:none;
}
ul.pagination a:hover, 
ul.pagination a.current {
	background:rgb(77,114,160);
	color:#fff; 
}
        
        </Style>
        
        
        ';
        // displaying paginaiton.
        echo $c->pagination($statement, $per_page, $page, $url = "?{$u}");
    }
};