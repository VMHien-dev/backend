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
  
    <article id="NoiDungSP">
    <?php include 'menutrai.php' ?>
    <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'GHESOFA')
            ?>

            <form action="" method="post">         
            <table class="noidungsp">
			<?php	
			$_SESSION['masach']=$_GET['masach'];
            $truyvan="SELECT * FROM SANPHAM AS S, KICHTHUOC AS K, CHATLIEU AS C WHERE S.MASP='".$_SESSION['masach']."' AND 
                      S.MAKT=K.MAKT AND S.MACL=C.MACL";
            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
            $dong=mysqli_fetch_array($ketqua);
         
            echo "<tr > <td rowspan='5' id='anh'> <img src='".$dong['HINH']."'></td>  </tr>";
            echo "<tr> <td class='chu'>".$dong['TENSP']."<br>
            <a class='giaban'> Giá bán :".number_format($dong['GIABAN'], 3, ',','.')."đ  <br> <br></a>
            <a class='gt'> Màu Sắc :".$dong['MAUSAC']." (Theo Yêu Cầu)<br><Br>
             Chất Liệu :".$dong['TENCL']." <Br><Br>
            Kích Thước : ".$dong['TENKT']." <br><Br>
             Miễn Phí: Tư vấn thiết kế và lắp đặt
            Miễn Phí: Vận chuyển với đơn hàng trên 10 Triệu với các Quận nội thành Hà Nội.           
            (Hỗ Trợ Vận Chuyển Các Tỉnh Trong Nước)     
            Giá chưa có VAT, vui lòng + 8% nếu có nhu cầu <br><Br></a> </td> </tr>";
            if(!isset($_SESSION['tendangnhap']))
            {
                echo " Đăng nhập để mua sản phẩm ";
            }
            else
            {
                if($_SESSION['loainguoidung']=='user')
                {
                    echo "<tr> <td> <button class='muangay1' name='btnThemGioHang' > Thêm vào giỏ hàng </button> 
                     <button class='muangay2' name='btnMuaSach'><a href='xemgiohangmuangay.php'>Mua ngay </a></button> </td> </tr>";
                   
                              
                              $n=sizeof($_SESSION['DSMaMua']);
                              if(isset($_POST['btnThemGioHang']))
                              {
                                  if($n==0)
                                  {
                                      array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                      array_push($_SESSION['DSSL'],1);
                                  }
                                  else
                                  {
                                      $kt=0;
                                      $i=0;
                                      while($kt==0 && $i<$n)
                                      {
                                          if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASP'])==0)
                                              $kt=1; 
                                          else
                                              $i++;
                                      }
                                      if($kt==0)
                                      {
                                          array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                          array_push($_SESSION['DSSL'],1);
                                          echo "<p class='c6'> Bạn đã thêm ".$dong['TENSP']. " vào giỏ hàng. Quay lại Trang chủ để tiếp tục mua sách </p>";
                                      }
                                      else
                                      {
                                          echo "<p class='c6'> Đã có ".$dong['TENSP']. " trong giỏ hàng. Quay lại Trang chủ để tiếp tục mua sách </p>";
                                          
                                      }
                                  }
                              }
                          
                }    
            }
           
		   ?>    
		</table>
            </form>

    </article>
    <?php include 'cuoitrang.php' ?>

</body>
</html>