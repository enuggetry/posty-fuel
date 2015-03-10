<?php
/*
	Implements the schedule.  Displays content that is scheduled to post.
*/
$page='schedule';
include_once "header.php";
include_once "serv/calendar.php";
?>

    <div class="row-fluid">
        <div class="span2 channel-legend-container" id="channel-legend-container">
        </div>
        <div class="span9">
            <div id='calendar'></div>    
        </div>
        <div class="span1">
        </div>
    </div>
    <div id="calendar-foot"></div>
    
    <!-- templates -->
    
    <script type="text/template" id="channelLegendTemplate">
        <% if( $.isEmptyObject(channels) ){ %>
            No Feeds
        <% } else { %>
            <ul> 
            <% $.each(channels,function() { %>
                <li data-id=<%= this.id %> class="status-info channel-legend posty-<%= this.id %>" data-value="<%= this.id %>" title="">
                    <%= this.name %>
                </li>
            <% }) %>
            </ul> 
        <% } %>
    </script>

    <script type="text/javascript" src="js/schedule.js"></script>
    <script type="text/javascript" src="js/models.js"></script>
    
    <script type="text/javascript">
        $(function () {
            renderCalendar();
        });
        
        function renderCalendar() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                    header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                    },
                    editable: true,
                    events: 
<?php
    echo generateFullcalendarEvents();
?>
                        
            });
        }
        function mysqlTimeStampToDate(timestamp) {
            //function parses mysql datetime string and returns javascript Date object
            //input has to be in this format: 2007-06-05 15:26:02
            var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
            var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
            return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
        }
    </script>
    
<?php
include_once "footer.php";
?>
