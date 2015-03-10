<?php session_start();
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['fb_token']);
    session_destroy();
}

if (!$_SESSION['fb_token']) {
    header('Location: http://autofacebookgroupposter.com/');

    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" type="text/css" href="css/autoposter.css">
</head>
<body>
<?php
/* INCLUSION OF LIBRARY FILES*/

require_once('lib/Facebook/FacebookSession.php');
require_once('lib/Facebook/FacebookRequest.php');
require_once('lib/Facebook/FacebookResponse.php');
require_once('lib/Facebook/FacebookSDKException.php');
require_once('lib/Facebook/FacebookRequestException.php');
require_once('lib/Facebook/FacebookRedirectLoginHelper.php');
require_once('lib/Facebook/FacebookAuthorizationException.php');
require_once('lib/Facebook/GraphObject.php');
require_once('lib/Facebook/GraphUser.php');
require_once('lib/Facebook/Entities/AccessToken.php');
require_once('lib/Facebook/HttpClients/FacebookCurl.php');
require_once('lib/Facebook/HttpClients/FacebookHttpable.php');
require_once('lib/Facebook/HttpClients/FacebookCurlHttpClient.php');


/* USE NAMESPACES */

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;

$app_id = '779159068832924';
$app_secret = '0aa761cdb946f6234018d70ead21cb7d';
FacebookSession::setDefaultApplication($app_id,$app_secret);

if(isset($_SESSION['fb_token'])){
    $sess = new FacebookSession($_SESSION['fb_token']);
}

$logout = 'http://autofacebookgroupposter.com/autoposter.php?fblogin&logout=true';


if (isset($sess)) {

    $request = new FacebookRequest($sess,'GET','/me');
    $response = $request->execute();
    $graph = $response->getGraphObject((GraphUser::className()));
    $name = $graph->getProperty('name');
    $_SESSION['fb_token'] = $sess->getToken();

    echo "Hi $name";
    echo " <a href='".$logout."'><buttton>Logoout</button></a>";



}

?>

<div id="main">

    <div class="grupe">
        <select multiple name="FavWebSite" size="20">
            <?php
            $session = new FacebookSession( $sess->getToken() );

            // graph api request for user data

            $friends = (new FacebookRequest( $session, 'GET', '/me/groups' ))->execute()->getGraphObject()->asArray();
            //    echo '<pre>' . print_r( $friends, 1 ) . '</pre>';
            foreach ($friends['data'] as $key) {
                echo '<option>'.$key->name.'</option><br>';
            }
            ?>
        </select>
    </div>

    <div class="margin">
        <h1>
            <?php

            ?>
        </h1>
    </div>


    <div class="margin">
	<textarea rows="10" cols="50" placeholder="Enter your text here."></textarea>
    </div>

    <div class="margin">
        <input type="file" name="pic" accept="image/*">
        <input type="button" value="Post">
    </div>

    <div class="baner margin">

    </div>

</div>

</body>
</html>