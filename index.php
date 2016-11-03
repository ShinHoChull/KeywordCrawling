<?
		header("Content-Type:text/html;charset=utf8");
		
		include_once 'class_curl.php';
		include_once 'keyword.class.php';
		
		$keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
		$keyword = urlencode($keyword);		
		$keywordClass = new keywordClass($keyword);
		$class_curl = new Model_CURL();


		$keywordClass->Set_basketArr("naver","http://ac.search.naver.com/nx/ac?q=$keyword&q_enc=UTF-8&st=100&frm=nv&r_format=json&r_enc=UTF-8&r_unicode=0&t_koreng=1&ans=2&run=2&rev=4&con=1");
		$keywordClass->Set_basketArr("daum","http://suggest.search.daum.net/sushi/pc/get?q=$keyword");
 		$keywordClass->Set_basketArr("zum","http://ssug.api.search.zum.com/json.zum?src=sbox&callback=restest_callback_sugg(%22%E3%85%85%22)&method=ssug.zumout&query=$keyword&_t=1477468160393");


		foreach($keywordClass->urlBasketArr as $key=>$value){
			foreach($value as $key=>$value){
				$keywordClass->Crawling($key , $class_curl->getUrl($value));
			}
		}		
?>

<!DOCTYPE HTML>
<html>
<head>
<title>연관검색어</title>
<link href="css/crawling1.css" rel="stylesheet">
<meta content="text/html; charset=UTF8" http=equiv="content-type">
</head>
<body>
		<!--검색어 창-->
		<div class="search" align="center" >
			<input type="text" id="keyword" name="keyword">
			<button id="keywordBt">검색</button><br/>	
		</div>
		
		<!--키워드 창-->
		<div id="parents_div"  class="keywordParentList" align="center">
			<div class="childkeywordList" name="divBox" onclick="selectDivBox1(this)"><h3>- Naver -</h3><?=$keywordClass->Print_crawlingNaver();?></div>
			<div class="childkeywordList"name="divBox" onclick="selectDivBox1(this)"><h3>- Daum -</h3><?=$keywordClass->Print_crawlingDaum();?></div>
			<div class="childkeywordList" name="divBox" onclick="selectDivBox1(this)"><h3>- Zum -</h3><?=$keywordClass->Print_crawlingZum();?></div>
		</div>
		<div id="childDiv">
		</div>
	
	<button class="mainButton" id="readingKeywordList"><h1>OK</h1></button>
	
<script src="http://code.jquery.com/jquery.js"></script>	
<script type="text/javascript" src="js/searchKeyword.js"></script>	
<script type="text/javascript">	
	(function(){
		document.getElementById("keywordBt").addEventListener("click", function(){
			var keyword = document.getElementById("keyword").value;
			if(keyword !== ""){
				location.href = "?keyword="+keyword;
			}else{
				alert("검색어를 입력해주세요");
				return;
			}
		})		
	}());

/*
	var searchKeyword = function(){
		console.log(arguments[0])
	}
*/
	
	
	
</script>
</body>
</html>
