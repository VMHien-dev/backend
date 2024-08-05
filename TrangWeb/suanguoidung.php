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
                    }?>
                    </ul>
                </nav>
        <article id="nguoidung">
       
		<?php
			include 'ketnoi.php';
			$conn=MoKetNoi();
            mysqli_select_db($conn,"GHESOFA");		   
		?>
		<form action="suanguoidung.php" method="post">
		<table class='thanhtoangiohang' align='center'>
        <caption class="thongtin"> CHI TIẾT HÓA ĐƠN MUA SẢN PHẨM</caption>
        <?php
            error_reporting(0);
            if($_SESSION['kt']!=0)
            {
                echo "<p class='ten'> Đã sửa thành công thông tin người dùng </p>";
            }
            $_SESSION['kt']=0;
            echo"<caption> THÔNG TIN NGƯỜI DÙNG </caption>";
            echo "<tr> <th> STT </th> <th> Tên đăng nhập </th> <th> Mật khẩu </th> <th>Họ tên người dùng </th> 
                       <th>Địa chỉ </th> <th>Số điện thoại </th> <th>Email</th> <th>Phân loại</th> </tr>";
            $n=sizeof($_SESSION['tensua']);
            for($i=0;$i<$n;$i++)
            {
                $truyvan="SELECT * FROM NGUOIDUNG WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td align='center'>".($i+1)." </td> <td > ".$dong['TENDANGNHAP']."  </td> 
                      <td> <input type='text' name= 'txtMK[".$i."]' value=".$dong['MATKHAU']." > </td> 
                      <td> <input type='text' name= 'txtHT[".$i."]' value=".$dong['HOTEN']." > </td> 
                      <td> <input type='text' name= 'txtDC[".$i."]' value=".$dong['DIACHI']." > </td> 
                      <td> ".$dong['SODT']." </td>
                      <td> <input type='text' name= 'txtM[".$i."]' value=".$dong['EMAIL']." > </td> 
                      <td> <select name='cboLoai[".$i."]'> <option value='user'> user </option>
                                                    <option value='admin'> admin </option>
                           </select> </td>
                      </tr>" ;
            }
            echo "<tr > <td colspan='4' id='c9'> <input class='them' type= 'submit' name= 'sbtDongY' value= 'Đồng ý' >  </td>
            <td colspan='4' id='c9'> <button class='them' name='btnThoat'> Quay lại Quản lý người dùng </button> </td> </tr>";
            
            if(isset($_POST['sbtDongY']))
            {
                for($i=0;$i<$n;$i++)
                {
                    $truyvan="UPDATE NGUOIDUNG 
                              SET MATKHAU='".$_POST['txtMK'][$i]."', HOTEN='".$_POST['txtHT'][$i]."', 
                                  DIACHI='".$_POST['txtDC'][$i]."', EMAIL='".$_POST['txtM'][$i]."', 
                                  PHANLOAI ='".$_POST['cboLoai'][$i]."'
                              WHERE TENDANGNHAP='".$_SESSION['tensua'][$i]."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                }
                $kq= mysqli_affected_rows($conn);
                if($kq!=0)
                {
                    $_SESSION['kt']=1;
                }
                header('Location: suanguoidung.php');
            }
            if(isset($_POST['btnThoat']))
                header('Location:quanlynguoidung.php');
        ?>
		</table>
		</form>


        </article>
       
      <?php include 'cuoitrang.php' ?>
    </body>
</html>