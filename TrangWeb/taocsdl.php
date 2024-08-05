<?php
    include 'ketnoi.php' ;
    $conn=MoKetNoi();
    if($conn->connect_error)
    {
        echo "không kết nối được MySQL";
    }
   
    $sql="CREATE DATABASE IF NOT EXISTS  GHESOFA";
    if(!mysqli_query($conn,$sql))
    {
            echo "không tạo được database Ghế Sofa ".mysqli_error($conn);
    }
    mysqli_select_db($conn,"GHESOFA");

    $THUONGHIEU = "CREATE TABLE IF NOT EXISTS THUONGHIEU (
        MATH varchar(20) primary key,
        TENTH nvarchar(200) not null)";
    $results = mysqli_query($conn,$THUONGHIEU)or die (mysqli_error($conn));
    
    $DataTHUONGHIEU="INSERT INTO THUONGHIEU (MATH,TENTH)". 
        "VALUES ('SV01','Sơn Hà'),".
        "('SH02','Homystar'),".
        "('SF03','Famica'),".
        "('SE04','Everhome')";
    $results = mysqli_query($conn,$DataTHUONGHIEU) or die (mysqli_error($conn));

    $CHATLIEU = "CREATE TABLE IF NOT EXISTS CHATLIEU (
        MACL varchar(100) primary key,
        TENCL nvarchar(200) not null)";
    $results = mysqli_query($conn,$CHATLIEU)or die (mysqli_error($conn));

        $DataCHATLIEU="INSERT INTO CHATLIEU (MACL,TENCL)". 
        "VALUES ('CL01','Da thật'),".
        "('CL02','Da Cao Cấp'),".
        "('CL03','Vải nỉ'),".
        "('CL04','Vải bố'),".
        "('CL05','Vải linen'),".
        "('CL06','Vải gấm'),".
        "('CL07','Nhung')";
    $results = mysqli_query($conn,$DataCHATLIEU) or die (mysqli_error($conn));

    $KIEUDANG = "CREATE TABLE IF NOT EXISTS KIEUDANG (
        MAKD varchar(20) primary key,
        TENKD nvarchar(200) not null)";
    $results = mysqli_query($conn,$KIEUDANG)or die (mysqli_error($conn));

    $DataKIEUDANG="INSERT INTO KIEUDANG (MAKD,TENKD)". 
    "VALUES ('SVANG','SOFA VĂNG'),".
    "('SGOCL','SOFA GÓC L'),".
    "('SDA','SOFA DA'),".
    "('SNI','SOFA NỈ'),".
    "('SVANPHONG','SOFA VĂN PHÒNG'),".
    "('SGIUONG','SOFA GIƯỜNG')";
    $results = mysqli_query($conn,$DataKIEUDANG) or die (mysqli_error($conn));
    
    $KICHTHUOC = "CREATE TABLE IF NOT EXISTS KICHTHUOC (
        MAKT varchar(20) primary key,
        TENKT nvarchar(200) not null)";
    $results = mysqli_query($conn,$KICHTHUOC)or die (mysqli_error($conn));

        $DataKICHTHUOC="INSERT INTO KICHTHUOC (MAKT,TENKT)". 
        "VALUES ('KT18','1m8 x 2m'),".
        "('KT2','2m'),".
        "('KT25','2m5'),".
        "('KT3','3m'),".      
        "('KT16',' 1m6')";
    $results = mysqli_query($conn,$DataKICHTHUOC) or die (mysqli_error($conn));


    $SANPHAM = "CREATE TABLE IF NOT EXISTS SANPHAM (
        MASP varchar(20) primary key,
        TENSP nvarchar(500) not null,
        MAUSAC NVARCHAR(100) NOT NULL,
        GIABAN int default 100000000,
        HINH varchar(200) not null,
        MAKD varchar(20) NOT NULL,
        MACL varchar(100) NOT NULL,
        MAKT  NVARCHAR(100) NOT NULL)";
    $results = mysqli_query($conn,$SANPHAM) or die (mysqli_error($conn));

    $DataSANPHAM="INSERT INTO SANPHAM (MASP,TENSP,MAUSAC,GIABAN,HINH,MAKD,MACL,MAKT)". 
                "VALUES ('SP01','SOFA VĂNG NỈ ĐẸP 1M8 – SP01','Màu xanh','3.510.000đ','img/SOFA VĂNG NỈ ĐẸP 1M8 – SP01.webp','SVANG','CL03','KT18'),". 
                "('SP02','Bộ ghế sofa nhỏ văng da 3 chỗ ngồi sang trọng hiện đại SP02','Màu Trắng','8.800.000₫','img/Ghe-sofa-vang-da-hien-dai-SP02.jpg','SVANG','CL02','KT18'),".
                "('SP03','BỘ SOFA DA CAO CẤP  SP03','Màu Đen Cam','10.800.000đ','img/BỘ SOFA VĂNG DA CAO CẤP - SP03.webp','SVANG','CL02','KT18'),".
                "('SP04','SOFA VĂNG NỈ ĐẸP SP04','Màu Xám','6.300.000đ','img/SOFA VĂNG NỈ ĐẸP - SP04.webp','SVANG','CL03','KT2'),".

                "('SP37','BỘ SOFA VĂNG NỈ SFV10','Màu xanh','3.510.000đ','img/sp37.webp','SVANG','CL03','KT18'),". 
                "('SP38','SOFA VĂNG NỈ COSY 1M8 MÀU GHI – SFV08','Màu Trắng','4.590.000đ','img/sp38.webp','SVANG','CL02','KT18'),".
                "('SP39','SOFA VĂNG NỈ XANH 1M6 SFV02-X','Màu Xanh','3.000.000đ','img/sp39.webp','SVANG','CL02','KT18'),".
                "('SP40','SOFA VĂNG NỈ 1M8 ĐỆM RỜI SFV15','Màu Xanh','4.860.000đ','img/sp40.webp','SVANG','CL03','KT2'),".
                
                "('SP05','SOFA GÓC DA CHỮ L – SFD30','Màu nâu','13.800.000đ','img/SOFA GÓC DA CHỮ L – SP05.webp','SGOCL','CL02','KT18'),".
                "('SP06','SOFA GÓC DA CHỮ L – SFD13','Màu ghi','7.500.000đ','img/SOFA GÓC DA CHỮ L – SP06.webp','SGOCL','CL01','KT2'),".
                "('SP07','SOFA GÓC L NỈ THÔNG MINH SFG31','Màu xanh','7.350.000đ','img/SOFA GÓC L NỈ THÔNG MINH SP07.webp','SGOCL','CL03','KT18'),".
                "('SP08','SOFA GÓC NỈ CHỮ L – SFG13G','Màu ghi','7.000.000đ','img/sofa-goc-ni-chu-l-SP08.webp','SGOCL','CL03','KT2'),".

                 
                "('SP33','BỘ SOFA GỖ MDF HIỆN ĐẠI SFG32-N','Theo yêu cầu','9.500.000đ','img/sp33.webp','SGOCL','CL02','KT18'),".
                "('SP34','SOFA GÓC NỈ TAY GỖ – SFG24 ','Màu ghi','8.150.000đ','img/sp34.webp','SGOCL','CL01','KT2'),".
               

                
                "('SP09','SOFA GÓC DA CỤC THÔNG MINH – SFD10','Màu đen','7.500.000đ','img/SOFA GÓC DA CỤC THÔNG MINH – SP09.webp','SDA','CL01','KT18'),".
                "('SP10','BỘ SOFA DA CAO CẤP SFD38','Màu ghi','11.500.000đ','img/BỘ SOFA DA CAO CẤP SP10.webp','SDA','CL01','KT2'),".
                "('SP11','BỘ GHẾ SOFA DA TIẾP KHÁCH CAO CẤP SVP05','Màu đen cam','13.500.000đ','img/SP11BỘ GHẾ SOFA DA TIẾP KHÁCH CAO CẤP.webp','SDA','CL02','KT2'),".
                "('SP12','SOFA GÓC DA CHỮ L – SFD19','Màu ghi','12.000.000đ','img/SOFA GÓC DA CHỮ L – Sp12.webp','SDA','CL03','KT2'),".

                "('SP32','SOFA VĂNG DA MÀU DA BÒ -SFV18','Màu da bò','8.520.000đ','img/sp32.webp','SDA','CL01','KT18'),".
               

                "('SP13','SOFA GÓC NỈ THÔNG MINH – SFG21','Màu GHI','6.500.000đ','img/SOFA GÓC NỈ THÔNG MINH – SP13.webp','SNI','CL03','KT18'),".
                "('SP14','SOFA GÓC NỈ THÔNG MINH – SFG15','Màu ghi','6.500.000đ','img/SOFA GÓC NỈ THÔNG MINH – SP14.webp','SNI','CL03','KT2'),".
                "('SP15','SOFA GÓC NỈ CHỮ L – SFG13G','Màu ghi','7.000.000đ','img/SOFA GÓC NỈ CHỮ L -SP15.webp','SNI','CL03','KT16'),".
                "('SP16','SOFA GÓC NỈ TAY GỖ – SFG24 ','Màu ghi','8.150.000đ','img/SOFA GÓC NỈ TAY GỖ – SP16.webp','SNI','CL03','KT2'),".

                "('SP17','BỘ SOFA VĂN PHÒNG TIẾP KHÁCH SVP01','Theo yêu cầu','10.500.000đ','img/BỘ SOFA VĂN PHÒNG TIẾP KHÁCH SP17.webp','SVANPHONG','CL02','KT18'),".
                "('SP18','BỘ SOFA TIẾP KHÁCH HIỆN ĐẠI SVP02','Màu ghi','12.500.000đ','img/BỘ SOFA TIẾP KHÁCH HIỆN ĐẠI SP18.webp','SVANPHONG','CL01','KT2'),".
                "('SP19','BỘ SOFA TIẾP KHÁCH VĂN PHÒNG SVP04','Màu nâu','7.000.000đ','img/BỘ SOFA TIẾP KHÁCH VĂN PHÒNG SP19.webp','SVANPHONG','CL02','KT16'),".
                "('SP20','BỘ SOFA TIẾP KHÁCH VĂN PHÒNG CAO CẤP SFV03 ','Màu ghi','8.150.000đ','img/BỘ SOFA TIẾP KHÁCH VĂN PHÒNG CAO CẤP SP20.webp','SVANPHONG','CL02','KT2'),".
                
                "('SP30','BỘ SOFA GỖ MDF HIỆN ĐẠI SFG33-V','Màu da bò phối kem','13.500.000đ','img/s30.webp','SVANPHONG','CL02','KT18'),".
                "('SP31','SOFA VĂN PHÒNG KIỂU NHẬT DA CLEO- SFD02','Màu kem','6.500.000đ','img/s31.webp','SVANPHONG','CL01','KT2'),".
              
              
                "('SP21','SOFA GIƯỜNG HAI LỚP GHI ĐEN SFB02-GD','Màu ghi kết hợp màu đen','3.450.000đ','img/SOFA GIƯỜNG HAI LỚP GHI ĐEN SP21.webp','SGIUONG','CL04','KT2'),".
                "('SP22','SOFA GIƯỜNG MỘT LỚP MÀU VÀNG SFB01-V',' Màu vàng bò','3.150.000đ','img/SOFA GIƯỜNG MỘT LỚP MÀU VÀNG -SP22.webp','SGIUONG','CL05','KT16'),".
                "('SP23','SOFA GIƯỜNG HAI LỚP MÀU XANH SFB02-X ',' Màu xanh','3.450.000đ','img/SOFA GIƯỜNG HAI LỚP MÀU XANH SP23.webp','SGIUONG','CL06','KT18'),".
                "('SP24','SOFA VĂNG ĐƠN SFV11','Màu Xanh ','1.800.000đ','img/SOFA VĂNG ĐƠN SP24.webp','SGIUONG','CL07','KT18'),".

                "('SP26','GHẾ SOFA GIƯỜNG CÓ TAY MÀU XANH SFB03-X','Màu Trắng','3.450.000đ','img/sp26GHẾ SOFA GIƯỜNG CÓ TAY MÀU XANH SFB03-X.webp','SGIUONG','CL03','KT18'),". 
                "('SP27','SOFA GIƯỜNG HAI LỚP MÀU XANH SFB02-X','Màu Xanh','3.450.000đ','img/s27.webp','SGIUONG','CL02','KT18'),".
                "('SP28','SOFA GIƯỜNG MỘT LỚP MÀU VÀNG SFB01-V','Màu Đen Cam','3.150.000đ','img/s28.webp','SGIUONG','CL02','KT18'),".
                "('SP29','SOFA GIƯỜNG MỘT LỚP MÀU ĐỎ SFB01-D','Màu Đỏ','3.150.000đ','img/s29.webp','SGIUONG','CL03','KT2')";
               
     $results = mysqli_query($conn,$DataSANPHAM) or die (mysqli_error($conn));


    $DONHANG="CREATE TABLE IF NOT EXISTS DONHANG(
            MADH int(10) auto_increment primary key,
            TENDANGNHAP varchar(200) NOT NULL,
            DIACHI nvarchar(200),
            SODT int,
            HOTEN nvarchar(200),
            NGAYDAT date,
            TONGTIEN int,
            THANHTOAN nvarchar(200)) auto_increment=1";
    $results = mysqli_query($conn,$DONHANG)or die (mysqli_error($conn));

    $CHITIETDONHANG="CREATE TABLE IF NOT EXISTS CHITIETDONHANG(
            MADH int(10),
            MASP varchar(20),
            SOLUONG int,
            PRIMARY KEY (MADH, MASP))";
    $results = mysqli_query($conn,$CHITIETDONHANG) or die (mysqli_error($conn));
    
    $NGUOIDUNG = "CREATE TABLE IF NOT EXISTS NGUOIDUNG (
        TENDANGNHAP varchar(200) NOT NULL,
        MATKHAU varchar(200) NOT NULL,
        HOTEN nvarchar(200) NOT NULL,
        DIACHI nvarchar(200) default 'Chưa cập nhật',
        SODT int default 0,
        EMAIL varchar(20) default 'Chưa cập nhật',
        PHANLOAI varchar(10) default 'user',
        PRIMARY KEY (TENDANGNHAP,SODT))";
    $results = mysqli_query($conn,$NGUOIDUNG)or die (mysqli_error($conn));
    
    $DataNGUOIDUNG="INSERT INTO NGUOIDUNG ( TENDANGNHAP,MATKHAU,HOTEN,DIACHI,SODT,EMAIL,PHANLOAI)". 
                "VALUES ('hien','123','Vũ Minh Hiền','123 abc','1234567890','abc@abc','admin')";
    $results = mysqli_query($conn,$DataNGUOIDUNG) or die (mysqli_error($conn));

    DongKetNoi($conn);
?>