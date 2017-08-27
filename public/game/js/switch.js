$(function(){
	var $type=$('#type');
	var $submitBtn=$('#submitBtn');
	
	$submitBtn.click(function(){
		$.post('switchServlet',{type:$type.val()},function(txt){
			var msg="操作失败";
			if(true==Boolean(txt)){
				msg="操作成功";
			}
			alert(msg);
		});
	});
	
});