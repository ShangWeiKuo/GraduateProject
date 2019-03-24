<?php  
    if(isset($_SESSION["account"]))
    {
    	if ($_SESSION["account"] != "admin")
    	{
    		include("part/sidebar-login.php");
    	}
    	else
    	{
    		include("part/sidebar-login-backend.php");
    	}
        
    }
    else
    {
        include("part/sidebar-nologin.php");
    }
?>