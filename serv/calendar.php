<?php

include_once "dbconfig.php";


// generate fullcalendar events from database
function generateFullcalendarEvents() {
    $query = "SELECT * FROM queues";
    $result = mysql_query($query);

    $events = "[";
    $i = 0;
    $items = array();
    
    while($row = mysql_fetch_array($result)):
        //print_r($row); echo "<br/>-------------------";
        $items = $row;
        if ($items["scheduled"]==1) {
            $events .= ($i==0) ? "{" : ",{";
            $events .= "title: '".$items["name"]."',";
            $events .= "start: new Date(mysqlTimeStampToDate('".$items["schedule_date"]."')),";
            $events .= "allDay: false,";
            $events .= "className: 'posty-".$items["channel_id"]."',";
            $events .= "postyChannelId: ".$items["channel_id"].",";
            $events .= "queueId: ".$items["id"];
            $events .= "}\n";
            $i++;
        }
    endwhile;
    $events .= "]";
    
    return $events;
}
?>