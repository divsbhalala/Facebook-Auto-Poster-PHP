<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 12.3.2015
 * Time: 12:24
 */

session_start();
//if (!$_SESSION['fb_token']) {
//    header('Location: http://autofacebookgroupposter.com/');
//
//    exit;
//}

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
require 'lib/Facebook/facebook.php';


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
FacebookSession::setDefaultApplication($app_id, $app_secret);

if (isset($_SESSION['fb_token'])) {
    $sess = new FacebookSession($_SESSION['fb_token']);
}


if (isset($sess)) {

    $request = new FacebookRequest($sess, 'GET', '/me');
    $response = $request->execute();
    $graph = $response->getGraphObject((GraphUser::className()));
    $name = $graph->getProperty('name');
    $_SESSION['fb_token'] = $sess->getToken();



}


if ($_GET['message']) {

    runMyFunction();
}


function runMyFunction()
{



    $facebook = new Facebook(array(
        'appId' => $GLOBALS['app_id'],
        'secret' => $GLOBALS['app_secret']
    ));



    $params = array(

        "access_token" =>$_SESSION['fb_token'] ,

        "message" => $_GET['message'],
        "link" => "http://autofacebookgroupposter.com",
        //"picture" => "http://i.imgur.com/lHkOsiH.png",
        "name" => "How to Auto Post on Facebook with PHP",
        "caption" => "http://autofacebookgroupposter.com",
        "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
    );

    try {

        $myArray = $_GET['groups'];
        foreach ($myArray as $value) {
            $ret = $facebook->api('/'.$value.'/feed', 'POST', $params);
        }

        //$ret = $facebook->api('/me/feed', 'POST', $params);
        echo 'Successfully posted to Facebook Pages';
        //echo '<script>alert("Successfully posted to Facebook Personal Profile")</script>';

    } catch(Exception $e) {
        echo $e->getMessage();
    }

}

?>




