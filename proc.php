<?php

function call_endpoint($url, $method = 'GET', $args = false)
    {
        $postdata = ($args) ? json_encode($args) : '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($postdata)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return ($response);
    }
    
if(isset($_POST['user'])) { 

	if (strpos($_POST['user'], '@gmail.com') !== false) {

	    $server_id ='YOUR_PLEX_SERVER_ID_HERE'; //Add your Plex ID Server here
	    $token = 'YOUR_PLEX_TOKEN_HERE'; // Add your PlexToken here
	    $libs = 'YOUR_LIBRARY_ID_HERE'; // Add your Librari section ID here
	    $http_method = 'POST';
                $http_link = 'https://plex.tv/api/servers/'.$server_id.'/shared_servers?X-Plex-Token='.$token;
                $http_body = array(
                    "server_id" => $server_id,
                    "shared_server" => array(
                        "library_section_ids" => $libs,
                        "invited_email" => $_POST['user'],
                        "sharing_settings" => json_decode('{}')
                    )
                );
                $http_return = 'SUCCESS_CREATE_USER';
                if (isset($http_method) && isset($http_link))
		        {
		            $cb = call_endpoint($http_link, $http_method, $http_body);
		            
		        }
		        echo "
					<html>
					<head>
						<meta http-equiv='REFRESH' content='0 ; url=https://accesofc.000webhostapp.com/'>
					<script>
						alert('Check your plex invitations, you have been invited successful.');
					</script>
					</head>
					</html>
				";
	    ;
	  }
	  else{
	  	echo "
					<html>
					<head>
						<meta http-equiv='REFRESH' content='0 ; url=https://accesofc.000webhostapp.com/'>
					<script>
						alert('Only gmail accounts allowed.');
					</script>
					</head>
					</html>
				";
	  }
} 
else{

				echo "
					<html>
					<head>
						<meta http-equiv='REFRESH' content='0 ; url=https://accesofc.000webhostapp.com/'>
					<script>
						alert('Fill the formulary.');
					</script>
					</head>
					</html>
				";

}