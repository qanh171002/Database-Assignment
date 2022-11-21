CREATE DATABASE COMPANY;

USE COMPANY
GO

CREATE TABLE EMPLOYEE (
	Fname varchar(25) NOT NULL,
	Minit char(1) NOT NULL check(Minit like '[A-Z]'),
	Lname varchar(25),
	Ssn char(9) check(Ssn like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]') PRIMARY KEY,
	Bdate date,
	Address varchar(50) not null,
	Sex char(1) check (Sex in ('F','M')),
	Salary int check(Salary >= 0),
	Super_ssn char(9) check(Super_ssn like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]') references EMPLOYEE(Ssn),
	Dno tinyint check(Dno >= 0)
);

insert into EMPLOYEE
VALUES ('John', 'B', 'Smith', '123456789', '1965-01-09', '731 Fodren, Houston, TX', 'M', 30000, '333445555', 5),
		('Franklin', 'T', 'Wong', '333445555', '1955-12-08', '638 Voss, Houston, TX', 'M', 40000, '888665555', 5),
		('Alicia', 'J', 'Zelaya', '999887777', '1968-01-19', '3321 Castle, Spring, TX', 'F', 25000, '987654321', 4),
		('Jennifer', 'S', 'Wallace', '987654321', '1941-06-20', '291 Berry, Bellaire, TX', 'F', 43000, '888665555', 4),
		('Ramesh', 'K', 'Narayan', '666884444', '1962-09-15', '975 Fire Oak, Humble, TX', 'M', 38000, '333445555', 5),
		('Joyce', 'A', 'English', '453453453', '1972-07-31', '5631 Rice, Houston, TX', 'F', 25000, '333445555', 5),
		('Ahmad', 'V', 'Jabbar', '987987987', '1969-03-29', '980 Dallas, Houston, TX', 'M', 25000, '987654321', 4),
		('James', 'E', 'Borg', '888665555', '1937-11-10', '450 Stone, Houston, TX', 'M', 55000, NULL, 1) ;

CREATE TABLE DEPARTMENT (
	Dname varchar(25) not null,
	Dnumber tinyint check(Dnumber >= 0) PRIMARY KEY,
	Mgr_ssn char(9) check(Mgr_ssn like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]') not null unique references EMPLOYEE(Ssn),
	Mgr_start_date date
);

insert into DEPARTMENT
VALUES ('Research', 5, '333445555', '1988-05-22'),
		('Administration', 4, '987654321', '1995-01-01'),
		('Headquarters', 1, '888665555', '1981-06-19');

ALTER TABLE EMPLOYEE
ADD CONSTRAINT FK_WF FOREIGN KEY (Dno) references DEPARTMENT(Dnumber);

CREATE TABLE DEPT_LOCATIONS (
	Dnumber tinyint check(Dnumber >= 0) references DEPARTMENT(Dnumber),
	Dlocation varchar(25),
	CONSTRAINT PK_Dloc PRIMARY KEY (Dnumber, Dlocation)
);

insert into DEPT_LOCATIONS
VALUES (1, 'Houston'),
		(4, 'Stafford'),
		(5, 'Bellaire'),
		(5, 'Sugarland'),
		(5, 'Houston');

CREATE TABLE PROJECT (
	Pname varchar(25),
	Pnumber smallint check(Pnumber >= 0) PRIMARY KEY,
	Plocation varchar(25),
	Dnum tinyint check(Dnum >= 0) references DEPARTMENT(Dnumber)
);

insert into PROJECT
VALUES ('ProductX', 1, 'Bellaire', 5),
		('ProductY', 2, 'Sugarland', 5),
		('ProductZ', 3, 'Houston', 5),
		('Computerization', 10, 'Stafford', 4),
		('Reorganization', 20, 'Houston', 1),
		('Newbenefits', 30, 'Stafford', 4);

CREATE TABLE WORKS_ON (
	Essn char(9) check(Essn like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]') references EMPLOYEE(Ssn),
	Pno smallint check(Pno >= 0) references PROJECT(Pnumber),
	Hours decimal(10,1),
	CONSTRAINT PK_WO PRIMARY KEY (Essn, Pno)
);

insert into WORKS_ON
VALUES ('123456789', 1, 32.5),
		('123456789', 2, 7.5),
		('666884444', 3, 40.0),
		('453453453', 1, 20.0),
		('453453453', 2, 20.0),
		('333445555', 2, 10.0),
		('333445555', 3, 10.0),
		('333445555', 10, 10.0),
		('333445555', 20, 10.0),
		('999887777', 30, 30.0),
		('999887777', 10, 10.0),
		('987987987', 10, 35.0),
		('987987987', 30, 5.0),
		('987654321', 30, 20.0),
		('987654321', 20, 15.0),
		('888665555', 20, NULL);

CREATE TABLE DEPENDENT (
	Essn char(9) check(Essn like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]') references EMPLOYEE(Ssn),
	Dependent_name varchar(25),
	Sex char(1) check (Sex in ('F','M')),
	Bdate date,
	Relationship varchar(25) not null,
	CONSTRAINT PK_DEPEND PRIMARY KEY (Essn, Dependent_name)
);

insert into DEPENDENT
VALUES ('333445555', 'Alice', 'F', '1986-04-05', 'Daughter'),
		('333445555', 'Theodore', 'M', '1983-10-25', 'Son'),
		('333445555', 'Joy', 'F', '1958-05-03', 'Spouse'),
		('987654321', 'Abner', 'M', '1942-02-28', 'Spouse'),
		('123456789', 'Michael', 'M', '1988-01-04', 'Son'),
		('123456789', 'Alice', 'F', '1988-12-30', 'Daughter'),
		('123456789', 'Elizabeth', 'F', '1967-05-05', 'Spouse');

SELECT * from EMPLOYEE;
SELECT * from DEPARTMENT;
SELECT * from DEPT_LOCATIONS;
SELECT * from PROJECT;
SELECT * from WORKS_ON;
SELECT * from DEPENDENT;

SELECT Fname, Lname from EMPLOYEE, DEPENDENT
where Ssn = Essn and Dependent_name = Fname;

--a-start
select Fname, Minit, Lname, Bdate, Address from EMPLOYEE where Fname = 'John' and Minit = 'B' and Lname = 'Smith';
--a-end

--b-start
SELECT Fname, Minit, Lname from EMPLOYEE, DEPARTMENT
where Dno = Dnumber and Dname = 'Administration'; 
--b-end

--c-start
select Fname, Minit, Lname
from EMPLOYEE, WORKS_ON, PROJECT
where Pname='ProductX' and Pnumber = Pno and Hours > 10 and Essn = Ssn and Dno = 5;
--c-end

--d-start
select distinct Super_ssn into A from EMPLOYEE; 
select * from A;

select distinct A.Super_ssn, Fname, Lname into SUPER_EMPLOYEE
from A, EMPLOYEE
where Ssn = A.Super_ssn ;
select * from SUPER_EMPLOYEE;

select EMPLOYEE.Fname, EMPLOYEE.Lname , SUPER_EMPLOYEE.Fname as Super_fname, SUPER_EMPLOYEE.Lname as Super_lname
from EMPLOYEE
full outer join SUPER_EMPLOYEE on EMPLOYEE.Super_ssn = SUPER_EMPLOYEE.Super_ssn;

DROP TABLE A;
DROP TABLE SUPER_EMPLOYEE;
--d-end

--e-start
SELECT Fname, Minit, Lname from EMPLOYEE, DEPT_LOCATIONS
where Dno = Dnumber and Dlocation = 'Houston';
--e-end
--f-start
SELECT Fname, Minit, Lname from EMPLOYEE, DEPENDENT
where Ssn = Essn and Dependent_name = Fname;
--f-end

--g-start
SELECT  Pno,SUM(Hours) AS 'số giờ làm', COUNT(Essn) AS 'số nhân viên' from WORKS_ON
GROUP BY Pno;
--g-end

--h-start
SELECT distinct * into B from EMPLOYEE
where sex = 'F';
SELECT COUNT(Ssn) AS 'Số nhân viên nữ', AVG(Salary) AS 'Lương trung bình' from B
--h-end

--i-start
SELECT COUNT(Ssn) AS 'EMnumber', AVG(Salary) AS 'AVGslr 'into C from EMPLOYEE
SELECT Dname,EMnumber from DEPARTMENT,C
where  AVGslr > 30000;
--i-end

DROP TABLE PROJECT;
DROP TABLE EMPLOYEE;
DROP TABLE DEPARTMENT;
DROP TABLE DEPT_LOCATIONS;
DROP TABLE WORKS_ON;
DROP TABLE DEPENDENT;

DROP DATABASE COMPANY;