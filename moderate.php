<?php
/*
	Implements the moderate page.
*/
$page='moderate';
include_once "header.php";
?>

    <div class="page-header">
      <h1>Moderation Queues</h1>
    </div>
    <div id="moderate-tabs">
    </div>
    
                
    <div id="workspace" style="display:none" >
    </div>

    <!-- Button trigger modal -->
    <!--button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Launch demo modal
    </button-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" style="display:none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
              <div id="diag-image-box" class="diag-image-box"></div>
              <div class="form-box">
                  <form role="form">
                    <div class="form-group">
                      <label for="diag-title">Title</label>
                      <input type="email" class="form-control" id="diag-title" placeholder="Title">
                    </div>
                    <div class="form-group">
                      <label for="diag-message">Message</label>
                      <textarea class="form-control" id="diag-message" placeholder="Message goes here" rows="4"></textarea>
                    </div>
                  </form>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="btn-save" type="button" class="btn btn-primary" data-dismiss="modal" title="">Schedule it</button>
          </div>
        </div>
      </div>
    </div>

    <!-- templates -->
        <script type="text/template" id="channelModerateTemplate">
            <% if( $.isEmptyObject(channels) ){ %>
                No Channels
            <% } else { %>
                <% isFirstOne = 1 %>
                <ul id="queue-tabs" class="nav nav-tabs"> 
                <% $.each(channels,function() { %>
                    <li channel="<%= this.id %>" <% if(isFirstOne){ %> class="active" <% } %>><a data-toggle="tab" href="#tab-<%= this.id %>"><%= this.name %></a></li>
                    </li>
                    <% isFirstOne = 0 %>
                <% }) %>
                </ul> 
                <% isFirstOne = 1 %>
                <div class="tab-content queue-tab-panes">
                <% $.each(channels,function() { %>
                    <div channel="<%= this.id %>" class="tab-pane fade<% if(isFirstOne){ %> in active<% } %> pane-<%= this.id %>" id="tab-<%= this.id %>" >blah blah <%= this.name %> blah blah</div>
                    <% isFirstOne = 0 %>
                <% }) %>
                </div> 
            <% } %>
        </script>
    
        <script type="text/template" id="workspaceTemplate">
            <% if( $.isEmptyObject(queues) ){ %>
                No entries
            <% } else { %>
                <% $.each(queues,function() { %>
                    <a href="#" class="queue-item" id="queue-item-<%= this.id %>" data-id="<%= this.id %>" data-toggle="modal" data-target="#myModal">blah blah <%= this.name %><%= this.name %><br/><%= this.image_url %></a>
                <% }) %>
            <% } %>
        </script>

    <script type="text/javascript" src="js/moderate.js"></script>
    <script type="text/javascript" src="js/models.js"></script>

<?php
include_once "footer.php";
?>
