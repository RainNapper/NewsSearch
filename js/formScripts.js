function collectNews() {
    var url = "html/CollectNews.php?";
    url += "start="+(new Date($('#startPicker').val()).toISOString());
    url += "&end="+(new Date($('#endPicker').val()).toISOString());
    url += "&q="+$('#query').val();
    url += "&max="+$('#maxCount').val();
    url += "&lng="+$('#language').val();

    data = {};
    $.get(url, function(data) {
        data = JSON.parse(data).HEADLINEML.HL;
        drawTimeline(data);
    });
}

function drawTimeline(data) {
    // Define domElement and sourceFile
    $('#timeline').html('');
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
    timeline('#timeline')
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
