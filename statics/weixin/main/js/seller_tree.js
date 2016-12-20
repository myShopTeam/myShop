//显示导航栏
function show_shop_nav(){
	if(pid < 1){
		show_shop_nav_name();
		return false;
	}
	$.ajax({
		async:false,
		url : requestUrl,
		type: 'get',
		data: {id : pid },
		dataType:"json",
		success: function(response) {
			show_shop_nav_name( response.data );
		}
	});
}
	
//显示导航名称
function show_shop_nav_name(data){
	var name = '';
	var id = 0;
	if(data){
		name = data.name;
		id = data.shop_id;
	}else{
		data = {};
		data.shop_id = 0;
		data.name = uname;
		data.avatar = headImg;
		data.amount = '';
		
	}
	name ? $('.shop-nav').html('<b>' + name + '</b> 的下级列表').show() : $('.shop-nav').html('所有列表').show();
	var html = template('data-item', data);
	$('#data-list tbody').append(html);
	show_id(id);
}
	
var is_show_pid = 0;
//显示下级
function show_id(id) {
	$.ajax({
		async:true,
		url : requestUrl,
		type: 'get',
		data: {limit : 100000,pid : id },
		dataType:"json",
		success: function(response) {
			var item = response.data;
			if(item.length>0){
				is_show_pid = 1;
				for(var i=0;i<item.length;i++){
					var _id = item[i]['shop_id'];
					var status=item[i]['status'];
					//console.log('上级:' + id + ',下级：'+_id);
					if(_id>0){
						if(status!=3){
							var html = template('data-item', item[i]);
							$('#show_' + id).append(html);
							$('#avatar_'+_id).addClass('avatar-bg');
							$('#avatar_img_'+_id).addClass('avatar-img-bg');
						}else{
							$('#show_' + id).attr('id','show_' + _id);
						}
						show_id(_id);
					}
				}
			}else{
			   if(is_show_pid==0) $('#show_' + id).append('暂无下级<br/><a href="/Follower/treeShow/shop_id/0" title="点击查看全部分销商树状图" class="item-sub"><span class="fa fa-tree"></span></a>');
				is_show_pid = 1;
			}
		}
	});
};