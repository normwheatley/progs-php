<?php
include 'sfh3_header.html'; 
/*
*/

function show_runs() 
{
include 'configdb.php';
include 'opendb.php';
error_reporting(E_ALL & ~E_NOTICE);

$run_number = $_POST['run_number']."%";
$run_date = $_POST['run_date']."%";
$hares = $_POST['hares']."%";

$query = "SELECT * from run_schedule WHERE run_number like '$run_number' and run_date like '$run_date' and hares like '$hares' order by '$run_number' desc";
$result = mysql_query($query);

$num = mysql_numrows($result); 
// Now see what parts of the user is allowed to update
switch ($num) {
case 0:  
    echo '<br><center>Sorry, there are no runs found'; 
    break;
default:
   echo "<center><h2> Update a run - $num runs were found</h2>";
   echo "<table border=1>";
   echo "<tr><td><b>Run Number</td><td><b>Date</td><td><b>Hares</td><td><b>Location</td></tr>";
   while ($row = mysql_fetch_assoc($result)) 
   	{
      $run_num = "{$row['run_number']}";
      $run_date = "{$row['run_date']}";
      $hares = "{$row['hares']}";
      $location = "{$row['location']}";
      echo "<tr><td><A href='edit_run.php?run=$run_num'>$run_num</a></td><td>$run_date</td><td>$hares</td><td>$location</td></tr>";
     }
    echo "</table>";
  }
}

function get_run_search_criteria() {
   print '<center><h2>Update run</h2></center><p>';
   print '<form method="POST" action="update_run.php">';
   print '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3>';
   print '<TR><TD VALIGN=TOP>Run Number: </td><TD VALIGN=TOP><INPUT NAME="run_number" TYPE=TEXT SIZE=8 MAXLENGTH=8></td></tr>';
   print '<TR><TD VALIGN=TOP>Date: </td><TD VALIGN=TOP><INPUT NAME="run_date" TYPE=TEXT SIZE=12 MAXLENGTH=12></td></tr>';
   print '<TR><TD VALIGN=TOP>Hares: </td><TD VALIGN=TOP><INPUT NAME="hares" TYPE=TEXT SIZE=40 MAXLENGTH=40></td></tr>';
   print '</TABLE>';
   print '<INPUT TYPE=RESET VALUE="clear"> <INPUT TYPE=SUBMIT name="submit" VALUE="find">';
   print '</FORM>';
}

if (empty($_REQUEST['submit'])) 
{
   get_run_search_criteria(); 
}
else
{
  show_runs();
}
include 'sfh3_footer.html';
?>