<?php 
include 'sfh3_header.html'; 
/*
 This adds a hasher to the database. It first writes out a form that asks for the hasher details, when the Add Hasher button is called, the form calls itself and the insert_hasher function is called to actually add the hasher.
*/
  error_reporting(E_ALL & ~E_NOTICE);

function insert_hasher() {
  include 'configdb.php';
  include 'opendb.php';

  $hash_name = $_POST['hash_name'];
  $insert="INSERT INTO hashers set ".
  $insert .= "hash_name = '".$hash_name."'";
  $insert .= ",first_name = '".$_POST['first_name']."'";
  $insert .= ",last_name = '".$_POST['last_name']."'";
  $insert .= ",password = '".$_POST['password']."'";
  $insert .= ",email_address = '".$_POST['email_address']."'";
  $insert .= ",address = '".$_POST['address']."'";
  $insert .= ",active = '".$_POST['active']."'";
  $insert .= ",home_phone = '".$_POST['home_phone']."'";
  $insert .= ",work_phone = '".$_POST['work_phone']."'";
  $insert .= ",comments = '".$_POST['comments']."'";
  $insert .= ",hide_address = '".$_POST['hide_address']."'";
  $insert .= ",mother_hash = '".$_POST['mother_hash']."'";
  $insert .= ",T_shirt_size = '".$_POST['T_shirt_size']."'";
  $insert .= ",country = '".$_POST['country']."'";
  $insert .= ",food_choice = '".$_POST['food_choice']."' ";
  
  $result = mysql_query($insert);
  if  ($result) echo "<center><h2>Hasher $hash_name was added successfully</h2></center><p>";
  else
  {
   echo "<center><h2>Sorry, there was an error adding hasher - $hash_name!<br>";
   echo "Please make sure the hasher doesn't already exist in the database.</h2></center>";
   echo "The insert statement was .... $insert<p>";
   $MYSQL_ERRNO = mysql_errno();
   $MYSQL_ERROR = mysql_error();
   echo "The error was $MYSQL_ERRNO ... $MYSQL_ERROR<br>";
   
  }
  mysql_close();
}

function get_hasher_details() 
{
   print '<form method="POST" action="add_yourself.php?insert=true">';
   print '<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3>';
   echo "<TR><TD VALIGN=TOP>Hash Name:      </TD><TD><input type=text size=40 name=\"hash_name\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>First Name:     </TD><TD><input type=text size=40 name=\"first_name\"> *</TD></TR>";
   echo "<TR><TD VALIGN=TOP>Surname:        </TD><TD><input type=text size=40 name=\"last_name\"> * </TD></TR>";
   echo "<TR><TD VALIGN=TOP>Password:       </TD><TD><input type=text size=40 name=\"password\"> *</TD></TR>";
   echo "<TR><TD VALIGN=TOP>Email:          </TD><TD><input type=text size=40 name=\"email_address\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Address:        </TD><TD><input type=text size=40 name=\"address\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Home phone:     </TD><TD><input type=text size=20 name=\"home_phone\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Work phone:     </TD><TD><input type=text size=20 name=\"work_phone\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Comments:       </TD><TD><input type=text size=60 maxlength=500 name=\"comments\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Hide address:   </TD><TD><input type=radio name=\"hide_address\" value=\"1\">Yes <input type=radio name=\"hide_address\" value=\"0\" checked>No </td></tr>";
   echo "<TR><TD VALIGN=TOP>Active Hasher:  </TD><TD><input type=radio name=\"active\" value=\"1\" checked>Yes <input type=radio name=\"active\" value=\"0\">No </td></tr>";
   echo "<TR><TD VALIGN=TOP>Mother Hash:    </TD><TD><input type=text size=40 name=\"mother_hash\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Country:        </TD><TD><input type=text size=40 name=\"country\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>Food choice:    </TD><TD><input type=text size=20 name=\"food_choice\"></TD></TR>";
   echo "<TR><TD VALIGN=TOP>T shirt size:   </TD><TD><input type=text size=10 name=\"T_shirt_size\"></TD></TR>";
   print '</TABLE>';
   print '<INPUT TYPE=RESET VALUE="Clear"> <INPUT TYPE=SUBMIT VALUE="Submit">';
   print '</FORM>';
}

if (empty($_REQUEST['insert'])) 
{
   get_hasher_details(); 
   print '* means that the field is required';
}
else
{
  insert_hasher();
}

include 'sfh3_footer.html';
?>
