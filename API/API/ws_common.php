<?php
include_once("database_config.php");
ini_set('max_execution_time', 300);

define('MESSAGE_0','Success');
define('MESSAGE_101','No users found.');
define('MESSAGE_501','An unknown error occurred!');
class ws_common
{			
	public function GetAllUsers()
	{
		$array = array();
		$query = "SELECT * FROM `Users`";
		try
		{
			$retval = mysql_query($query);
			if(mysql_num_rows($retval) == 0)
			{
				return $this->JSONResponse(101, MESSAGE_101, $array);
			}
			while ($row = mysql_fetch_array($retval)) 
			{
				$result = new stdClass;
				$result->name =$row['Name'];
				$result->uniqueID = $row['UniqueID'];
				$result->friends = $row['Friends'];
				$result->email = $row['Email'];
				$result->classes = $row['Classes'];
				array_push($array, $result);
			}
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}	
	}
	
	public function CreateRandomString()
	{
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 10) as $k) $rand .= $seed[$k];
		return $rand;
	}
	
	public function CreateUser($ownerFriendId, $name, $emailid)
	{
		$array = array();
		$myRandomString = $this->CreateRandomString();
		
		//create folder
		if (!mkdir("../".$myRandomString, 0777, true)) {
			die('Failed to create folders...');
		}
		$query = "INSERT INTO `Users` (Name, UniqueID, Email, Friends) VALUES('".$name."', '".$myRandomString."', '".$emailid."', '".$ownerFriendId."')";
		mysql_query($query);
		// create index.php
		$query = "SELECT * FROM  `Template`";
		$retval = mysql_query($query);
		$row = mysql_fetch_array($retval);
		$result =  $row['Code'];
		$myNewPage = str_replace("OXb3RDnrFI", $myRandomString, $result);
		$myfile = fopen("../".$myRandomString."/index.php", "w") or die("Unable to open file!");
		fwrite($myfile, $myNewPage);
		fclose($myfile);	
		//make friends with owner
		$query = "SELECT Friends from `Users` where UniqueID = '".$ownerFriendId."'";
		$retval = mysql_query($query);
		if(mysql_num_rows($retval) == 0)
		{
			return $this->JSONResponse(101, MESSAGE_101, $array);
		}
		$row = mysql_fetch_array($retval);
		$result =  $row['Friends'];
		if($result == "")
			$result = $myRandomString;
		else 
			$result = $result."|".$myRandomString;
		$query = "UPDATE `Users` SET Friends='". $result."' where UniqueID = '".$ownerFriendId."'";
		mysql_query($query);
	}
	
	public function getSolution()
	{	
		for($i = 1955; $i<=2014; $i++){
			$myfile = fopen("myData.txt", "r") or die("Unable to open file!");
			$numDeaths = 0;
			$numTornadoes = 0;
			while(!feof($myfile)) {
				$pieces = explode(" ", fgets($myfile));
				if($pieces[0] == $i && $pieces[2] == "AL" && $pieces[1] == 7){
					$numDeaths += $pieces[3];
					$numTornadoes += $pieces[4];
				}

			}
			fclose($myfile);
			echo $numDeaths." ".$numTornadoes."\n";
			 
		}
				
	}
	
	public function getTornadoDataYear($year)
	{
		$myfile = fopen("myData.txt", "r") or die("Unable to open file!");
		$array = array();
		$result->Jan = 0;
		$result->JanCount = 0;
		$result->Feb = 0;
		$result->FebCount = 0;
		$result->Mar = 0;
		$result->MarCount = 0;
		$result->Apr = 0;
		$result->AprCount = 0;
		$result->May = 0;
		$result->MayCount = 0;
		$result->Jun = 0;
		$result->JunCount = 0;
		$result->Jul = 0;
		$result->JulCount = 0;
		$result->Aug = 0;
		$result->AugCount = 0;
		$result->Sep = 0;
		$result->SepCount = 0;
		$result->Oct = 0;
		$result->OctCount = 0;
		$result->Nov = 0;
		$result->NovCount= 0;
		$result->Dec = 0;
		$result->DecCount = 0;
		while(!feof($myfile)) {
			$pieces = explode(" ", fgets($myfile));
			if($pieces[0] == $year)
				switch ($pieces[1])
				{
					case 1:
					$result->Jan = $result->Jan + $pieces[4];
					$result->JanCount = $result->JanCount + $pieces[3];
					break;					
					case 2:
					$result->Feb = $result->Feb + $pieces[4];
					$result->FebCount = $result->FebCount + $pieces[3];
					break;					
					case 3:
					$result->Mar = $result->Mar + $pieces[4];
					$result->MarCount = $result->MarCount + $pieces[3];
					break;					
					case 4:
					$result->Apr = $result->Apr + $pieces[4];
					$result->AprCount = $result->AprCount + $pieces[3];
					break;					
					case 5:
					$result->May = $result->May + $pieces[4];
					$result->MayCount = $result->MayCount + $pieces[3];
					break;					
					case 6:
					$result->Jun = $result->Jun + $pieces[4];
					$result->JunCount = $result->JunCount + $pieces[3];
					break;					
					case 7:
					$result->Jul = $result->Jul + $pieces[4];
					$result->JulCount = $result->JulCount + $pieces[3];
					break;					
					case 8:
					$result->Aug = $result->Aug + $pieces[4];
					$result->AugCount = $result->AugCount + $pieces[3];
					break;					
					case 9:
					$result->Sep = $result->Sep + $pieces[4];
					$result->SepCount = $result->SepCount + $pieces[3];
					break;					
					case 10:
					$result->Oct = $result->Oct + $pieces[4];
					$result->OctCount = $result->OctCount + $pieces[3];
					break;					
					case 11:
					$result->Nov = $result->Nov + $pieces[4];
					$result->NovCount = $result->NovCount + $pieces[3];
					break;
					case 12:
					$result->Dec = $result->Dec + $pieces[4];
					$result->DecCount = $result->DecCount + $pieces[3];
					break;
					
				}
				
		}
		array_push($array, $result);
		return $this->JSONResponse(0, MESSAGE_0, $array);
	}

	public function getTornadoData($state, $year)
	{
		$myfile = fopen("myData.txt", "r") or die("Unable to open file!");
		$array = array();
		$result->Jan = 0;
		$result->JanCount = 0;
		$result->Feb = 0;
		$result->FebCount = 0;
		$result->Mar = 0;
		$result->MarCount = 0;
		$result->Apr = 0;
		$result->AprCount = 0;
		$result->May = 0;
		$result->MayCount = 0;
		$result->Jun = 0;
		$result->JunCount = 0;
		$result->Jul = 0;
		$result->JulCount = 0;
		$result->Aug = 0;
		$result->AugCount = 0;
		$result->Sep = 0;
		$result->SepCount = 0;
		$result->Oct = 0;
		$result->OctCount = 0;
		$result->Nov = 0;
		$result->NovCount= 0;
		$result->Dec = 0;
		$result->DecCount = 0;
		while(!feof($myfile)) {
			$pieces = explode(" ", fgets($myfile));
			if($pieces[0] == $year && $pieces[2] == $state)
				switch ($pieces[1])
				{
					case 1:
					$result->Jan = $result->Jan + $pieces[4];
					$result->JanCount = $result->JanCount + $pieces[3];
					break;					
					case 2:
					$result->Feb = $result->Feb + $pieces[4];
					$result->FebCount = $result->FebCount + $pieces[3];
					break;					
					case 3:
					$result->Mar = $result->Mar + $pieces[4];
					$result->MarCount = $result->MarCount + $pieces[3];
					break;					
					case 4:
					$result->Apr = $result->Apr + $pieces[4];
					$result->AprCount = $result->AprCount + $pieces[3];
					break;					
					case 5:
					$result->May = $result->May + $pieces[4];
					$result->MayCount = $result->MayCount + $pieces[3];
					break;					
					case 6:
					$result->Jun = $result->Jun + $pieces[4];
					$result->JunCount = $result->JunCount + $pieces[3];
					break;					
					case 7:
					$result->Jul = $result->Jul + $pieces[4];
					$result->JulCount = $result->JulCount + $pieces[3];
					break;					
					case 8:
					$result->Aug = $result->Aug + $pieces[4];
					$result->AugCount = $result->AugCount + $pieces[3];
					break;					
					case 9:
					$result->Sep = $result->Sep + $pieces[4];
					$result->SepCount = $result->SepCount + $pieces[3];
					break;					
					case 10:
					$result->Oct = $result->Oct + $pieces[4];
					$result->OctCount = $result->OctCount + $pieces[3];
					break;					
					case 11:
					$result->Nov = $result->Nov + $pieces[4];
					$result->NovCount = $result->NovCount + $pieces[3];
					break;
					case 12:
					$result->Dec = $result->Dec + $pieces[4];
					$result->DecCount = $result->DecCount + $pieces[3];
					break;
					
				}
				
		}
		array_push($array, $result);
		return $this->JSONResponse(0, MESSAGE_0, $array);
	}

	public function UpdateBirthday($uniqueID, $bday)
	{
		
		try
		{
			$query = "UPDATE `Users` SET Bday='".$bday."' where UniqueID = '".$uniqueID."'";
			mysql_query($query);
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}
	}
	
	public function UpdateSchool($uniqueID, $school)
	{
		try
		{
			$query = "UPDATE `Users` SET School='".$school."' where UniqueID = '".$uniqueID."'";
			mysql_query($query);
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}
	}
	public function GetAllClasses()
	{
		$array = array();
		$query = "SELECT * FROM `Classes`";
		try
		{
			$retval = mysql_query($query);
			if(mysql_num_rows($retval) == 0)
			{
				return $this->JSONResponse(101, MESSAGE_101, $array);
			}
			while ($row = mysql_fetch_array($retval)) 
			{
				$result = new stdClass;
				$result->code =$row['Code'];
				$result->className = $row['Class'];
				array_push($array, $result);
			}
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}	
	}
	
	public function UpdateClasses($uniqueID, $code1, $code2, $code3, $code4)
	{
		try
		{
			$query = "UPDATE `Users` SET Classes='".$code1."|".$code2."|".$code3."|".$code4."' where UniqueID = '".$uniqueID."'";
			mysql_query($query);
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}
	}
	
	public function GetAllInfo($uniqueID)
	{
		$array = array();
		$query = "SELECT * FROM `Users` where UniqueID = '".$uniqueID."'";
		try
		{
			$retval = mysql_query($query);
			if(mysql_num_rows($retval) == 0)
			{
				return $this->JSONResponse(101, MESSAGE_101, $array);
			}
			while ($row = mysql_fetch_array($retval)) 
			{
				$result = new stdClass;
				$result->name =$row['Name'];
				$result->bday =$row['Bday'];
				$result->school = $row['School'];
				$result->classes = $row['Classes'];
				array_push($array, $result);
			}
			return $this->JSONResponse(0, MESSAGE_0, $array);
		}
		catch (Exception $ex) 
		{	
			return $this->JSONResponse(501, MESSAGE_501, $array);
		}
	}
	
	public function JSONResponse($code, $message, $data)
	{
		$result = new stdClass;
		$result->code = $code;
		$result->message = $message;
		$result->data = $data;		
		return json_encode($result);
	}
}
?>