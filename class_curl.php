<?php
class Model_CURL
{		
		
        function getUrl($url)
        {
                if(function_exists("curl_init"))
                {
                        $ch = curl_init();

						$header[0] = "Accept: application/json";
						$header[] = "Cache-Control: max-age=0";
						$header[] = "Connection: keep-alive";
						$header[] = "Keep-Alive: 300";
						$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
						$header[] = "Accept-Language: en-us,en;q=0.5";
						$header[] = "Pragma: "; // browsers keep this blank. 
						
						$ranNum = rand(1,3);
						
						$refererArr = array(1=>"https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&ie=utf8&query=%EA%B0%90%EC%9E%90",
																2=>"https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&ie=utf8&query=%EC%B9%98%ED%82%A8",
																3=>"https://search.naver.com/search.naver?where=nexearch&query=%EC%96%91%EB%85%90%EC%B9%98%ED%82%A8+%EC%B9%BC%EB%A1%9C%EB%A6%AC&ie=utf8&sm=tab_she&qdt=0");
																
						$encodingArr = array(1=>"gzip, deflate, sdch",2=>"gzip, deflate,",3=>"gzip");
						
						$useragentArr = array(1=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36",
																		2=>"Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko",
																		3=>"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36");
								
						curl_setopt ($ch, CURLOPT_HEADER, 1); 
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_REFERER, ''); //추가
                        curl_setopt($ch, CURLOPT_ENCODING, $encodingArr[$ranNum]); //추가 
                        curl_setopt($ch, CURLOPT_USERAGENT,  $useragentArr[$ranNum]);//추가
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                        $html = curl_exec($ch);
                        curl_close($ch);
                }
                else
                {
                        $html = HttpClient::quickGet($url);
                }

                return $html;
        }
}