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
            <option>https://www.facebook.com/groups/PricelessPossibilities/</option>
            <option>https://www.facebook.com/groups/networkmarketingcommunity/</option>
            <option>https://www.facebook.com/groups/n.w.marketers/</option>
            <option>https://www.facebook.com/groups/NetworkMarketingMasterMindGroup/</option>
            <option>https://www.facebook.com/groups/advertiseyours/</option>
            <option>https://www.facebook.com/groups/162470847268401/</option>
            <option>https://www.facebook.com/groups/007ENGLISH/</option>
            <option>https://www.facebook.com/groups/119863094732728/</option>
            <option>https://www.facebook.com/groups/5860308817/</option>
            <option>https://www.facebook.com/groups/online1marketing1group/</option>
            <option>https://www.facebook.com/groups/advertiseuronlinebiz/</option>
            <option>https://www.facebook.com/groups/themokh/</option>
            <option>https://www.facebook.com/groups/OneFamilyUnited/</option>
            <option>https://www.facebook.com/groups/InternetNetworkMarketingUKE/</option>
            <option>https://www.facebook.com/groups/adminupdate/</option>
            <option>https://www.facebook.com/groups/affiliatemarketingprofessionals/</option>
            <option>https://www.facebook.com/groups/postanythingx/</option>
            <option>https://www.facebook.com/groups/360890220674534/</option>
            <option>https://www.facebook.com/groups/pinoydeal/</option>
            <option>https://www.facebook.com/groups/ads.pubs/</option>
            <option>https://www.facebook.com/groups/pinoymembers/</option>
            <option>https://www.facebook.com/groups/NetworkMarketingFriends.1/</option>
            <option>https://www.facebook.com/groups/freeads2013/</option>
            <option>https://www.facebook.com/groups/advertise247/</option>
            <option>https://www.facebook.com/groups/groupvision/</option>
        </select>
    </div>

    <div class="margin">
        <h1>
            <?php

            ?>
        </h1>
    </div>


    <div class="margin">
	<textarea rows="10" cols="50">
	</textarea>
    </div>

    <div class="margin">
        <input type="file" name="pic" accept="image/*">
    </div>

    <div class="baner margin">

    </div>

</div>

</body>
</html>