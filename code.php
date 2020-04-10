<?php

if ( isset( $_POST["submit"] ) ) {
$reg = $_POST["reg"];
$marks1=$_POST["subject1"];
$marks2=$_POST["subject2"];
$marks3=$_POST["subject3"];
$marks4=$_POST["subject4"];
$marks5=$_POST["subject5"];

$conn=new mysqli("localhost","root","aaa","newDB");
if($conn->conn_error)
{
echo $conn->error;
}
else
{
$sql="select * from student where reg= '$reg'";
$result=$conn->query($sql);
if($result->num_rows>0) 
{
$msg="Registration Number Already Exists!!";
}
else{
$sum=$marks1+$marks2+$marks3+$marks4+$marks5;
$avg=$sum/500;
$percentage=$avg*100;

$st=$conn->prepare("INSERT INTO student(reg,marks1,marks2,marks3,marks4,marks5,percentage) values(?,?,?,?,?,?,?)");
$st->bind_param("iiiiiid",$reg,$marks1,$marks2,$marks3,$marks4,$marks5,$percentage);
$st->execute();
$msg="<br>percentage is ".$percentage."<br>Submitted Successfully";

}

}

}
?>
<html>
<head>
<title>Calculate Average</title>
<style>


.formcontainer{

  background: #f1f1f1;
  color: #000;
  border: 1px solid #ccc;

  padding: 20px;
  margin-top: 50px;
  margin-left:200px;
  margin-right:100px;

}
</style>
</head>
<body>
<form action="deepak.php" method="post">
<div class="formcontainer">
Reg No:
<input type="number" name="reg" placeholder="enter Reg No"  required><br><br>
Subject1:
<input type="number" name="subject1" placeholder="enter Marks 1" min=0 max=100 required><br><br>
Subject2:
<input type="number" name="subject2" placeholder="enter Marks 2" min=0 max=100 mirequired><br><br>
Subject3:
<input type="number" name="subject3" placeholder="enter Marks 3" min=0 max=100 required><br><br>
Subject4:
<input type="number" name="subject4" placeholder="enter Marks 4" min=0 max=100 required><br><br>
Subject5:
<input type="number" name="subject5" placeholder="enter Marks 5" min=0 max=100 required><br><br>

<input type="submit" name="submit" value="Submit">

<?php if(msg!=null) echo $msg; ?>
</div>
</form>




</body>
</html>
