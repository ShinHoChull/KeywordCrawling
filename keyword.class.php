<?
	
	
	/**
	* keyword class
	*/
	class keywordClass {
		
		private $keyword;
		private $naverBasket;
		private $daumBasket;
		private $zumBasket;
		public $urlBasketArr = array();
	
	
		public function __construct($keyword =""){
			$this->keyword = $keyword;
		}
		
		//Array 포인터 참조
		public function Set_basketArr($basketName = "" , $url=""){
			$this->urlBasketArr[] = array($basketName=>$url);
		}
		
		public function Print_basketArr(){
			print_r($this->urlBasketArr);
		}
		
		public function Size_basketArr(){
			return count($this->urlBasketArr);
		}
		
		public function Crawling($keyword,$html=""){

			switch($keyword){
				case "naver":
					$this->NaverCrawling($html);	
				break;
				case "daum":
					$this->DaumCrawling($html);	
				break;
				case "zum":
					$this->ZumCrawling($html);	
				break;
			}	
		}
		
		public function DaumCrawling($html){

			$tempArr = explode('application/json;charset=UTF-8', $html);
			$tempJson = json_decode($tempArr[1]);
			
// 			$this->basket .= "*********Daum Crawling********<br/>";		
			
			foreach($tempJson as $key=>$value){
				if($key === "subkeys"){
					foreach($value as $key){
						$this->daumBasket .= "<input type='button' value='".$key."' onclick='searchKeyword(this.value)'><br/>";	
					}
				}
			}
		}
		
		public function NaverCrawling($html){

			$tempArr = explode('noindex', $html);
			$tempJson = json_decode($tempArr[1]);
			
// 			$this->basket .= "*********Naver Crawling********<br/>";		
			
			foreach($tempJson as $key=>$value){
				if($key === "items"){
						$itemsSize = count($value[0]);
						for($i = 0 ; $i < $itemsSize; $i++){
						$this->naverBasket .=  "<input type='button' value='".$value[0][$i][0]."' onclick='searchKeyword(this.value)'><br/>";
					}
				}
			}
		}
		
		public function ZumCrawling($html){
			
			$tempArr = explode('restest_callback_sugg("ㅅ")(', $html);
			$tempJson = json_decode(substr($tempArr[1],0,-1));
			
// 			$this->basket .= "*********Zum Crawling********<br/>";			
			
			foreach($tempJson as $key=>$value){
				
				foreach($value as $key=>$value){
					if($key === "entry"){
						foreach($value as $value){
							if(isset($value->title)){
								 $this->zumBasket .= "<input type='button' value='".$value->title."' onclick='searchKeyword(this.value)'><br/>";	
							}else if(isset($value->content)){
								 $this->zumBasket .= "<input type='button' value='".$value->content."' onclick='searchKeyword(this.value)'><br/>";									
							}	
						}
					}
				}
			}
		}
		
		public function Print_crawlingNaver(){
			return 	$this->naverBasket;
		}
		
		public function Print_crawlingDaum(){
			return 	$this->daumBasket;
		}		
		
		public function Print_crawlingZum(){
			return 	$this->zumBasket;
		}
		
	}
	