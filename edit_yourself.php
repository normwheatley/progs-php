<?php
include 'sfh3_header.html'; 
include 'configdb.php';
include 'opendb.php';
/*
*/
function ask_for_hashers_details() 
{
   print '<form method="POST" action="edit_yourself.php?function=get_hasher_record">';
   print '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3>';
   echo "<TR><TD VALIGN=TOP>First Name:     </TD><TD><input type=text size=40 name=\"first_name\"> *</TD></TR>";
   echo "<TR><TD VALIGN=TOP>Surname:        </TD><TD><input type=text size=40 name=\"last_name\"> * </TD></TR>";
   echo "<TR><TD VALIGN=TOP>Password:       </TD><TD><input type=password size=40 name=\"password\"> *</TD></TR>";
   print '</TABLE>';
   print '<INPUT TYPE=RESET VALUE="Clear"> <INPUT TYPE=SUBMIT VALUE="Find Me">';
   print '</FORM>';
   print '* means that the field is required';
}

function get_hasher_record()
{
  $last_name = $_POST['last_name']; 
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  if (!$first_name) { 
	$first_name='%';
  }
//-- get the hashers from the hashers table //

$query = "SELECT * from hashers WHERE first_name like '$first_name' and last_name = '$last_name' and password= '$password'";
$result = mysql_query($query);

$num = mysql_numrows($result);
$row = mysql_fetch_assoc($result);
// Now see what parts of the user is allowed to update
switch ($num) {
case 0:  
    echo '<br><center>Sorry, there are no hashers found'; 
    break;
case 1:
   $rowid = "{$row['rowid']}";
   $hash_name = "{$row['hash_name']}";
   $first_name = "{$row['first_name']}";
   $last_name = "{$row['last_name']}";
   $password = "{$row['password']}";
   $email_address = "{$row['email_address']}";
   $run_updater = "{$row['run_updater']}";
   $dbase_updater = "{$row['dbase_updater']}";
   $last_b2b = "{$row['last_b2b']}";
   $home_phone = "{$row['home_phone']}";
   $work_phone = "{$row['work_phone']}";
   $address = "{$row['address']}";
   $comments = "{$row['comments']}";
   $mismanagement = "{$row['mismanagement']}";
   $hide_address = "{$row['hide_address']}";
   $mother_hash = "{$row['mother_hash']}";
   $T_shirt_size = "{$row['T_shirt_size']}";
   $mgmt_role = "{$row['mgmt_role']}";
   $country = "{$row['country']}";
   $active = "{$row['active']}";
   $food_choice = "{$row['food_choice']}";
   echo "<center><h2>Update your information</h2>";
   echo "<form action=\"edit_yourself.php?function=update\" method=post>";
   print '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3>';
   echo "<input type=hidden name=\"rowid\" value=\"$rowid\">";
   echo "<TR><TD>Hash Name:   </TD><TD>   <input type=text size=40 name=\"hash_name\" value=\"$hash_name\"></TD></TR>";
   echo "<TR><TD>First Name:   </TD><TD>  <input type=text size=40 name=\"first_name\" value=\"$first_name\"></TD></TR>";
   echo "<TR><TD>Surname:  </TD><TD><input type=text size=40 name=\"last_name\" value=\"$last_name\"></TD></TR>";
   echo "<TR><TD>Password: </TD><TD><input type=text size=40 name=\"password\" value=\"$password\"></TD></TR>";
   echo "<TR><TD>Email:    </TD><TD><input type=text size=40 name=\"email_address\" value=\"$email_address\"></TD></TR>";
   echo "<TR><TD>Address:   </TD><TD>     <input type=text size=40 name=\"address\" value=\"$address\"></TD></TR>";
   echo "<TR><TD>Home phone: </TD><TD>    <input type=text size=20 name=\"home_phone\" value=\"$home_phone\"></TD></TR>";
   echo "<TR><TD>Work phone:  </TD><TD>   <input type=text size=20 name=\"work_phone\" value=\"$work_phone\"></TD></TR>";
   echo "<TR><TD>Comments:    </TD><TD>   <input type=text size=60 maxlength=500 name=\"comments\" value=\"$comments\"></TD></TR>";
   echo "<TR><TD>Hide address: </TD><TD>  <input type=text size=1 name=\"hide_address\" value=\"$hide_address\"> 1 means yes, 0 means no</TD></TR>";   
   echo "<TR><TD>Active Hasher: </TD><TD> <input type=text size=1 name=\"active\" value=\"$active\"> 1 means yes, 0 means no</TD></TR>";
   echo "<TR><TD>Mother Hash:   </TD><TD> <input type=text size=40 name=\"mother_hash\" value=\"$mother_hash\"></TD></TR>";
   echo "<TR><TD>Country:       </TD><TD> <input type=text size=40 name=\"country\" value=\"$country\"></TD></TR>";
   echo "<TR><TD>Food_choice:   </TD><TD> <input type=text size=20 name=\"food_choice\" value=\"$food_choice\"></TD></TR>";
   echo "<TR><TD>T shirt size:  </TD><TD> <input type=text size=10 name=\"T_shirt_size\" value=\"$T_shirt_size\"></TD></TR>";
   print '</TABLE>';

   echo "<input type=\"Submit\" value=\"update\">";
   echo "<input type=\"Reset\" value=\"cancel\">";
   print '</form>';
   break;
default:
// If more than one person has this username and password we need help!!
   echo "Sorry, $num people have this log in<br>";
   echo "Did you input a first name as well as a last name and password?<br>";
   echo "If you did , then please ask the Web Admin<br>";
   break;
 }
}

function update_hasher_record()
{
$hash_name=$_POST['hash_name'];
$sql_update = "UPDATE hashers SET ";
$sql_update .= "last_name = '".$_POST['last_name']."'";
$sql_update .= ",hash_name = '".$_POST['hash_name']."'";
$sql_update .= ",address = '".$_POST['address']."'";
$sql_update .= ",first_name = '".$_POST['first_name']."'";
$sql_update .= ",email_address = '".$_POST['email_address']."'";
if (!empty ($_POST['last_b2b'])) $sql_update .= ",last_b2b = '".$_POST['last_b2b']."'";
$sql_update .= ",password = '".$_POST['password']."'";
$sql_update .= ",run_updater = '".$_POST['run_updater']."'";
$sql_update .= ",active = '".$_POST['active']."'";
$sql_update .= ",dbase_updater = '".$_POST['dbase_updater']."'";
$sql_update .= ",B2B_updater = '".$_POST['B2B_updater']."'";
$sql_update .= ",home_phone = '".$_POST['home_phone']."'";
$sql_update .= ",work_phone = '".$_POST['work_phone']."'";
$sql_update .= ",comments = '".$_POST['comments']."'";
$sql_update .= ",mismanagement = '".$_POST['mismanagement']."'";
$sql_update .= ",hide_address = '".$_POST['hide_address']."'";
$sql_update .= ",mother_hash = '".$_POST['mother_hash']."'";
$sql_update .= ",T_shirt_size = '".$_POST['T_shirt_size']."'";
$sql_update .= ",mgmt_role = '".$_POST['mgmt_role']."'";
$sql_update .= ",country = '".$_POST['country']."'";
$sql_update .= ",food_choice = '".$_POST['food_choice']."' ";
$sql_update .= " where rowid = '".$_POST['rowid']."'";
$result = mysql_query($sql_update);

if  ($result) echo "<center><h2>Hasher $hash_name updated ok</h2></center>";
else
{
echo "Sorry, there was an error updating  hasher $hash_name!<br><br>";
echo "The query was ... $sql_update<br>";
}
mysql_close();	
}

$function = $_GET['function'];
if (!$function)
{ 
  ask_for_hashers_details(); 
}
elseif ($function=="get_hasher_record")
{
  get_hasher_record();
}
elseif ($function = "update") 
{	
  update_hasher_record();
}

include 'sfh3_footer.html'; 
?>