$(document).ready(function(){
    	$.ajax({
	    type:'GET',
	    url:'worker/friendList.html',
	    success:function(data){
	        zuneShow("c2",data);
	    }
	});
});
/*
$("#showUpdateExp").click(function(){
    $("#expupdater").slideToggle();
});
*/
/*
$("#updateExpenseNow").click(function(){
    var expense = $("#expense").attr("value");
    console.log(expense);    
    var selfid = $('#c2').find("div:first").attr("id");
    var eventID = 1;
    $.ajax({
		type:'POST',
		data:{eventid:eventID,expense:expense,user:selfid},
		url:'worker/expense.php',
		success: function(data){
			zuneShow("cOne",data);
		}
	});
})
*/
$("#myEvents").click(function(){
    $("#container").hide();
    $("#container2").hide();
    $("#container").show();
	var selfid = $('#c2').find("div:first").attr("id");
	
	 $.ajax({
        type:'GET',
        url:'worker/uFile.txt',
        success:function(text){
	    
	$.ajax({
		type:'POST',
		data:{user:text},
		url:'worker/event_list.php',
		success: function(data){
			zuneShow("cOne",data);
		}
	});
	    }
	 });
	
});

$("#createEvent").click(function(){
        $("#container").hide();
  //  $("#container2").hide();
    $("#container2").show();
//	$.ajax({
//		type:'GET',
//		url:'createEventHandle.html',
//		success: function(data){
//			zuneShow("c1",data);
//		}
//	});
	$.ajax({
	    type:'GET',
	    url:'worker/friendList.html',
	    success:function(data){
	        zuneShow("c2",data);
	    }
	});    
});

function expandEventNameHolder(that){

    $(that).parent().find('div.eventNameHolder').slideToggle();
       
}

$("#submitCreateEvent").click(function(){
    var name = $("#name").attr("value");
    var venue = $("#venue").attr("value");
    var date = $("#date").attr("value");
    var userlist="";
    $("#c3 div").each(function(){
        userlist+= $(this).attr('id')+"&";
    });    
    //l = userlist.length;
    
    //userlist = userlist.substring(0,l-1);
    userlist+=$('#c2').find("div:first").attr("id");
    $.ajax({
        type:'POST',
        url:'worker/create_event.php',
        data:{name:name,venue:venue,date:date,userlist:userlist},
        success:function(data){
            $("#c1").append("<p>"+data+"<p>");
        }
    });
 
});

$("#cOne").on("mouseover",".event",function(){
	$(this).css({"background-color":"#EFEFEF"});
});
$("#cOne").on("mouseout",".event",function(){
	$(this).css({"background-color":"white"});
});
$("#cOne").on("click",".event",function(){
	var name = $(this).find("p:first").text();
	name;
	$.ajax({
		type:'GET',
		url:'demo/'+name+'.html',
		success: function(data){
			zuneShow("cTwo",data);
		}
	})
	
});

function recalcnow(that){
    var id = $(that).attr("id");
    var expense = $("#expense_"+id).attr("value");
    console.log(expense);    
  //  var selfid = $('#c2').find("div:first").attr("id");
    var selfid;
    $.ajax({
        type:'GET',
        url:'worker/uFile.txt',
        success:function(text){
    var eventID = $('#id_'+id).text();
    $.ajax({
		type:'POST',
		data:{eventid:eventID,expense:expense,user:text},
		url:'worker/expense.php',
		success: function(data){
			zuneShow("cOne",data);
		}
	});
        }
    });

}

$("#cOne").on("click","#updateExpenseNow",function(){
    
});



$("#c2").on("mouseover",".fList",function(){
	$(this).css({"background-color":"#EFEFEF"});
});
$("#c2").on("mouseout",".fList",function(){
	$(this).css({"background-color":"white"});
});
$("#c2").on("click",".fList",function(){
//	var name = $(this).fin.text();
//	name;
//	$.ajax({
//		type:'GET',
//		url:'demo/'+name+'.html',
//		success: function(data){
///			zuneShow("cTwo",data);
//		}
//	})
	var id = $(this).attr('id');
	$("#c3").append("<div id="+id+">"+$(this).html()+"</div>");

});


function zuneShow(id,result){
	container = document.getElementById(id);
	$(container).html(result);
	$(container).css({"padding-left":"+=10","opacity":"0"});
	$(container).animate({paddingLeft:'-=10' ,opacity:'+=1'},'200','swing');
}

function zuneHide(id){
	container = document.getElementById(id);
	$(container).animate({paddingLeft:'-=10' ,opacity:'-=0'},'200','swing');
	$(container).html(" ");
}

