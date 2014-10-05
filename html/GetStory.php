<?php
try
{
    require_once '../config.php';
    $storyID = $_GET['sid'];

    $requestor = new WebServices_News1_RetrieveStoryML1();
    $requestor->setStoryIDs($storyID);
    $requestor->setTimeOut(120);
    $response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

    $view = new Views_News1_RetrieveStoryML1Response($response);
    echo $view->getJSON();
}
catch (Exception $e)
{
	echo '<h2 class="error">' . $e->getMessage() . '</h2>';
}
?>
