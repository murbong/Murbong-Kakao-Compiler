<?php

require('compile.php');

$data    = json_decode(file_get_contents('php://input'), true);
$userkey = $data["user_key"];
$content = $data["content"];

$garr['message']['text']     = '잘가!!!';
$garr['keyboard']['type']    = 'buttons';
$garr['keyboard']['buttons'] = array(
    'C', 
    'C++',
    'C++11',
    'C#',
    'JAVA',
    'Python2',
    'Python3',
    'Lua'
);

$say = json_encode($garr);

$fp = "./userdat/$userkey";

$file = $fp . "lang";
$code = $fp . "code";
//$input = $fp."input";


if ($content == "끝내기"|| $content == "exit") {
    
    echo $say;
    unlink($file);
    unlink($code);
    //unlink($input);
}    

 else {
    
//    if (!file_exists($file)) {
        
        if ($content == "C") {
            
            $message['message']['text'] = 'C!!';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/C/".rand(1,9).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'c');
        } else if ($content == "C++") {
            
            $message['message']['text'] = 'C++!!';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/C/".rand(1,9).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'cpp');
            
        } else if ($content == "C++11") {
            
            $message['message']['text'] = 'C++11!';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/C/".rand(1,9).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'cpp11');
            
        } else if ($content == "C#") {
            
            $message['message']['text'] = 'C# 이 모에요?';
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'cs');
            
        } else if ($content == "JAVA") {
            
            $message['message']['text'] = 'Java요???';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/JAVA/".rand(1,14).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'java');
            
        } else if ($content == "Python2") {
            
            $message['message']['text'] = 'Python2!';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/Python/".rand(1,4).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'python2.7');
            
        } else if ($content == "Python3") {
            
            $message['message']['text'] = 'Python3!!';
			$message['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/Python/".rand(1,4).".png";
	 		$message['message']['photo']['width'] = 480;
	 	    $message['message']['photo']['height'] = 480;
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'python3.2');
            
        } else if ($content == "Lua") {
            
            $message['message']['text'] = 'Lua? 얽ㅋㅋㅋ';
            echo json_encode($message);
            $save = fopen($file, 'w') or die("Unable");
            fwrite($save, 'lua');
            
        }
        
  //  }
   
    
    else {
        if (!file_exists($code)) {
            $save = fopen($code, 'w') or die("Unable");
            fwrite($save, $content);
            $message['message']['text'] = "입력이 있다면 공백으로 구분해 주세요. 없으면 아무키나 누르세요.\n언제든지 나가고싶다면 exit, 끝내기를 타이핑해주세요.";
            
            echo json_encode($message);
            
        } else {
            
            $load = fopen($file, 'r') or die("Unable");
            $lang = fread($load, filesize($file));
            $load = fopen($code, 'r') or die("Unable");
            $codel                  = fread($load, filesize($code));
            $out                    = trim(compile($lang, $codel, $content));
            $arr['message']['text'] = $out;
	    	$arr['message']['photo']['url'] = "http://murbong.ga:8081/kakao/cas/Result/".rand(1,18).".png";
	 		$arr['message']['photo']['width'] = 480;
	 	    $arr['message']['photo']['height'] = 480;
            //$arr['keyboard']['type'] = 'buttons';
            //$arr['keyboard']['buttons'] = array('C','C++','C++11','JAVA','Python2','Python3','Lua');
            echo json_encode($arr);
            
            //unlink($file);
            unlink($code);
            //unlink($input);
            
            
            
            
        }
        
    }
}



?>
