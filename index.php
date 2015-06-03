<?php
// index.php :)
$page='home';
include_once "header.php";
?>
    
    <div class="page-header">
      <h1>Demo</h1>
    </div>
      <p>Sample application using FuelUX, bootstrap, & backbone</p>
      <h3>What it does</h3>
      <p>This app facilitates scheduling of images from RSS feeds to randomly post on a facebook or twitter page.</p>
	  <p style="padding-left: 50px;"><strong>Workflow: Select --> Moderate</strong></p>
	  <p>
          The data is real and the app is fully data-driven.  The main workflow is mostly functional, albeit simplified.  The app was built from the ground up based
          on an idea that I had about improving the speed as which I could process interesting image-based content for social propagation.  
          PHP and MySQL is used on the backend.</p>
	  <h3>Usage</h3>
	  <p>Start by selecting data from the RSS feeds (photos), using multi select.  Then select Add to Queue buttons for one of the channels (Facebook, Twitter,...).
          These are the moderation queues.  Then select the Moderation tab.  Each moderation queue has a tab holding the selected items. 
          Click on items in the moderation queues to bring up a popup and then schedule the item. Click the Schedule tab to reveal the scheduled
          content.  The principle of the scheduling 
          function is to not require entry of specific schedule times; rather, the app randomly schedules the content for delivery 
          at prime times, potentially based on certain algorithms, for optimal social impact.
      </p>
	  <h3>Content Feeds</h3>
      <img src="images/select.jpg" width="700">
	  <dl class="num-list">
		<dt>Main Menu</dt> 
		<dt>Add RSS Feed</dt>
		<dd>Currently works with a limited RSS formats.  It is currently intended to support image RSS feeds.</dd>
		<dt>RSS feed list</dt>
		<dd>The list of RSS feeds that are currently monitored.</dd>
		<dt>Feed Image Gallery</dt>
		<dd>Click image to select one or more image.  Scroll down to see other RSS feed galleries.</dd>
		<dt>Channels</dt>
		<dd>Click Add to Queue to add the selected images to the particular channel queue.  There is currently no way to add/remove channels
		except directly via the database.</dd>
		<dt>Selected check mark</dt>
		<dd>Note, when selected the green check mark will appear.</dd>
	  </dl>
	  <h3>Moderation Queue</h3>
	  <p>Allows us to moderate what gets schedule for posting</p>
      <img src="images/moderate.jpg" width="700">
	  <dl class="num-list">
		<dt>Channel Queue Tabs</dt>
	    <dd>Selects the queue to view.  </dd>
		<dt>Queue Image Gallary</dt>
		<dd>The content of the queues are those images that were previously selected from the Select page. 
		Click an image to schedule an item.  Currently, there are not specific scheduling options except that the 
		system randomly selects a time within the next three weeks to schedule the post.  This is actually by intention.  I didn't want the burden of
		always selecting the specific date to schedule.  I wanted a system that just figures out the optimal time to schedule a post.</dd>
		<dt>Scheduled flag</dt>
		<dd>The calendar icon indicates the item is selected.</dd>
	  </dl>
	  <h3>Schedule</h3>
	  <p>Once posts are scheduled, they are visible on the calendar.
	  </p>
      
      <h3>Limitations</h3>
      <p>The main thing it doess't do yet is actually post anything to twitter of FB.
          That work is intended to be a server-side cron operation (of which I partially built the proof of concept using FB api) (code included).  Obviously, there 
          are many configuration pages and options missing from the app, scheduling algorithms, error checking, etc.  But, those are unnecessary for 
          a development demonstration.  The calendar plugin is really nice; however, currently only used to display schedules (the schedule data is real; just can't change them).  There are many
          types of RSS formats; it can only support a few right now.
      </p>
      <h3>Reflection</h3>
      <p>I attempted to cover some of the more obvious function of FuelUX, bootstrap and backbone.  Some things I spent a lot of time on and 
      and ultimately didn't get fully working yet were things like nested templates and collections. Getting the collections to sync well with the MySQL counterparts
      is not 100%.  Hence, the RSS gallary of the app are not driven by backbone, for expediency.  It's not unlike any template system or libraries I've worked with. A little more time and I can probably figure it out.
      But, I wanted to deliver the app.  I generally had no problems with the GUI components.  Working with those components are not unlike any other web UI.    Finding good examples online was not easy.  </p>
      <p>All in all, using FuelUX/bootstrap achieves a nice looking app in a relatively short time.</p>
     
<?php
include_once "footer.php";
?>
