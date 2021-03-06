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
include("functions_external.php");
include("selections.php");

if(isset($_REQUEST["url"]) && ($_COOKIE["security_level"] == "1" || $_COOKIE["security_level"] == "2")) 
{
    
    // Destroys the session and the cookie 'admin
    if($_COOKIE["security_level"] == "2")
    {
        
        // Destroys the session 
        $_SESSION = array();
        session_destroy();

        // Deletes the cookie 'admin' 
        setcookie("admin", "0", time()-300, "/", "", false, false);
        
    }

    switch($_REQUEST["url"])
    {        
        case "1" : 
            
            header("location: http://itsecgames.blogspot.com");            
            break;
        
        case "2" : 
            
            header("location: http://www.linkedin.com/in/malikmesellem");            
            break; 
        
        case "3" : 
            
            header("location: http://twitter.com/MME_IT");            
            break;
        
        case "4" : 
            
            header("location: http://www.mmeit.be/en");            
            break;
        
        default : 
            
            header("location: unvalidated_redir_fwd.php");            
            break;
        
    }

}

if(isset($_REQUEST["url"]) && ($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2"))
{
   
    // Debugging
    // echo $_REQUEST["url"];
    
    header("location: http://" . $_REQUEST["url"]);

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

<title>bWAPP - Unvalidated Redirects and Forwards</title>

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
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>
            
        </tr>
        
    </table>   
   
</div> 

<div id="main">
    
    <h1>Unvalidated Redirects and Forwards</h1>

    <p>Beam Me Up, <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);} ?>...</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

<?php

if($_COOKIE["security_level"] == "1" || $_COOKIE["security_level"] == "2")
{

?>
        <select name="url">

            <option value="1">Blog</option>
            <option value="2">LinkedIn</option>
            <option value="3">Twitter</option>
            <option value="4">Company website</option>

        </select>
<?php

}

else
{

?>
        <select name="url">

            <option value="itsecgames.blogspot.com">Blog</option>
            <option value="www.linkedin.com/in/malikmesellem">LinkedIn</option>
            <option value="twitter.com/MME_IT">Twitter</option>
            <option value="www.mmeit.be/en">Company website</option>

        </select>
<?php

}

?>

        <button type="submit" name="form" value="submit">Beam</button>

    </form>
    
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
