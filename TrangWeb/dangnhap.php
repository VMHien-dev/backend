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
             <li><a class="b1" href="dangky.php"> ĐĂNG KÝ  </a></li>
     </nav>
    
     <article id="dangnhap">
            <?php
                $dnten="";
                $dnmk="";
                 if(isset($_POST["btndangnhap"]))
                 {
                    session_start();
                    include 'ketnoi.php';
                    $conn=MoKetNoi();
                    if($conn->connect_error)
                    {
                        echo "<p class='c6'> Không kết nối được MYSQL </p>";
                    }
                    mysqli_select_db($conn,"GHESOFA");

                    $dnten=$_POST['txtdnten'];
                    $dnmk=$_POST['txtdnmk'];

                    $kt=1;
                    if(empty($dnten) || empty($dnmk))
                    {
                        echo "<p class='ten'> Bạn chưa nhập đầy đủ thông tin. </p>";
                        $kt=0;
                    }
                    
                    $query=mysqli_query($conn,"SELECT HOTEN,MATKHAU,PHANLOAI FROM NGUOIDUNG WHERE TENDANGNHAP='$dnten'") or die (mysqli_error($conn));

                    if(mysqli_num_rows($query)==0)
                    {
                        echo "<p class='ten'> Tên đăng nhập không tồn tại.Vui lòng kiểm tra lại hoặc đăng ký.<p>";
                        $kt=0;
                    }
                    else
                    {
                        $row=mysqli_fetch_array($query);
                        if($dnmk != $row['MATKHAU'])
                        {
                            echo "<p class='ten'> Mật khẩu không đúng.Vui lòng nhập lại. </p>";
                            $kt=0;
                        }
                    }

                    if($kt==1)
                    {
                        $_SESSION['tendangnhap']=$row['HOTEN'];
                        $_SESSION['loainguoidung']=$row['PHANLOAI'];
                        $_SESSION['DSMaMua']=array();
                        $_SESSION['DSSL']=array();
                        header('Location: trangchu.php');
                    }
                 }      
            ?>
        <form name='frmDK' method='post' action="dangnhap.php">
        <table class="frm">
            <th colspan="2">Đăng Nhập</th>
            <tr>
                <td class="icon"><i class="fa-solid fa-user"></i></td>
                <td>Tên Đăng Nhập:<input class="int" type="text" name="txtdnten" id="" placeholder="Nhập tên đăng nhập" required='true' value="<?php echo $dnten ?>"></td>
            </tr>
            <tr>
                <td class="icon"><i class="fa-solid fa-lock"></i></td>
                <td>Mật Khẩu:<input class="int2" type="password" name="txtdnmk" id="" placeholder="Nhập mật khẩu" required='true' value="<?php echo $dnmk ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                     <input class="btn-sub" type="submit" name="btndangnhap" value="Đăng Nhập"></button>
                     <input class="btn-sub" type="reset" name="btnnhaplai" value="Nhập lại thông tin"></button>
                </td>
            </tr>
        </table>
        </form>

        </article>
</body>
</html>