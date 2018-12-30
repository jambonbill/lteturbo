$(function(){
	
	'use strict';
	
	let tickets=[];

	$('#btnNewTicket').click(()=>{
		$('#modalTicket').modal('show');
	});

	function getTickets(){
	    
	    console.info('getTickets');
	    
	    let p={
	    	'do':'getTickets'
	    };
	    
	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });    
	}

	getTickets();

	function displayTickets(dat){
	    
	    console.info('displayTickets');
	
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';
	    
	    htm+='<thead>';
	    htm+='<th>#</th>';
	    htm+='</thead>';
	
	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];
	        console.log(o);
		    htm+='<tr data-id="'+o.id+'">';
		    htm+='<td>'+o;
		}    
	    htm+='</tbody>';
	    htm+='</table>';
	    
	    if (dat.length>0) {
	        htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<pre>no data</pre>';
	    }
	    
	
	    $('#boxTickets .box-body').html(htm);
	    $('#boxTickets table').tablesorter();
	    $('#boxTickets tbody>tr').click(function(){
	    	$('.overlay').show();
	        console.log($(this).data('id'));
	        //document.location.href='';
	    });
	}

	$('.overlay').hide();
});