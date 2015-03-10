<?php
/*
	This implements the select page which lists RSS feed data.
	The right sidebar shows the channels
*/
$page='select';
include_once "header.php";
?>
    
    <!-- RSS Add/Remove block -->
    <div class="row-fluid select-subbar">
        <div id="add-feed" class="span3">
            
        </div>
        <div class="span9">
            <div id="feed-pillbox" class="pillbox">
                
            </div>
        </div>
    </div>

    <!-- RSS display block -->
    
    <div class="row-fluid">
        <div id="rsslist" class="span10">
        </div>
        <!--div class="span2">
            <div class="channel-margin"></div-->
        <div class="channel-right-bar">
            <div id="channel-bucket-list" class="channel-bucket-list">
            </div>
        </div>
    </div>
    
    <div id="queue-workspace" class="queue-workspace">
    </div>
    
    <!-- templates -->

        <script type="text/template" id="addFeedTemplate">
                <input id="new-feed-url" type="text" placeholder="Add RSS URL">
                <button id="add-feed-btn" class="btn btn-primary add-btn" type="button">Add</button>
        </script>

        <script type="text/template" id="pillboxFeedTemplate">
            <% if( $.isEmptyObject(feeds) ){ %>
                No Feeds
            <% } else { %>
                <ul> 
                <% $.each(feeds,function() { %>
                    <li data-id=<%= this.id %> class="status-info" data-value="<%= this.url %>" title="click to jump to feed; dbl click to delete."><%= this.name %></li>
                <% }) %>
                </ul> 
            <% } %>
        </script>
                
        <script type="text/template" id="channelBucketTemplate">
            <% if( $.isEmptyObject(channels) ){ %>
                No Feeds
            <% } else { %>
                <ul> 
                <% $.each(channels,function() { %>
                    <li data-id=<%= this.id %> class="status-info channel-box" data-value="<%= this.id %>" title="">
                        <%= this.name %>
                        <div class='pics1' style='height:80px'></div>
                        <div class='add-to-queue-container'>
                          <button id="add-to-queue-<%= this.id %>" class="btn btn-primary add-to-queue-btn" type="button">Add to queue</button>
                        </div>
                    </li>
                <% }) %>
                </ul> 
            <% } %>
        </script>
    
        <script type="text/template" id="channelBucketTemplate">
            <% if( $.isEmptyObject(channels) ){ %>
                Nothing
            <% } else { %>
                <% $.each(channels,function() { %>
                <div class="mini-image-box"><img width='32' src='<%= this.image_url %>' /></div>
                <% }) %>
            <% } %>
        </script>

    <script type="text/javascript" src="js/rss.js"></script>
    <script type="text/javascript" src="js/select.js"></script>
    <script type="text/javascript" src="js/models.js"></script>
<?php
include_once "footer.php";
?>
