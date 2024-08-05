<html >
<?php include 'dautrang.php' ?>
<body>
    <header id="logo" >       
        <img  src="img/logo1.png" alt="Logo">     
        <form action="timkiem.php" method="get" >
            <h2 class="search-bar"><input type="buton" name="find" placeholder="Tìm kiếm...">
                <button type="submit"><i class="material-icons">search</i></button> </h2> 
            </form>
            
            <!-- <h1 class="hotline"> <button type="button" ><i class="fa-solid fa-phone-volume"></i> &nbsp; &nbsp; 0987.123.456</button></h1> -->
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
    
    <article id="NoiDung">
    <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'GHESOFA')
            ?>
            <form action="xemthem.php" method="post">
            <table class="xem">
                    <?php
                        $truyvan1="SELECT * FROM KIEUDANG ";
                        $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                        $tongdong1 = mysqli_num_rows($ketqua1);
                        for($i=1;$i<=$tongdong1;$i++)
                        {
                            $dong1=mysqli_fetch_array($ketqua1);  
                            $truyvan="SELECT * FROM SANPHAM AS S, KIEUDANG AS K WHERE S.MAKD=K.MAKD AND TENKD='".$dong1['TENKD']."'";
                            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn)); 
                            for ($j=1;$j<=1;$j++)
                            {
                                $dong=mysqli_fetch_array($ketqua);
                                echo "<td><button type='button' name='' class='noidung' >   <img src='".$dong[ 'HINH']."'> <br><br> <input type='submit' name='btnXemThem' class='tenkd'  value='".$dong1['TENKD']."'>  </button> </td>";                               
                            }
                       }
                    ?>
                </table>
                <p class="hline">  </p>
                <img src="img/banner.jpg">
                
                <table class="NoiDung_Table">
                    <?php
                        $truyvan1="SELECT * FROM KIEUDANG ";
                        $ketqua1 = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                        $tongdong1 = mysqli_num_rows($ketqua1);
                        for($i=1;$i<=$tongdong1;$i++)
                        {
                            $dong1=mysqli_fetch_array($ketqua1);
                            echo "<tr><strong><td colspan='4' class='tensp'>".$dong1['TENKD'] ."<p class='hline'></p></td></strong></tr>";
                            $truyvan="SELECT * FROM SANPHAM AS S, KIEUDANG AS K WHERE S.MAKD=K.MAKD AND TENKD='".$dong1['TENKD']."'";
                            $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                            echo "<tr>";
                            for ($j=1;$j<=4;$j++)
                            {
                                $dong=mysqli_fetch_array($ketqua);
                                echo "<td> <button type='button' name='btnXem' class='noidung'> <a href='xemnoidung.php?masach=".$dong['MASP']."'>  <img src='".$dong[ 'HINH']."'> <br> <br> ".$dong['TENSP']." </a>
                               <p class='gia'> <br >  ".number_format($dong['GIABAN'], 3, ',','.')." đ <br> </p>  </button> <br><br>
                                <button type='button' name='btnXem' class='dathang'> <a href='xemnoidung.php?masach=".$dong['MASP']."'> Đặt Hàng Ngay </a> </button> </td>";
                              
                            }                           
                        }
                    ?>
                </table>
            </form>

    </article>
  
    <?php include 'cuoitrang.php' ?>

</body>
</html>