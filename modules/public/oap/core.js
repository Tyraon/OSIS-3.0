$(document).ready(function(){
	
	var clicking = false;
	var loop = false;
	init();
	
	function init(){
		$('#vplayer').prop('volume',0.8);
		$('#pointer').css({"margin-left":"72px"});
		$('#isvol').css({"width":"80px"});
		$('#vol').html('$');
		$('#vplayer').attr('loop',false);
	}
	
	$('#pbtn').click(function(){
		if($('#vplayer')[0].paused){
			$('#vplayer')[0].play();
			$('#pbtn').html('2');
			$('#bground')[0].play();
		}else{
			$('#vplayer')[0].pause();
			$('#pbtn').html('1');
			$('#bground')[0].pause();
		}
	});
	
	$('#vplayer').on('loadedmetadata',function(){
		$('#dura').val($('#vplayer')[0].duration);
	});
	
	$('#vplayer').on('timeupdate',function(){
		$('#currt').val($('#vplayer')[0].currentTime);
		//$('#dura').val($('#vplayer')[0].duration);
		var prozent = ($('#vplayer')[0].currentTime*100)/$('#vplayer')[0].duration;
		var width = (200*prozent)/100;
		$('#current').css({"width":width + "px"});
	});
	
	window.setInterval(function(){
		if($('#source').attr('src') != ""){
			var buffer = $('#vplayer')[0].buffered.end(0);
			var prozent = (buffer*100)/$('#vplayer')[0].duration;
			var width = (200*prozent)/100;
			$('#buffer').css({"width":width + "px"});
		}
	},500);
	
	$('#volume').mousedown(function(){
		clicking = true;
	});
	
	$(document).mouseup(function(){
		clicking = false;
	});
	
	$('#volume').mousemove(function(e){
		if(clicking == false) return;
		
		var posX = e.pageX-$('#volume').offset().left;
		var pointerPos = posX-8;
		$('#vplayer').prop('volume',(posX/100));
		$('#pointer').css({"margin-left":pointerPos + "px"});
		$('#isvol').css({"width":posX + "px"});
		if(posX >= 50){
			var icon = '$';
		}else{
			var icon = '#';
		}
		$('#vol').html(icon);
	});
	
	$('#progbar').mousedown(function(){
		clicking = true;
	});
	
	$('#progbar').mousemove(function(e){
		if(clicking == false) return;
		
		var posX = e.pageX-$('#progbar').offset().left;
		var prozent = (posX/200)*100;
		var currt = ($('#vplayer')[0].duration*prozent)/100;
		$('#vplayer').prop('currentTime',currt);
	});
	
	
	$('#open').click(function(){
		var source = prompt('Bitte URL zum Video angeben.');
		if(source != ""){
			var pos = source.lastIndexOf(".");
			var type = source.substr((pos+1));
			$('#vplayer').attr('src',source);
			//$('#vplayer').attr('type','video/' + type);
		}
	});
	
	$('#loop').click(function(){
		if(loop == false){
			loop = true;
			$('#loop').css({"color":"#c00"});
		}else{
			loop = false;
			$('#loop').css({"color":"#c00"});
		}
		$('#vplayer').attr('loop',loop);
	});
	
});
