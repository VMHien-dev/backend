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
                mysqli_select_db($conn,'GHESOFA')
    ?>
        <form action="xemgiohangmuangay.php" method="post">
		<table class='banggiohang' align='center'>
        <?php
                
                if(isset($_POST['btnXoaMuaNgay']))
                {
                    echo "<p class='c6' align='center'>Bạn chưa chọn sách mua. Quay lại Trang chủ để chọn sách </p>";
                }
                else
                {
                echo "<caption class='thongtin'> THÔNG TIN GIỎ HÀNG </caption>";
                $truyvan="SELECT * FROM SANPHAM AS S, KICHTHUOC AS K, CHATLIEU AS C WHERE S.MASP='".$_SESSION['masach']."' AND 
                S.MAKT=K.MAKT AND S.MACL=C.MACL";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                $_SESSION['SL']=$_POST['txtSL'];
                $Tien=$_SESSION['SL'] * $dong['GIABAN'];
                if(empty($_POST['txtSL']))
                    { 
                        $_SESSION['SL'] =1; 
                        $Tien=$_SESSION['SL'] * $dong['GIABAN'];
                    }
                echo "<tr> <th> STT </th> <th colspan='2'> THÔNG TIN SẢN PHẨM </th> <th> Giá tiền </th> <th colspan='2'align='center'>Số lượng </th> <th class='tien'>Thành tiền </th> </tr>";
                echo "<tr> <td> 1 </td> <td > <img src='".$dong['HINH']."'></td> 
                           <td>".$dong['TENSP']." <br> <br> Màu Sắc :".$dong['MAUSAC']."  <br> <br> Kích Thước : ".$dong['TENKT']." </td>  
                           <td>".number_format($dong['GIABAN'], 3, ',','.')."đ </td> 
                           <td> <input  type='number' min='1'  oninput='validity.valid||(value='');' name='txtSL' value=".$_SESSION['SL']." > </td>
                            <td>    <button class='xoa' name='btnXoaMuaNgay'> Xóa Sách </button> </td>
                           <td> ".number_format($Tien , 3, ',','.')." đ </td>
                     </tr>";
                echo "<tr class='tien'> <td colspan='6'> Tổng tiền </td> <td>".number_format($Tien, 3, ',','.')." đ </td> </tr>";   
                echo "<tr > <td colspan='4' id='nut'><button class='thanhtoan' name='btnThanhToanMuaNgay'> Thanh toán </button> </td>
                           <td colspan='3' id='nut'> <input type='submit' class='thanhtoan' name='btnCapNhatMuaNgay' value='Cập nhật giỏ hàng'> </td> </tr>";
                
                if (isset($_POST['btnThanhToanMuaNgay']))
                    {
                        header('Location:chitietgiohangmuangay.php');
                    }  
                }
                ?>
		</table>
		</form>
    </article>
   
    <?php include 'cuoitrang.php' ?>
   
</body>
</html>