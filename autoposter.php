<?php
session_start();

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        window.onload = function() {
            $('#post').on('click',function(){
                var message = document.getElementsByName('message')[0];
                message = message.value;

                if (message === "") {
                    alert("Please enter some text before posting")
                    return;
                }

                var groups = [];

                $( "select option:selected" ).each(function() {
                    groups.push(this.id);
                });

                if (groups.length <= 0) {
                    alert("Please select at least one group.");
                    return;
                }
                $.ajax({
                    url: 'http://autofacebookgroupposter.com/background.php',
                    data:{message:message,groups:groups},
                    success: function(data){
                       alert(data);

                    },
                    error: function(data) {
                        alert('Send this error to milos.keza@gmail.com: '+data);
                    }
                });
            });
        }

    </script>
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
    $logout = 'http://autofacebookgroupposter.com/autoposter.php?fblogin&logout=true';
    $request = new FacebookRequest($sess, 'GET', '/me');
    $response = $request->execute();
    $graph = $response->getGraphObject((GraphUser::className()));
    $name = $graph->getProperty('name');
    $_SESSION['fb_token'] = $sess->getToken();

    echo "Hi $name";
    echo " <a href='" . $logout . "'><buttton>Logout</button></a>";


}

//
//if ($_GET['message']) {
//
//    runMyFunction();
//}
//
//
//function runMyFunction()
//{
//
//
//
//    $facebook = new Facebook(array(
//        'appId' => $GLOBALS['app_id'],
//        'secret' => $GLOBALS['app_secret']
//    ));
//
//
//
//    $params = array(
//
//        "access_token" =>$_SESSION['fb_token'] ,
//
//        "message" => $_GET['message'],
//        "link" => "http://autofacebookgroupposter.com",
//        //"picture" => "http://i.imgur.com/lHkOsiH.png",
//        "name" => "How to Auto Post on Facebook with PHP",
//        "caption" => "http://autofacebookgroupposter.com",
//        "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
//    );
//
//    try {
//
//        $myArray = $_GET['groups'];
//        foreach ($myArray as $value) {
//            $ret = $facebook->api('/'.$value.'/feed', 'POST', $params);
//
//        }
//
//
////        $ret = $facebook->api('/936921146327264/feed', 'POST', $params);
////        $ret = $facebook->api('/524710721001729/feed', 'POST', $params);
//        //$ret = $facebook->api('/me/feed', 'POST', $params);
//        //echo '<h1>Successfully posted to Facebook Personal Profile</h1>';
//        //echo '<script>alert("Successfully posted to Facebook Personal Profile")</script>';
//
//    } catch(Exception $e) {
//        echo $e->getMessage();
//    }
//
//}

?>

<div id="main">



    <div class="margin">
        <h1>
            <?php

            ?>
        </h1>
    </div>


    <div class="margin">




            <textarea rows="10" cols="50" placeholder="Enter your text here." name="message" id="message"></textarea>
            <div class="grupe">
                <select multiple name="FavWebSite" size="20">
                    <?php
                    $session = new FacebookSession($sess->getToken());

                    // graph api request for user data

                    $friends = (new FacebookRequest($session, 'GET', '/me/groups'))->execute()->getGraphObject()->asArray();
                    foreach ($friends['data'] as $key) {
                        //echo '<option>'.$key->name.' ID: '.$key->id.'</option><br>';
                        echo '<option id="' . $key->id . '">' . $key->name . '</option><br>';
                    }
                    ?>
                </select>
            </div>
            <button id="post">Post</button>

    </div>

    <div class="margin">
        <input type="file" name="pic" accept="image/*">

    </div>

    <div class="baner margin">

    </div>

</div>

</body>
</html>