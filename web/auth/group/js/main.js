$(()=>{
    'use strict';
    let users=[];//group users
    let perms=[];//group perms
    let list=[];//list all perms
    let perm_id;//selected permission
    let user_id;//selected user

    let getUsers=()=>{
        console.info('getUsers');
        let p={
            do:'getUsers',
            id:$('#id').val()
        };
        $('.overlay').show();
        $.post('ctrl.php',p, (json)=>{
            console.log(json);
            users=json.users;
            displayUsers();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }

    let getPerms=()=>{
        console.info('getPerms');
        let p={
            do:'getPerms',
            id:$('#id').val()
        };
        $('.overlay').show();
        $.post('ctrl.php',p, (json)=>{
            console.log(json);
            perms=json.perms;
            displayPerms();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }

    function getList(){
        console.info('getList()');
        $('.overlay').show();
        $.post('ctrl.php', {do:'listPermissions'}, (json)=>{
            console.log(json);
            list=json.list;
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }


    function displayUsers(){

        console.info('displayUsers');
        let dat=users;
        let str=$('#search').val();
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        //htm+='<th width=30>#</th>';
        htm+='<th>Name</th>';
        htm+='<th>Email</th>';
        htm+='</thead>';

        htm+='<tbody>';
        for(let i in dat){
            let o=dat[i];
            if(str){
                let reg=new RegExp(str,'i');
                let match=false;
                if(reg.test(o.id))match=1;
                if(reg.test(o.name))match=1;
                if(!match)continue;
            }
            //console.log(o);
            if(o.is_active==0){
                htm+='<tr data-id="'+o.id+'" title="#'+o.id+'" class="text-muted">';//inactive
            }else{
                htm+='<tr data-id="'+o.id+'" title="#'+o.id+'">';
            }

            //htm+='<td><i class="text-muted">'+o.id;
            htm+='<td>'+o.first_name+' '+o.last_name;
            htm+=' <a href="../auth_user/'+o.id+'"><i class="fas fa-angle-double-right"></i></a>';
            htm+='<td>'+o.email;
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            //htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
            htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no user</div></div>';
        }

        $('#boxUsers .card-body').html(htm);
        $('#boxUsers table').tablesorter();
        $('#boxUsers tbody>tr').click(function(){
            $('#boxUsers tbody>tr').removeClass('bg-primary');
            $(this).addClass('bg-primary');
            console.log("#"+$(this).data('id'));
            $('#btnDelUser').attr("disabled",false);
        });
    }


    function displayPerms(){
        console.info('displayPerms()');
        let dat=perms;
        //let str=$('#search').val();
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        //htm+='<th>#</th>';
        htm+='<th>Name</th>';
        htm+='</thead>';

        htm+='<tbody>';
        for(let i in dat){
            let o=dat[i];
            /*
            if (str) {
                let reg=new RegExp(str,'i');
                let match=false;
                if(!match)continue;
            }
            */
            console.log(o);
            htm+='<tr data-id="'+o.id+'" title="#'+o.id+'">';
            //htm+='<td>'+o.name;
            htm+='<td>'+o.name;
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            //htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
            htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no permission</div></div>';
        }

        $('#boxPerms .card-body').html(htm);
        $('#boxPerms table').tablesorter();
        $('#boxPerms tbody>tr').click(function(){
            $('#boxPerms tbody>tr').removeClass('bg-primary');
            $(this).addClass('bg-primary');
            console.log($(this).data('id'));
            $('#btnDelPerm').attr('disabled',false);

        });
    }


    window.popPermissions=function(){
        console.log('popPermissions()');
        $('#modalPermissions').modal('show');
        display();
        function display(){
            console.info('display');
            let dat=list;
            //let str=$('#search').val();
            let num=0;
            let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

            htm+='<thead>';
            htm+='<th>Permission</th>';
            htm+='<th>#</th>';
            htm+='</thead>';

            htm+='<tbody>';
            for(let i in dat){
                let o=dat[i];
                /*
                if(str){
                    let reg=new RegExp(str,'i');
                    let match=false;
                    if(!match)continue;
                }
                */
                console.log(o);
                htm+='<tr data-id="'+o.id+'">';
                htm+='<td>'+o.name;
                htm+='<td>'+o.content_type_id;
                num++;
            }
            htm+='</tbody>';
            htm+='</table>';

            if (num>0) {
                //htm+='<i class="text-muted">'+num+' record(s)</i>';
            } else {
                htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
            }

            $('#modalPermissions .modal-body').html(htm);
            $('#modalPermissions table').tablesorter();
            $('#modalPermissions tbody>tr').click(function(){
                //$('.overlay').show();
                let id=$(this).data('id');
                console.log(id);

                //if(!confirm("Add permission #"+id))return;

                let p={
                    do:'addPerm',
                    group_id:$('#id').val(),
                    perm_id:id
                };

                $('.overlay').show();
                $.post('ctrl.php', p, (json)=>{
                    $('.overlay').hide();
                    console.log(json);
                    if(json.created){
                        $('#modalPermissions').modal('hide');
                        getPerms();
                    }
                }).fail((e)=>{
                    alert(e.responseText);
                    console.error(e.responseText);
                }).always(()=>{
                    $('.overlay').hide();
                });
            });
        }
    }

    $('#btnPopPerms').click(()=>popPermissions());

    $('#btnDelPerm').click(()=>{

    });

    $('#btnAddUser').click(()=>{
        let n=prompt("Enter user email","");
        if(!n)return;

        let p={
            do:'groupUserAdd',
            group_id:$('#id').val(),
            email:n
        };
        $('.overlay').show();
        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
            if(json.error){
                alert(json.error);
                console.error(json.error);
            }else if(json.created){
                getUsers();
            }
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    });

    $('#btnDelUser').click(()=>{
        if(!user_id)return;

        let p={
            do:'groupUserDel',
            group_id:$('#id').val(),
            user_id:user_id
        };

        $('.overlay').show();
        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
            if(json.error){
                alert(json.error);
                console.error(json.error);
            }else if(json.created){
                getUsers();
            }
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    });

    getPerms();
    getUsers();
    getList();
});