SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `tldatabase`;
CREATE DATABASE IF NOT EXISTS `tldatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tldatabase`;

CREATE TABLE `NGƯỜI DÙNG` (
	`Mã người dùng` int PRIMARY KEY AUTO_INCREMENT,
	`Tên người dùng` varchar(20) NOT NULL UNIQUE,
	`Mật khẩu` varchar(25) NOT NULL,
	`Địa chỉ` varchar(50),
	`Email` varchar(50) NOT NULL UNIQUE,
	`Họ và tên` varchar(50) NOT NULL,
	`Ngày sinh` date,
	`Sđt` char(10) , 
    /*Sdt trigger check*/
	`Loại người dùng` char check (`Loại người dùng` in ('S','T')),
	`Giới tính` char check (`Giới tính` in ('M','F'))
);
CREATE TABLE `HỌC VIÊN` (
    `Mã học viên` int references `NGƯỜI DÙNG`(`MÃ NGƯỜI DÙNG`),
	PRIMARY KEY (`Mã học viên`)
);

CREATE TABLE `GIẢNG VIÊN` (
    `Mã giảng viên` int references `NGƯỜI DÙNG`(`MÃ NGƯỜI DÙNG`),
	PRIMARY KEY (`Mã giảng viên`)
);

CREATE TABLE `KHOÁ HỌC` (
    `Mã khoá học` char(6) PRIMARY KEY,
    `Mã giảng viên` int NOT NULL references `GIẢNG VIÊN`(`MÃ GIẢNG VIÊN`) ,
	`Tên khoá học` varchar(50) not null unique, 
	`Học phí` int not null check(`Học phí` >= 0) ,
	`Số bài học` tinyint ,
    /*So bai hoc trigger check*/
	`Thời gian hoàn thành` int not null ,
    /*Thoi gian hoan thanh trigger check*/
	`Thời gian mở` datetime 
);

CREATE TABLE `HỌC VẤN` (
    `Mã học viên` int references `HỌC VIÊN`(`MÃ HỌC VIÊN`),
	`Bậc học` varchar(25) CHECK (`Bậc học` in ('Tiểu học','THCS','THPT','Đại học')), 
	`Năm bắt đầu` year ,
    /* trigger nam bat dau */
	`Năm kết thúc` year ,
    /* trigger nam ket thuc */
	`Chuyên ngành` varchar(50),
	`Trường` varchar(100),
    PRIMARY KEY (`Mã học viên`, `Bậc học`, `Năm bắt đầu`, `Năm kết thúc`, `Chuyên ngành`, `Trường`)
);

CREATE TABLE `CHỨNG CHỈ` (
    `Số hiệu` char(9) PRIMARY KEY,
    `Mã học viên` int not null references `HỌC VIÊN`(`MÃ HỌC VIÊN`) ,
	`Tên khoá học` varchar(50) not null references `KHOÁ HỌC`(`TÊN KHOÁ HỌC`) , 
	`Ngày cấp` date not null,
	`Xếp loại` varchar(2) not null check (`Xếp loại` in ('XS','G','K','TB')) 
);

CREATE TABLE `BẰNG CẤP` (
    `Mã giảng viên` int references `GIẢNG VIÊN`(`MÃ GIẢNG VIÊN`) ,
    `Học vị` varchar(20) not null check (`Học vị` in ('Cử nhân','Thạc sĩ','Tiến sĩ')),
	`Chuyên ngành` varchar(50) not null, 
	`Tên trường` varchar(100) not null,
	PRIMARY KEY(`Mã giảng viên`, `Học vị`, `Chuyên ngành`, `Tên trường`)
);

CREATE TABLE `KINH NGHIỆM GIẢNG DẠY` (
    `Mã giảng viên` int references `GIẢNG VIÊN`(`MÃ GIẢNG VIÊN`),
    `Nơi công tác` varchar(100) not null, 
	`Thời gian công tác` tinyint not null check (`Thời gian công tác` >= 2),
	PRIMARY KEY (`Mã giảng viên`, `Nơi công tác`, `Thời gian công tác`)
);


CREATE TABLE `BÀI HỌC` (
    `Mã khóa học` char(6) not null references `KHOÁ HỌC`(`Mã khoá học`),
	`Số thứ tự` tinyint ,
	`Tên bài học` varchar(50) not null,
	`Bài tập` varchar(30),
	`Thời lượng` tinyint not null check (`Thời lượng` >= 0) ,
	`File bài học` varchar(30) not null,
	PRIMARY KEY(`Mã khóa học` ,`Số thứ tự`)
);


CREATE TABLE `GIÁO TRÌNH` (
    `Mã giáo trình` char(9) PRIMARY KEY,
	`Nhà xuất bản` varchar(50),
	`Tên giáo trình` varchar(50) not null,
	`Năm xuất bản` smallint ,
    /*trigger nam xuat ban*/
	`Giá` int check (`giá` >= 0)
);

CREATE TABLE `TÁC GIẢ` (
    `Mã giáo trình` char(9) not null references `GIÁO TRÌNH`(`Mã giáo trình`),
    `Tác giả` varchar(50) not null,
	PRIMARY KEY(`Mã giáo trình`,`Tác giả`)
);

CREATE TABLE `THAM GIA` (
    `Mã khoá học` char(6) not null references `KHOÁ HỌC`(`Mã khoá học`),
    `Mã học viên` int not null references `HỌC VIÊN`(`Mã học viên`),
	`Ngày tham gia` date,
	`Điểm số` smallint not null check (`Điểm số` >= 0 and `Điểm số` <= 10) ,
	`Tiến trình học` smallint not null check (`Tiến trình học` >= 0 and `Tiến trình học` <= 100) ,
	PRIMARY KEY(`Mã khoá học`,`Mã học viên`)
);

CREATE TABLE `TIÊN QUYẾT` (
    `Mã khoá học học trước` char(6) not null references `KHOÁ HỌC`(`Mã khoá học`),
    `Mã khoá học học sau` char(6) not null references `KHOÁ HỌC`(`Mã khoá học`),
	PRIMARY KEY(`Mã khoá học học trước`,`Mã khoá học học sau`)
);

CREATE TABLE `SỬ DỤNG` (
    `Mã khoá học` char(6) not null references `KHOÁ HỌC`(`Mã khoá học`),
    `Mã giáo trình` char(9) not null references `GIÁO TRÌNH`(`Mã giáo trình`),
	PRIMARY KEY(`Mã khoá học`,`Mã giáo trình`)
);

CREATE TABLE `SỞ HỮU` (
    `Mã giáo trình` char(9) not null references `GIÁO TRÌNH`(`Mã giáo trình`),
    `Mã người dùng` int not null references `NGƯỜI DÙNG`(`Mã người dùng`),
	PRIMARY KEY(`Mã giáo trình`,`Mã người dùng`)
);

-- CREATE ROLE student
-- CREATE ROLE teacher
-- CREATE ROLE admin

-- --user
-- GRANT select ON [NGƯỜI DÙNG] to student
-- GRANT select ON [NGƯỜI DÙNG] to teacher
-- GRANT select,insert,update,delete ON [NGƯỜI DÙNG] to admin

-- --student
-- GRANT select, update ON [HỌC VIÊN] to student
-- GRANT select ON [HỌC VIÊN] to teacher
-- GRANT select,insert,update,delete ON [HỌC VIÊN] to admin

-- --teacher
-- GRANT select ON [GIẢNG VIÊN] to student
-- GRANT select, update ON [GIẢNG VIÊN] to teacher
-- GRANT select,insert,update,delete ON [GIẢNG VIÊN] to admin

-- --course
-- GRANT select ON [KHOÁ HỌC] to student
-- GRANT select, insert, update, delete ON [KHOÁ HỌC] to teacher
-- GRANT select,insert,update,delete ON [KHOÁ HỌC] to admin

-- --hvan
-- GRANT select, insert, update, delete ON [HỌC VẤN] to student
-- GRANT select ON [HỌC VẤN] to teacher
-- GRANT select,insert,update,delete ON [HỌC VẤN] to admin

-- --certificate
-- GRANT select ON [CHỨNG CHỈ] to student
-- GRANT select,insert,update,delete ON [CHỨNG CHỈ] to admin

-- --bcap
-- GRANT select ON [BẰNG CẤP] to student
-- GRANT select, insert, update, delete ON [BẰNG CẤP] to teacher
-- GRANT select,insert,update,delete ON [BẰNG CẤP] to admin

-- --experience
-- GRANT select ON [KINH NGHIỆM GIẢNG DẠY] to student
-- GRANT select, insert, update, delete ON [KINH NGHIỆM GIẢNG DẠY] to teacher
-- GRANT select,insert,update,delete ON [KINH NGHIỆM GIẢNG DẠY] to admin

-- --experience
-- GRANT select ON [BÀI HỌC] to student
-- GRANT select, insert, update, delete ON [BÀI HỌC] to teacher
-- GRANT select,insert,update,delete ON [BÀI HỌC] to admin

-- --syllabus
-- GRANT select ON [GIÁO TRÌNH] to student
-- GRANT select, insert, delete ON [GIÁO TRÌNH] to teacher
-- GRANT select,insert,delete ON [GIÁO TRÌNH] to admin

-- --author
-- GRANT select ON [TÁC GIẢ] to student
-- GRANT select ON [TÁC GIẢ] to teacher
-- GRANT select,insert,delete ON [TÁC GIẢ] to admin

-- --attendance
-- GRANT select, insert ON [THAM GIA] to student
-- GRANT select,insert,update,delete ON [THAM GIA] to admin

-- --prerequisite
-- GRANT select ON [TIÊN QUYẾT] to student
-- GRANT select, insert, update, delete ON [TIÊN QUYẾT] to teacher
-- GRANT select,insert,update,delete ON [TIÊN QUYẾT] to admin

-- --use
-- GRANT select ON [SỬ DỤNG] to student
-- GRANT select, insert, update, delete ON [SỬ DỤNG] to teacher
-- GRANT select,insert,update,delete ON [SỬ DỤNG] to admin

-- --possess
-- GRANT select,insert ON [SỞ HỮU] to student
-- GRANT select, insert ON [SỞ HỮU] to teacher
-- GRANT select,insert,update,delete ON [SỞ HỮU] to admin