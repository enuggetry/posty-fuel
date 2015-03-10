/*
RSS class for processing and displaying RSS gallery and events.
*/

var Rss = {
    selectCount:0,
    
    load: function () {
        var self = this;
        //console.log("loadRSS");
        $("#rsslist").html("");
        $("#feed-pillbox > ul > li").each(function( index ) {
            id = $(this).attr("data-id");
            url = $(this).attr("data-value");
            //console.log("url: "+url);
            block = "rss-/block-"+id;
            $("#rsslist").append("<div id='"+block+"' class='rss-block'></div>");
            self.get(block,url);
        });
    },
    get: function (div,url) {
        var self = this;
        var div1 = div;
        $.get( "serv/getrss.php?rss="+url, {} )
            .done(function( data ) {
                //console.log("got rss");
                $("#"+div1).html(data);
                self.process(div1);
        });
    },
    process: function (div) {
        var self = this;
        //console.log("processRSS");
        var showdiv = div+"-show";
        var rsstitle = $("#"+div+" channel > title").html();
        var items = "";
        items = self.getitems("#"+div+" item");
        
        $("#"+div).parent().append("<div class='"+showdiv+"'><a name='"+div+"' /><h1>"+rsstitle+"</h1>"+items+"</div><div style='clear:both'></div>");

        setTimeout(function(){ 
            // setup click handling
            console.log("timeout "+showdiv);
            $('.'+showdiv+' > div.rssRow').each(function(){
                    var id = $(this).attr('item-id');
                    var el = this;
                    //var url = $(this).html();
                    $(this).unbind();

                    $(this).click(function(e){
                        self.toggleCheck(el);
                        return false;
                    });
            });//end of each
           
        }, 1500);
    },
    getitems: function (div){
        var items = "";
        var i = 0;
        $(div).each(function( index ) {
            var title = $("title",this).html();
            // get image, if any
            var image = '';
            if ($("enclosure",this).length) {
                image = $("enclosure",this).attr("url");
                /*
            } else if ($("link[type='image/jpeg']",this).length) {
                image = $("link[type='image/jpeg']",this).attr("href");    
                **/
            } else {
                txt = $("description",this).html();
                a = txt.split("src=");
                b = a[1].split('"');
                image = b[1]; 
            }
            items += "<div class='rssRow' id='rssRow-"+i+"' item-id='"+i+"' name='"+title+"' image_url='"+image+"' ><div style='background-color:#ccc;width:200px;height:150px;overflow:hidden'><img class='rss-image' width='200' src='"+image+"' /></div><img class='check-mark' src='images/check-green.png' /><h4>"+title+"</h4></div>";
            i++;
        });
        return items;
    },
    toggleCheck: function (el) {
        //console.log("toggle "+$(el).attr("item-id"));
        if ($("img.check-mark",el).is(":visible")) this.uncheck(el);
        else this.check(el);
    },
    check: function (el){
        $("img.check-mark",el).show('fast');
        this.selectCount++;
    },
    uncheck: function (el){
        $("img.check-mark",el).hide('fast');
        this.selectCount--;
    },
    clearAllChecked: function () {
        //console.log("clearAllChecked");
        $(".rssRow img.check-mark").hide();
        Rss.selectCount = 0;    
    }
};

