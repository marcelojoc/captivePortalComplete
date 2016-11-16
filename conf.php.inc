<?php

//error_reporting(E_ALL);
ini_set('display_errors', '1');


$mysql_db = "captive";
$mysql_host = "localhost"; //If the MySQL server is running on the same server as the web auth page
$mysql_user = "captive"; //Change to the appropriate user that has access to DB/table
$mysql_pass = "mcuejv73uf9w83nv"; //Change to the appropriate password for the user above
$table = "creds";  //Change to the appropriate table name


//DB local
//$mysql_db = "diplomatic";
//$mysql_host = "localhost"; //If the MySQL server is running on the same server as the web auth page
//$mysql_user = "root"; //Change to the appropriate user that has access to DB/table
//$mysql_pass = ""; //Change to the appropriate password for the user above
//$table = "creds";  //Change to the appropriate table name

//UniFi server credentials
$unifiServer = "https://127.0.0.1:8443"; //Change to the IP/FQDN of your UniFi Server
//It's important to note that if this server is offsite, you need to have port 8443 forwarded through to it
$unifiUser = "adminsia"; //Change to your UniFi Username
$unifiPass = "geadfsm"; //Change to your UniFi Password

//Establish connection the MySQL server using credentials as above.  If connection cannot be made, the process will fail and produce a troubleshooting error
$mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
	if(!$mysql) {
		
die("Database connection failed: " . mysql_error());
	}

//Select the appropriate database for credential storage
$db_select = mysql_select_db($mysql_db,$mysql);
	if(!$db_select) {
		die("Database selection failed: " . mysql_error());
	}

//The function to authenticate a user using Username, Password, and Email as authentication paramaters then return a true boolena to the auth.php page
function auth_user($name,$email,$mac,$fecha,$huesped,$table) {
//	$query = "SELECT * FROM `$table` WHERE `username` = \"$username\"";
    
	

	if ($huesped == "si"){
		$huesped=1;
		$formatFecha = date("Y-m-d", strtotime($fecha));
	}else{
		$huesped=0;
		$formatFecha= date("Y-m-d");;
	};

	$query = "INSERT INTO `$table` (`name`, `email`, `mac`, `checkout`, `checkin`, `huesped` )  VALUES (\"$name\", \"$email\", \"$mac\", \"$formatFecha\", now(), \"$huesped\") ";
//echo $query;
	$execute = mysql_query($query);
if (!$execute) {
    die('Invalid query: ' . mysql_error());
}

	return true;
/*	while($row = mysql_fetch_assoc($execute)) {
		if(($row['password'] == $password) && ($row['email'] == $email)) {
			echo "true";
			return true;
		} else {
			echo "false";
			echo "Your username, password, or email was not found.<br />You will be redirected to the login page momentarily";
			sleep(5);
			header("Location: auth.php");
		}
	}
*/
//If not requiring email as an authentication parameter, comment out the above while loop and uncomment the following while loop
/*
	while($row = mysql_fetch_assoc($execute)) {
		if($row['password'] == $password) {
			echo "true";
			return true;
		} else {
			echo "false";
			echo "Your username and/or password was not found.<br />You will be redirected to the login page momentarily";
			sleep(5);
			header("Location: auth.php");
		}
	}
*/
}



function sendAuthorization($id, $minutes) {
	global $unifiServer;
	global $unifiUser;
	global $unifiPass;

	// Start Curl for login
	$ch = curl_init();
	// We are posting data
	curl_setopt($ch, CURLOPT_POST, TRUE);
	// Set up cookies
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
#curl_setopt($ch, CURLOPT_VERBOSE, 1);

	$cookie_file = "/var/www/guest/s/default/unifi_cookie";
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
	// Allow Self Signed Certs
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	// Force SSL3 only
	curl_setopt($ch, CURLOPT_SSLVERSION, 1);
	// Login to the UniFi controller
	curl_setopt($ch, CURLOPT_URL, "$unifiServer/api/login");
//	curl_setopt($ch, CURLOPT_URL, "$unifiServer/login");
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode(array("username" => $unifiUser, "password" => $unifiPass)).":");
//	curl_setopt($ch, CURLOPT_POSTFIELDS,"login=login&username=$unifiUser&password=$unifiPass");
	curl_exec ($ch);
	curl_close ($ch);

	// Send user to authorize and the time allowed
	$data = json_encode(array(
		'cmd'=>'authorize-guest',
        'mac'=>$id,
        'minutes'=>$minutes));
	$ch = curl_init();
	// We are posting data
	curl_setopt($ch, CURLOPT_POST, TRUE);
	
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
#curl_setopt($ch, CURLOPT_VERBOSE, 1);

	// Set up cookies
	$cookie_file = "/var/www/guest/s/default/unifi_cookie";
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
	// Allow Self Signed Certs
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	// Force SSL3 only
	curl_setopt($ch, CURLOPT_SSLVERSION, 1);
	// Make the API Call
	curl_setopt($ch, CURLOPT_URL, $unifiServer.'/api/s/default/cmd/stamgr');
//	curl_setopt($ch, CURLOPT_URL, $unifiServer.'/api/cmd/stamgr');
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$data);
	curl_exec ($ch);
	curl_close ($ch);


	// Logout of the connection
	$ch = curl_init();
	// We are posting data
	curl_setopt($ch, CURLOPT_POST, TRUE);
	// Set up cookies
	$cookie_file = "/var/www/guest/s/default/unifi_cookie";

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//curl_setopt($ch, CURLOPT_VERBOSE, 1);

	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
	// Allow Self Signed Certs
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	// Force SSL3 only
	curl_setopt($ch, CURLOPT_SSLVERSION, 1);
	// Make the API Call
        curl_setopt($ch, CURLOPT_URL, "$unifiServer/api/logout");
//	curl_setopt($ch, CURLOPT_URL, $unifiServer.'/logout');
	curl_exec ($ch);
	curl_close ($ch);
//	sleep(12); // Small sleep to allow controller time to authorize
//	header('Location: ' . $url);//$_SESSION['url']);
}
?>

