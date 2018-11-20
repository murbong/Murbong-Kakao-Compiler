<?php

	function compile($lang,$code,$input)
	{
	$languageID=$lang;
        error_reporting(0);

	if($_FILES["file"]["name"]!="")
	{
		include "compilers/make.php";
	}
	else
	{
		$_POST["code"] = $code;
		$_POST["input"] = $input;
		switch($languageID)
			{
				case "c":
				{
					return include("compilers/c.php");
					break;
				}
				case "cpp":
				{
					return include("compilers/cpp.php");
					break;
				}

				case "cpp11":
				{
					return include("compilers/cpp11.php");
					break;
				}
			    case "cs":
				{
					return include("compilers/cs.php");
					break;
				}
				case "java":
				{	
					return include("compilers/java.php");
					break;
				}
				case "python2.7":
				{
					return include("compilers/python27.php");
					break;
				}
				case "python3.2":
				{
					return include("compilers/python32.php");
					break;
				}
				case "lua":
				{
				
					return include("compilers/lua.php");
					break;
				}
			}
		}
	}
?>
