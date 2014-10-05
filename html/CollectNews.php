<?php
try
{
    require_once '../config.php';

    $startTime = $_GET['start'];
    $endTime = $_GET['end'];
    $query = $_GET['q'];
    $maxCount = $_GET['max'];
    $language = $_GET['lng'];


	$requestor = new WebServices_News1_RetrieveHeadlineML1();
	$requestor->setTimeOut(120);
	$requestor->setMaxCount($maxCount);
	$requestor->setStartTime($startTime);
	$requestor->setEndTime($endTime);
    $requestor->setFilter(new SoapVar('<Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
          <MetaDataConstraint class="Language" xmlns="http://schemas.reuters.com/ns/2006/04/14/rmds/webservices/news/filter">
            <Value>'.$language.'</Value>
          </MetaDataConstraint>
        </Filter>
        <Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
          <FreeTextConstraint xmlns="http://schemas.reuters.com/ns/2006/04/14/rmds/webservices/news/filter">
            <Value>'.$query.'</Value>
          </FreeTextConstraint>
        </Filter>', XSD_ANYXML));
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_Shared_HeadlinesResponse($response);
    echo $view->getJSON();

}
catch (Exception $e)
{
	echo '<h2 class="error">' . $e->getMessage() . '</h2>';
}
?>
