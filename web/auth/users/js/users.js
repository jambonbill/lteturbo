$(function(){

	'use strict';

	let users=[];

	function getUsers(){

	    console.info('getUsers');

	    let p={
	    	'do':'getUsers'
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
		    users=json.users;
		    displayUsers();
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}

	getUsers();

	function displayUsers(){

	    console.info('displayUsers');

		let dat=users;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th width=20>#</th>';
	    htm+='<th>username</th>';
	    htm+='<th>email</th>';
	    htm+='<th width=180>last login</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];
	        //console.log(o);
		    htm+='<tr data-id="'+o.id+'">';
		    htm+='<td><i class="text-muted">'+o.id+'</i>';
		    htm+='<td>'+o.username;
		    htm+='<td>'+o.email;
		    htm+='<td>';
		    if(o.last_login)htm+=o.last_login;
		}
	    htm+='</tbody>';
	    htm+='</table>';

	    if (dat.length>0) {
	        htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<pre>no data</pre>';
	    }


	    $('#boxUsers .card-body').html(htm);
	    $('#boxUsers table').tablesorter();
	    $('#boxUsers tbody>tr').click(function(){
	    	$('.overlay').show();
	        console.log($(this).data('id'));
	        document.location.href='../user/?id='+$(this).data('id');
	    });
	}

	$('#btnNewUser').click(function(){
		$('#modalUserNew').modal('show');
		$('#email').focus();
	});

	$('table').tablesorter();
	$('.overlay').hide();
	console.log('users.js');
});

