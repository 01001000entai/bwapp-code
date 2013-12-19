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

switch($_COOKIE["security_level"])
{
        
    case "0" : 
            
        header("location: ba_insecure_login_1.php");        
        break;
        
    case "1" :
                
        header("location: ba_insecure_login_2.php");        
        break;
        
    case "2" :           
       
        header("location: ba_insecure_login_3.php");        
        break;
        
    default : 
            
        header("location: ba_insecure_login_1.php");        
        break;
       
} 

?>