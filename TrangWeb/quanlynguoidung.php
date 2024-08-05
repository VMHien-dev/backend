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
		<form action="quanlynguoidung.php" method="post">
		<table class='thanhtoangiohang' align='center'>
        <caption class="thongtin"> CHI TIẾT HÓA ĐƠN MUA SẢN PHẨM </caption>
        <?php
            
            echo"<caption> THÔNG TIN NGƯỜI DÙNG </caption>";
            echo "<tr> <th> STT </th> <th> Tên đăng nhập </th> <th> Mật khẩu </th> <th>Họ tên người dùng </th> 
                       <th>Địa chỉ </th> <th>Số điện thoại </th> <th>Email</th> <th>Phân loại</th>
                       <th align='center'>Chọn xóa/sửa</th> </tr>";
            $truyvan="SELECT * FROM NGUOIDUNG";
            $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
            $tongdong = mysqli_num_rows($ketqua);
            $ten=array();
            for($i=0;$i<$tongdong;$i++)
            {
                $dong=mysqli_fetch_array($ketqua);
                echo "<tr> <td align='center'>".($i+1)." </td> <td >".$dong['TENDANGNHAP']."</td> 
                      <td>".$dong['MATKHAU']."</td> <td>".$dong['HOTEN']."</td> <td>".$dong['DIACHI']."</td> 
                      <td>".$dong['SODT']."</td><td>".$dong['EMAIL']."</td> <td>".$dong['PHANLOAI']."</td> 
                      <td > <input type= 'checkbox' name= 'chkChon[".$i."]'> </td> </tr>" ;
                if(isset($_POST['chkChon'][$i]))
                {
                    array_push($ten,$dong['TENDANGNHAP']);
                }
            }
            echo "<tr > <td colspan='3' id='c9'> <button class='them' name='btnThem'> Thêm người dùng </button> </td>
                        <td colspan='3' id='c9'> <button class='them' name='btnXoa'> Xóa người dùng</button> </td>
                        <td colspan='3' id='c9'> <button class='them' name='btnSua'> Sửa thông tin </button> </td>
                 </tr>";  
            if(isset($_POST['btnThem']))
                header('Location: themnguoidung.php');
            if(isset($_POST['btnXoa']))
            {
                $sodongxoa=sizeof($ten);
                if($sodongxoa!=0)
                {
                    for($i=0;$i<$sodongxoa;$i++)
                    {
                        $truyvanxoa="DELETE FROM NGUOIDUNG WHERE TENDANGNHAP='".$ten[$i]."' ";
                        $ketquaxoa = mysqli_query($conn,$truyvanxoa) or die (mysqli_error($conn));
                        header('Location: quanlynguoidung.php');
                    }
                }
                if(!isset($_POST['chkChon']))
                {
                    echo "<p class='c6'>Bạn chưa chọn người dùng để xóa </p>";
                }
            }
            if(isset($_POST['btnSua']))
            {
                if(!isset($_POST['chkChon']))
                {
                    echo "<p class='c6'>Bạn chưa chọn người dùng để sửa </p>";
                }
                else
                {
                    $_SESSION['tensua']=array();
                    $_SESSION['tensua']=$ten;
                    header('Location: suanguoidung.php');
                }
            }   
        ?>
		</table>
		</form>


        </article>
       
      <?php include 'cuoitrang.php' ?>
    </body>
</html>