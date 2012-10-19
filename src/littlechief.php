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
	function css(){
		header("Content-type: text/css; charset=UTF-8");
?>
/*

	Style for littlechief

*/
html{
}

body{
	margin:0;
	padding:0;
	font-family: "Segoe UI", "Segoe WP", Helvetica, "Lucida Grande", sans-serif;
}

#container{
	margin-left:24px;
	margin-top:12px;
	margin-right:24px;
	margin-bottom:12px;
}

#header{
	margin-bottom:12px;
	padding:0;
}

h1{
	font-size:36px;
	line-height:30px;
	font-weight:normal;
	margin:0;
	padding:0;
}

h1 a{
	color:#666;
	text-decoration:none;
}

h2{
	display:none;
}

h3{
	font-family:24px;
	font-weight:normal;
	margin:0;
	padding:0;
	margin-bottom:12px;
}

#filebrowser{
	margin:0;
	padding:0;
	list-style:none;
}

#filebrowser li a{
	display:block;
	padding:12px;
	margin-bottom:6px;
	overflow: auto;
	background:#eee;
	color:#666;
	text-decoration:none;

	-webkit-transition: background 0.2s linear;
	-moz-transition: background 0.2s linear;
	-o-transition: background 0.2s linear;
	transition: background 0.2s linear;
}

#filebrowser li a:hover{
	background:#4ea6ea;
	color:#fff;
}

.file-title{
	display:block;
	font-weight:bold;
}

.file-modified{
	float:left;
}

.file-size{
	float:right;
}

.control{
	overflow:auto;
	margin-bottom:12px;
}

.control ul{
	margin:0;
	padding:0;
	list-style:none;
	float:left;
}

.control ul li{
	display:inline;
}

.control ul li a{
	color:#control;
	text-decoration:none;
	font-weight:bold;
	color:#cacaca;
	padding-right:10px;
}

.control ul li a:hover{
	color:#999;
}

#message{
	float:left;
	color:#76c721;
	font-weight:bold;
}

.error{
	color:#f00;
}

#content{
	overflow:auto;
}

#maincontent{
	width:67%;
	float:left;
}

#maincontent .control ul{
	float:right;
}

#sidecontent{
	width:30%;
	float:right;
	border:1px solid #ddd;
}

textarea{
	min-width:100%;
	max-width:100%;
	height:680px;
	border:1px solid #ddd;

	font-family:Verdana, Helvetica, Arial, sans-serif;
	font-size:11px;
	line-height:14px;
	padding:10px;
}

iframe{
	background:#fff;
	width:100%;
	height:700px;
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
	function format_bytes($size) {
		// Credits to joaoptm78
		$units = array(' B', ' KB', ' MB', ' GB', ' TB');
		for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
		return round($size, 2).$units[$i];
	}

	function file_browser(){
?>
			<h3>File Browser</h3>
			<ul id="filebrowser">

<?php

$toc=0;
$filelist = array();

if ($handle = opendir('./')) {

	while (false !== ($file = readdir($handle))) {

		$ext=substr($file, -4);
		if($file=="." || $file==".."){

		}else{
			$filelist[$toc]=$file;
			$toc++;
		}
	}
	closedir($handle);
}

//array_multisort($filedate,SORT_DESC, $filelist,SORT_ASC);
//reset($filelist);

for($x=0;$x<$toc;$x++){
	if(!is_dir($filelist[$x])){

?>
				<li>
<?php
				if(is_writable($filelist[$x])){
?>
					<a href="./<?php echo script(); ?>?file=<?php echo $filelist[$x]; ?>">
						<span class="file-title"><?php echo $filelist[$x] ?></span>
						<span class="file-modified"><?php echo date("d/m/Y",filemtime("./".$filelist[$x])); ?></span>
						<span class="file-size"><?php echo format_bytes(filesize("./".$filelist[$x])); ?></span>
					</a>
<?php
				}else{
?>
					<div class="nonwrite">
						<span class="file-title"><?php echo $filelist[$x] ?></span>
						<span class="file-modified"><?php echo date("d/m/Y",filemtime("./".$filelist[$x])); ?></span>
						<span class="file-size"><?php echo format_bytes(filesize("./".$filelist[$x])); ?></span>
					</div>
<?php
				}
?>
				</li>

<?php
	}
}
?>
			</ul>
<?php
	}



	function file_editor($filename){
?>
			<div class="control">
				<ul>
					<li><a href="" accesskey="s" onclick="save();return false;">Save</a></li>
					<li><a href="" accesskey="r" onclick="init();refreshframe();return false;">Revert</a></li>
					<li><a href="<?php echo $script;?>?do=down&file=<?php echo $_GET['file']; ?>" accesskey="d">Download</a></li>
				</ul>
				<div id="message"></div>
			</div>

			<div id="maincontent">
				<textarea name="textcontainer" id="textcontainer" onkeydown="handlekey(this, event);"></textarea>
				<div id="bottomctrl" class="control">
					<ul>
<?php
						if(substr($filename,-3)=="css"){
?>
						<li><label for="previewpage">Preview</label><input type="text=" name="previewpage" id="previewpage" onchange="refreshframe();" /></li>
<?php
						}
?>
						<li><a href="" id="expand" accesskey="b" onclick="expandeditor();return false;">Expand</a></li>
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

				document.getElementById('message').innerHTML="Saving...";

			}else if (xmlhttp.readyState==4){

				if (xmlhttp.status==200){

					document.getElementById('message').innerHTML="Saved";
					docdata=escape(document.getElementById('textcontainer').value);
					refreshframe();

				}else{
					document.getElementById('message').innerHTML="<span class='error'>We have a http problem " + status + ":" + xmlhttp.statusText+"</span>";
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

				document.getElementById('message').innerHTML="Loading...";

			}else if (xmlhttp.readyState==4){
				if (xmlhttp.status==200){

					if(xmlhttp.responseText!=""){

						document.getElementById('message').innerHTML="&nbsp;";
						document.getElementById('textcontainer').value=xmlhttp.responseText;
						docdata=escape(document.getElementById('textcontainer').value);

					}else{

						document.getElementById('message').innerHTML="<span class='error'>Whops! there is no data in the file or it just does not exist.</span>";

					}
				}else{

					document.getElementById('message').innerHTML="<span class='error'>We have a http problem " + status + ":" + xmlhttp.statusText+"</span>";

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

		function expandeditor(){
			if(document.getElementById('sidecontent').style.display=="none"){

				document.getElementById('sidecontent').style.display="";
				document.getElementById('maincontent').style.width="67%";
				document.getElementById('expand').innerHTML="Expand";

			}else{

				document.getElementById('sidecontent').style.display="none";
				document.getElementById('maincontent').style.width="97%";
				document.getElementById('expand').innerHTML="Preview";

			}
		}

		function refreshframe(){
			document.getElementById('preframe').src=document.getElementById('preframe').src;
		}

		function leave(){
			if(docdata!=escape(document.getElementById('textcontainer').value)){
				return "You have unsaved changes.";

			}else{

			}
		}
		addEvent(window, 'beforeunload', leave);

		function htmlEntities(str) {
			return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		}

		function handlekey(o, e){

			//Highly based on http://pallieter.org/Projects/insertTab/
			document.getElementById('message').innerHTML="";

			var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;

			if (kC == 9 && e.shiftKey && !e.ctrlKey && !e.altKey){
				// Handle multiple line shift tab

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
							if(a[i].charCodeAt(0)==9){
								a[i]=a[i].substring(1);
							}else{
								a[i]=a[i];
							}
						}
					}

					o.value=pre+a.join("\n")+post;
					o.setSelectionRange(sS, sS+a.join("\n").length);
					o.focus();

				}

				if (e.preventDefault){
					e.preventDefault();
				}

				return false;

			}else if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey){

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
					o.setSelectionRange(sS, sS+a.join("\n").length);
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

	}elseif($_GET['do']!=""){

		if($_GET['do']=="load"){
			echo load($_GET['file']);
		}elseif($_GET['do']=="save"){
			save($_GET['file']);
		}elseif($_GET['do']=="down"){
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