<?php
     chdir("execute");
	$CC="g++";
	$out="timeout 5s ./a.out";
	$code=$_POST["code"];
	$input=$_POST["input"];
	$filename_code="main.cpp";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	$check=0;

	//if(trim($code)=="")
	//die("The code area is empty");
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);
	$executionStartTime = microtime(true);

	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		$ret= $output;
	}
	else if(!strpos($error,"error"))
	{
		$ret=$error;
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		$ret= $output;
	}
	else
	{
		$ret= $error;
		$check=1;
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	//$ret .= "\nCompiled And Executed In: $seconds s";
	if($check==1)
	{
		//echo "<pre>Verdict : CE</pre>";
	}
	else if($check==0 && $seconds>3)
	{
		//echo "<pre>Verdict : TLE</pre>";
	}
	else if(trim($output)=="")
	{
		//echo "<pre>Verdict : WA</pre>";
	}
	else if($check==0)
	{
		//echo "<pre>Verdict : AC</pre>";
	}
	exec("rm $filename_code");
	exec("rm *.o");
	exec("rm *.txt");
	exec("rm $executable");
	chdir("../");
	return $ret;
?>

