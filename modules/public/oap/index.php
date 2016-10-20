<?php
@include('../../../config.php');
@session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/ui-darkness/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
		@font-face {
		font-family: soundcontr;
		local: Guifx v2 Transports;
		src: url(transports.ttf);
		}
		body{background:url(../../../<?php echo $background;?>);}
		#preview{visibility:hidden;}
		td{padding-left:5px;}
		button{font-family:soundcontr; width:30px; height:30px; border-radius:15px;}
		button:focus{outline:none;}
		#control{opacity:1; bottom:10px; background:rgba(40,40,40,0.7); border-radius:5px; height:30px; padding:5px;  transition: all 0.5s ease-in-out; z-Index:105; position:absolute; width:90%; left:5%;}
		/*#control:hover{opacity:1;}*/
		#progbar{width:200px; border:1px solid #111; border-radius:3px;}
		#current{width:0px; height:20px; border-radius:3px; /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,2989d8+50,207cca+51,7db9e8+100;Blue+Gloss+Default */
background: rgb(30,87,153); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
opacity:0.5}
		#buffer{width:0px; height:20px; border-radius:3px; /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#b8e1fc+0,a9d2f3+10,90bae4+25,90bcea+37,90bff0+50,6ba8e5+51,a2daf5+83,bdf3fd+100;Blue+Gloss+%231 */
background: rgb(184,225,252); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(184,225,252,1) 0%, rgba(169,210,243,1) 10%, rgba(144,186,228,1) 25%, rgba(144,188,234,1) 37%, rgba(144,191,240,1) 50%, rgba(107,168,229,1) 51%, rgba(162,218,245,1) 83%, rgba(189,243,253,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e1fc', endColorstr='#bdf3fd',GradientType=0 ); /* IE6-9 */
		}
		#volume{width:100px; height:10px; border:1px solid #111; border-radius:3px;}
		#pointer{width:16px; height:16px; border-radius:8px; background:#ccc; border:1px solid #333; margin-top:-3px; opacity:1;}
		#pointer:focus{outline:none;}
		#isvol{width:0px; height:10px; /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,2989d8+50,207cca+51,7db9e8+100;Blue+Gloss+Default */
background: rgb(30,87,153); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
opacity:0.5}
		#vol{font-family:soundcontr;}
		input{background:none; border:none; color:#e1e1e1;}
	</style>
    <link type="text/css" rel="stylesheet" href="../../../main.css" />
	<script src="../../../css_look.js" type="text/javascript"></script>
    <script src="core.js" type="text/javascript"></script>
    <title>OAP @ <?php echo $site_title;?></title>

</head>
<body style="background:#000;">
<center>
<video id="bground" width="100%" height="100%" loop>
<source src="stock-video-premium-video-background-hd0223-8326.mp4" type="video/mp4" />
</video>
<audio id="vplayer" poster="video-icon-19.png" width="100%" height="100%" style="z-Index:101;">
<source id="source" src="../../../data/desktop/<?php echo $_SESSION['username'];?>/<?php echo @$_GET['f'];?>" type="audio/mp3" />
</audio>
<div id="control">
<table border="0"><tr><td>
<button id="pbtn" class="btn">1</button></td>
<td>
<div id="progbar">
	<div id="buffer">
		<div id="current"></div>
    </div>
</div>
</td><td width="20">
<span id="vol"></span>
</td><td>
<div id="volume"><div id="isvol"><button id="pointer"></button></div></div>
</td><td width="100">
<span id="time"><input id="currt" size="2" maxlength="5" value="0.00" readonly /> / <input id="dura" size="2" maxlength="5" value="0.00" readonly /></span>
</td><td>
<button id="loop" title="Wiederholen">(</button>
<button id="open" title="Audio &ouml;ffnen (URL)">'</button>
</td></tr></table>
</div>
</center>
</body>
</html>