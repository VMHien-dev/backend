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
             
             <li><a class="b1" href="#"> TIN TỨC </a></li>
             <li><a class="b1" href="#"> LIÊN HỆ   </a></li>
             <li><a class="b1" href="dangnhap.php"> ĐĂNG NHẬP  </a></li>
     </nav>
    
     <article class="dangky">

        <?php
        $tendn="";
        $mk="";
        $mkre="";
        $ten="";
        $diachi="";
        $sdt="";
        $email="";
        include 'ketnoi.php';
        $conn=MoKetNoi();
        if($conn->connect_error)
        {
            echo"<p class='c6'> không kết nối được mysql </p> ";
        }
        mysqli_select_db($conn,"GHESOFA");

        if(isset($_POST["btndangky"]))
        {
            $tendn=$_POST['txttendn'];
            $mk=$_POST['txtmk'];
            $mkre=$_POST['txtmkre'];
            $ten=$_POST['txtten'];
            $diachi=$_POST['txtdiachi'];
            $sdt=$_POST['txtsdt'];
            $email=$_POST['txtemail'];
            $kt=1;
        }
        if($mk!=$mkre)
        {
            echo"<p class='ten'> Bạn nhập lại mật khẩu chưa đúng </p>";
            $kt=0;
        }
        if(empty($tendn) || empty($mk) || empty($mkre)|| empty($sdt)||empty($ten))
        {
            echo "<p class='ten''>Vui lòng nhập thông tin bắt buộc chưa đầy đủ </p>";
            $kt=0;
        }
        if(mysqli_num_rows(mysqli_query($conn,"SELECT TENDANGNHAP FROM NGUOIDUNG WHERE TENDANGNHAP='$tendn' ")) > 0 )
        {
            echo "<p class='ten'> Tên đăng nhập  này đã có người dùng.Vui lòng chọn tên khác. </p>";
            $kt=0;
        }
        if(mysqli_num_rows(mysqli_query($conn,"SELECT SODT FROM NGUOIDUNG WHERE SODT='$sdt' ")) > 0 )
        {
            echo "<p class='ten'> Số điện thoại đã có người dùng.Vui lòng nhập SĐT khác. </p>";
            $kt=0;
        }
        
        if($kt==1)
        {
            $nguoidung="INSERT INTO NGUOIDUNG(TENDANGNHAP,MATKHAU,HOTEN,DIACHI,SODT,EMAIL)
            VALUES('{$tendn}','{$mk}','{$ten}','{$diachi}','{$sdt}','{$email}')";
            $results=mysqli_query($conn,$nguoidung) or die (mysqli_error($conn));

            echo"<p class='ten'> Bạn đã đăng ký thành công .Hãy đăng nhập trang web hoặc quay về trang chủ </p>";
        } 
    ?>
        <form name='frmDK' method='post' action="dangky.php">
        <table class="frm2">
            <th colspan="2">Đăng Ký</th>
            <tr>
                <td class="icon"><i class="fa-solid fa-user"></i></td>
                <td>Tên đăng nhập (*):<input class="mk1" type="text" name="txttendn" id="" placeholder="Nhập tên đăng nhập" required='true' value="<?php echo $tendn ?>"></td>
            </tr>
            <tr>
                <td class="icon"><i class="fa-solid fa-lock"></i></td>
                <td>Mật khẩu (*):  <input class="mk2" type="password" name="txtmk" id="" placeholder="Nhập mật khẩu"   required='true' value="<?php echo $mk ?>"></td>
            </tr>
            <tr>
                <td class="icon"><i class="fa-solid fa-lock"></i></td>
                <td>Nhập lại mật khẩu (*):<input class="mk3" type="password" name="txtmkre" id="" placeholder="Nhập lại mật khẩu" required='true' value="<?php echo $mkre ?>"></td>
            </tr>
            <tr><td><th colspan="2">Thông tin cá nhân </th> </tr></td>
            <tr>
                <td ></td>
                <td>Họ tên (*):<input class="mk4" type="text" name="txtten" id="" placeholder="Họ tên"  required='true' value="<?php echo $ten ?>"></td>
            </tr>
            <tr>
                <td ></td>
                <td>Địa chỉ:<input class="mk5" type="text" name="txtdiachi" id="" placeholder="Địa chỉ" value="<?php echo $diachi ?>" ></td>
            </tr>
            <tr>
                <td ></td>
                <td>Số điện thoại (*):<input class="mk6" type="text" name="txtsdt" id="" placeholder="Số điện thoại" required='true' value="<?php echo $sdt ?>"></td>
            </tr>
            <tr>
                <td ></td>
                <td>Email:<input class="mk7" type="text" name="txtemail" id="" placeholder="email" value="<?php echo $email ?>"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input class="btn-sub" type="submit" name="btndangky" value="Đăng Ký"></button>
                    <input class="btn-sub" type="reset" name="btnnhaplai" value="Nhập lại thông tin"></button>
                </td>
            </tr>
        </table>
        </form>
        </article>
</body>
</html>