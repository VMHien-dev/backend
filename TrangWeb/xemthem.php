<html >
<?php include 'dautrang.php' ?>
<body>
    <header id="logo" >       
        <img  src="img/logo1.png" alt="Logo">     
        <form action="" method="get" >
            <h2 class="search-bar"><input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit"><i class="material-icons">search</i></button> </h2> 
            </form>
            <!-- <h1 class="hotline"> <button type="button"><i class="fa-solid fa-phone-volume"></i> &nbsp; &nbsp; 0987.123.456</button></h1> -->
    </header>
    <nav id="nav">
        <ul class="thanhmenu">
           <b> <li><a class="b1" href="trangchu.php">  TRANG CHỦ   </a></li>
             <li><a class="b1" href="#">  GIỚI THIỆU   </a>  </li>
             <li><a class="b1" href="#">  SẢN PHẨM NỘI THẤT    </a></li>
             <li><a class="b1" href="#"> GHẾ SOFA   </a>
             <ul >
                 <a  href="#">  GHẾ SOFA GÓC L </a>
                 <a  href="#"> GHẾ SOFA DA </a>
                 <a  href="#"> GHẾ SOFA NỈ </a>
                 <a  href="#"> GHẾ SOFA GIƯỜNG </a>
                 </li>
             </ul>
             <li><a class="b1" href="#"> TIN TỨC </a></li>
             <li><a class="b1" href="#"> LIÊN HỆ   </a></li>
             <?php include 'menuchinh.php' ?>
     </nav>
     <?php include 'menuphai.php' ?>
    <article id="xemthem">
    <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'GHESOFA')
            ?>
            <form action="xemthem.php" method="post">
                <table class="NoiDung_Table">
                    <?php
                       function HienThiSach($ketqua)
                       {
                        for($i=1;$i<=3;$i++)
                        {
                            echo "<tr>";
                            for($j=1;$j<=3;$j++)
                            {
                                $noidung=mysqli_fetch_array($ketqua);
                                if(isset($noidung)){
                                    echo "<td> <button type='button' name='btnXem' class='noidung'>  <a href='xemnoidung.php?masach=".$noidung['MASP']."'>  <img src='".$noidung[ 'HINH']."'> <br> <br> ".$noidung['TENSP']." </a>
                                    <p class='gia'> <br >  ".number_format($noidung['GIABAN'], 3, ',','.')." đ <br></p> </button><br><Br>
                                     <button type='button' name='btnXem' class='dathang'> <a href='xemnoidung.php?masach=".$noidung['MASP']."'> Đặt Hàng Ngay </a> </button> </td>";
                                }
                             
                            }
                            echo "</tr>";
                        }
                    }
                        
                    if(isset($_POST["btnXemThem"]))
                    {
                        $_SESSION['theloai']=$_POST["btnXemThem"];
                    }
                    echo " <caption class='tensp'>  ".$_SESSION['theloai']."</caption>";

                    $truyvan="SELECT * FROM SANPHAM AS S, KIEUDANG AS K WHERE S.MAKD=K.MAKD AND TENKD='".$_SESSION['theloai']."'";
                    $ketqua=mysqli_query($conn,$truyvan) or die (mysqli_error($conn));
                    $sl = mysqli_num_rows($ketqua);
                    $sodong=$sl/3;

                    if($sodong<=3)
                    {
                        HienThiSach($ketqua);
                    }

                       else
                       {
                        $tongdong = mysqli_num_rows($ketqua);
                        $tranghientai = isset($_GET['trang']) ? $_GET['trang'] : 1;
                        $soluong = 9;
                        $tongsotrang = ceil($tongdong / $soluong);
                        if($tranghientai > $tongsotrang)
                        {
                            $tranghientai = $tongsotrang;
                        }
                        else if ($tranghientai < 1)
                        {
                            $current_page = 1;
                        }
                        $batdau = ($tranghientai - 1) * $soluong;
                        $truyvan="SELECT * FROM SANPHAM AS S, KIEUDANG AS K WHERE S.MAKD=K.MAKD AND TENKD='".$_SESSION['theloai']."'"."LIMIT $batdau,$soluong";
                        $ketqua =mysqli_query($conn,$truyvan) or die (mysqli_error($conn));
                        HienThiSach($ketqua);
                       
                    ?>

                    <?php 
                    if($tranghientai > 1 && $tongsotrang > 1 )
                    {
                        echo '<a href="trangchu.php?trang='.($tranghientai-1).'"> Qua Trang Trước </a> | ';
                    }
                    for($i = 1;$i <= $tongsotrang;$i++)
                    {
                        if($i == $tranghientai)
                        {
                            echo '<span>'.$i.'</span> | ';
                        }
                        else
                        {
                            echo '<a href="xemthem.php?trang='.$i.'">'.$i.'</a> | ';
                        }

                    }
                    if($tranghientai < $tongsotrang && $tongsotrang > 1)
                    {
                        echo '<a href="xemthem.php?trang='.($tranghientai+1).'"> Qua trang tiếp theo </a>';
                    }
                } 
                    ?>
                </table>
            </form>

    </article>
  
    <?php include 'cuoitrang.php' ?>

</body>
</html>