/*
	generates the pill box and channel buckets and process events for them.
	backbone.
*/
var App = {
    run: function(){
        this.addfeedview = new this.addFeedView();
        this.feedcollection = new this.feedCollection();
        this.pillboxfeedview = new this.pillboxFeedView();
        this.channelcollection = new this.channelCollection();
        this.channelbucketview = new this.channelBucketView();
        //this.channelmoderateview = new this.channelModerateView();
        
        Backbone.history.start();
    }
};	

App.addFeedView = Backbone.View.extend({
	el: '#add-feed',
	template:  _.template($('#addFeedTemplate').html()),
	events: {
            "click #add-feed-btn": 'addFeedEvent'
	},
	initialize : function(){ 
            console.log("init addFeedView");
            _.bindAll(this,'render','addFeedEvent');
            this.render();
        },
        render: function(){
            this.$el.html( this.template );
        },
	addFeedEvent : function(event){
            var url = $('#new-feed-url').val();
            console.log("addFeedEvent: "+url);
            if (url.length==0) {
                alert ("please enter an RSS URL.");
            }
            else {
                var feedmodel = new App.FeedModel({
                    url : url,
                    type:'rss',
                    name: url
                });
                feedmodel.save();
                $('#new-feed-url').val("");
                App.pillboxfeedview.listPage();
            }
            return false;
	}
});

App.pillboxFeedView = Backbone.View.extend({
	el: '#feed-pillbox',
	template: _.template($('#pillboxFeedTemplate').html()),
	
	initialize : function(){
            console.log("init pillboxFeedView");
            _.bindAll(this,'listPage','deleteFeed');
            this.listPage();
            //this.render();
	},
	render: function(response){
            //console.log("pillbox render");
            var self = this;

            this.$el.html(this.template({feeds: response }));
            
	},
	listPage: function(querystring){ 
            var self = this;
            App.feedcollection.fetch({
                data: querystring,
                success: function(collection , response){ 
                    self.render(response);
                    
                    // setup click and dblclick event handling
                    $('#feed-pillbox li[data-id]').each(function(){
                            var id = $(this).attr('data-id');
                            var url = $(this).html();
                            $(this).unbind();

                            $(this).click(function(e){
                                self.jumpTo(id);	
                                return false;
                            });
                            $(this).dblclick(function(e){
                                self.deleteFeed(id);				
                            });
                    });//end of each
                    
                    Rss.load();
                }
            });
	},
	deleteFeed: function(id){ 
            console.log("deleteFeed "+id);
            if(confirm('are you sure feed: '+id+'?')){
                App.feedcollection.get(id).destroy();
                App.pillboxfeedview.listPage();
            }
	},
	jumpTo: function(id){ 
            jump  = "#rss-block-"+id;
            console.log("jumpTo "+jump);
            window.location.href = jump;
            //App.router.navigate('edit/'+id ,{ trigger : true });
	}
}); 

App.channelBucketView = Backbone.View.extend({
	el: '#channel-bucket-list',
	template: _.template($('#channelBucketTemplate').html()),
	
	initialize : function(){
            console.log("init channelBucketView");
            _.bindAll(this,'listPage','delete');
            this.listPage();
	},
	events: {
            "click .channel-box button": 'addQueueEvent'
	},
	render: function(response){
            //console.log("channelbucket render");
            this.$el.html(this.template({channels: response }));
	},
	listPage: function(querystring){
            //console.log("listPage channelBucketView");
            var self = this;
            App.channelcollection.fetch({
                data: querystring,
                success: function(collection , response){ 
                    self.render(response);
                    self.fillQueueImages();
                }
            });
	},
	delete: function(id){ 
            console.log("delete channel "+id);
            if(confirm('are you sure - channel: '+id+'?')){
                App.channelcollection.get(id).destroy();
                App.channelbucketview.listPage();
            }
	},
        addQueueEvent: function(event){
            var self = this;
            var this_id = event.target.id;
            var id = $(event.target).parent().parent().attr("data-id");
            console.log("addQueueEvent "+this_id+" channel_id "+id);
            $(".rssRow img.check-mark").each(function() {   // find all items with check-marks and insert
                if ($(this).is(":visible")) {
                    console.log("adding to queue "+$(this).parent().attr("id"));
                    var item = $(this).parent();
                    var image_url = item.attr("image_url");
                    var name = item.attr("name");
                    //var image = item.find("img.rss-image").attr("src");
                    console.log(image_url);
                    self.insertMiniImage($("#"+this_id).parent().parent().find("div.pics1"),image_url);

                    // commit to db
                    var queuemodel = new App.QueueModel({
                        name : name,
                        image_url :image_url,
                        channel_id: id
                    });
                    queuemodel.save();
                }
            });
            Rss.clearAllChecked();
        },
        insertMiniImage: function(div,image_url){
            div.prepend("<div class='mini-image-box'><img width='32' src='"+image_url+"' /></div>");
        },
        fillQueueImages: function(event) {
            var self = this;
            //console.log("fillQueueImages");
            setTimeout(function(){ 
                $('.channel-box').each(function(){
                    var id = $(this).attr('data-id');
                    console.log("fillQueueImages "+id);
                    var imageBox = $("div.pics1",this);
                    $.ajax({
                        dataType : 'json',
                        url: 'serv/queue.php',
                        data:{
                            cmd: "list",
                            channel_id: id
                        },
                        success: function( data ){
                            $.each(data, function( index, value ) {
                                console.log(value.image_url);
                                self.insertMiniImage(imageBox,value.image_url);
                            });
                        }
                    }); // end of ajax
                    
                    /*  not sure why this doesn't work
                    var coll = new App.queueCollection();
                    coll.fetch({data: $.param({'channel_id':id})});   

                    console.log(coll);
                    coll.each(function(model){ 
                      console.log(model); 
                    });         
                    */
                });//end of each

            }, 1500);
        } 
}); 

$(function(){
    App.run();
});
