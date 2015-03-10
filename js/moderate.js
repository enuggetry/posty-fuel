/*
	generates the moderate page, queue tabs, etc.
	backbone
*/

var App = {
    run: function(){
        this.feedcollection = new this.feedCollection();
        this.channelcollection = new this.channelCollection();
        this.queuecollection = new this.queueCollection();
        this.channelmoderateview = new this.channelModerateView();
        
        Backbone.history.start();
    }
};	

App.channelModerateView = Backbone.View.extend({
	el: '#moderate-tabs',
	template: _.template($('#channelModerateTemplate').html()),
	
	initialize : function(){
            console.log("init channelModerateView");
            _.bindAll(this,'listPage','delete');
            this.listPage();
	},
	events: {
            "click .queue-item-box button": 'addQueueEvent'
	},
	render: function(response){
            console.log("channelModerate render");
            this.$el.html(this.template({channels: response }));
	},
	listPage: function(querystring){
            console.log("listPage channelModerateView");
            var self = this;
            App.channelcollection.fetch({
                data: querystring,
                success: function(collection , response){ 
                    self.render(response);
                    self.fillPanes();
                }
            });
	},
	delete: function(id){ 
            console.log("delete channel "+id);
            if(confirm('are you sure - channel: '+id+'?')){
                App.channelcollection.get(id).destroy();
                App.channelmoderateview.listPage();
            }
	},
        fillPanes: function(){
            var self = this;
            var html1 = $("#workspace").html();
            $(".queue-tab-panes .tab-pane").each(function(){
                var channel = $(this).attr("channel");
                $(".pane-"+channel).html(html1);
                $(".pane-"+channel+" > script").attr("id","pane-"+channel)

                $.ajax({
                    dataType : 'json',
                    url: 'serv/queue.php',
                    data:{
                        cmd: "list",
                        channel_id: channel
                    },
                    success: function( data ){
                        $.each(data, function( index, value ) {
                            //console.log(value.image_url);
                            //self.insertImage(imageBox,value.image_url);
                            //$("#tab-"+channel).append("<a href='#' class='queue-item-box' data-id='"+value.id+"' data-toggle='modal' data-target='#myModal'><div class='pics'><img width='250' src='"+value.image_url+"' /></div>"+value.name+"</a>");
                            var scheduled = value.scheduled=="1" ? "p-checked" : "";
                            $("#tab-"+channel).append("<a href='#' class='queue-item-box' data-id='"+value.id+"' ><div class='pics'><img width='250' src='"+value.image_url+"' /></div><img class='check-mark scheduled-"+value.scheduled+"' src='images/calendar.png' /><p>"+value.name+"</p></a>");
                        });
                        self.setupClickEvents();
                   }
                }); // end of ajax
                
                // this dont work - why?
                /*setTimeout(function(){ 
                    var view = new App.queueUnsentView();
                    view.el = "#tab-"+channel;
                    view.template = _.template($('#pane-'+channel).html());
                    view.channel_id = channel;
                    view.listPage($.param({'channel_id':channel}));
                }, 1000);*/     
            });
        },
        //insertImage: function(div,image_url){
        //    div.append("<div class='queue-item-box'><div class='pics'><img width='32' src='"+image_url+"' /></div></div>");
        //},
        setupClickEvents: function () {
            var self = this;
            setTimeout(function(){ 
                $('.queue-item-box').each(function(){
                        var item = this;
                        var id = $(this).attr('data-id');
                        var url = $(this).html();
                        $(this).unbind();

                        $(this).click(function(e){
                            App.channelmoderateview.queueItemEvent(item);
                            return false;
                        });
                        $(this).dblclick(function(e){
                            App.channelmoderateview.queueItemEvent(item);				
                        });
                });//end of each
            }, 1000);     
        },
        queueItemEvent: function (item) {
            var id = $(item).attr("data-id");
            var title = $("p",item).html();
            var image_url = $("img",item).attr("src");
            
            //console.log(item);
            $("#myModalLabel").html(title + " ("+id+")");
            $("#diag-title").val(title);
            $("#diag-image-box").html("<img class='diag-image' src='"+image_url+"' />");
            $("#myModal").attr("item-id",id);
            $('#myModal').modal('show');        
        },
        addQueueEvent: function(event){
        }
}); 
/*
App.queueUnsentView = Backbone.View.extend({
	el: '#workspace',
	template: _.template($('#workspaceTemplate').html()),
        channel_id: 1,
	
	initialize : function(){
            console.log("init queueUnsentView");
            //_.bindAll(this,'listPage','delete');
            //this.listPage();
	},
	events: {
            "click .queue-item-box button": 'addQueueEvent'
	},
	render: function(response){
            console.log("queueUnsentView render "+this.el);
            this.$el.html(this.template({queues: response }));
	},
	listPage: function(querystring){
            console.log("listPage channelModerateView");
            var self = this;
            var queuecollection = new App.queueCollection();
            queuecollection.fetch({
                data: querystring,
                success: function(collection , response){ 
                    self.render(response);
                }
            });
	},
        addQueueEvent: function(event){
        },
        editEvent: function(){
            
        }
}); 
*/
$(function(){
    App.run();
    
    // setup click and dblclick event handling
    
/*    $('#myModal').on('show.bs.modal', function (e) {
      $("#myModalLabel").html("Hahaha");
      console.log(e.relatedTarget);
    });*/
    $('#btn-save').click(function () {
        var btn = $(this);
        //btn.button('loading')
        
        var id = $("#myModal").attr("item-id");
        var title = $("#diag-title").val();
        console.log("btn-save id");
        
        $.ajax({
            dataType : 'json',
            url: 'serv/queue.php',
            data:{
                cmd: "add",
                id:id,
                name: title,
                schedule_random:1
            },
            success: function( data ){
                var el = ".queue-item-box[data-id='"+id+"'] > img.check-mark";
                $(el).addClass("scheduled-1");
                /*$.each(data, function( index, value ) {
                    //console.log(value.image_url);
                    //self.insertMiniImage(imageBox,value.image_url);
                });*/
            }
        }); // end of ajax
    });
    
});

$(function () {
  $('#queue-tabs a:first').tab('show')
})
