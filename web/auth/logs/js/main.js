$(function(){

	'use strict';

	let dat=[];

	function get(){

	    console.info('get');

	    let p={
	    	'do':'get',
	    	search:$('#search').val(),
	    	userid:$('#user').val(),
	    	date:$('#date').val(),
	    	channel:$('#channel').val(),
	    	limit:$('#limit').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
		    dat=json.logs;
		    display();
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}

	get();

	function display(){

	    //console.info('display');
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';
	    htm+='<thead>';
	    htm+='<th width=20>#</th>';
	    htm+='<th>Channel</th>';
	    htm+='<th>uid</th>';
	    htm+='<th>Message</th>';
	    htm+='<th>Time</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];
	        let jsdate=new Date(o.time*1000)
	        console.log(o);
		    htm+='<tr data-id="'+o.id+'">';
		    htm+='<td><i class="text-muted">'+o.id;
		    htm+='<td>'+o.channel;
		    htm+='<td>';
		    if(o.userid)htm+=o.userid;
		    htm+='<td>'+o.message;
		    htm+='<td>'+jsdate;
		}
	    htm+='</tbody>';
	    htm+='</table>';

	    if (dat.length>0) {
	        htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<pre>no data</pre>';
	    }


	    $('#boxLogs .card-body').html(htm);
	    $('#boxLogs table').tablesorter();
	    $('#boxLogs tbody>tr').click(function(){
	    	//$('.overlay').show();
	        console.log($(this).data('id'));
	        //document.location.href='';
	    });
	}

	$('#boxFilter select,#boxFilter input').change(()=>{
		get();
	});

});