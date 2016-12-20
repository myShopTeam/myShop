//公用特效js
//@author lmh
document.write('<style>');
document.write('#alert_msg{	width: 20%;height: 35px;position: fixed;left: 40%; top: 100px;padding-left: 5px;border-radius: 5px;border: 1px solid #babcbe;background-color:#eef0f3;display:none;line-height: 35px; text-align: center;z-index:8000}');
document.write('.success,.error,.warning,.commonuse,.normalspan{width: 70px;padding:2px;border-radius: 5px;border: 1px solid #babcbe;line-height: 20px; text-align: center;display:block}');
document.write('.success{background-color:#99CC66;color:#FFF}');
document.write('.error{background-color:#FF6666;color:#FFF}');
document.write('.warning{background-color:#FFFF66;color:#FFF}');
document.write('.commonuse{background-color:#babcbe;color:#FFF}');
document.write('.selectInput {width: 180px;	height: 33px;	line-height: 36px;	padding-left: 10px;	margin-top: 12px;font-size: 12px;background-position: 0 0px;cursor: pointer;}.selectInput option {	height: 33px;	padding-left: 10px;	line-height: 36px;}.file_txt{	width: 320px;height: 35px;padding-left: 5px;border-radius: 5px;border: 1px solid #babcbe;background: none repeat scroll 0 0 #eef0f3;}');

document.write('</style>');

document.write('<div id="alert_msg"></div>');
$.extend({
  alert:function(msg,color,fcolor,time){
	  alert(msg);
	  /*var alert_msg= $("#alert_msg");		 
	  if(color==1)	{
		  color='#008000';
	  }else if(color==0){
		  color='#ff0000';
	  } 
	  color= (color==undefined)?'#008000':color;
	  fcolor= (fcolor==undefined)?'#FFFFFF':fcolor; 
	  alert_msg.css({'display':"block",'background-color':color,'color':fcolor});
	  time= (time==undefined)?3000:time;	 
	  alert_msg.text(msg);
	  setTimeout(function(){alert_msg.css({'display':"none"});},time);*/
  }
});
