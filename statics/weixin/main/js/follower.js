function forFollower(){
}
forFollower.prototype={
	
	init:function(){
		var _this=this;
		$("#checkAll").click(function(){
			var $checked=$("input[name=check_user]");
			var $this=this;
			$checked.each(function(){
				this.checked=$this.checked? true :false;
			});
			
		});
		$("#balance_sort").click(function(){//按照余额排序
			var sort_type=0;
			if($(this).hasClass('asc')){
				sort_type=1;
				$(this).addClass('desc');
			}else{
				sort_type=2;
				$(this).addClass('asc');
			}
			_this.sortsearch(sort_type);
		});
		$("#comm_sort").click(function(){//按照分成排序
			var sort_type=0;
			if($(this).hasClass('asc')){
				sort_type=3;
				$(this).addClass('desc');
			}else{
				sort_type=4;
				$(this).addClass('asc');
			}
			_this.sortsearch(sort_type);
		});
		$("#sale_sort").click(function(){//按照销售总额
			var sort_type=0;
			if($(this).hasClass('asc')){
				sort_type=5;
				$(this).addClass('desc');
			}else{
				sort_type=6;
				$(this).addClass('asc');
			}
			_this.sortsearch(sort_type);
		});
		$("#num_sort").click(function(){//按照分销完成订单数
			var sort_type=0;
			if($(this).hasClass('asc')){
				sort_type=7;
				$(this).addClass('desc');
			}else{
				sort_type=8;
				$(this).addClass('asc');
			}
			_this.sortsearch(sort_type);
		});
		
		
		
		$("#toAudit").click(function(){//组装json
			var data=[];
			var jsonData='[';
			$("input[name=check_user]:checked").each(function(){
				jsonData+='"'+this.value+'",'
				data.push(this.value);
			});
			jsonData=jsonData.substr(0,jsonData.length-1)+']';
			
			if(data.length==0){
				alert("您没有选择任何用户");
				return false;	
			}else{
				$.ajax({
					type:"post",
					url:audit_url,
					data:{ids:jsonData},
					dataType:"json",
					success:function(res){
						if(res.status==1){
							alert("审核完毕");	
							window.location=location.href;
						}else if(res.status==2){
							alert(res.msg);
							window.location=location.href;
						}else{
							alert(res.msg);
							window.location=location.href;
						}
					}
				});	
			}	
		});
		//拒绝
		$("#toDeny").click(function(){
			var data=[];
			var jsonData='[';
			$("input[name=check_user]:checked").each(function(){
				jsonData+='"'+this.value+'",'
				data.push(this.value);
			});
			jsonData=jsonData.substr(0,jsonData.length-1)+']';
			
			if(data.length==0){
				alert("您没有选择任何用户");
				return false;	
			}else{
				$.ajax({
					type:"post",
					url:deny_url,
					data:{ids:jsonData},
					dataType:"json",
					success:function(res){
						if(res.status==1){
							alert("操作完成");	
							window.location=location.href;
						}else if(res.status==2){
							alert(res.msg);
							window.location=location.href;
						}
					}
				});	
			}	
		});
		//加载用户详细信息
		var settings={
                constrains: 'horizontal', 
                trigger:'click',
                multi: false,
                width:'220',
				height:'260',
                type:'async',
                cache:true,
                content: function(data){
					var obj = eval('(' + data + ')');
					var html=template('user_info',obj);
					return html;
                }
        }
		$('.user_list img').each(function(i,item){
			settings.url=$(item).attr('link-target');
			$(item).webuiPopover('destroy').webuiPopover(settings);
		});
	},sortsearch:function(sort_type){//排序查询
		$("#sort_type").val(sort_type);
		$("#seller_form").submit();
	}
	
}