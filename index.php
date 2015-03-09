<?php session_start();
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['fb_token']);
}
if ($_SESSION['fb_token']) {
header('Location: http://autofacebookgroupposter.com/autoposter.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Free facebook group poster | Automate your groups postings on facebook</title>
    <meta name="description" content="Post FREE to UNLIMITED facebook groups with a click!">
    <meta name="keywords" content="free facebook group poster, fb group poster, facebook group poster, post to facebook groups, facebook auto poster, facebook autoposter, fb autoposter, facebook group autoposter, fb group autoposter">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="copyright" content="Copyright © 2015 Autofacebookgroupposter.com">
    <meta name="rating" content="general">
    <meta name="distribution" content="Global">
    <meta name="revisit-after" content="30 days">
    <link rel="SHORTCUT ICON" href="img/favicon.ico">
    <meta http-equiv="pragma" content="no-cache" />
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
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

/* PROCESS */

$app_id = '779159068832924';
$app_secret = '0aa761cdb946f6234018d70ead21cb7d';
$redirect_url = 'http://autofacebookgroupposter.com/';

FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);

$logout = 'http://autofacebookgroupposter.com/index.php?fblogin&logout=true';

try {
    $sess = $helper->getSessionFromRedirect();
}
catch (FacebookRequestException $ex) {

}
catch (Exception $ex) {

}

if(isset($_SESSION['fb_token'])){
    $sess = new FacebookSession($_SESSION['fb_token']);

}

if (isset($sess)) {

    $request = new FacebookRequest($sess,'GET','/me');
    $response = $request->execute();
    $graph = $response->getGraphObject((GraphUser::className()));
    $name = $graph->getName();
    $_SESSION['fb_token'] = $sess->getToken();
    echo "Hi $name";
    echo " <a href='".$logout."'><buttton>Logoout</button></a><br>";
    echo "<a href='autoposter.php'><p>Go to AutoPoster</p></a>";

}


?>
<div id="main">
    <?php
    if (!isset($sess)) {
    echo '<a href="'.$helper->getLoginUrl().'" ><img src="img/fb_button.jpg" id="fb_login"> </a>';
    }
    ?>


</div>



</body>
</html>