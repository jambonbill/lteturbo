$(function(){
	
	$('#btnSave').click(function(){
		alert('save! (todo)');
	});
	
	$('#btnPassword').click(function(){
		var p=prompt("Enter new password");

		$.post('ctrl.php',{'do':'changePassword','user_id':$('#user_id').val(),'password':p},function(x){
			try{eval(x);}
			catch(e){console.warn(x);}
		});
	});
	
	$('#btnDelete').click(function(){
		if(!confirm("Delete this user ?"))return;

		$.post('ctrl.php',{'do':'deleteUser','user_id':$('#user_id').val()},function(x){
			try{eval(x);}
			catch(e){console.warn(x);}
		});

	});

	console.log('user.js');

});