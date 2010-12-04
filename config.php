<?PHP
#################################################################################
## Copyright (C) 2008 by Manifest Interactive                                  ##
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

## TEST FOR CONNECTION TO THIS FILE DIRECTLY
if($_SERVER['PHP_SELF'] == '/config.php') die('You cannot access this file directy.');

## SET CONNECTION FOR OTHER FILES TO VALIDATE
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL & ~E_NOTICE); 
session_start();

$whoisservers = array(
	"ac" =>"whois.nic.ac",
	"ae" =>"whois.nic.ae",
	"aero"=>"whois.aero",
	"af" =>"whois.nic.af",
	"ag" =>"whois.nic.ag",
	"al" =>"whois.ripe.net",
	"am" =>"whois.amnic.net",
	"arpa" =>"whois.iana.org",
	"as" =>"whois.nic.as",
	"asia" =>"whois.nic.asia",
	"at" =>"whois.nic.at",
	"au" =>"whois.aunic.net",
	"az" =>"whois.ripe.net",
	"ba" =>"whois.ripe.net",
	"be" =>"whois.dns.be",
	"bg" =>"whois.register.bg",
	"bi" =>"whois.nic.bi",
	"biz" =>"whois.biz",
	"bj" =>"whois.nic.bj",
	"br" =>"whois.registro.br",
	"bt" =>"whois.netnames.net",
	"by" =>"whois.ripe.net",
	"bz" =>"whois.belizenic.bz",
	"ca" =>"whois.cira.ca",
	"cat" =>"whois.cat",
	"cc" =>"whois.nic.cc",
	"cd" =>"whois.nic.cd",
	"ch" =>"whois.nic.ch",
	"ci" =>"whois.nic.ci",
	"ck" =>"whois.nic.ck",
	"cl" =>"whois.nic.cl",
	"cn" =>"whois.cnnic.net.cn",
	"com" =>"whois.verisign-grs.com",
	"coop" =>"whois.nic.coop",
	"cx" =>"whois.nic.cx",
	"cy" =>"whois.ripe.net",
	"cz" =>"whois.nic.cz",
	"de" =>"whois.denic.de",
	"dk" =>"whois.dk-hostmaster.dk",
	"dm" =>"whois.nic.cx",
	"dz" =>"whois.ripe.net",
	"edu" =>"whois.educause.edu",
	"ee" =>"whois.eenet.ee",
	"eg" =>"whois.ripe.net",
	"es" =>"whois.ripe.net",
	"eu" =>"whois.eu",
	"fi" =>"whois.ficora.fi",
	"fo" =>"whois.ripe.net",
	"fr" =>"whois.nic.fr",
	"gb" =>"whois.ripe.net",
	"gd" =>"whois.adamsnames.com",
	"ge" =>"whois.ripe.net",
	"gg" =>"whois.channelisles.net",
	"gi" =>"whois2.afilias-grs.net",
	"gl" =>"whois.ripe.net",
	"gm" =>"whois.ripe.net",
	"gov" =>"whois.nic.gov",
	"gr" =>"whois.ripe.net",
	"gs" =>"whois.nic.gs",
	"gw" =>"whois.nic.gw",
	"gy" =>"whois.registry.gy",
	"hk" =>"whois.hkirc.hk",
	"hm" =>"whois.registry.hm",
	"hn" =>"whois2.afilias-grs.net",
	"hr" =>"whois.ripe.net",
	"hu" =>"whois.nic.hu",
	"ie" =>"whois.domainregistry.ie",
	"il" =>"whois.isoc.org.il",
	"in" =>"whois.inregistry.net",
	"info" =>"whois.afilias.info",
	"int" =>"whois.iana.org",
	"io" =>"whois.nic.io",
	"iq" =>"vrx.net",
	"ir" =>"whois.nic.ir",
	"is" =>"whois.isnic.is",
	"it" =>"whois.nic.it",
	"je" =>"whois.channelisles.net",
	"jobs" =>"jobswhois.verisign-grs.com",
	"jp" =>"whois.jprs.jp",
	"ke" =>"whois.kenic.or.ke",
	"kg" =>"www.domain.kg",
	"ki" =>"whois.nic.ki",
	"kr" =>"whois.nic.or.kr",
	"kz" =>"whois.nic.kz",
	"la" =>"whois.nic.la",
	"li" =>"whois.nic.li",
	"lt" =>"whois.domreg.lt",
	"lu" =>"whois.dns.lu",
	"lv" =>"whois.nic.lv",
	"ly" =>"whois.nic.ly",
	"ma" =>"whois.iam.net.ma",
	"mc" =>"whois.ripe.net",
	"md" =>"whois.ripe.net",
	"me" =>"whois.meregistry.net",
	"mg" =>"whois.nic.mg",
	"mil" =>"whois.nic.mil",
	"mn" =>"whois.nic.mn",
	"mobi" =>"whois.dotmobiregistry.net",
	"ms" =>"whois.adamsnames.tc",
	"mt" =>"whois.ripe.net",
	"mu" =>"whois.nic.mu",
	"museum" =>"whois.museum",
	"mx" =>"whois.nic.mx",
	"my" =>"whois.mynic.net.my",
	"na" =>"whois.na-nic.com.na",
	"name" =>"whois.nic.name",
	"net" =>"whois.verisign-grs.net",
	"nf" =>"whois.nic.nf",
	"nl" =>"whois.domain-registry.nl",
	"no" =>"whois.norid.no",
	"nu" =>"whois.nic.nu",
	"nz" =>"whois.srs.net.nz",
	"org" =>"whois.pir.org",
	"pl" =>"whois.dns.pl",
	"pm" =>"whois.nic.pm",
	"pr" =>"whois.uprr.pr",
	"pro" =>"whois.registrypro.pro",
	"pt" =>"whois.dns.pt",
	"re" =>"whois.nic.re",
	"ro" =>"whois.rotld.ro",
	"ru" =>"whois.ripn.net",
	"sa" =>"whois.nic.net.sa",
	"sb" =>"whois.nic.net.sb",
	"sc" =>"whois2.afilias-grs.net",
	"se" =>"whois.iis.se",
	"sg" =>"whois.nic.net.sg",
	"sh" =>"whois.nic.sh",
	"si" =>"whois.arnes.si",
	"sk" =>"whois.ripe.net",
	"sm" =>"whois.ripe.net",
	"st" =>"whois.nic.st",
	"su" =>"whois.ripn.net",
	"tc" =>"whois.adamsnames.tc",
	"tel" =>"whois.nic.tel",
	"tf" =>"whois.nic.tf",
	"th" =>"whois.thnic.net",
	"tj" =>"whois.nic.tj",
	"tk" =>"whois.dot.tk",
	"tl" =>"whois.nic.tl",
	"tm" =>"whois.nic.tm",
	"tn" =>"whois.ripe.net",
	"to" =>"whois.tonic.to",
	"tp" =>"whois.nic.tl",
	"tr" =>"whois.nic.tr",
	"travel" =>"whois.nic.travel",
	"tv" => "tvwhois.verisign-grs.com",
	"tw" =>"whois.twnic.net.tw",
	"ua" =>"whois.net.ua",
	"ug" =>"whois.co.ug",
	"uk" =>"whois.nic.uk",
	"us" =>"whois.nic.us",
	"uy" =>"nic.uy",
	"uz" =>"whois.cctld.uz",
	"va" =>"whois.ripe.net",
	"vc" =>"whois2.afilias-grs.net",
	"ve" =>"whois.nic.ve",
	"vg" =>"whois.adamsnames.tc",
	"wf" =>"whois.nic.wf",
	"ws" =>"whois.website.ws",
	"yt" =>"whois.nic.yt",
	"yu" =>"whois.ripe.net");

function LookupDomain($domain){
	global $whoisservers;
	$whoisserver = "";
	foreach($whoisservers as $tld=>$server) {
		if(substr($domain, -strlen($tld)) == $tld) {
			$whoisserver = $server;
			break;
		}
	}
	if(!$whoisserver) {
		
		if(preg_match('/(\d+).(\d+).(\d+).(\d+)/',$domain)){
			$whoisserver = "whois.arin.net";
		}
		else {
			return "Error: No appropriate Whois server found for $domain domain!";
		}
	}
	$result = QueryWhoisServer($whoisserver, $domain);
	if(!$result) {
		return "Error: No results retrieved from $whoisserver server for $domain domain!";
	}
	else {
		preg_match("/Whois Server: (.*)/", $result, $matches);
		$secondary = $matches[1];
		if($secondary) {
			$result = QueryWhoisServer($secondary, $domain);
			return "$domain domain lookup results from $secondary server:\n\n" . $result;
		}
		else {
			return "$domain domain lookup results from $whoisserver server:\n\n" . $result;
		}
	}
}

function QueryWhoisServer($whoisserver, $domain) {
	$port = 43;
	$timeout = 10;
	$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
	fputs($fp, $domain . "\r\n");
	$out = "";
	while(!feof($fp)){
		$out .= fgets($fp);
	}
	fclose($fp);
	
	return $out;
}

if(strlen($_POST['domain']) > 0 || strlen($_GET['domain']) > 0) {
	// add ability to match ip address
	$url = (strlen($_POST['domain'])>0) ? $_POST['domain']:$_GET['domain'];
	$url = rtrim($url, "/");
	$url = preg_replace('/http:\/\//', '', $url);
	$post = (substr($url,0,7) != 'http://') ? 'http://'.$url:$url;
	if(preg_match('/(\d+).(\d+).(\d+).(\d+)/',$url)){
		$string = $url;
		$result = LookupDomain($url);
	}
	else {
		$domain = split("\.", $url);
		$domain = array_reverse($domain);
		$string = $domain[1].'.'.$domain[0];
		$result = LookupDomain($string);
	}
}
?>