$(()=>{
    'use strict';
    let groups=[];

    let get=()=>{
        console.info('get');
        $('.overlay').show();
        $.post('ctrl.php',{do:'get'}, (json)=>{
            console.log(json);
            groups=json.groups;
            display();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }

    get();

    function display(){//display groups

        console.info('display()');
        let dat=groups;
        let str=$('#search').val();
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        htm+='<th width=30>#</th>';
        htm+='<th>Name</th>';
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
            console.log(o);
            htm+='<tr data-id="'+o.id+'">';
            htm+='<td><i class="text-muted">'+o.id;
            htm+='<td>'+o.name;
            htm+=' <a href="../auth_group/'+o.id+'"><i class="fas fa-angle-double-right"></i></a>';
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            //htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
            htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
        }

        $('#boxGroups .card-body').html(htm);
        $('#boxGroups table').tablesorter();
        $('#boxGroups tbody>tr').click(function(){
            //$('.overlay').show();
            $('#boxGroups tbody>tr').removeClass('bg-primary');
            $(this).addClass('bg-primary');
            console.log("Group #"+$(this).data('id'));
            getGroup($(this).data('id'));
        });
    }


    let users=[];
    function getGroup(id){
        let p={
            do:'groupUsers',
            group_id:id
        };

        $('.overlay').show();
        $('#boxUsers').show();

        $('#btnEdit').attr('href','../auth_group/'+id);

        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
            users=json.users;
            displayGroupUsers();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }


    function displayGroupUsers(){
        console.info('displayGroupUsers');
        let dat=users;
        let str=$('#search').val();
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        htm+='<th>Name</th>';
        htm+='<th>Email</th>';
        htm+='</thead>';

        htm+='<tbody>';
        for(let i in dat){
            let o=dat[i];
            if (str) {
                let reg=new RegExp(str,'i');
                let match=false;
                if(!match)continue;
            }
            //console.log(o);
            htm+='<tr data-id="'+o.id+'" title="#'+o.id+'">';
            htm+='<td>'+o.username;
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
            //$('.overlay').show();
            //console.log($(this).data('id'));
            //document.location.href='';
        });

    }



    $('#btnNew').click(()=>{
        let n=prompt("Enter group name","group");
        if(!n)return;
        let p={
            'do':'create',
            name:n
        };
        $('.overlay').show();
        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
            get();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    });

    $('#search').change(()=>display());
    $('#boxUsers').hide();
});