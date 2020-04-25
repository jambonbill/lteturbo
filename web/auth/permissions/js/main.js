$(()=>{
    'use strict';

    let types=[];
    let perms=[];

    let get=()=>{
        console.info('get');
        //let p={do:'get'};
        $('.overlay').show();
        $.post('ctrl.php',{do:'get'}, (json)=>{
            console.log(json);
            perms=json.list;
            display();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }

    get();


    function getContentTypes(){
        console.info('getContentTypes()');
        $('.overlay').show();
        $.post('ctrl.php',{do:'getContentTypes'}, (json)=>{
            console.log(json);
            types=json.types;
            displayCTypes();
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }


    get();
    getContentTypes();


    function displayCTypes(){
        console.info('displayCTypes()');
        let dat=types;
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        htm+='<th width=30>#</th>';
        htm+='<th>App.Model</th>';
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
            htm+='<tr data-id="'+o.id+'" title="#'+o.id+'">';
            htm+='<td><i class="text-muted">'+o.id+'</i>';
            htm+='<td>'+o.app_label;
            htm+='.'+o.model;
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            //htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
            htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
        }

        $('#boxContentTypes .card-body').html(htm);
        $('#boxContentTypes table').tablesorter();
        $('#boxContentTypes tbody>tr').click(function(){
            $('#boxContentTypes tbody>tr').removeClass("bg-primary");
            $(this).addClass("bg-primary");
            //console.log($(this).data('id'));
            display($(this).data('id'));
        });
    }


    /**
     * Display permissions
     * @return {[type]} [description]
     */
    function display(ctype){
        console.info('display()', ctype);
        let dat=perms;
        //let str=$('#search').val();
        let num=0;
        let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

        htm+='<thead>';
        htm+='<th width=30>#</th>';
        htm+='<th>Name</th>';
        htm+='<th title="Content type">c.type #</th>';
        htm+='<th>codename</th>';
        htm+='</thead>';

        htm+='<tbody>';
        for(let i in dat){
            let o=dat[i];
            if(ctype&&ctype!=o.content_type_id)continue;
            /*
            if(str){
                let reg=new RegExp(str,'i');
                let match=false;
                if(reg.test(o.id))match=1;
                if(reg.test(o.name))match=1;
                if(!match)continue;
            }
            */
            //console.log(o);
            htm+='<tr data-id="'+o.id+'">';
            htm+='<td><i class="text-muted">'+o.id;
            htm+='<td>'+o.name;
            htm+='<td><span class="badge badge-light">#'+o.content_type_id+'</span>';
            htm+='<td>'+o.codename;
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            //htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
            htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
        }

        $('#boxPerms .card-body').html(htm);
        $('#boxPerms table').tablesorter();
        $('#boxPerms tbody>tr').click(function(){
            //$('.overlay').show();
            $('#boxPerms tbody>tr').removeClass('bg-primary');
            $(this).addClass('bg-primary');
            console.log("Group #"+$(this).data('id'));
            getGroup($(this).data('id'));
        });
    }


    let users=[];
    function getGroup(id)
    {
        let p={
            do:'groupUsers',
            group_id:id
        };

        $('.overlay').show();
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
        htm+='<th>#</th>';
        htm+='<th>Name</th>';
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
            htm+='<tr data-id="'+o.id+'">';
            htm+='<td>'+o;
            num++;
        }
        htm+='</tbody>';
        htm+='</table>';

        if (num>0) {
            htm+='<i class="text-muted">'+num+' record(s)</i>';
        } else {
        htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
        }

        $('#boxGroup .card-body').html(htm);
        $('#boxGroup table').tablesorter();
        $('#boxGroup tbody>tr').click(function(){
            //$('.overlay').show();
            //console.log($(this).data('id'));
            //document.location.href='';
        });
    }


    window.popNew=()=>{
        console.log('popNew()');
        $('#modalNewPermission').modal('show');
    }

    $('#btnNew').click(()=>popNew());

    function create(){
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
    }


    $('#search').change(()=>display());
});