<?php 
include 'sfh3_header.html'; 
include 'configdb.php';
include 'opendb.php';
/*
*/
function get_login_details() 
{
   print 'In order to change the data in the database, you must have certain privileges. So please log in.';
   print '<form method="POST" action="login.php?insert=true">';
   print '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3>';
   echo "<TR><TD VALIGN=TOP>First Name:     </TD><TD><input type=text size=40 name=\"first_name\"> *</TD></TR>";
   echo "<TR><TD VALIGN=TOP>Surname:        </TD><TD><input type=text size=40 name=\"last_name\"> * </TD></TR>";
   echo "<TR><TD VALIGN=TOP>Password:       </TD><TD><input type=password size=40 name=\"password\"> *</TD></TR>";
   print '</TABLE>';
   print '<INPUT TYPE=RESET VALUE="Clear"> <INPUT TYPE=SUBMIT VALUE="Login">';
   print '</FORM>';
   print '* means that the field is required';
}

function login_hasher()
{
   $last_name = $_POST['last_name']; 
   $password = $_POST['password'];
   $first_name = $_POST['first_name'];
   if (!$first_name) { 
	$first_name='%';
  }	

//-- get the user from the login table //

  $query = "SELECT * from hashers WHERE last_name = '$last_name' and password = '$password' and first_name like '$first_name'";
  $result = mysql_query($query);

  $num = mysql_numrows($result);
// Now see what parts of the user is allowed to update
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  $run_updater = "{$row['run_updater']}";
  $dbase_updater = "{$row['dbase_updater']}";
  $hash_name= "{$row['hash_name']}";
  mysql_close();
  mysql_free_result($result);

switch ($num) {
  case 0:  
    echo '<br>Sorry, you are not in the database' . mysql_error();
    echo '<br>Please try again';
    $err = mysql_error();
    print $err;
    break;
  case 1:
//print "successfully logged into system.";
//proceed to perform website’s functionality – e.g. present information to the user
     include 'edit_db.php';
     break;
  default:
// If more than one person has this username and password we need help!!
   echo "Sorry, $num people have this log in<br>";
   echo "Did you input a first name as well as a last name and password?<br>";
   echo "If you did , then please ask the Web Admin<br>";
   break;
}
}


if (empty($_REQUEST['insert'])) 
{
   get_login_details(); 
}
else
{
  login_hasher();
}
include 'sfh3_footer.html'; 

?>
