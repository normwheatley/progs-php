<?php 
include 'sfh3_header.html';
include 'configdb.php';
include 'opendb.php';
error_reporting(E_ALL & ~E_NOTICE);
//
// usage http://localhost/sfh3/edit_hasher_main2?hasher=123
//

function update_hashers()
{
$hash_name=$_POST['hash_name'];
$sql_update = "UPDATE hashers SET ";
$sql_update .= "last_name = '".$_POST['last_name']."'";
$sql_update .= ",hash_name = '".$_POST['hash_name']."'";
$sql_update .= ",address = '".$_POST['address']."'";
$sql_update .= ",email_address = '".$_POST['email_address']."'";
$sql_update .= ",first_name = '".$_POST['first_name']."'";
$sql_update .= ",last_b2b = '".$_POST['last_b2b']."'";
$sql_update .= ",password = '".$_POST['password']."'";
$sql_update .= ",run_updater = '".$_POST['run_updater']."'";
$sql_update .= ",active = '".$_POST['active']."'";
$sql_update .= ",dbase_updater = '".$_POST['dbase_updater']."'";
$sql_update .= ",B2B_updater = '".$_POST['B2B_updater']."'";
$sql_update .= ",home_phone = '".$_POST['home_phone']."'";
$sql_update .= ",work_phone = '".$_POST['work_phone']."'";
$sql_update .= ",comments = '".$_POST['comments']."'";
$sql_update .= ",mismanagement = '".$_POST['mismanagement']."'";
$sql_update .= ",mgmt_role = '".$_POST['mgmt_role']."'";
$sql_update .= ",hide_address = '".$_POST['hide_address']."'";
$sql_update .= ",mother_hash = '".$_POST['mother_hash']."'";
$sql_update .= ",T_shirt_size = '".$_POST['T_shirt_size']."'";
$sql_update .= ",country = '".$_POST['country']."'";
$sql_update .= ",food_choice = '".$_POST['food_choice']."' ";
$sql_update .= " where rowid = '".$_POST['rowid']."'";

error_reporting(E_ALL^E_NOTICE); 
$result = mysql_query($sql_update);

if  ($result) echo "<center><h2>Hasher $hash_name updated ok</h2></center>";
else
{
echo "Sorry, there was an error updating  hasher $hash_name!<br><br>";
echo "The query was ... $sql_update<br>";
}
mysql_close();
}

if (empty($_REQUEST['update'])) 
{
$hasher_id = $_GET['hasher']; 
//-- get the hasher from the hashers table //

$query = "SELECT * from hashers WHERE rowid = $hasher_id";

error_reporting(E_ALL^E_NOTICE); 
$result = mysql_query($query);
// Now see what parts of the user is allowed to update
$row = mysql_fetch_assoc($result);
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
   print '<center><h2>Update hasher</h2></center><p>';
   echo "<pre>";
   echo "<form action=\"edit_hasher.php?update=true\" method=post>";
   echo "<input type=hidden name=\"rowid\" value=\"$rowid\">";
   echo "Hash Name:      <input type=text size=40 name=\"hash_name\" value=\"$hash_name\"><br>";
   echo "First Name:     <input type=text size=40 name=\"first_name\" value=\"$first_name\"><br>";
   echo "Surname:        <input type=text size=40 name=\"last_name\" value=\"$last_name\"><br>";
   echo "Password:       <input type=text size=40 name=\"password\" value=\"$password\"><br>";
   echo "Email:          <input type=text size=40 name=\"email_address\" value=\"$email_address\"><br>";
   echo "Address:        <input type=text size=40 name=\"address\" value=\"$address\"><br>";
   echo "Home phone:     <input type=text size=20 name=\"home_phone\" value=\"$home_phone\"><br>";
   echo "Work phone:     <input type=text size=20 name=\"work_phone\" value=\"$work_phone\"><br>";
   echo "Comments:       <input type=text size=60 maxlength=500 name=\"comments\" value=\"$comments\"><br>";
   echo "Hide address:   <input type=text size=1 name=\"hide_address\" value=\"$hide_address\"> 1 means yes, 0 means no<br>";   
   echo "Active Hasher:  <input type=text size=1 name=\"active\" value=\"$active\"> 1 means yes, 0 means no<br>";
   echo "Mother Hash:    <input type=text size=40 name=\"mother_hash\" value=\"$mother_hash\"><br>";
   echo "Last B2B:       <input type=text size=6 name=\"last_b2b\" value=\"$last_b2b\"><br>";
   echo "Country:        <input type=text size=40 name=\"country\" value=\"$country\"><br>";
   echo "Food_choice:    <input type=text size=20 name=\"food_choice\" value=\"$food_choice\"><br>";
   echo "T shirt size:   <input type=text size=10 name=\"T_shirt_size\" value=\"$T_shirt_size\"><br>";
   echo "Mismanager:     <input type=text size=1 name=\"mismanagement\" value=\"$mismanagement\"><br>";
   echo "Mgmt role:      <input type=text size=40 name=\"mgmt_role\" value=\"$mgmt_role\"><br>";
   echo "Run updater:    <input type=text size=1 name=\"run_updater\" value=\"$run_updater\"> 1 means yes, 0 means no<br>";   
   echo "Database updater: <input type=text size=1 name=\"dbase_updater\" value=\"$dbase_updater\"> 1 means yes, 0 means no<br>";   
   echo "<input type=\"Submit\" value=\"update\">";
   echo "<input type=\"Reset\" value=\"cancel\">";
   print '</form>';
   echo "</pre>";
   mysql_close();
   error_reporting(E_ALL^E_NOTICE); 
   mysql_free_result($result);
}
else
{
  update_hashers();
}

include 'sfh3_footer.html';
?>

