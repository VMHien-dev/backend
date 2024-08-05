<?php 
    session_start();
    if(isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'])
    {
        echo"<li class='menu1'> <a class='text' href='dangxuat.php'> Đăng Xuất </a> </li>";
        if(isset($_SESSION['loainguoidung']) && $_SESSION['loainguoidung']=='admin')
        {
            echo "<li class='menu1'> <a class='text' href='quanlynguoidung.php'> Quản Trị Người Dùng</a> </li>";
        }
        if(isset($_SESSION['loainguoidung']) && $_SESSION['loainguoidung']=='user')
        {
            echo "<li class='menu1'> <a class='text' > Xin chào bạn ".$_SESSION['tendangnhap']." </a> </li>";
            $n=sizeof($_SESSION['DSMaMua']);
            if($n==0)
            echo "<li class='menu1'> <a class='text' href='giohang.php'> Xem Giỏ Hàng </a> </li>";
            else
            echo "<li class='menu1'> <a class='text' href='giohang.php'> Xem Giỏ Hàng (".$n.") </a> </li>";
        }

      
    }
    else
    {
        echo "<li class='menu1'> <a class='text' href='dangky.php'> Đăng Ký </a> </li>";
        echo "<li class='menu1'> <a class='text' href='dangnhap.php'> Đăng Nhập </a> </li>";
    
      
    }

?>