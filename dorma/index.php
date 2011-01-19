<?php 

		/*Gumagawa ng koneksyon sa database*/
	$con = mysql_connect("localhost","DORMA","dorm");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
		
		
				
if (!mysql_select_db("dormdatabase", $con))
  {
  echo "Error selecting database: " . mysql_error();
  }

		$sql = "CREATE TABLE Resident
		(
		StudentNumber varchar(10) NOT NULL,
		FirstName varchar(30),
		MidName varchar(15),
		LastName varchar(15),
		Bday varchar(20),
		Gender varchar(10),
		CivStatus varchar(10),
		Course varchar(30),
		LastSchoolAttended varchar(50),
		SchoolType varchar(10),
		Religion varchar(20),
		Classification varchar(15),
		STFAPBracket varchar(3),
		MonthlyStipend int,
		Address varchar(50),
		Region varchar(10),
		TelNo int,
		Email varchar(30),
		NumBro int,
		NumSis int,
		BirthOrder varchar(15),
		Ailments varchar(30),
		Medications varchar(30),
		BFGF int,
		College varchar(30),
		Age int,
		RoomNumber int,
		PRIMARY KEY (FirstName, MidName, LastName))";
		/*FOREIGN KEY (RoomNumber) REFERENCE Room(RNumber)
			ON DELETE CASCADE,
		FOREIGN KEY (OrgName) REFERENCE Org(LastName, FirstName, MiddleNmae, OrgName)
			ON DELETE CASCADE
		 )";*/
		$sql = "CREATE TABLE Violation
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		
		DateOfViolation varchar(15),
		ActionTaken varchar(30),
		Date varchar(15),
		Nature varchar(20),
		Primary Key(FirstName,MidName,LastName),
		FOREIGN KEY (LastName) REFERENCES Resident(LastName)
			ON DELETE CASCADE,
		
		FOREIGN KEY (MidName) REFERENCES Resident(MidName)
			ON DELETE CASCADE,
		
		FOREIGN KEY (FirstName) REFERENCES Resident(FirstName)
			ON DELETE CASCADE
		)";
		$sql = "CREATE TABLE Balance
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		Months varchar(30),
		Total int(15,4)
		)";
		$sql = "CREATE TABLE Room
		(
		RoomNumber int(10),
		Capacity int(3)
		)";
		$sql = "CREATE TABLE Appliances
		(
		CRTLNum int(10),
		ORNum int(10),
		RumNum int(10),
		AppName varchar(15);
		)";
		$sql = "CREATE TABLE Org
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		OrgName varchar(50);
		)
		";
		
		$sql = "CREATE TABLE Manpower
		(
		EmpNum varchar(30),
		Name varchar(15),
		DateStarted varchar(8)
		)
		";

		$sql = "CREATE TABLE Workload
		(
		EmpNum varchar(30),
		DateStarted varchar(8),
		DateCompleted varchar(8),
	    Nature varchar(50),
	    Status varchar(30)
		)
		";

		$sql = "CREATE TABLE Scholarship
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		ScholarshipName varchar(20)
		)
		";
		
		$sql = "CREATE TABLE Talent
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		TalentName varchar(20)
		)
		";
	
		
		$sql = "CREATE TABLE HonorsReceived
		(
		LastName varchar(15) NOT NULL,
		
		MidName varchar(15) NOT NULL,
		
		FirstName varchar(30) NOT NULL,
		Honors varchar(20)
		)
		";
		
		
if (!mysql_query($sql,$con))
  {
  echo "Error creating table: " . mysql_error();
  }
mysql_close($con);



?>
<html>
 <head><title>Hello world!</title> </head>
	<body>
		<?php
		echo 'Hello World<br/><br/><br/>';
		?>
		<a href = "addResident.php" > Add Resident </a>
	</body>
</html>