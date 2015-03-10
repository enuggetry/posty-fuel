
App.FeedModel = Backbone.Model.extend({
    sync: function( method , model , options ){
        console.log("feed model: "+ method);
        if( method === 'create' || method === 'update' )
        {
            return $.ajax({
                dataType : 'json',
                url: 'serv/feed.php',
                data:{
                    cmd: "add",
                    id: (this.get('id') || ''),
                    name: (this.get('name') || ''),
                    type: (this.get('type') || ''),
                    url: (this.get('url') || ''),
                },
                success: function( data ){
                    if( data.success === true){
                        if( method === 'update') {
                        }
                        else {
                        }
                    }
                    else {
                        $.each( data.validationError, function(){ 
                            console.log(this.error);
                        }); // end of each
                    }
                }
            }); // end of ajax
        } // end of if
        else if ( method ==='delete' ){
            var id = this.get('id');
            return $.getJSON('serv/feed.php',
                { cmd: "delete", id : id},
                function(data){ 
                    if( data.success === true ){
                    }
                    else {
                        alert(data.msg);
                    }
                }); // end of getJSON
        }
    } // end of sync
}); 

App.ChannelModel = Backbone.Model.extend({
    sync: function( method , model , options ){
        console.log("channel model: "+ method);
        if( method === 'create' || method === 'update' )
        {
            return $.ajax({
                dataType : 'json',
                url: 'serv/channel.php',
                data:{
                    cmd: "add",
                    id: (this.get('id') || ''),
                    name: (this.get('name') || ''),
                    type: (this.get('type') || '')
                },
                success: function( data ){
                    //$('span.false').html('');
                    if( data.success === true){
                        if( method === 'update') {
                        }
                        else {
                        }
                    }
                    else {
                        $.each( data.validationError, function(){ 
                            console.log(this.error);
                        }); // end of each
                    }
                }
            }); // end of ajax
        } // end of if
        else if ( method ==='delete' ){
            var id = this.get('id');
            return $.getJSON('serv/channel.php',
                { cmd: "delete", id : id},
                function(data){ 
                    if( data.success === true ){
                    }
                    else {
                        alert(data.msg);
                    }
                }); // end of getJSON
        }
    } // end of sync
}); 

App.QueueModel = Backbone.Model.extend({
    sync: function( method , model , options ){
        console.log("feed model: "+ method);
        if( method === 'create' || method === 'update' )
        {
            return $.ajax({
                dataType : 'json',
                url: 'serv/queue.php',
                data:{
                    cmd: "add",
                    id: (this.get('id') || ''),
                    name: (this.get('name') || ''),
                    content: (this.get('content') || ''),
                    link_url: (this.get('link_url') || ''),
                    image_url: (this.get('image_url') || ''),
                    channel_id: (this.get('channel_id') || '')
                },
                success: function( data ){
                    //$('span.false').html('');
                    if( data.success === true){
                        if( method === 'update') {
                        }
                        else {
                        }
                    }
                    else {
                        $.each( data.validationError, function(){ 
                            console.log(this.error);
                        }); // end of each
                    }
                }
            }); // end of ajax
        } // end of if
        else if ( method ==='delete' ){
            var id = this.get('id');
            return $.getJSON('serv/queue.php',
                { cmd: "delete", id : id},
                function(data){ 
                    if( data.success === true ){
                    }
                    else {
                            alert( data.msg );
                    }
                }); // end of getJSON
        }
    } // end of sync
}); 

App.feedCollection = Backbone.Collection.extend({
	model : App.FeedModel,
	url: 'serv/feedlist.php'
});

App.channelCollection = Backbone.Collection.extend({
	model : App.ChannelModel,
	url: 'serv/channellist.php'
});

App.queueCollection = Backbone.Collection.extend({
	model : App.QueueModel,
	url: 'serv/queuelist.php'
});

