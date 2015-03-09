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
$redirect_url = 'http://www.login.autofacebookgroupposter.com/autoposter.php';

FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);
$sess = $helper->getSessionFromRedirect();


if (isset($sess)) {
    $request = new FacebookRequest($sess,'GET','/me');
    $response = $request->execute();
    $graph = $response->getGraphObject((GraphUser::className()));
    $name = $graph->getName();
    echo "Hi $name";

}


?>
<html>
<?php
if (!isset($sess)) {
    echo '<a href="'.$helper->getLoginUrl().'" ><img src="img/fb_button.png" id="fb_login"> </a>';
}
?>

</html>