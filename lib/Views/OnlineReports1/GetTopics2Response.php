<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_OnlineReports1_GetTopics2Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval = '<hr/>';
				
		foreach ($this->response->Region  as $region)
		{

                    $retval .= '<table width="100%" class="bordered">' .
                            '<thead><b>' .
                            $region->name .
                            '</b></thead>';
                    
                    foreach($region->topic as $topic)
                    {
                         $retval .= '<tr><td width="30%">' .
                                 $topic->code .
                                 '</td><td>' .
                                 $topic->desc .
                                 '</td></tr>';
                    }
                    $retval .= "</table></br>";
		}
		
		return $retval;
	}
}