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
	`phoneNum` char(10) , 
    /*Sdt trigger check*/
	`userRole` char check (`userRole` in ('S','T')),
	`gender` char check (`gender` in ('M','F'))
);
CREATE TABLE `student` (
    `studentID` int references `user`(`userID`),
	PRIMARY KEY (`studentID`)
);

CREATE TABLE `teacher` (
    `teacherID` int references `user`(`userID`),
	PRIMARY KEY (`teacherID`)
);

CREATE TABLE `course` (
    `courseID` char(6) PRIMARY KEY,
    `teacherID` int NOT NULL references `teacher`(`teacherID`) ,
	`courseName` varchar(50) not null unique, 
	`fee` int not null check(`fee` >= 0) ,
	`lessonNum` tinyint ,
    /*So bai hoc trigger check*/
	`fullTime` int not null ,
    /*Thoi gian hoan thanh trigger check*/
	`createTime` datetime 
);

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


CREATE TABLE `curriculum` (
    `curriCode` char(9) PRIMARY KEY,
	`publisher` varchar(50),
	`curriName` varchar(50) not null,
	`publishYear` smallint ,
    /*trigger nam xuat ban*/
	`cost` int check (`cost` >= 0)
);

CREATE TABLE `author` (
    `curriCode` char(9) not null references `curriculum`(`curriCode`),
    `name` varchar(50) not null,
	PRIMARY KEY(`curriCode`,`name`)
);

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