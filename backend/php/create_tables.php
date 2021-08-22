<?php
	error_reporting(E_ALL);
	include("common/dbddconnect.php"); 

function drop_table($con, $name)
{
  $query= "drop table if exists `".$name."`;" ;

  if (!mysqli_query($con, $query))
  {
	echo $query . "<br>";
	echo "Error description: " . mysqli_error($con) ;
  }
  else{
	echo "Drop table ".$name." OK.<br>";
	echo "<br><br>";
  }
}

function drop_tables($con)
{
	drop_table($con,"Food");
}

function create_tables($con)
{
	$query=
		"create table `Food` ("
		.   "id varchar(100) not null,"
		.   "name varchar(100) not null," 
		.	"type varchar(100) not null," 
		.	"shop varchar(100) not null," 
		.	"url varchar(1024) not null," 
		.	"mid int not null," 
		.	"h1 int not null," 
		.	"h2 int not null," 
		.	"h3 int not null," 
		.	"h4 int not null," 
		.	"h5 int not null," 
		.	"h6 int not null," 
		.	"h7 int not null," 
		.	"h8 int not null," 
		.	"h9 int not null," 
		.	"h10 int not null," 
		.	"h11 int not null," 
		.	"h12 int not null," 
		.	"h13 int not null," 
		.	"h14 int not null," 
		.	"h15 int not null," 
		.	"h16 int not null," 
		.	"date_created datetime default current_timestamp, "
		.   "last_updated datetime default current_timestamp,"
		.	"primary key(id)) engine=InnoDB default charset=utf8mb4;"
		;

	if (!mysqli_query($con, $query))
	{
		echo $query . "<br>";
		echo "Error description: " . mysqli_error($con) ;
		echo "<br><br>";
	}
	else{
		echo "Create table Food OK.<br>";
		echo "<br><br>";
	}
}
?><html>
<head>
<style>
.d_table {
  padding:5px;
  margin:2px;
  vertical-align:top;
}
.d_tr {
  vertical-align:top;
}
.d_td {
  display:inline-block;
  padding-left:10px;
  width:150px;
}
.d_submit {
  width:100px;
}
</style>
</head>
<body>
<div style="padding:100px; margin:100px">
<?php

if( isset($_POST['action']) )
{
  $action = $_POST["action"];
	echo "action = " . $action ."<br><br>";

  if($action=="create")
  {
    create_tables($con);
  }
  else if($action=="drop")
  {
    drop_tables($con);
  }
}
else
{
  echo "What's up?";
}
 ?><br><br><br>
<div class="d_table" border=1>
  <div class="d_tr">
  <div class="d_td">Create table:</div>
  <div class="d_td">
    <form method=post action="#">
      <input type="hidden" name="action" value="create">
      <input class="d_submit" type="submit" value="Create">
    </form></div><div>
    <div class="d_tr">
  <div class="d_td">Drop table:</div>
  <div class="d_td">
    <form method=post action="#">
      <input type="hidden" name="action" value="drop">
      <input class="d_submit" type="submit" value="Drop">
    </form></div></div>
  <div class="d_td">Refresh:</div>
  <div class="d_td">
    <form method=get action="#">
      <input class="d_submit" type="submit" value="Refresh">
    </form></div></div>
</div>

</div>

 </body>
 </html>
 <?php include("common/dbddclose.php"); ?>

	
				