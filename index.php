<?PHP
#################################################################################
## Copyright (C) 2009 by Manifest Interactive                                  ##
## http://www.ManifestInteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## LICENSE                                                                     ##
## Redistribution and use in source and binary/encoded forms, with or          ##
## without modification, is not permitted.                                     ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Russell Schmalfeldt                                   ##
#################################################################################

include_once('classes/class_Whois.php');
$url = (strlen($_POST['domain'])>0) ? $_POST['domain']:$_GET['domain'];
if(strlen($url)>0) $whois = new Whois($url);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Manifest Interactive :: Whois Lookup</title>

	<!-- //////////////////////////////////////////////////////////////////////////////////////////////
         __  __             _  __          _      ___       _                      _   _
        |  \/  | __ _ _ __ (_)/ _| ___ ___| |_   |_ _|_ __ | |_ ___ _ __ __ _  ___| |_(_)_   _____
        | |\/| |/ _` | '_ \| | |_ / _ Y __| __|   | || '_ \| __/ _ \ '__/ _` |/ __| __| \ \ / / _ \
        | |  | | (_| | | | | |  _|  __|__ \ |_    | || | | | ||  __/ | | (_| | (__| |_| |\ V /  __/
        |_|  |_|\__,_|_| |_|_|_|  \___|___/\__|  |___|_| |_|\__\___|_|  \__,_|\___|\__|_| \_/ \___|
		
	Please feel free to learn what you wish from our source code :)

	 ////////////////////////////////////////////////////////////////////////////////////////////// -->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="keywords" content="Manifest, Interactive, Whois, Lookup, Domain, Who Is" />
	<meta name="description" content="Manifest Interactive Whois Lookup" />
	<meta name="author" content="Manifest Interactive" />
	<meta name="revisit-after" content="1 week" />
	<meta name="robots" content="index,follow" />
	<meta name="googlebot" content="index,follow" />
	<meta name="company" content="Manifest Interactive" />
	<meta name="language" content="EN" />
	<meta name="content-language" content="english" />
	<meta name="copyright" content="Manifest Interactive" />
	<meta name="rating" content="general" />
	<meta name="coverage" content="worldwide" />
	<meta name="resource-type" content="document" />
	<meta name="rating" content="general" />
	<meta http-equiv="imagetoolbar" content="no" />

	<script type="text/javascript" language="javascript" src="http://www.manifestinteractive.com/mint/?js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" language="javascript">
	$().ready(function(){
		$(window).bind("resize", resizeWindow);
		var newHeight = $(window).height();
		$("#src").css("height", (newHeight-150));
		$("#domain").keypress(function(e){return alphaNumeric(e)});
	});
	function resizeWindow(e) {
		var newHeight = $(window).height();
		$("#src").css("height", (newHeight-150));
	}
	function alphaNumeric(e){
		if((e.which>=32 && e.which<=44) || e.which==47 || (e.which>=58 && e.which<=64) || (e.which>=91 && e.which<=94) || e.which==96 || (e.which>=123 && e.which<=126)){
			$("#sectionerror").html('Invalid Character &nbsp;<span style="font-weight: normal; color: #999;">( Only Use: A-Z a-z 0-9 . - _ )<\/span>').show();
			return false;
		}
		else {
			$("#sectionerror").html('').hide();
		}
	}
	</script>
	
	<link rel="shortcut icon" href="http://www.manifestinteractive.com/favicon.ico" type="image/x-icon" />
	<link rel="alternate" href="http://www.manifestinteractive.com/rss.php" type="application/rss+xml" title="Manifest Interactive Media Portfolio" />
	<link rel="start" href="http://www.manifestinteractive.com" title="Home" />
	<style type="text/css" media="screen, projection">
		@import "css/style.css";
	</style>
	
</head>

<body>
<div id="wrapper">
    <a href="http://www.manifestinteractive.com/tools/whois/"><img src="http://www.manifestinteractive.com/images/logo.gif" width="161" height="41" border="0" /></a><br /><br />
    <form action="http://www.manifestinteractive.com/tool/whois/" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2 style="float: left;">
        Domain/IP: <input type="text" name="domain" id="domain" value="<?=$whois->domain?>" style="width: 250px;" spellcheck="false" title="Enter a Domain Name or IP Address." /> <input type="submit" value="&nbsp;Whois Lookup&nbsp;" title="Perform a Whois Lookup on this Domain Name or IP Address." />
		<?PHP if($whois->url && !preg_match("/No match for/i", $whois->data) && !preg_match("/Error:/i", $whois->data)){ ?><input type="button" value="&nbsp;Open URL&nbsp;" title="Open this URL in a new window." onclick="window.open('<?=$whois->url?>')" /><?PHP } ?>
        <?PHP if(preg_match("/No match for/i", $whois->data)){?><input type="button" value="&nbsp;Order Domain&nbsp;" title="Order this Domain Name with GoDaddy.com." onclick="window.open('http://www.godaddy.com/gdshop/registrar/search.asp?domainToCheck=<?=$whois->domainarray[1]?>&tld=.<?=strtoupper($whois->domainarray[0])?>&checkAvail=1&ci=12014')" /><?PHP } ?>
        </h2>
        <div id="sectionerror" style="float: left; margin: 10px 0px 0px 10px;"><span style="color: #666;"><b>SAMPLE</b>:&nbsp; example.com &nbsp;|&nbsp; 123.45.678.90 &nbsp;</span><span style="font-weight: normal; color: #999;">(no "http://www.")</span></div>
        <?PHP if($whois->data){ ?><textarea readonly="readonly" name="src" id="src" spellcheck="false"><?PHP echo htmlspecialchars($whois->data);?></textarea><?PHP } ?>
	</form>
</div>
</body>
</html>
