<!--
    Team:			blueSky
    Programmer:		Tommy Wijaya
    Purpose:		Extract Information From Resume, Version 1
    Client:			Milestone Search
    Version:		12.0 11.10.2010
    File:			insert.php
    FYI	: 			This Just Bloddy Hard Dude.
-->

<?php

//PHP Extract PHP File

//http://www.webcheatsheet.com/php/reading_clean_text_from_pdf.php
function decodeAsciiHex($input) {
    $output = "";

    $isOdd = true;
    $isComment = false;

    for($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] != '>'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        switch($c) {
            case '\0': case '\t': case '\r': case '\f': case '\n': case ' ': break;
            case '%': 
                $isComment = true;
            break;

            default:
                $code = hexdec($c);
                if($code === 0 && $c != '0')
                    return "";

                if($isOdd)
                    $codeHigh = $code;
                else
                    $output .= chr($codeHigh * 16 + $code);

                $isOdd = !$isOdd;
            break;
        }
    }

    if($input[$i] != '>')
        return "";

    if($isOdd)
        $output .= chr($codeHigh * 16);

    return $output;
}

function decodeAscii85($input) {
    $output = "";

    $isComment = false;
    $ords = array();
    
    for($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ')
            continue;
        if ($c == '%') {
            $isComment = true;
            continue;
        }
        if ($c == 'z' && $state === 0) {
            $output .= str_repeat(chr(0), 4);
            continue;
        }
        if ($c < '!' || $c > 'u')
            return "";

        $code = ord($input[$i]) & 0xff;
        $ords[$state++] = $code - ord('!');

        if ($state == 5) {
            $state = 0;
            for ($sum = 0, $j = 0; $j < 5; $j++)
                $sum = $sum * 85 + $ords[$j];
            for ($j = 3; $j >= 0; $j--)
                $output .= chr($sum >> ($j * 8));
        }
    }
    if ($state === 1)
        return "";
    elseif ($state > 1) {
        for ($i = 0, $sum = 0; $i < $state; $i++)
            $sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
        for ($i = 0; $i < $state - 1; $i++)
            $ouput .= chr($sum >> ((3 - $i) * 8));
    }

    return $output;
}
function decodeFlate($input) {
    return @gzuncompress($input);
}

function getObjectOptions($object) {
    $options = array();
    if (preg_match("#<<(.*)>>#ismU", $object, $options)) {
        $options = explode("/", $options[1]);
        @array_shift($options);

        $o = array();
        for ($j = 0; $j < @count($options); $j++) {
            $options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));
            if (strpos($options[$j], " ") !== false) {
                $parts = explode(" ", $options[$j]);
                $o[$parts[0]] = $parts[1];
            } else
                $o[$options[$j]] = true;
        }
        $options = $o;
        unset($o);
    }

    return $options;
}
function getDecodedStream($stream, $options) {
    $data = "";
    if (empty($options["Filter"]))
        $data = $stream;
    else {
        $length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
        $_stream = substr($stream, 0, $length);

        foreach ($options as $key => $value) {
            if ($key == "ASCIIHexDecode")
                $_stream = decodeAsciiHex($_stream);
            if ($key == "ASCII85Decode")
                $_stream = decodeAscii85($_stream);
            if ($key == "FlateDecode")
                $_stream = decodeFlate($_stream);
        }
        $data = $_stream;
    }
    return $data;
}
function getDirtyTexts(&$texts, $textContainers) {
    for ($j = 0; $j < count($textContainers); $j++) {
        if (preg_match_all("#\[(.*)\]\s*TJ#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
        elseif(preg_match_all("#Td\s*(\(.*\))\s*Tj#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
    }
}
function getCharTransformations(&$transformations, $stream) {
    preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
    preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);

    for ($j = 0; $j < count($chars); $j++) {
        $count = $chars[$j][1];
        $current = explode("\n", trim($chars[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))
                $transformations[str_pad($map[1], 4, "0")] = $map[2];
        }
    }
    for ($j = 0; $j < count($ranges); $j++) {
        $count = $ranges[$j][1];
        $current = explode("\n", trim($ranges[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $_from = hexdec($map[3]);

                for ($m = $from, $n = 0; $m <= $to; $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);
            } elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $parts = preg_split("#\s+#", trim($map[3]));
                
                for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));
            }
        }
    }
}
function getTextUsingTransformations($texts, $transformations) {
    $document = "";
    for ($i = 0; $i < count($texts); $i++) {
        $isHex = false;
        $isPlain = false;

        $hex = "";
        $plain = "";
        for ($j = 0; $j < strlen($texts[$i]); $j++) {
            $c = $texts[$i][$j];
            switch($c) {
                case "<":
                    $hex = "";
                    $isHex = true;
                break;
                case ">":
                    $hexs = str_split($hex, 4);
                    for ($k = 0; $k < count($hexs); $k++) {
                        $chex = str_pad($hexs[$k], 4, "0");
                        if (isset($transformations[$chex]))
                            $chex = $transformations[$chex];
                        $document .= html_entity_decode("&#x".$chex.";");
                    }
                    $isHex = false;
                break;
                case "(":
                    $plain = "";
                    $isPlain = true;
                break;
                case ")":
                    $document .= $plain;
                    $isPlain = false;
                break;
                case "\\":
                    $c2 = $texts[$i][$j + 1];
                    if (in_array($c2, array("\\", "(", ")"))) $plain .= $c2;
                    elseif ($c2 == "n") $plain .= '\n';
                    elseif ($c2 == "r") $plain .= '\r';
                    elseif ($c2 == "t") $plain .= '\t';
                    elseif ($c2 == "b") $plain .= '\b';
                    elseif ($c2 == "f") $plain .= '\f';
                    elseif ($c2 >= '0' && $c2 <= '9') {
                        $oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
                        $j += strlen($oct) - 1;
                        $plain .= html_entity_decode("&#".octdec($oct).";");
                    }
                    $j++;
                break;

                default:
                    if ($isHex)
                        $hex .= $c;
                    if ($isPlain)
                        $plain .= $c;
                break;
            }
        }
        $document .= "\n";
    }

    return $document;
}

function pdf2text($filename) {
    $infile = @file_get_contents($filename, FILE_BINARY);
    if (empty($infile))
        return "";

    $transformations = array();
    $texts = array();

    preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);
    $objects = @$objects[1];

    for ($i = 0; $i < count($objects); $i++) {
        $currentObject = $objects[$i];

        if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {
            $stream = ltrim($stream[1]);

            $options = getObjectOptions($currentObject);
            if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))
                continue;

            $data = getDecodedStream($stream, $options); 
            if (strlen($data)) {
                if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {
                    $textContainers = @$textContainers[1];
                    getDirtyTexts($texts, $textContainers);
                } else
                    getCharTransformations($transformations, $data);
            }
        }
    }

    return getTextUsingTransformations($texts, $transformations);
}
?> 

<?php 
//Parse Word From Word Doc
function parseWord($userDoc) 
{
	$fileHandle = fopen($userDoc, "r");
	$line = @fread($fileHandle, filesize($userDoc)); 
	$lines = explode(chr(0x0D),$line);
	$outtext = "";
	foreach($lines as $thisline)
	{
		$pos = strpos($thisline, chr(0x00));
		if (($pos !== FALSE)||(strlen($thisline)==0))
		{
		} else {
		$outtext .= $thisline." ";
		}
	}
	$outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
	return $outtext;
}
?>

<?php
//Get Email From Doc
function getEmail($doc){
	$lengthOfQueriedEmail = 60;
	$mystring = $doc;
	$findme   = '@';
	$pos = strpos($mystring, $findme); //position of @\
	
	if ($pos == "" ){
		$correctEmail = "";
		return $correctEmail;
		
	}else{
		
		if ($pos > 30){
		$start = $pos - 30; //find first of the @ position by using " " (Space)
		}
		else{
		$start = 0;
		}
		
			$email = substr($mystring, $start, $lengthOfQueriedEmail);
		
			$atPosition = strpos ($email,'@');
			
			$startPos = 0;
			$i = $atPosition;
			$value = NULL;
				while($startPos == 0){
					$value = substr($email,$i,1);
					if ($value == " "){
						$startPos = $i;
					}
					$i--;
				}
		
			$endPos = 0;
			$i = $atPosition;
			$value = NULL;
			while($endPos == 0){
				$value = substr($email,$i,1);
				if ($value == " "){
					$endPos = $i;
				}
				$i++;
			}
	
		$length = $endPos - $startPos;
		$correctEmail = substr($email, $startPos+1, $length);
	
		if (substr($correctEmail,0,6) == "mailto"){
			$correctEmail = substr($correctEmail,6); //To Take mailto Out From Doc Document
		}
		return $correctEmail;
	}
		
}
?>
<?php
//To Replace All Other Character To Space
function replaceSpace($doc){
	$search  = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
					 'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
					 '1','2','3','4','5','6','7','8','9','0',
					 '!','@','#','$','%','^','&','*','(',')','-','+','_','=',':',
					 '\;','\'','"','\?','\\','/',',','.');
	$i = 0;
	$docLength = strlen($doc);
	while ($i < $docLength){
		$char = substr($doc,$i,1);
		
		$si=0;
		while ($si < sizeof($search)){
			$compare = strcmp($search[$si],$char);
			if ($compare == 0){
				break;
			}
			$si++;
		}
		
		if($si ==  sizeof($search) ){
				$doc = str_replace($char,' ', $doc);
			}	
		$i++;
	}
	return $doc;
}

//Get Name - This Function Get Name From File Name
function getName($doc){	
$firstName="";
$lastName="";

	$capital = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$pos = strpos($doc, "Resume_");
	if ($pos == ""){
		//echo "No Name";
		return false;
	}else{
		$name = substr($doc, $pos+7); //To Get Name From File Name
		$name = substr($name, 0, -4); //Remove the extention character on File Name;

		$namei = 0;
		$nameLength = strlen($name);
		$lastCapital = false;
		
		//To Split First Name And Last Name Using Capital
		while ($namei < $nameLength){
			$char = substr($name,$namei,1);
							$nameSi=0;
							while ($nameSi < sizeof($capital)){							
								$compare = strcmp($capital[$nameSi],$char);							
								if ($compare == 0){
									$lastCapitalPos = $namei;
									$lastCapital = true;
								}
								$nameSi++;
							}
			$namei++;
		}
		if($lastCapital == true){
			$firstName = substr($name,0,$lastCapitalPos);
			$lastName = substr($name,$lastCapitalPos, strlen($name) - ($lastCapitalPos -1 ));
			
			$firstName = strtoupper(substr($firstName,0,1)) .  strtolower(substr($firstName,1));
			$lastName = strtoupper(substr($lastName,0,1)) .  strtolower(substr($lastName,1));
		}else{
			$name = strtoupper(substr($name,0,1)) .  strtolower(substr($name,1));
			$firstName = $name;
			$lastName = $name;
		}
 		$candidateName[] = $firstName;
		$candidateName[] = $lastName;
    	return $candidateName;
	}
}

//Extract Address From Resume
function getAddress($doc){
/*	Sample Address				
		30, 	Highfield Street, 			Durack, 					4077, 		QLD 		Australia
		4/95 	Donald St, 					Brunswick, 					3056, 		Melbourne, 	Australia
		106 	Macquarie St, 				CAPALABA 		QLD 		4157
		30 		Norman Street 				East Brisbane 	QLD 		4169
		5/73-75	Franklin Road, 				Doncaster 		VIC 		3123
		16 		Dumaresq Parade, 			Metford 		NSW 		2323
		91 		Buckwell Drive 				Hassall Grove 	NSW 		2761
		113 	Emsworth Street, 			WYNNUM 			QLD 		4178
		89, 68 	Macarthur Street. 			Parramatta.		NSW 		2150 
		13 		Brushwood Drive, 			Samford, 		Brisbane, 	Queensland 	4520

	*/
	$streetNumber	= "";
	$streetName		= "";
	$city			= "";
	$state			= "";
	$postCode		= "";
	$country		= "";
	
	$stateLong 		= array("Victoria", "New South Wales", "Queensland","Canberra", "South Australia", "Western Australia","Northern Territory", "Hobart", "Launceston");
	$stateShort   	= array("VIC", "NSW", "QLD","CBR", "SA", "WA","NT", "HOB", "LTON");
	$doc     		= str_replace($stateLong, $stateShort, $doc);
	
	$streetTypeS 	= array("St,","Rd,","Ave,","Dr,","Pr,","Cr,");
	$streetTypeL	= array("Street,","Road,","Avenue,","Drive,","Parade,","Court,");
	$doc     		= str_replace($streetTypeS, $streetTypeL, $doc);
	
	$remove 		= array("1","2","3","4","5","6","7","8","9","0",",");
	$alphabeth 		= array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","y","z");
	//Check State
	
	$i=0;
	$statePos="";
	$stateTrue = false;
	while($i < count($stateShort)){
		$statePos = strpos($doc,$stateShort[$i]); 	
		if($statePos != ""){
			$statePosition[] = $statePos;
			$stateTrue = true;
		}
		$i++;
	}
	if ($stateTrue == true){
		$statePos = min($statePosition);
		if ($statePos > 0){
			$state = substr($doc,$statePos,3);
			$i=0;
			while($i < count($stateShort)){
				if ($state == $stateShort[$i]){
					$country = "Australia";
					break;
				}
				$i++;
			}
			//echo $i;
			
				if($i == count($stateShort)){
					$state = "";
					$country = "";
					//echo "No State Found";
				}
		}
	}
	
	//Check Post Code
	$checkPostCode = substr($doc,$statePos+3,6);
	$postI=0;
	while($postI < strlen($checkPostCode)){
		$checkNumber = substr($checkPostCode,$postI,1);
		if(is_numeric($checkNumber)){
			$postCode.=substr($checkPostCode,$postI,1);
			if(strlen($postCode)==4){
				break;
			}
		}
		$postI++;
	}
	if(strlen($postCode)<>4){
		$postCode ="";
		$checkPostCode = substr($doc,$statePos-6,6);
		$postI=0;
		while($postI < strlen($checkPostCode)){
					$checkNumber = substr($checkPostCode,$postI,1);
					if(is_numeric($checkNumber)){
						$postCode.=substr($checkPostCode,$postI,1);
						if(strlen($postCode)==4){
							break;
						}
					}
					$postI++;

		}
	}
	if(strlen($postCode)<>4){
		$postCode="";
	}
	
	//Check Street Name;
	$streetI=0;
	$streetType ="";
	while($streetI<5){
		$streetPos = strpos($doc,substr($streetTypeL[$streetI],0,-1));
		if($streetPos > 0){
			//echo $streetPos;
			$streetType = $streetTypeL[$streetI];
			break;
		}
		$streetI++;		
	}
	
	$streetI=2;
	while($streetName == "" && $streetPos != "" && $streetI < 100){
	 $spacePos = substr($doc,$streetPos-$streetI,1);
		if ($spacePos == " "){
	//		echo $streetI;
			$streetName = substr($doc,$streetPos-$streetI,$streetI);
		}
	$streetI++;
	}
	$streetName .= $streetType;
	$streetName = str_replace($remove,"", $streetName);

	//Check City
	if($streetPos != ""){
	$cityCheck = substr($doc,$streetPos, strpos($doc,$state)-$streetPos);
	$checkFirstSpace = strpos($cityCheck,' ');
	$city = substr($cityCheck,$checkFirstSpace);	
	//Replace ,(comma) and Number to String
	$city     	= str_replace($remove,"", $city);
	}
	
	//Check Street Number
	if($streetName!=""){
		$streetPosName = strpos ($doc,$streetName);
		$streetNumI =0;
		while($streetNumber == "" && $streetNumI < 100){
			//echo $streetPosName;
			$rightPosition = substr($doc,$streetPosName - $streetNumI,1);
			//echo $rightPosition;
			
			//echo "While";
			if(preg_match('/[^A-Za-z]/',$rightPosition)) {
			}else{
				$streetNumber = substr($doc,$streetPosName-($streetNumI-2),$streetNumI-2);
				break;
			}
			$streetNumI++;
		}
	}
	$streetNumber = str_replace(array(","," "),"",$streetNumber);
	
	$fullAddress[] = $streetNumber;
	$fullAddress[] = $streetName;
	$fullAddress[] = $city;
	$fullAddress[] = $state;
	$fullAddress[] = $postCode;
	$fullAddress[] = $country;
	return $fullAddress;
	
}

//Extract Phone Number From Resume
function getContactNumber($doc){
//Strap Out inappropriate character
	$doc = str_replace(" ",'',$doc);
	$doc = str_replace("-",'',$doc);
	$doc = str_replace("(",'',$doc);
	$doc = str_replace(")",'',$doc);
	$doc = str_replace("+",'',$doc);	
	$doc = str_replace("/",'',$doc);	
	//echo $doc;
	
	//value that want to be extract from document
	$mobile="";
	$homePhone="";
	$workPhone=""; 	//Will Not Process Work Phone 
	$workFax="";	//Will Not Process Work Fax
	
	//Help Parameter
	$startNumber=0;
	$lastPosition=0;
	$strapNumber=0;
	$scarp="";
	$docLength = strlen($doc);
	
	//Set the Number of Char Will be Check
	//take 75% of the first Document
	$docLengthCheck = round ($docLength*0.75);
	//echo "Doc Length : ".$docLengthCheck."<br />";
	
	$doc = substr($doc,0,$docLengthCheck);
	//echo "Document : <br />".$doc."<p>";
	
	//strap some resume part for incresing speed or the function
	$strapPosition=0;
	$numberOfStrap=200;
	
	$ifTest=0;
	while ($lastPosition < $docLengthCheck){
		$checkString = substr($doc,$strapPosition,$numberOfStrap);
		//echo "<br />".$checkString;
		if($ifTest == 200){break;}$ifTest++;
		
			while(strlen($checkString) > 10){
				if($ifTest == 200){break;}$ifTest++;
					//$startNumber = strpos($checkString, "0");
					//echo $checkString; 
					$start0 = strpos($checkString, "0");
					//echo "<br/>".$start0;
					$start6 = strpos($checkString, "6");
					
					if($start0 == ""  && $start6 == ""){
						//echo "There is No Telephone Number Here";
						break;
					}
					
					if($start0 != 0){
						//do Nothing
					}
					
					if($start0 == ""){ 
							$start0 = $start6+1;
						}
					if($start6 == ""){ 
							$start6 = $start0+1;
						}
					
					if($start6 != 0){
						//Do Nothing
					}
					//Check Zero Or Six character Come First
					
					if ($start0 < $start6){
						$scarp = substr($checkString, $start0, 10);
						$checkType= "";
						
						//Check if Everything is Number
						if (is_numeric($scarp)){
							$checkType = substr($scarp,1,1);
								if($checkType == '2' || $checkType == '3' || $checkType == '7' || $checkType == '8'){
									$homePhone = $scarp;
								}elseif($checkType == '4'){
									$mobile = $scarp;
								}else{
									//echo "Not Australia Phone Number";
								}
								
								$checkString = substr($checkString,$start0+10);
							}
							else
							{
								$scrapi = 0;
								$scrapNum = 0;
								while($scrapi < strlen($scarp)){
									if(is_numeric(substr($scarp,$scrapi,1))){
										$scrapNum++;
									}else{
										break;
									}
								$scrapi++;		  
								}
								//echo "<br />Not A Phone Number";
								$checkString = substr($checkString,$start0+$scrapNum);
							}
					}
			
					if ($start6 < $start0 ){
						$scarp = substr($checkString, $start6, 11);
						
						$checkType = substr($scarp,1,1);
						if($checkType == '1'){
							$scarp = "0".substr($scarp,2);
						}
								
								
						//Check if Everything is Number
						if (is_numeric($scarp)){
							$checkType = substr($scarp,1,1);
								if($checkType == '2' || $checkType == '3' || $checkType == '7' || $checkType == '8'){
									$homePhone = $scarp;
								}elseif($checkType == '4'){
									$mobile = $scarp;
								}else{
									//echo "Not Australia Phone Number";
								}
								$checkString = substr($checkString,$start6+10);
							}
							else
							{
								$scrapi = 0;
								$scrapNum = 0;
								while($scrapi < strlen($scarp)){
									if(is_numeric(substr($scarp,$scrapi,1))){
										$scrapNum++;
									}else{
										break;
									}
								$scrapi++;		  
								}
								//echo "<br />Not A Phone Number";
								$checkString = substr($checkString,$start6+$scrapNum);
							}
					}			

			}
			
				if($mobile !="" && $homePhone !=""){
					break;
				}
		
		if ($strapPosition + 150 < strlen($doc)){
			$strapPosition += 150;
		}else{
			$numberOfStarp = strlen($doc)-$strapPosition;
			$lastPosition = $docLengthCheck;
		}
	}
	$contactNumber[]=$homePhone;
	$contactNumber[]=$mobile;
	return $contactNumber;
}

function extractResume($documentFile,$fullFilename){
		$finFirstName="";
		$finLastName="";
		$finEmail="";
		$finPhone="";
		$finMobile="";
		$finStreetNumber="";
		$finStreetName="";
		$finCity="";
		$finState="";
		$finPostCode="";
		$finCountry="";

		$userDoc = $documentFile;
		$userDoc =  replaceSpace($userDoc);
		
		
		//Get Name
		list($finFirstName,$finLastName) = getName($fullFilename);
   		
		//Get Email
		$finEmail = getEmail($userDoc);
		list($finPhone,$finMobile) = getContactNumber($userDoc);
		
		//Get Address
		list($finStreetNumber,$finStreetName,$finCity,$finState,$finPostCode,$finCountry)=getAddress($userDoc);;
		
		$resume[]=$finFirstName;
		$resume[]=$finLastName;
		$resume[]=$finEmail;
		$resume[]=$finPhone;
		$resume[]=$finMobile;
		$resume[]=$finStreetNumber;
		$resume[]=$finStreetName;
		$resume[]=$finCity;
		$resume[]=$finState;
		$resume[]=$finPostCode;
		$resume[]=$finCountry;
		
		return $resume;
}
?>

<?php
if(isset($_POST['queryString'])){
	
	$file = $_POST['queryString'];
	$strFilename = $_POST['txtfilename'];
	list($rFirstName,$rLastName,$rEmail,$rPhone,$rMobile,$rStNumber,$rStName,$rCity,$rState,$rPostCode,$rCountry)=	extractResume($file,$strFilename);
	
	$rFirstName = trim($rFirstName);
	$rLastName = trim($rLastName);
	$rEmail  = trim($rEmail);
	$rPhone = trim($rPhone);
	$rMobile  = trim($rMobile);
	$rStNumber  = trim($rStNumber);
	$rStName  = trim($rStName);
	$rCity  = trim($rCity);
	$rState  = trim($rState);
	$rPostCode  = trim($rPostCode);
	$rCountry  = trim($rCountry);
	
	if($rFirstName == "" &&
	   $rLastName == "" &&
	   $rEmail== "" && 
	   $rPhone== "" &&
	   $rMobile== "" && 
	   $rStNumber== "" && 
	   $rStName== "" && 
	   $rCity== "" && 
	   $rState== "" && 
	   $rPostCode== "" && 
	   $rCountry == ""){
		echo "<SCRIPT LANGUAGE=\"javascript\">";
		echo 'alert(\'No Resume File Found\');';
		echo "</SCRIPT>";	
	}
	
	echo "<SCRIPT LANGUAGE=\"javascript\">";
	echo 'function fillResume(){';
	echo 'document.getElementById(\'txtInsertFName\').value=\''.$rFirstName.'\';';
	echo 'document.getElementById(\'txtInsertSurname\').value=\''.$rLastName.'\';';
	echo 'document.getElementById(\'txtInsertEmail\').value=\''.$rEmail.'\';';
	echo 'document.getElementById(\'txtInsertHPhone\').value=\''.$rPhone.'\';';
	echo 'document.getElementById(\'txtInsertMobile\').value=\''.$rMobile.'\';';
	echo 'document.getElementById(\'txtInsertStNum\').value=\''.$rStNumber.'\';';
	echo 'document.getElementById(\'txtInsertStName\').value=\''.$rStName.'\';';
	echo 'document.getElementById(\'txtInsertCity\').value=\''.$rCity.'\';';
	echo 'document.getElementById(\'cboInsertState\').value=\''.$rState.'\';';
	echo 'document.getElementById(\'txtInsertPostCode\').value=\''.$rPostCode.'\';';
	echo 'document.getElementById(\'txtInsertCountry\').value=\''.$rCountry.'\';';
	echo '}';
	echo "fillResume();";
	echo "</SCRIPT>";	
}
?>
