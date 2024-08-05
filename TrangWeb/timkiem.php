<html >
<?php include 'dautrang.php' ?>
<body>
    <header id="logo" >       
        <img  src="img/logo1.png" alt="Logo">     
        <form action="timkiem.php" method="get" >
            <h2 class="search-bar"><input type="buton" name="find" placeholder="Tìm kiếm...">
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
    
      
        <article id="TimKiem">
        <table  class="NoiDung_Table">
        <h2> &nbsp;Kết quả tìm kiếm cho từ khóa: <?php echo $_GET['find']; ?></h2>
        <?php
        include 'ketnoi.php';
        $conn=MoKetNoi();
        mysqli_select_db($conn,"GHESOFA");
        $find = $_GET['find'];
        $truyvan="SELECT * FROM SANPHAM AS S, KIEUDANG AS K WHERE S.MAKD=K.MAKD AND (TENSP LIKE '%$find%' OR TENKD LIKE '%$find%')";
        $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
        $tongdong = mysqli_num_rows($ketqua);
        if ($tongdong == 0) {
            echo "<tr><td colspan='3'>Không tìm thấy kết quả nào.</td></tr>";
        } else {
            $row_count = 0;
            while ($dong = mysqli_fetch_array($ketqua)) {
                $row_count++;
                if ($row_count % 4 == 1) {
                    echo "<tr>";
                }
                echo "<td> <button type='button' name='btnXem' class='noidung'> <a href='xemnoidung.php?masach=".$dong['MASP']."'>  <img src='".$dong[ 'HINH']."'> <br> <br> ".$dong['TENSP']." </a>
                <p class='gia'> <br >  ".number_format($dong['GIABAN'], 3, ',','.')." đ <br> </p>  </button> <br><br>
                 <button type='button' name='btnXem' class='dathang'> <a href='xemnoidung.php?masach=".$dong['MASP']."'> Đặt Hàng Ngay </a> </button> </td>";
               
                if ($row_count % 4 == 0) {
                    echo "</tr>";
                }
            }
            if ($row_count % 4 != 1) {
                echo "</tr>";
            }
        }
            ?>
        </table>
    </article>
       
      <?php include 'cuoitrang.php' ?>
    </body>
</html>



