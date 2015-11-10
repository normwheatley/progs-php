<?php
include 'sfh3_header.html';
include 'configdb.php';
include 'opendb.php';
error_reporting(E_ALL & ~E_NOTICE);
//
// usage http://localhost/sfh3/edit_run?run=123
//

function update_run()
{
$run = $_POST['run'];
$sql_select = "UPDATE run_schedule SET ";
$sql_select .= "run_date = '".$_POST['run_date']."'";
if (!empty ($_POST['start_time'])) $sql_select .=   ",start_time = '".$_POST['start_time']."'";
if (!empty ($_POST['hares'])) $sql_select .=   ",hares = '".$_POST['hares']."'";
if (!empty ($_POST['location'])) $sql_select .=   ",location = '".$_POST['location']."'";
if (!empty ($_POST['On_On_location'])) $sql_select .=   ",On_On_location = '".$_POST['On_On_location']."'";
if (!empty ($_POST['Comments'])) $sql_select .=   ",Comments = '".$_POST['comments']."'";
if (!empty ($_POST['directions']))$sql_select .=   ",directions = '".$_POST['directions']."'";
if (!empty ($_POST['hash'])) $sql_select .= ",Hash = '".$_POST['hash']."'";
if (!empty ($_POST['run_map'])) $sql_select .=   ",run_map = '".$_POST['run_map']."'";
$sql_select .= " where run_number = '".$_POST['run']."'";

error_reporting(E_ALL^E_NOTICE); 
$result = mysql_query($sql_select);

if  ($result) echo "<center><h2>Run $run updated ok</h2></center>";
else
{
echo "Sorry, there was an error updating run $run!<br><br>";
echo "The query was ... $sql_select<br>";
}
mysql_close();
}

function delete_run()
{
  $run = $_POST['run'];
  $sql_delete = "DELETE from run_schedule WHERE run_number = $run";
  echo "delete stmt is $sql_delete<br>";
  $result = mysql_query($sql_delete);

  if  ($result) echo "<center><h2>Run $run deleted ok</h2></center>";
  else
  {
    echo "Sorry, there was an error deleting $run!<br><br>";
    echo "The query was ... $sql_delete<br>";
  }
  mysql_close();
}
 
function show_run()
{	
   $run = $_GET['run']; 
//-- get the run from the run_schedule table //

  $query = "SELECT * from run_schedule WHERE run_number = $run";
  $result = mysql_query($query);

  $row = mysql_fetch_assoc($result);
  $run_date = "{$row['run_date']}";
  $start_time = "{$row['start_time']}";
  $hares = "{$row['hares']}";
  $location = "{$row['location']}";
  $On_On_location = "{$row['On_On_location']}";
  $comments = "{$row['comments']}";
  $directions = "{$row['directions']}";
  $Hash = "{$row['Hash']}";
  $run_map = "{$row['run_map']}";
  echo "<center><h2>Updating run number $run</h2></center>";
  echo "<pre>";
  echo "<form action=\"edit_run.php\" method=post>";
  echo "<input type=hidden name=\"run\" value=\"$run\">";
  echo "Run Number: $run<br>";
  echo "Date:       <input type=text size=12 name=\"run_date\" value=\"$run_date\"><br>";
  echo "Time:       <input type=text size=20 name=\"start_time\" value=\"$start_time\"><br>";
  echo "Hares:      <input type=text size=50 maxlength=50 name=\"hares\" value=\"$hares\"><br>";
  echo "Location:   <input type=text size=60 maxlength=500 name=\"location\" value=\"$location\"><br>";
  echo "On On:      <input type=text size=60 maxlength=500 name=\"On_On_location\" value=\"$On_On_location\"><br>";
  echo "Comments:   <input type=text size=60 maxlength=500 name=\"comments\" value=\"$comments\"><br>";
  echo "Directions: <input type=text size=60 maxlength=500 name=\"directions\" value=\"$directions\"><br>";
  echo "Map:        <input type=text size=60 maxlength=500 name=\"run_map\" value=\"$run_map\"><br>";
  echo "Hash:       <input type=text size=12 maxlength=50 name=\"hash\" value=\"$Hash\"><br>";
  echo "<br>";
  echo "<input type=\"Submit\" name=\"function\" value=\"update\">";
  echo "<input type=\"Submit\" name=\"function\" value=\"delete\">";
  echo "<input type=\"Reset\" value=\"cancel\">";
  print '</form>';
  echo "</pre>";
  mysql_close();
  mysql_free_result($result);
}
/*
 * Now this is where the program actually starts. First we see if we were called with a 
 * run number and what we're supposed to do (ie function value)
 */
$function = $_POST['function'];
$run = $_POST['run'];
if (!$function)
{ 
  show_run();
}
elseif ($function=="delete")
{
  delete_run();
}
elseif ($function = "update") 
{	
  update_run();
}

include 'sfh3_footer.html';
?>