<html >
<?php include 'dautrang.php' ?>
<body>
    <header id="logo" >       
        <img  src="img/logo1.png" alt="Logo">     
        <form action="" method="get" >
            <h2 class="search-bar"><input type="text" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit"><i class="material-icons">search</i></button> </h2> 
            </form>
            <!-- <h1 class="hotline"> <button type="button"><i class="fa-solid fa-phone-volume"></i> &nbsp; &nbsp; 0987.123.456</button></h1>
    </header> -->
    <nav id="nav">
        <ul class="thanhmenu">
           <b> <li><a class="b1" href="trangchu.php">  TRANG CHỦ   </a></li>
           <?php  session_start();
                    if(isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'])
                    {
                        echo "<li class='menu1'> <a class='text' > Xin chào bạn ".$_SESSION['tendangnhap']." </a> </li>";
                    }?>
                    </ul>
             
    
    <article id="muahang">
    <?php
                include 'ketnoi.php';
                $conn=MoKetNoi();
                mysqli_select_db($conn,'GHESOFA')
            ?>
            <form action="xemgiohangmuangay.php" method="post">   
		<table class='thanhtoangiohang' align='center'>
        <caption class="thongtin"> CHI TIẾT HÓA ĐƠN SẢN PHẨM </caption>
			<?php
               
               $truyvan="SELECT * FROM SANPHAM AS S, KICHTHUOC AS K, CHATLIEU AS C WHERE S.MASP='".$_SESSION['masach']."' AND 
               S.MAKT=K.MAKT AND S.MACL=C.MACL";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                
                $Tien=$_SESSION['SL'] * $dong['GIABAN'];
                $TongTien=$Tien;
                echo "<tr> <th> STT </th> <th colspan='2' align='center'> Thông tin sản phẩm </th> <th> Giá tiền </th> <th>Số lượng </th> <th class='tientt'>Thành tiền </th> </tr>";
                echo "<tr> <td> 1 </td> <td > <img src='".$dong['HINH']."'></td> 
                <td>".$dong['TENSP']." <br> <br> Màu Sắc :".$dong['MAUSAC']."  <br> <br> Kích Thước : ".$dong['TENKT']." </td>  
                           <td>".number_format($dong['GIABAN'], 3, ',','.')."đ </td> 
                           <td align='center'> ".$_SESSION['SL']." </td>
                           <td> ".number_format($Tien, 3, ',','.')."đ </td>
                     </tr>";         
                echo "<tr> <td colspan='5' align='center'> Tổng tiền </td> <td>".number_format($TongTien, 3, ',','.')."đ </td> </tr>";   
                echo "<tr> <td colspan='6' id='c9'> <br> <br>Cám ơn bạn đã mua sản phẩm !!! </td>"; 
                
            ?>  
		</table>
		</form>

    </article>
  
    <?php include 'cuoitrang.php' ?>

</body>
</html>