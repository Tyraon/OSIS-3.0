var winId = 0;

$(document).ready(function(){
	look.glas("#menu","#000000");
	look.bShadow("#menu","black","-20","0","20","5");
	look.glas(".wintitle","#000000");
	
	
	//#####################

	$(document).bind('contextmenu', function(e){
		return false;
	});
	
	$(document).keydown('f11', function(e){
		//alert();
		/*setTimeout(function(){
			location.reload();
		},10);*/
		//return false;
	});
	
	$(document).bind('keydown', function(e){
		if(e.which == 17){
			$(document).bind('keydown', function(ev){
				if(ev.which == 16){
					$(document).bind('keydown', function(evt){
						if(evt.which == 73) return false;
					});
				}
			});
		}
	});
	
	$(document).bind('keydown', function(e){
		if(e.which == 36)
		screenLock();
	});
	
	
	$(document).click(function(){
			
			endContext();
	});
	
	
		
	if(!$.browser.webkit){
		alert('Bitte benutze einen richtigen Browser, wie den Google Chrome!');
		location.replace('sys/logout.php');
	}
	
	$('#deskt').css({"height":$(document).innerHeight() + "px"});
	
	setTimeout(function(){$('#loading').remove();},1000);

	//#####################
	
	
	var newmenuheight = $('#newmenu').height();
	var menpos = $(document).innerHeight()-(($('#newmenu').height()+22)*2);
	$('#newmenu').css({"top":menpos + "px"});
	newMenuClose();	
	
	/*$(window).resize(function(){
		newmenuheight = $('#newmenu').height();
		menpos = $(document).innerHeight()-($('#newmenu').height()+22);
	});*/
	
	$('.menuitem').click(function(e){
		//if(!e){var e=window.event;}
		console.log(e);
		if(e.toElement){
			var nav_src = e.toElement.id;
			var nav_tit = e.toElement.title;
		}else{
			var nav_src = e.target.id;
			var nav_tit = e.target.title;
		}
		openWindow(nav_tit,nav_src);
	});

	$('#menuclick').click(newMenuOpen);


	function newWindow(){
		$('body').append(buildWindow());
		
	}


	$('#newmenu').on('blur', newMenuClose);
	$(document).click(function(){
		$('#newmenu').height() >= 200 ? newMenuClose() : '';
	});
	
	$('#logout').click(function(){
		location.replace('sys/logout.php');
	});
	
	$('.prefs').click(function(){
		openWindow('Einstellungen', 'inc/prefs.php');
	});
	
	$('.fulls').click(function(){
		fullScreen();
	});

	function newMenuClose(){
		//alert();
		$('#newmenu').css({"width":"200px","height":"0px","min-height":"0px","top":$(document).innerHeight() + "px"});
		$('#menuclick').css({"box-shadow":"none"});
	}

	function newMenuOpen(){
		$('#newmenu').focus();
		var menpos = ($('#menu').offset().top-(newmenuheight));
		$('#newmenu').css({"width":"200px","height":newmenuheight + "px","min-height":"200px","top":menpos + "px","transition":"all 0.3s ease-in-out"});
		$('#menuclick').css({"box-shadow":"0px 0px 5px 0px white"});
	}
	
	clock();
	
	function clock(){
		setInterval(function(){
			var time = new Date();
			var ho = time.getHours() < 10 ? "0" + time.getHours() : time.getHours();
			var mi = time.getMinutes() < 10 ? "0" + time.getMinutes() : time.getMinutes();
			var se = time.getSeconds() < 10 ? "0" + time.getSeconds() : time.getSeconds();
			$('#clock').html(ho + ':' + mi + ':' + se);
		},1000);
	}
	
	$('#deskt').mousedown(function(e){if(e.button == 2){deskContext(e); return false;}});
	
	function fullScreen(){
		document.documentElement.webkitRequestFullScreen();
		newMenuClose();
	}

	
});


	function buildWindow(titel,source,width,height){
		winId++;
		titel = titel == '' || titel == undefined ? 'Unbekannt' : titel;
		source = source == '' || source == undefined ? 'blank.html' : source;
		width = width == '' || width == undefined ? '800' : width;
		height = height == '' || height == undefined ? '600' : height;
		var widthInt = parseInt(width)-5;
		var heightInt = parseInt(height)-25;
		var posx = winId*10;
		var posy = winId*10;
		var winout = '<div id="win' + winId + '" class="window" style="width:' + width + 'px; height:' + height + 'px; top:' + posy + 'px; left:' + posx + 'px;" onmousedown="winFocus(' + winId + ');"><div id="wintit' + winId + '" class="wintitle" style="width:' + widthInt + 'px;"><button class="closebutton" onclick="winClose(' + winId + ');">X</button><button class="minbutton" onclick="winMin(' + winId + ');">-</button><button class="screenshot1" onclick="screenShot(document.getElementById(\'winfr' + winId + '\'));"></button>' + titel + '</div><iframe id="winfr' + winId + '" name="winfr' + winId + '" src="' + source + '" width="100%" height="' + heightInt + '" frameborder="0" onmousedown="winFocus(' + winId + ');"></iframe></div><script>  $( function() {    $( "#win' + winId + '" ).draggable();  } );  $("#win' + winId + '").resizable();  $("#win' + winId + '").resize(function(){ var titwidth = $("#win' + winId + '").width()-5; var frheight = $("#win' + winId + '").height()-25; console.log(titwidth);  $("#wintit' + winId + '").css({"width":titwidth + "px"});  $("#winfr' + winId + '").css({"height":frheight + "px"});  });  var cont = $("#winfr' + winId + '").contents(); $("body",cont).click(function(){ winFocus(' + winId + ');});  </script>';
		$('#taskbar').append(buildTask(titel,winId));
		$('#task' + winId).css({"box-shadow":"0px 0px 5px 0px #fff"});
		return winout;
	}	

	function buildTask(titel,wId){
		var maxtitle = titel.length > 20 ? titel.substr(0,16) + '...' : titel;
		var newTask = '<span id="task' + wId + '" class="task" onmousedown="winFocus(' + wId + ');">' + maxtitle + '</span>';
		return newTask;
	}
	
		function openWindow(titel,source){
		$('body').append(buildWindow(titel,source));
	}



$('.wintitle').on('mousedown', function(e){
	console.log('OK');
});

function winFocus(wId){
	for(var i = 0; i < winId; i++){
		var w = i+1;
		$('#win' + w).css({"z-index":"100"});
		$('#task' + w).css({"box-shadow":"none"});
	}
	$('#win' + wId).css({"z-index":"101","visibility":"visible"});
	$('#task' + wId).css({"box-shadow":"0px 0px 5px 0px #fff"});
}

function winMin(wId){
	$('#win' + wId).css({"visibility":"hidden"});
}

function winClose(wId){
	$('#win' + wId).remove();
	$('#task' + wId).remove();
}

refreshDesktop = function(){
		$.ajax({
		url: 'inc/desktop.php?username=' + username + '&pl=../',
		method: 'GET'
	}).done(function(result){
		$('#deskt').html(result);
	});
}

function winOpen(e){
	var file = e.toElement.title;
/*	if(file.split('.')[1] == 'txt'){
		openWindow('TeEd - ' + e.toElement.title,'modules/public/teed/index.php?a=2&f=' + e.toElement.title);
	}else if(file.split('.')[1] == 'bif'){
		openWindow('BIF-Reader - ' + e.toElement.title,'modules/public/bifreader/index.php?a=2&f=' + e.toElement.title);
	}*/
	var fileEnd = file.split('.')[1];
	if(userIni[fileEnd]) {
		var path = $(".menuitem[title~='" + userIni[fileEnd] + "']").attr('id');
		openWindow(userIni[fileEnd] + ' - ' + file, path + '?a=2&f=' + file);
	}
}

function newContext(e){
	var contextmenu = '<div id="contextmenu" onclick="endContext();"><ul id="contextlist"><li class="contextitem" id="deletefile" onclick="deleteFile(\'' + e.toElement.title + '\');">L&ouml;schen</li><li class="contextitem" id="renamefile" onclick="renameFile(\'' + e.toElement.title + '\',\'' + e.toElement.id + '\');">Umbenennen</li><li class="contextitem" id="transferfile" onclick="transferFile(\'' + e.toElement.title + '\');">Senden an</li><li class="contextitem">Abbrechen</li></ul></div>';
	$('body').append(contextmenu);
	$('#contextmenu').css({"left":event.pageX + "px","top":event.pageY + "px"});
}

function endContext(){
	$('body #contextmenu').map(function(){
		$(this).remove();
		return false;
	});
}

function deleteFile(file){
	var fdelete = confirm('Datei löschen?\n\n(Die Datei kann nicht wiederhergestellt werden.)');
	if(fdelete == true) {
		$("#deskt").append('<iframe id="delete" src="inc/file/delete/fdelete.php?f=' + file + '" width="0" height="0" frameborder="0"></iframe>');
		setTimeout(function(){$("#delete").remove(); refreshDesktop();},500);
		alert('Datei wurde gelöscht!');
	}
}

function renameFile(file,idx){
	var renamer = '<input id="oldname" type="hidden" value="' + file + '" /><input id="newname" value="' + file + '" />';
	$('#' + idx + '.dSym .dText').html(renamer);
	$('#newname').focus().select();
	$('#newname').blur(function(){
		$("#deskt").append('<iframe id="rename" src="inc/file/rename/frename.php?f=' + $("#oldname").val() + '&n=' + $("#newname").val() + '" width="0" height="0" frameborder="0"></iframe>');
		setTimeout(function(){$("#rename").remove(); refreshDesktop();},500);
	});
	$('#newname').keydown(function(e){
		if(e.keyCode==13){
			$("#deskt").append('<iframe id="rename" src="inc/file/rename/frename.php?f=' + $("#oldname").val() + '&n=' + $("#newname").val() + '" width="0" height="0" frameborder="0"></iframe>');
			setTimeout(function(){$("#rename").remove(); refreshDesktop();},500);
		}
	});
}

function transferFile(file){
	var touser = prompt('An welchen Benutzer soll die Datei gesendet werden?');
	var istouser = confirm('Datei wirklich an den Benutzer ' + touser + ' senden?');
	if(istouser == true){
		$("#deskt").append('<iframe id="transfer" src="inc/file/transfer/ftransfer.php?f=' + file + '&touser=' + touser + '" width="0" height="0" frameborder="0"></iframe>');
		setTimeout(function(){$("#transfer").remove(); refreshDesktop(); alert('Datei gesendet');},500);
	}
}

function deskContext(){
	var contextmenu = '<div id="contextmenu" onclick="endContext();"><ul id="contextlist"><li class="contextitem" onclick="refreshDesktop();">Aktualisieren</li><li class="contextitem">Abbrechen</li></ul></div>';
	$('body').append(contextmenu);
	var e = window.event;
	$('#contextmenu').css({"left":e.pageX + "px","top":e.pageY + "px"});
}

function screenShot(area){
	html2canvas(area, {
	  onrendered: function(canvas) {
		//$('#desktop').append(canvas);
		var file = 'Screenshot.png';
		var img = canvas.toDataURL("image/png");
		//$("#deskt").append('<iframe id="transfer" src="inc/file/screenshot/screenshot.php?f=' + file + '&content=' + img + '" width="0" height="0" frameborder="0"></iframe>');
		//setTimeout(function(){$("#transfer").remove(); refreshDesktop(); alert('Screenshot gespeichert!');},500);
		//$('#desktop').append('<img src="' + img + '"/>');
		$.ajax({
			url: "inc/file/screenshot/screenshot.php?f=Screenshot.bif",
			method: 'POST',
			data:{bild:img},
			success: function(php_script_response){console.log(php_script_response); alert('Screenshot gespeichert'); refreshDesktop();}
		});
	  }
	});
}

function screenSaver(){
	setInterval(function(){
		var time = new Date();
		var ho = time.getHours() < 10 ? "0" + time.getHours() : time.getHours();
		var mi = time.getMinutes() < 10 ? "0" + time.getMinutes() : time.getMinutes();
		var se = time.getSeconds() < 10 ? "0" + time.getSeconds() : time.getSeconds();
		$('#scsclock').html(ho + ':' + mi + ':' + se);
	},1000);
	var scs = '<marquee id="clockMarq" behavior="alternate" direction="up" style="width:100%; height:100%;"><marquee id="scsclock" behavior="alternate" direction="right" style="width:100%; color:#f1f1f1; font-size:128px; text-shadow:1px 0 #CCCCCC, 0 1px #AAAAAA,2px 1px #CCCCCC, 1px 2px #AAAAAA,3px 2px #CCCCCC, 2px 3px #AAAAAA,4px 3px #CCCCCC, 3px 4px #AAAAAA,5px 4px #CCCCCC, 4px 5px #AAAAAA,6px 5px #CCCCCC, 5px 6px #AAAAAA,6px 6px #CCCCCC;"></marquee></marquee><script>lockBindings = $(document).bind(\'keydown\',function(e){if(e.which == 122)return false;});</script>';
	$('#lockScreen').append(scs);	
}

function unlockPCheck(){
	if($.sha1(username.toUpperCase() + ':' + $('#unlockInput').val().toUpperCase()) == tempCheck){
		$('#lockScreen').remove();
		lockBindings ='';
		clearTimeout(waitForReLock);
	}else{
		$('#lockScreen').remove();
		screenLock();
	}
}

function unlockScreen(){
	$('#clockMarq').remove();
	var unlockForm = '<h2>Entsperren</h2><h3>' + username + '</h3><input id="unlockInput" type="password" class="login" style="margin-top:200px;" /><br><button id="unlockBtn" class="login">Entsperren</button><script>$(\'#unlockInput\').focus();$(\'#unlockBtn\').click(unlockPCheck);</script>';
	$('#lockScreen').append(unlockForm);
	waitForReLock = setTimeout(function(){
		$('#lockScreen').remove();
		screenLock();
	},15000);
}

function screenLock(){
	var lockDiv = '<div id="lockScreen" style="width:100%; height:100%; text-align:center; background:#111; position:absolute; top:0px; z-Index:900;"><script>$(\'#lockScreen\').click(function(){unlockScreen();});</script></div>';
	$('body').append(lockDiv);
	screenSaver();
}