<?php

/*

	File editor functions

*/

	function script(){
		$script = pathinfo($_SERVER["SCRIPT_NAME"]);
		return $script['filename'].".".$script['extension'];
	}

	function save($filename){
		$fp = fopen($filename,"w");
		fwrite($fp, stripslashes($_POST['data']));
		fclose($fp);
	}

	function download($filename){
		$file=basename($filename);

		header('Content-type: application/force-download');
		header('Content-Transfer-Encoding: Binary');

		header('Content-length: '.filesize($file));
		header('Content-disposition: attachment;filename='.$file);

		if(file_exists($file)){
			readfile($file);
		}
	}

	function load($filename){
		$file=basename($filename);

		if(file_exists($file)){
			if(filesize($file)!=0){

				$fp = fopen($file,"r");
				$ctn = fread($fp, filesize($file));
				fclose($fp);

			}else{
				$ctn="";
			}

			echo $ctn;
		}
	}


/*

	UI functions

*/

	function logo(){
		$ddata="iVBORw0KGgoAAAANSUhEUgAAADMAAAAFCAMAAADfXCSoAAAABGdBTUEAANbY1E9YMgAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAAGUExURQAAAP///6XZn90AAAA/SURBVHjaYmBgBAIgwcAAJ8AiIBYjhIAjqBIGmB5GTAaSahiC6sWhB24jIwOMTZk9MAMReuA+w+ofRkaAAAMAVIoApttoI1kAAAAASUVORK5CYII=";

		header("Content-type: image/png");
		echo base64_decode($ddata);
	}

	function css(){
		header("Content-type: text/css; charset=UTF-8");
?>
/*

	Style for littlechief

*/
html{
	height: 100%;
}

body{
	margin:0;
	padding:0;
	height: 98%;
}

#container{
	padding-top:10px;
	padding-left:10px;
	padding-right:10px;
	height: 95%;
}

#content{
	height:90%;
}

#header {

}

#header h2{
	display:none;
}

#header h1{
	padding-top:0;
	margin:5px;
	height:5px;
	width:51px;
	background:#fff url('./<?php echo script(); ?>?data=logo') no-repeat top left;
}

#header h1 a{
	height:8px;
	width:51px;
	display:block;
	text-indent:-9999px;
	background:#fff url('./<?php echo script(); ?>?data=logo') no-repeat top left;
}

#header h2 span{
	display:none;
}

#control{
	margin-bottom:5px;
}

#control ul,li{
	list-style:none;
	display:inline;
	padding:0px;
	margin:0px;
}

#control a{
	padding-top:2px;
	padding-bottom:2px;
	padding-left:5px;
	padding-right:5px;
	color:#777;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	text-decoration:none;
}

#control a:link,#control a:active,#control a:visited{
	border:#ddd 1px solid;
	border-bottom:#ddd 2px solid;
	border-radius:3px;
}

#control a:hover{
	border:#aaa 1px solid;
	border-bottom:#aaa 2px solid;
}

#control a:active{
	position:relative;
	top:1px;
	border:#aaa 1px solid;
	border-bottom:#aaa 1px solid;
}

#error{
	display:inline;
	padding-left:40px;
	color:#f00;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
}

#maincontent{
	float:left;
	width:70%;
	height: 97%;
}

textarea{
	width:100%;
	height:100%;
	overflow:auto;
	border:#ddd 1px solid;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	line-height:14px;
	padding:10px;
}

input{
	border-top:#aaa 1px solid;
	border-left:#aaa 1px solid;
	border-bottom:#ddd 1px solid;
	border-right:#ddd 1px solid;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
}

#sidecontent{
	float:right;
	width:27%;
	height: 100%;
}

#sidectrl ul,li{
	list-style:none;
	display:inline;
	padding:0px;
	margin:0px;
}

#sidectrl{
	clear:both;
	text-align:center;
	margin-bottom:5px;
}

#sidectrl a{
	padding-top:2px;
	padding-bottom:2px;
	padding-left:5px;
	padding-right:5px;
	color:#777;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	text-decoration:none;
}

#sidectrl a:link,#sidectrl a:active,#sidectrl a:visited{
	border-top:#ddd 1px solid;
	border-left:#ddd 1px solid;
	border-bottom:#aaa 1px solid;
	border-right:#aaa 1px solid;
}

#sidectrl a:hover{
}

.frame{
	width:100%;
	height: 100%;
	border:#ddd 1px solid;
}

#footer{
	clear:both;
}

#bottomctrl{
	width:100%;
}

#bottomctrl ul,li{
	list-style:none;
	padding:0px;
	margin:0px;
}

#bottomctrl{
	clear:both;
	text-align:right;
	margin-top:10px;
	margin-bottom:5px;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
}

#bottomctrl a{
	padding-top:2px;
	padding-bottom:2px;
	padding-left:5px;
	padding-right:5px;
	color:#777;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	text-decoration:none;
}

#bottomctrl label{
	color:#777;
	padding-right:5px;
}

#bottomctrl a:link,#bottomctrl a:active,#bottomctrl a:visited{
	border:#ddd 1px solid;
	border-bottom:#ddd 2px solid;
	border-radius:3px;
}

#bottomctrl a:hover{
	border:#aaa 1px solid;
	border-bottom:#aaa 2px solid;
}

#bottomctrl a:active{
	position:relative;
	top:1px;
	border:#aaa 1px solid;
	border-bottom:#aaa 1px solid;
}

#footer{
	display:none;
}

.fable{
	width:100%;
	padding:0;
	margin:0;
}

th{
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	padding: 6px 6px 6px 12px;
	border-right: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	border-top: 1px solid #ddd;
	letter-spacing: 2px;
	text-transform: uppercase;
	text-align: left;
	background:#fafafa;
}

td{
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	border-right: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background: #fff;
	padding: 6px 6px 6px 12px;
	color: #444;
}

.idno{
	border-left: 1px solid #ddd;
}

.idcol{
	border-left: 1px solid #ddd;
}


caption {
	padding: 0 0 5px 0;
	width: 100%;
	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	text-align: right;
}

.fable a:link,a:visited{
	text-decoration:none;
	color:#aaa;
}

.fable a:hover{
	text-decoration:none;
	color:#f00;
}
.nonwrite{
	color:#f00;
}
<?php
	}

	function xhtml_header($title="",$header=""){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="<?php echo script(); ?>?data=css" type="text/css" />
	<title>LittleChief - <?php echo $title; ?></title>
<?php
	echo $header;
?>
</head>

<body>
	<div id="container">
		<div id="header">
			<h1><span><a href="<?php echo script(); ?>">Littlechief</a></span></h1>
			<h2><span>Littlecheif designed to fix the big mischief</span></h2>
		</div>
		<div id="content">

<?php
	}

	function xhtml_footer(){
?>


		</div>
	</div>
</body>
</html>
<?php
	}

/*

	Pages

*/
	function file_browser(){
?>
	<table cellspacing="0" class="fable">
	<caption>File browser</caption>

	<tr>
		<th class="idcol">No</th>
		<th>Filename</th>
		<th>Date</th>
		<th>Size</th>
	</tr>

<?php

$toc=0;
$filelist = array();
$filedate = array();

if ($handle = opendir('./')) {

	while (false !== ($file = readdir($handle))) {
	
		$ext=substr($file, -4);
		if($file=="." || $file==".."){

		}else{
			$filelist[$toc]=$file;
			$filedate[$toc]=date("d/m/Y",filemtime("./".$filelist[$toc]));
			$toc++;
		}
	}
	closedir($handle);
}

array_multisort($filedate,SORT_DESC, $filelist,SORT_ASC);

reset($filelist);

$numbering=0;

for($x=0;$x<$toc;$x++){
	if(!is_dir($filelist[$x])){

		$numbering=($numbering+1);
?>
	<tr class="tdnorm">
		<td class="idno">#<?php echo $numbering; ?></td>
		<?php
			if(is_writable($filelist[$x])){
		?>
		<td width="60%"><a href="./<?php echo script(); ?>?file=<?php echo $filelist[$x]; ?>"><?php echo $filelist[$x] ?></a></td>
		<?php
			}else{
		?>
		<td width="60%" class="nonwrite"><?php echo $filelist[$x] ?></td>
		<?php
			}
		?>
		<td><?php echo date("d/m/Y",filemtime("./".$filelist[$x])); ?></td>
		<td><?php echo round(filesize("./".$filelist[$x])/1024,2); ?>KB</td>
	</tr>
<?php
	}
}
?>
	</table>
<?php
	}



	function file_editor($filename){
?>
		<div id="control">
			<ul>
				<li><a href="" accesskey="s" onclick="save();return false;">Save</a></li>
				<li><a href="" accesskey="r" onclick="init();RefreshFrame();return false;">Revert</a></li>
				<li><a href="<?php echo $script;?>?do=down&file=<?php echo $_GET['file']; ?>" accesskey="d">Download</a></li>
				<!--<li><a href="" accesskey="w" onclick="nowrap();return false;">Wrap</a></li>-->
				<!--<li><a href="" accesskey="t" onclick="tab();return false;">Tab</a></li>-->
			</ul>
			<div id="error"></div>
		</div>

		<div id="maincontent">
			<textarea name="textcontainer" id="textcontainer" onkeypress="textevent();" onkeydown="insertTab(this, event);"></textarea>
			<div id="bottomctrl">
				<ul>
					<?php if(substr($filename,-3)=="css"){
							?><li><label for="previewpage">Preview</label><input type="text=" name="previewpage" id="previewpage" onchange="RefreshFrame();" /></li><?php
						}
						?>
					<li><a href="" id="prex" accesskey="b" onclick="preex();return false;">Expand</a></li>
				</ul>
			</div>
		</div>

		<div id="sidecontent">
			<iframe src="<?php echo $filename; ?>" name="preframe" id="preframe" frameborder="0" class="frame"></iframe>
		</div>

<?php
	}


/*

	Javascript

*/

	function editor_js($filename){
		ob_start();
?>
<script type="text/javascript">
	var xmlhttp;
	var loaded="false";

	var data="";
	var type="<?php echo substr($filename,-3); ?>";

	// by Scott Andrew
	// add an eventlistener to browsers that can do it somehow.
	function addEvent(obj, evType, fn){
		if (obj.addEventListener){
			obj.addEventListener(evType, fn, true);
			return true;
		}else if (obj.attachEvent){
			var r = obj.attachEvent('on'+evType, fn);
			return r;
		}else{
			return false;
		}
	}

	//General functions
	function saveXMLDoc(url){

		// code for Mozilla, etc.
		if (window.XMLHttpRequest){

		  xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=save_state;

		  xmlhttp.open("POST",url,true);
		  datatobesend="data="+encodeURIComponent(document.getElementById('textcontainer').value);

		  //alert(datatobesend);

		  xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
		  xmlhttp.setRequestHeader('Content-Length',datatobesend.length)
		  xmlhttp.send(datatobesend);

		}else if (window.ActiveXObject){

		// code for IE

			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			if (xmlhttp){

				xmlhttp.onreadystatechange=save_state;
				xmlhttp.open("GET",url,true);

				datatobesend="data="+escape(document.getElementById('textcontainer').value);

				xmlhttp.setRequestHeader('Content-Type',"application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader('Content-Length',datatobesend.length)
				xmlhttp.send(datatobesend);

			}
		}
	}

	function save_state(){

		if (xmlhttp.readyState=='1'){

			document.getElementById('error').innerHTML="Saving...";

		}else if (xmlhttp.readyState==4){

			if (xmlhttp.status==200){

				document.getElementById('error').innerHTML="Saved";
				docdata=escape(document.getElementById('textcontainer').value);
				RefreshFrame();

			}else{
				document.getElementById('error').innerHTML="We have a http problem " + status + ":" + xmlhttp.statusText;
			}

		}

	}

	function loadXMLDoc(url){

		// code for Mozilla, etc.
		if (window.XMLHttpRequest){

		  xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=state_change;

		  xmlhttp.open("GET",url,true);
		  xmlhttp.send(null);

		}else if (window.ActiveXObject){

			// code for IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

			if (xmlhttp){

				xmlhttp.onreadystatechange=state_change;
				xmlhttp.open("GET",url,true);
				xmlhttp.send();

			}
		}
	}

	function state_change(){

		if (xmlhttp.readyState=='1'){

			document.getElementById('error').innerHTML="Loading...";

		}else if (xmlhttp.readyState==4){
			if (xmlhttp.status==200){

				if(xmlhttp.responseText!=""){

					document.getElementById('error').innerHTML="&nbsp;";
					document.getElementById('textcontainer').value=xmlhttp.responseText;
					docdata=escape(document.getElementById('textcontainer').value);

				}else{

					document.getElementById('error').innerHTML="Whops! there is no data in the file or it just does not exist.";

				}
			}else{

				document.getElementById('error').innerHTML="We have a http problem " + status + ":" + xmlhttp.statusText;

			}
		}
	}
	//End General Functions

	function init(){
		loadXMLDoc("<?php echo $script;?>?do=load&file=<?php echo $filename; ?>");
	}
	addEvent(window, 'load', init);

	function save(){
		saveXMLDoc("<?php echo $script;?>?do=save&file=<?php echo $filename; ?>");
	}

	function preex(){
		if(document.getElementById('sidecontent').style.display=="none"){

			document.getElementById('sidecontent').style.display="";
			document.getElementById('maincontent').style.width="70%";
			document.getElementById('prex').innerHTML="Expand";

		}else{

			document.getElementById('sidecontent').style.display="none";
			document.getElementById('maincontent').style.width="98%";
			document.getElementById('prex').innerHTML="Preview";

		}
	}

	function nowrap(){
		alert(document.getElementById('textcontainer').style.whiteSpace);
		document.getElementById('textcontainer').style.whiteSpace="normal"
	}

	function RefreshFrame(){
		document.getElementById('preframe').src=document.getElementById('preframe').src;
		/*
		if(document.getElementById('sidecontent').style.display!="none"){
			if(type=="css"){

				tempsrc=document.getElementById('previewpage').value;

			}else{

				tempsrc=document.getElementById('preframe').src;
			}

			document.getElementById('preframe').src="";
			document.getElementById('preframe').src=tempsrc;
		}
		*/
	}

	function textevent(){
		document.getElementById('error').innerHTML="";
	}

	function leave(){
		//test=confirm("are you sure you want to leave?");
		//data=escape(document.getElementById('textcontainer').value);

		if(docdata!=escape(document.getElementById('textcontainer').value)){
			return "You have unsaved changes.";

		}else{

		}
	}
	addEvent(window, 'beforeunload', leave);

	function htmlEntities(str) {
    		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}

	function insertTab(o, e){
		// http://pallieter.org/Projects/insertTab/

		var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;

		if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey){

			var oS = o.scrollTop;

			var sS = o.selectionStart;
			var sE = o.selectionEnd;

			if (o.value.slice(sS,sE).indexOf("\n")>=0){

				var pre = o.value.slice(0,sS);
				var sel = o.value.slice(sS,sE);
				var post = o.value.slice(sE,o.value.length);

				var a = sel.split("\n")

				for (i=0;i<a.length;i++){
					if(a[i].length>0){
						a[i]="\t"+a[i];
					}
				}

				o.value=pre+a.join("\n")+post;
				o.setSelectionRange(sS + 1, sS + 1);
				o.focus();

			}else if (o.setSelectionRange){


				var sS = o.selectionStart;
				var sE = o.selectionEnd;
				o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
				o.setSelectionRange(sS + 1, sS + 1);
				o.focus();

			}else if (o.createTextRange){

				document.selection.createRange().text = "\t";
				e.returnValue = false;

			}

			o.scrollTop = oS;

			if (e.preventDefault){
				e.preventDefault();
			}

			return false;
		}
		return true;
	}
</script>
<?php
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}



/*

	Main

*/
	if($_GET['data']!=""){
		
		if($_GET['data']=="css"){
			css();
		}

		if($_GET['data']=="logo"){
			logo();
		}

	}elseif($_GET['do']!=""){

		if($_GET['do']=="load"){

			echo load($_GET['file']);

		}else	if($_GET['do']=="save"){

			save($_GET['file']);

		}else	if($_GET['do']=="down"){

			download($_GET['file']);

		}

	}elseif($_GET['file']!=""){

		xhtml_header($_GET['file'],editor_js($_GET['file']));
		file_editor($_GET['file']);
		xhtml_footer();

	}else{

		xhtml_header("File Browser");
		file_browser();
		xhtml_footer();

	}
?>