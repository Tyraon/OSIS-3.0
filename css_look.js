var tag = (function(){
	return {
		head : function(input,area){
			var output = '<h2 id="tag-head">' + input + '</h2>';
			return output;
		},
		ref : function(addr,input){
			var output = '<a href="' + addr + '">' + input + '</a>';
			return output;
		}
	};
})();

var look = (function(){
	return {
		tShadow : function(input,color,posX,posY,cou){
			color = setColor(color);
			$(input).css({"text-shadow" : setPos(posX) + " " + setPos(posY) + " " + setCou(cou) + " " + color});
		},
		bShadow : function(input,color,posX,posY,cou,dis,direct){
			color = setColor(color);
			$(input).css({"box-shadow" : setDirect(direct) + " " + setPos(posX) + " " + setPos(posY) +  " "  + setCou(cou) + " " + setDis(dis) + " " + color});
		},
		gradBg : function(input,color1,color2,direction,orientation){
			color1 = !color1 ? "#ffffff" : color1;
			color2 = setColor(color2);
			var cHex1 = color1;
			var cHex2 = color2;
			color1 = toDez(color1);
			color2 = toDez(color2);
			direction = setDirection(direction);
			orientation = setOrientation(orientation);
			var browser = browserDetect();
			var gradient = gradBrowser(browser,color1,color2,cHex1,cHex2,direction,orientation);
			$(input).css({"background" : gradient});
		},
		boRad : function(input,radius){
			radius = !radius ? "10" : radius;
			$(input).css({"border-radius" : radius + "px"});
		},
		rota2d : function(input,deg){
			deg = setDeg(deg);
			var browser = browserDetect();
			var rotate = rotaBrowser(browser);
			$(input).css({"transform" : "rotate(" + deg + "deg)"});
		},
		zoom : function(input,sizeX,sizeY){
			var size = setSize(input,sizeX,sizeY);
			sizeX = size[0];
			sizeY = size[1];
			$(input).css({"width" : sizeX, "height" : sizeY, "cursor" : "default"});
			$(input).on('mouseover', function(){
				var newX = (parseInt(sizeX)*2).toString();
				var newY = (parseInt(sizeY)*2).toString();
				$(input).css({"width" : newX, "height" : newY, "-webkit-transition" : "all 0.5s ease-in-out", "cursor" : "zoom-in"});
			});
			$(input).on('mouseout', function(){
				$(input).css({"width" : sizeX, "height" : sizeY, "cursor" : "default"});				
			});
		},
		persX : function(input,rota){
			persp = setDeg(rota);
			rota = persp;
			$(input).css({"transform" : "perspective(" + persp + "em) rotateX(" + rota + "deg)"});
		},
		persY : function(input,rota){
			persp = setDeg(rota);
			rota = persp;
			$(input).css({"transform" : "perspective(" + persp + "em) rotateY(" + rota + "deg)"});
		},
		skew : function(input,rotaX,rotaY){
			rotaX = setDeg(rotaX);
			rotaY = setDeg(rotaY);
			$(input).css({"transform" : "skew(" + rotaX + "deg," + rotaY + "deg)"});
		},
		trans : function(input,posX,posY){
			posX = setPos(posX);
			posY = setPos(posY);
			$(input).css({"transform" : "translate(" + posX + "," + posY + ")"});
		},
		deep : function(input,color){
			color = setColor(color);
			$(input).css({"box-shadow" : "1px 1px 0px rgb(" + deepColor(color,1) + "), 2px 2px 0px rgb(" + deepColor(color,1.5) + "), 3px 3px 0px rgb(" + deepColor(color,2) + "), 4px 4px 0px rgb(" + deepColor(color,2.5) + "), 5px 5px 0px rgb(" + deepColor(color,3) + "), 6px 6px 0px rgb(" + deepColor(color,3.5) + "), 7px 7px 0px rgb(" + deepColor(color,4) + "), 8px 8px 0px rgb(" + deepColor(color,4.5) + "), 9px 9px 0px rgb(" + deepColor(color,5) + ")"});
		},
		tDeep : function(input,color){
			color = setColor(color);
			$(input).css({"text-shadow" : "1px 1px 0px rgb(" + deepColor(color,1) + "), 2px 2px 0px rgb(" + deepColor(color,2) + "), 3px 3px 0px rgb(" + deepColor(color,3) + "), 4px 4px 0px rgb(" + deepColor(color,4) + "), 5px 5px 0px rgb(" + deepColor(color,5) + ")"});
		},
		puls : function(input,color,duration){
			color = setColor(color);
			duration = setDeg(duration);
			$.keyframe.define([{
				name : 'pulsi',
				'0%' : {'box-shadow' : '0px 0px 5px 1px ' + color},
				'50%' : {'box-shadow' : '0px 0px 20px 3px ' + color},
				'100%' : {'box-shadow' : '0px 0px 5px 1px ' + color}
			}]);
			$(input).playKeyframe({
								   name : 'pulsi',
								   duration : duration + 's',
								   timingFunction : 'linear',
								   iterationCount : 'infinite',
								   direction : 'normal',
								   fillMode : 'forwards',
								   complete : function(){}
								   });
		},
		rainBow : function(input,duration){
			duration = setDeg(duration);
			$.keyframe.define([{
				name : 'rainbow',
				'0%' : {'box-shadow' : '0px 0px 15px 3px #cc0000'},
				'33%' : {'box-shadow' : '0px 0px 15px 3px #00cc00'},
				'67%' : {'box-shadow' : '0px 0px 15px 3px #0000cc'},
				'100%' : {'box-shadow' : '0px 0px 15px 3px #cc0000'}
			}]);
			$(input).playKeyframe({
								   name : 'rainbow',
								   duration : duration + 's',
								   timingFunction : 'linear',
								   iterationCount : 'infinite',
								   direction : 'normal',
								   fillMode : 'forwards',
								   complete : function(){}
								   });
		},
		glas : function(input,color,direction,orientation){
			color = setColor(color);
			var cHex1 = color;
			var cHex2 = color;
			direction = setDirection(direction);
			orientation = setOrientation(orientation);
			var browser = browserDetect();
			var gradient = glasBrowser(browser,color,cHex1,cHex2,direction,orientation);
			$(input).css({"background" : gradient});
		},
		glow : function(input,color){
			color = setColor(color);
			$(input).css({"box-shadow" : "0px 0px 0px 0px " + color});
			$(input).on('mouseover', function(){
				$(input).css({"box-shadow" : "0px 0px 10px 1px" + color, "transition" : "all 0.15s ease-in-out"});
			});
			$(input).on('mouseout', function(){
				$(input).css({"box-shadow" : "0px 0px 0px 0px " + color});				
			});
		},
		tHover : function(input,color){
			color = setColor(color);
			var color2 = $(input).css("color");
			$(input).on('mouseover', function(){
				$(input).css({"color" : color});
			});
			$(input).on('mouseout', function(){
				$(input).css({"color" : color2});
			});
		},
		openMenu : function(input,sizeX,sizeY,drag,arrow){
			arrow ? $(arrow).css({"opacity" : "1"}) : "";
			$(input).css({"width" : "20px", "height" : "20px", "overflow" : "hidden"});
			$(input).on('mouseover', function(){
				arrow ? $(arrow).css({"opacity" : "0", "transition" : "all 0.5s ease-in-out"}) : "";
				$(input).css({"width" : sizeX + "px", "height" : sizeY + "px", "transform" : "translateX(" + setDrag(drag,sizeX) + ")", "transition" : "all 0.5s ease-in-out"});
			});
			$(input).on('mouseout', function(){
				arrow ? $(arrow).css({"opacity" : "1"}) : "";
				$(input).css({"width" : "20px", "height" : "20px", "margin-left" : "0px"});
			});
		}
	};
})();


//Funktionen
function deepColor(color,step){
	color = color.substr(1,6);
	var red = parseInt(color.substr(0,2),16);
	var green = parseInt(color.substr(2,2),16);
	var blue = parseInt(color.substr(4,2),16);
	red = red >= "20" ? (red-(20*step)).toString() : "00";
	green = green >= "20" ? (green-(20*step)).toString() : "00";
	blue = blue >= "20" ? (blue-(20*step)).toString() : "00";
	color = red + "," + green + "," + blue;
	return color;
}

function setSize(ele,width,height){
	var size = !width || !height ? [$(ele).width(),$(ele).height()] : [width,height];
	return size;
}

function setDeg(deg){
	deg = !deg ? "0" : deg;
	return deg;
}

function setDrag(drag,pos){
	pos = drag == 1 ? "-" + pos : "0";
	return pos;
}

function rotaBrowser(browser){
	var rota = browser == "moz" ? "-moz-transform" :
			browser == "ms" ? "-ms-transform" :
			browser == "webkit" ? "-webkit-transform":
			browser == "o" ? "-o-transform" : "transform";
	return rota;
}

function setPos(pos){
	var pos = !pos ? "5px" : pos + "px";
	return pos;
}

function setDis(pos){
	var pos = !pos ? "0px" : pos + "px";
	return pos;
}

function setCou(pos){
	var pos = !pos ? "10px" : pos + "px";
	return pos;
}

function setDirect(direct){
	var direct = direct == 1 ? "inset" : "";
	return direct;
}

function setColor(color){
	color = !color ? "#000000" : color;
	return color;
}

function setDirection(direction){
	direction = !direction ? "top" : direction;
	return direction;
}

function setOrientation(orientation){
	orientation = !orientation ? "linear" : orientation;
	return orientation;
}

function toDez(color){
	color = color.substr(1,6);
	var red = parseInt(color.substr(0,2),16).toString();
	var green = parseInt(color.substr(2,2),16).toString();
	var blue = parseInt(color.substr(4,2),16).toString();
	color = red + "," + green + "," + blue;
	return color;
}

function browserDetect() {
	var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    // Firefox 1.0+
var isFirefox = typeof InstallTrigger !== 'undefined';
    // At least Safari 3+: "[object HTMLElementConstructor]"
var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    // Internet Explorer 6-11
var isIE = /*@cc_on!@*/false || !!document.documentMode;
    // Edge 20+
var isEdge = !isIE && !!window.StyleMedia;
    // Chrome 1+
var isChrome = !!window.chrome && !!window.chrome.webstore;
		var browser = isOpera ? "-o-" :
					isFirefox ? "-moz-":
					isSafari || isChrome ? "-webkit-":
					isIE || isEdge ? "-ms-": "";
	return browser;
}

function gradBrowser(browser,color1,color2,cHex1,cHex2,direction,orientation){
	var gradient1 = "-webkit-" + orientation + "-gradient(" + direction + ", rgba(" + color1 + ",1) 0%, rgba(" + color2 + ",1) 100%)";
	var gradient2 = "-moz-" + orientation + "-gradient(" + direction + ", rgba(" + color1 + ",1) 0%, rgba(" + color2 + ",1) 100%)";
	var gradient3 = "" + orientation + "-gradient(" + direction + ", rgba(" + color1 + ",1) 0%, rgba(" + color2 + ",1) 100%)";
	var gradient4 = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" + cHex1 + "', endColorstr='#" + cHex2 + "',GradientType=0 )";
	var gradient = browser == "-moz-" ? gradient2 : 
				browser == "-webkit-" ? gradient1 :
				browser == "-ms-" ? gradient4 : gradient3;
	return gradient;
}

function glasColor(color,faktor){
	var rgb = [parseInt(color.substr(1,2),16),parseInt(color.substr(3,2),16),parseInt(color.substr(5,2),16)];
	rgb[0] = (rgb[0]+faktor)>=255 ? 255 : rgb[0]+faktor;
	rgb[1] = (rgb[1]+faktor)>=255 ? 255 : rgb[1]+faktor;
	rgb[2] = (rgb[2]+faktor)>=255 ? 255 : rgb[2]+faktor;
	var color = rgb[0].toString() + "," + rgb[1].toString() + "," + rgb[2].toString();
	return color;
}

function glasBrowser(browser,color,cHex1,cHex2,direction,orientation){
	var gradient1 = "-webkit-" + orientation + "-gradient(" + direction + ", rgba(" + glasColor(color,160) + ",1) 0%, rgba(" + glasColor(color,100) + ",1) 50%, rgba(" + glasColor(color,0) + ",1) 51%, rgba(" + glasColor(color,-1) + ",1) 100%)";
	var gradient2 = "-moz-" + orientation + "-gradient(" + direction + ", rgba(" + glasColor(color,160) + ",1) 0%, rgba(" + glasColor(color,100) + ",1) 50%, rgba(" + glasColor(color,0) + ",1) 51%, rgba(" + glasColor(color,-1) + ",2) 100%)";
	var gradient3 = "" + orientation + "-gradient(" + direction + ", rgba(" + glasColor(color,160) + ",1) 0%, rgba(" + glasColor(color,100) + ",1) 50%, rgba(" + glasColor(color,0) + ",1) 51%, rgba(" + glasColor(color,-1) + ",1) 100%)";
	var gradient4 = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" + cHex1 + "', endColorstr='#" + cHex2 + "',GradientType=0 )";
	var gradient = browser == "-moz-" ? gradient2 : 
				browser == "-webkit-" ? gradient1 :
				browser == "-ms-" ? gradient4 : gradient3;
	return gradient;
}