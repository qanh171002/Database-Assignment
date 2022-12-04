SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `tldatabase`;
CREATE DATABASE IF NOT EXISTS `tldatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tldatabase`;

CREATE TABLE `user` (
	`userID` int PRIMARY KEY AUTO_INCREMENT,
	`username` varchar(20) NOT NULL UNIQUE,
	`password` varchar(25) NOT NULL,
	`address` varchar(50),
	`email` varchar(50) NOT NULL UNIQUE,
	`fullName` varchar(50) NOT NULL,
	`dob` date,
	`phoneNum` char(10),
	--  check( phoneNum like'[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'), 
    /*Sdt trigger check*/
	`userRole` char check (`userRole` in ('S','T')),
	`gender` char check (`gender` in ('M','F'))
);

INSERT INTO `user` VALUES
(1,'trickstar','123456','Nhà ở đâu ai biết', 'a@mail.com', 'Nguyễn Văn A', '2002-11-13','0944272951','S','M'),
(2,'nhan','123456','Nhà ở đâu ai biết', 'b@mail.com', 'Nguyễn Văn B', '2002-11-14','0944272951','T','M');

CREATE TABLE `student` (
    `studentID` int references `user`(`userID`),
	PRIMARY KEY (`studentID`)
);

INSERT INTO `student` VALUES
(1);

CREATE TABLE `teacher` (
    `teacherID` int references `user`(`userID`),
	PRIMARY KEY (`teacherID`)
);

INSERT INTO `teacher` VALUES
(2);

CREATE TABLE `course` (
    `courseID` char(6) PRIMARY KEY,
    `teacherID` int NOT NULL references `teacher`(`teacherID`) ,
	`courseName` varchar(50) not null unique, 
	`description` varchar(5000),
	`fee` int not null check(`fee` >= 0) ,
	`lessonNum` tinyint ,
    /*So bai hoc trigger check*/
	`fullTime` int not null , 
    /*Thoi gian hoan thanh trigger check*/
	`createTime` datetime,
	`studentNum` int ,
	/*So hoc sinh trigger check*/
	`image` varchar(50)
);

INSERT INTO `course` VALUES
('CODE10',2,'Lập trình 1','',2000, 2, 14 , '2002-11-13',0,'laptrinh1.png');


CREATE TABLE `education` (
    `studentID` int references `student`(`studentID`),
	`learnDeg` varchar(25) CHECK (`learnDeg` in ('Primary','Secondary','High','University')), 
	`start` year ,
    /* trigger nam bat dau */
	`finish` year ,
    /* trigger nam ket thuc */
	`spec` varchar(50),
	`inst` varchar(100),
    PRIMARY KEY (`studentID`, `learnDeg`, `start`, `finish`, `spec`, `inst`)
);

CREATE TABLE `certificate` (
    `code` char(9) PRIMARY KEY,
    `studentID` int not null references `student`(`studentID`) ,
	`courseID` char(6) not null references `course`(`courseID`) , 
	`date` date not null,
	`rank` varchar(2) not null check (`rank` in ('XS','G','K','TB')) 
);

CREATE TABLE `degree` (
    `teacherID` int references `teacher`(`teacherID`) ,
    `acaRank` varchar(20) not null check (`acaRank` in ('Bachelor','Master','PhD')),
	`specialization` varchar(50) not null, 
	`institution` varchar(100) not null,
	PRIMARY KEY(`teacherID`, `acaRank`, `specialization`, `institution`)
);

CREATE TABLE `experience` (
    `teacherID` int references `teacherID`(`teacherID`),
    `place` varchar(100) not null, 
	`numYears` tinyint not null check (`numYears` >= 2),
	PRIMARY KEY (`teacherID`, `place`, `numYears`)
);


CREATE TABLE `lesson` (
    `courseID` char(6) not null references `course`(`courseID`),
	`no` tinyint ,
	`lessonName` varchar(50) not null,
	`exercise` varchar(30),
	`duration` tinyint not null check (`duration` >= 0) ,
	`lessonSrc` varchar(30) not null,
	PRIMARY KEY(`courseID` ,`no`)
);

INSERT INTO `lesson` VALUES
('CODE10',1,'Lập trình 1','example.pdf',14 ,'example.pdf');

CREATE TABLE `curriculum` (
    `curriCode` char(9) PRIMARY KEY,
	`publisher` varchar(50),
	`curriName` varchar(50) not null,
	`publishYear` smallint ,
    /*trigger nam xuat ban*/
	`cost` int check (`cost` >= 0),
	`author` varchar(50),
	`image` varchar(50)
);

INSERT INTO `curriculum` VALUES
('EBOOK1001','Nhà xuất bản Code trẻ','300 Bài Code Thiếu Nhi', 2011 , 0 ,'Trùm Code', 'book2.jpg'),
('EBOOK1000','Copyrighted Material','HTML for Babies', 2011 , 10 ,'John C Vanden-Heuvel Sr', 'book1.jpg');


CREATE TABLE `attend` (
    `courseID` char(6) not null references `course`(`courseID`),
    `studentID` int not null references `student`(`studentID`),
	`attendDay` date,
	`score` smallint not null check (`score` >= 0 and `score` <= 10) ,
	`progress` smallint not null check (`progress` >= 0 and `progress` <= 100) ,
	PRIMARY KEY(`courseID`,`studentID`)
);

CREATE TABLE `prerequisite` (
    `preCourseID` char(6) not null references `course`(`courseID`),
    `sucCourseID` char(6) not null references `course`(`courseID`),
	PRIMARY KEY(`preCourseID`,`sucCourseID`)
);

CREATE TABLE `use` (
    `courseID` char(6) not null references `course`(`courseID`),
    `curriCode` char(9) not null references `curriCode`(`curriculum`),
	PRIMARY KEY(`courseID`,`curriCode`)
);

CREATE TABLE `possess` (
    `curriCode` char(9) not null references `curriculum`(`curriCode`),
    `userID` int not null references `user`(`userID`),
	PRIMARY KEY(`curriCode`,`userID`)
);


DELIMITER |

CREATE trigger check_lnum BEFORE
insert on lesson 
for EACH row 
BEGIN
	set @courseid = new.courseID;
	set @time = new.duration;
	UPDATE course set lessonNum = lessonNum + 1, fullTime = fullTime + @time where courseID = @courseid;
end |

DELIMITER ;

DELIMITER |

CREATE trigger check_Snum BEFORE 
insert on attend
for EACH row
BEGIN
   set @courseid = new.courseID;
   UPDATE course set studentNum = studentNum + 1 where courseID = @courseID;
end |

DELIMITER ;

DELIMITER |
CREATE trigger check_Syear BEFORE 
insert on education
for EACH ROW
BEGIN
     DECLARE c_year CONDITION FOR SQLSTATE '45000';
     IF(new.start < 1945 OR new.start > year(curdate())) THEN
        SIGNAL c_year
		SET MESSAGE_TEXT = 'invalid start year';
        end if;
end |
DELIMITER ;

DELIMITER |
CREATE trigger check_Fyear BEFORE 
insert on education
for EACH ROW
BEGIN
     DECLARE c_year CONDITION FOR SQLSTATE '45000';
     IF(new.finish < education.start OR new.finish < year(curdate())) THEN
        SIGNAL c_year
		SET MESSAGE_TEXT = 'invalid finish year';
        end if;
end |
DELIMITER ;

DELIMITER |
CREATE trigger check_Pyear BEFORE 
insert on curriculum
for EACH ROW
BEGIN
     DECLARE c_year CONDITION FOR SQLSTATE '45000';
     IF(new.publishYear < 2010 OR new.publishYear > year(curdate())) THEN
        SIGNAL c_year
		SET MESSAGE_TEXT = 'invalid publish year';
        end if;
end |
DELIMITER ;

DELIMITER |
BEGIN
     IF(new.userRole = 'S') THEN INSERT INTO student VALUE(new.userID);
     ELSE INSERT INTO teacher VALUE(new.userID);
     end if;
end |
DELIMITER ;

DELIMITER |
BEGIN
  DECLARE c_Pnum CONDITION FOR SQLSTATE '45000';
  IF( user.phoneNum NOT REGEXP('0[0-9]*9')) THEN
  SIGNAL c_Pnum
  SET MESSAGE_TEXT = 'Invalid phone number';
  END IF;
END |
DELIMITER ;



-- CREATE ROLE student
-- CREATE ROLE teacher
-- CREATE ROLE admin

-- --user
-- GRANT select ON [NGƯỜI DÙNG] to student
-- GRANT select ON [NGƯỜI DÙNG] to teacher
-- GRANT select,insert,update,delete ON [NGƯỜI DÙNG] to admin

-- --student
-- GRANT select, update ON [student] to student
-- GRANT select ON [student] to teacher
-- GRANT select,insert,update,delete ON [student] to admin

-- --teacher
-- GRANT select ON [GIẢNG VIÊN] to student
-- GRANT select, update ON [GIẢNG VIÊN] to teacher
-- GRANT select,insert,update,delete ON [GIẢNG VIÊN] to admin

-- --course
-- GRANT select ON [course] to student
-- GRANT select, insert, update, delete ON [course] to teacher
-- GRANT select,insert,update,delete ON [course] to admin

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
-- GRANT select ON [curriculum] to student
-- GRANT select, insert, delete ON [curriculum] to teacher
-- GRANT select,insert,delete ON [curriculum] to admin

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
