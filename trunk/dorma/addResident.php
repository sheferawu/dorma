<html>
<head>
<script type="text/javascript" src="addJS.js"></script>
</head>
<body>
<form>
Last Name:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="firstname">
<br><br>
First Name: 
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="lastname">
<br><br>
Middle Name: 
&nbsp;<input type="text" name="lastname">
<br><br>
Date of Birth:
&nbsp;
<select name="Month"  onchange="getMonth(this.options[this.selectedIndex].value)">
<option value="Month" >Month</option>
<option value="Jan"  >January</option>
<option value="Feb" >February</option>
<option value="Mar" >March</option>
<option value="Apr" >April</option>
<option value="May" >May</option>
<option value="Jun" >June</option>
<option value="Jul" >July</option>
<option value="Aug" >August</option>
<option value="Sep" >September</option>
<option value="Oct" >October</option>
<option value="Nov" >November</option>
<option value="Dec" >December</option>
</select>
&nbsp;
<div style="display:inline;" id = "Day">
<select name="Day" >
<option value="Day">Day</option>
</select>
</div>
&nbsp;
<div style="display:inline;" id = "Year">
<select name="Year">
<option value="Year">Year</option>
<option value=""></option>
</select>
</div>
<br><br>
Gender:
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<select name="Gender">
<option value="M">Male</option>
<option value="F">Female</option>
</select>
<br><br>
Civil Status:
&nbsp;&nbsp;&nbsp;
<select name="Civil Status">
<option value="single">Single</option>
<option value="married">Married</option>
<option value="separated">Separated</option>
<option value="widowed">Widowed</option>
</select>
<br><br>
Last School Attended: 
&nbsp;
<input type="text" name="lastSchoolAttended" size="25">
<br><br>
School Type:
&nbsp;
<select name="SchoolType">
<option value="Public">Public</option>
<option value="Private">Private</option>
</select>
<br><br>
Relgion: 
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="Religion">
<br><br>
Classification:
&nbsp;
<select name="classification">
<option value="Freshman">Freshman</option>
<option value="Sophomore">Sophomore</option>
<option value="Junior">Junior</option>
<option value="Senior">Senior</option>
</select>
<br><br>
Student Number:
&nbsp;
<select name="Batch">
<option value="1990">1990</option>
</select>
&nbsp;<input type="text" name="StudNumber" size="5">
<br><br>
STFAP Bracket:
&nbsp;
<select name="STFAP Bracket">
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="E1">E1</option>
<option value="E2">E2</option>
</select>
<br><br>
Scholarship:
&nbsp;
<input type="text" name="Scholarship" size="40">
<br> <br>
Monthly Stipend (Php):
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="MonthlyStipend" size="25">
<br><br>
Home Address:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="HomeAddress" size="40">
<br><br>
Region:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Region" size="25">
<br><br>
Telephone Number:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Telephone Number" size="25">
<br><br>
Email:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Email" size="25">
<br><br>
Father:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="FathersName" size="25">
&nbsp;
Occupation:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Occupation" size="25">
&nbsp;
Monthly Income:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="MonthlyIncome" size="25">
<br><br>
Name of Firm or Employer:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="FirmEmployerName" size="40">
<br><br>
Office Address:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="OfficeAddress" size="40">
<br><br>
Mother:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="MothersName" size="25">
&nbsp;
Occupation:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Occupation" size="25">
&nbsp;
Monthly Income:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="MonthlyIncome" size="25">
<br><br>
Name of Firm or Employer:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="FirmEmployerName" size="40">
<br><br>
Office Address:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="OfficeAddress" size="40">
<br><br>
No.of Brother(s):
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="NumBrothers" size="5">
No.of Sister(s):
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="NumSisters" size="5">
Birth Order:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="BirthOrder" size="5">
<br><br>
Other Source of Income:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="IncomeSource" size="5">
&nbsp;
Amount:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Amount" size="15">
Hobbies:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Hobbies" size="25">
Honors Received:
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="text" name="Honors" size="15">





</form>
</body>
</html>