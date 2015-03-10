/*
	Generates the calendar page (schedule)
*/
var App = {
    run: function(){
        this.channelcollection = new this.channelCollection();
        this.channelbucketview = new this.channelLegendView();
        
        Backbone.history.start();
    }
};	


App.channelLegendView = Backbone.View.extend({
	el: '#channel-legend-container',
	template: _.template($('#channelLegendTemplate').html()),
	
	initialize : function(){
            console.log("init channelLegendView");
            this.listPage();
	},
	render: function(response){
            //console.log("channelLegendbucket render");
            this.$el.html(this.template({channels: response }));
	},
	listPage: function(querystring){
            //console.log("listPage channelLegendView");
            var self = this;
            App.channelcollection.fetch({
                data: querystring,
                success: function(collection , response){ 
                    self.render(response);
                    self.fillQueueImages();
                }
            });
	}
}); 

$(function(){
    App.run();
});

// convert SQL datetime to JS Date
function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
}
