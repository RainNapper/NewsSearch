<?php
  require_once 'config.php';
?>

<!--
  The TRKD API sample code is provided for informational purposes only 
  and without knowledge or assumptions of the end users development environment. 
  We offer this code to provide developers practical and useful guidance while developing their own code. 
  However, we do not offer support and troubleshooting of issues that are related to the use of this code 
  in a particular environment; it is offered solely as sample code for guidance. 
  Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com 
  for additional information regarding the TRKD API.
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="class.css" />
<title>RKD Samples</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="js/timeline.js"></script>
<link href="js/timeline.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script>

    /*  You need a domElement, a sourceFile and a timeline.

        The domElement will contain your timeline.
        Use the CSS convention for identifying elements,
        i.e. "div", "p", ".className", or "#id".

        The sourceFile will contain your data.
        If you prefer, you can also use tsv, xml, or json files
        and the corresponding d3 functions for your data.


        A timeline can have the following components:

        .band(bandName, sizeFactor
            bandName - string; the name of the band for references
            sizeFactor - percentage; height of the band relation to the total height
            Defines an area for timeline items.
            A timeline must have at least one band.
            Two bands are necessary, to change the selected time interval.
            Three and Bands are allowed.

        .xAxis(bandName)
            bandName - string; the name of the band the xAxis will be attached to
            Defines an xAxis for a band to show the range of the band.
            This is optional, but highly recommended.

        .labels(bandName)
            bandName - string; the name of the band the labels will be attached to
            Shows the start, length and end of the range of the band.
            This is optional.

        .tooltips(bandName)
            bandName - string; the name of the band the labels will be attached to
            Shows current start, length, and end of the selected interval of the band.
            This is optional.

        .brush(parentBand, targetBands]
            parentBand - string; the band that the brush will be attached to
            targetBands - array; the bands that are controlled by the brush
            Controls the time interval of the targetBand.
            Required, if you want to control/change the selected time interval
            of one of the other bands.

        .redraw()
            Shows the initial view of the timeline.
            This is required.

        To make yourself familiar with these components try to
        - comment out components and see what happens.
        - change the size factors (second arguments) of the bands.
        - rearrange the definitions of the components.
    */

function drawTimeline() {
    // Define domElement and sourceFile
    var timelineDiv = "#timeline";
    var sourceDiv = "#headline_data";
    var data = JSON.parse($(sourceDiv).html()).HEADLINEML["HL"];
    
    var articleInfo = {};
    var timelineData = [];

    data.forEach(function(item) {
        articleInfo[item.ID] = { creationTime: item.CT,
                                        title: item.HT,
                                      urgency: item.UR,
                                       topics: item.TO,
                                         type: item.TY };
        timelineData.push( { start: item.CT,
                               end: "",
                             label: item.HT,
                                id: item.ID,
                           urgency: item.UR });
    });

    // Read in the data and construct the timeline
    timeline(timelineDiv)
        .data(timelineData)
        .band("mainBand", 0.82)
        .band("naviBand", 0.08)
        .xAxis("mainBand")
        .tooltips("mainBand")
        .xAxis("naviBand")
        .labels("mainBand")
        .labels("naviBand")
        .brush("naviBand", ["mainBand"])
        .redraw();
}

</script>

<table cellpadding="10px">
  <tr valign="top">
    <td class="bordered">
      <?php require_once HTML_PATH . 'navigationMenu.php'; ?>
    </td>
    <td valign="top" class="bordered" width="100%">
      <?php require_once HTML_PATH . 'content.php'; ?>
    </td>
    <div id="headline_data" style="display: none;">
    <div id="timeline"></div>
    <div id="story">
        <div id="story_title"></div>
        <div id="story_date"></div>
        <div id="story_content"> </div>
    </div>
    <td>
    </td>
  </tr>
  <input type="button" onclick="drawTimeline();" value="Draw Timeline">
</table>
</body>
</html>
