<?php

/*

bWAPP, or a buggy web application, is a free and open source deliberately insecure web application.
It helps security enthusiasts, developers and students to discover and to prevent web vulnerabilities.
bWAPP covers all major known web vulnerabilities, including all risks from the OWASP Top 10 project!
It is for educational purposes only.

Enjoy!

Malik Mesellem
Twitter: @MME_IT

© 2014 MME BVBA. All rights reserved.

*/

include("security.php");
include("security_level_check.php");
include("selections.php");

$message = "";

switch($_COOKIE["security_level"])
{

    case "0" :       

        if(isset($_GET["admin"]))                
        {

            if($_GET["admin"] == "1")
            {

                $message = "Cowabunga...<p><font color=\"green\">You unlocked this page using an URL manipulation.</font></p>";

            }

            else
            {

                 $message="<font color=\"red\">This page is locked.</font><p>HINT: check the URL...</p>";

            }

        }

        else 
        {

            header("location: " . $_SERVER["SCRIPT_NAME"] . "?admin=0");

            exit;                  

        }          

        break;

    case "1" :

        if((isset($_COOKIE["admin"])))
        {

            if($_COOKIE["admin"] == "1")
            {

				$message = "Cowabunga...<p><font color=\"green\">You unlocked this page using a cookie manipulation.</font></p>";

            }  

            else
            {

                $message="<font color=\"red\">This page is locked.</font><p>HINT: check the cookies...</p>";

            } 

        }

        else    
        {    

            // Sets a cookie 'admin' when there is no cookie detected
            setcookie("admin", "0", time()+300, "/", "", false, false);

            header("location: " . $_SERVER["SCRIPT_NAME"]);

            exit;

        }        

        break;

    case "2" :             

        // Debugging
        // print_r($_SESSION);

        if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
        {

            $message = "Cowabunga...<p><font color=\"green\">You unlocked this page with a little help from the dba :)</font></p>";

        }

        else
        {

            $message="<font color=\"red\">This page is locked.</font><p>HINT: contact your dba...</p>";

        }            

        break;

    default :  

        if(isset($_GET["admin"]))                
        {

            if($_GET["admin"] == "1")
            {

                $message = "Cowabunga...<p><font color=\"green\">You unlocked this page using an URL manipulation.</font></p>";

            }

            else
            {

                 $message="<font color=\"red\">This page is locked.</font><p>HINT: check the URL...</p>";

            }

        }

        else 
        {                

            header("location: " . $_SERVER["SCRIPT_NAME"] . "?admin=0");

            exit;                  

        }          

        break;

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Architects+Daughter">
<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>

<title>bWAPP - Session Management</title>

</head>

<body>
    
<header>

<h1>bWAPP</h1>

<h2>an extremely buggy web app !</h2>

</header>    

<div id="menu">
      
    <table>
        
        <tr>
            
            <td><a href="portal.php">Bugs</a></td>
            <td><a href="password_change.php">Change Password</a></td>
            <td><a href="user_extra.php">Create User</a></td>
            <td><a href="security_level_set.php">Set Security Level</a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');">Reset</a></td>            
            <td><a href="credits.php">Credits</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Blog</a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);};}?></font></td>
            
        </tr>
        
    </table>   
   
</div> 

<div id="main">

    <h1>Session Mgmt. - Administrative Portals</h1>

    <p><?php echo $message;?></p>

</div>
    
<div id="side">    
    
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>

</div>     
    
<div id="disclaimer">
          
    <p>bWAPP is for educational purposes only / Follow <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> on Twitter and receive our cheat sheet, updated on a regular basis / &copy; 2014 MME BVBA</p>
   
</div>
    
<div id="bee">
    
    <img src="./images/bee_1.png">
    
</div>
    
<div id="security_level">
  
    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">
        
        <label>Set your security level:</label><br />
        
        <select name="security_level">
            
            <option value="0">low</option>
            <option value="1">medium</option>
            <option value="2">high</option> 
            
        </select>
        
        <button type="submit" name="form_security_level" value="submit">Set</button>
        <font size="4">Current: <b><?php echo $security_level?></b></font>
        
    </form>   
    
</div>
    
<div id="bug">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">
        
        <label>Choose your bug:</label><br />
        
        <select name="bug">
   
<?php

// Lists the options from the array 'bugs' (bugs.txt)
foreach ($bugs as $key => $value)
{
    
   $bug = explode(",", trim($value));
   
   // Debugging
   // echo "key: " . $key;
   // echo " value: " . $bug[0];
   // echo " filename: " . $bug[1] . "<br />";
   
   echo "<option value='$key'>$bug[0]</option>";
 
}

?>


        </select>
        
        <button type="submit" name="form_bug" value="submit">Hack</button>
        
    </form>
    
</div>
      
</body>
    
</html>