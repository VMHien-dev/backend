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
           <?php  session_start();
                    if(isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'])
                    {
                        echo "<li class='menu1'> <a class='text' > Xin chào bạn ".$_SESSION['tendangnhap']." </a> </li>";
                    }
         ?>
    </ul> 
   
    <article id="giohang">
       
		<?php
			include 'ketnoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"GHESOFA");		   
		?>
		<form action="" method="post">
		<table class='banggiohang' align='center'>
        <?php
                
                $n=sizeof($_SESSION['DSMaMua']);
                if($n==0)
                {
                    echo "<p class='c6' align='center'> Bạn chưa chọn sách để mua </p>";
                }
                else
                {
                    echo"<caption class='thongtin'> THÔNG TIN GIỎ HÀNG </caption>";
                    echo "<tr> <th> STT </th> <th colspan='2' align='center'> Thông tin sách mua </th> <th> Giá tiền </th> <th colspan='2'align='center'>Số lượng </th> <th>Thành tiền </th> </tr>";
                    $TongTien=0;
                    for($i=0;$i<$n;$i++)
                    {
                        $truyvan="SELECT * FROM SANPHAM AS S, KICHTHUOC AS K, CHATLIEU AS C WHERE S.MASP='".$_SESSION['DSMaMua'][$i]."' AND 
                        S.MAKT=K.MAKT AND S.MACL=C.MACL";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    if(isset($_POST['txtSL'][$i]))
                    {
                        $_SESSION['DSSL'][$i]=$_POST['txtSL'][$i];
                    }    
                    $Tien=$_SESSION['DSSL'][$i] * $dong['GIABAN'];
                    $TongTien+=$Tien;                             
                    echo "<tr> <td align='center'>".($i+1)." </td> <td > <img src='".$dong['HINH']."'></td> 
                    <td>".$dong['TENSP']." <br> <br> Màu Sắc :".$dong['MAUSAC']."  <br> <br> Kích Thước : ".$dong['TENKT']." </td>  
                    <td>".number_format($dong['GIABAN'], 3, ',','.')."đ </td> 
                    <td> <input  type='number' min='1'  oninput='validity.valid||(value='');' name='txtSL[".$i."]' value=".$_SESSION['DSSL'][$i]." > </td>
                     <td>    <button class='xoa' name='btnXoa[".$i."]'> Xóa Sản Phẩm </button> </td>
                    <td> ".number_format($Tien , 3, ',','.')." đ </td>
                      </tr>";        
                    if(isset($_POST['btnXoa'][$i]))
                    {
                          for($j=$i;$j<$n-1;$j++)
                          {
                            $_SESSION['DSMaMua'][$j]=$_SESSION['DSMaMua'][$j+1];
                            $_SESSION['DSSL'][$j]=$_SESSION['DSSL'][$j+1];
                          }
                          array_pop($_SESSION['DSMaMua']);
                          array_pop($_SESSION['DSSL']);
                          header('Location:giohang.php');
                    }
                    }
                    echo "<tr class='tien'> <td colspan='6'> Tổng tiền </td> <td>".number_format($TongTien, 3, ',','.')." đ </td> </tr>";   
                    echo "<tr > <td colspan='4' id='nut'><button class='thanhtoan' name='btnThanhToanMuaNgay'> <a href='chitietgiohang.php'> Thanh toán </a> </button> </td>
                               <td colspan='3' id='nut'> <input type='submit' class='thanhtoan' name='btnCapNhatMuaNgay' value='Cập nhật giỏ hàng'> </td> </tr>";
                }
                ?>
		</table>
		</form>


        </article>
       
      <?php include 'cuoitrang.php' ?>
    </body>
</html>