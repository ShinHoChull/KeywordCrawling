

	var searchKeyword = function(){
		
			var keyword = arguments[0];
			var data ={
				q:keyword,
				htype:"position",
				callback:"jsonp_1xaa53k4n8vr8ur"
			};
		
		    $.ajaxPrefilter('json', function(options, orig, jqXHR) {
		        return 'jsonp';
		    });
		  
		    $.ajax({
		        url: "http://suggest.search.daum.net/sushi/pc/get"
		        , crossDomain: true
		         ,dataType : "jsonp"
				 ,jsonp : "callback"
		        , type: 'get'
		        , data: data
		        , success: function( data, textStatus, jqXHR )
		        {		
			        endExtraction(keyword,data)
				}
		        , error: function( jqXHR, textStatus, errorThrown )
		        {
		            alert( textStatus + ", " + errorThrown+"1!!" );
		        }
		    });
	}
	
	
	var endExtraction = function(){
		
		var startObject = arguments[1];
		
		   var data ={
		callback:'restest_callback_ssug("'+arguments[0]+'")',
		method:"ssug",
		query:arguments[0],
		_t:"1477984824308"
		};
	
	    $.ajaxPrefilter('json', function(options, orig, jqXHR) {
	        return 'jsonp';
	    });
	  
	    $.ajax({
	        url: "http://ssug.api.search.zum.com/json.zum"
	        , crossDomain: true
	         ,dataType : "jsonp"
			 ,jsonp : "callback"
	        , type: 'get'
	        , data: data
	        , success: function( data, textStatus, jqXHR )
	        {	
				keywordAttach(startObject,data);
			}
	        , error: function( jqXHR, textStatus, errorThrown )
	        {
	            alert( textStatus + ", " + errorThrown+"1!!" );
	        }
	    });	
	  }
	  
	  var keywordAttach = function(d,z){
		  
		  var keywordArr = new Array();
		  var keywordLength = 0;
		  var i,j,f="",b="";
		  
		  for( i in z){
			 for( j in z[i].entry){
				 keywordArr.push(z[i].entry[j].title);
			 } 
		  }
		  
		  	for( i in d.subkeys){
			  	 keywordArr.push( d.subkeys[i]);
		  	}
		  	keywordLength = keywordArr.length;

		  	
		  	for( i = 0; i < keywordLength; i++ ){
				if( i < keywordLength/2 ){
					if(keywordArr[i] !== undefined)
						f += "<input type='button' value='"+keywordArr[i]+"' onclick='searchKeyword(this.value)'><br/>";
				}else{
					if(keywordArr[i] !== undefined)
						b += "<input type='button' value='"+keywordArr[i]+"' onclick='searchKeyword(this.value)'><br/>";
				}
		  	}

		  	htmlMake(f,b);
	  }
	  
	  
	  
	  //this에대한 문제때문에 같은 함수를 2개 만듬... 추후 수정..
	  var selectDivBox1 = function(e){
		  
		  if(e.className  === "childkeywordList"){
			  e.className = "backgroundChange";
		  }else{
			  e.className = "childkeywordList";
		  }
	  }
	  
	  var selectDivBox2 = function(){
		  
		  if(this.className  === "childkeywordList"){
			  this.className = "backgroundChange";
		  }else{
			  this.className = "childkeywordList";
		  }
	  }
	  //=====================================
	  
	  //사용자에게 보여줄 HTML 제작하기.
	  var htmlMake = function(f,b){
		  var c;
		  
		  c = document.createElement("div");
		  	c.onclick = selectDivBox2;
		  	c.setAttribute("name", "divBox");
		 	c.className = "childkeywordList";
		 	c.align="center";
		  	c.innerHTML = f;
		  	
		  	document.body.insertBefore(c, document.getElementById("childDiv"));
		  	
		  	c = document.createElement("div");
		  	c.onclick = selectDivBox2;
		  	c.setAttribute("name", "divBox");
		 	c.className = "childkeywordList";
		 	c.align="center";
		  	c.innerHTML = b;
		  	document.body.insertBefore(c, document.getElementById("childDiv"));
		  	
		  	$( 'html, body' ).stop().animate( { scrollTop : document.body.scrollHeight } );
	  }
	  

	  //선택한 노드의 키워드 읽기
	  document.getElementById("readingKeywordList").addEventListener("click", function(){
		  
		  	var divBoxs = document.getElementsByName("divBox");
			var divLength = divBoxs.length; 
			var tempObject;
			var inputChilid,inputChildLength;
			
			for(var i = 0 ; i < divLength; i ++){
				
				tempObject = divBoxs[i];
				if(tempObject.className === "backgroundChange"){
					
					inputChilid = tempObject.getElementsByTagName("input");	
					inputChildLength = inputChilid.length;
	
					for(var j = 0 ; j < inputChildLength; j++){
						if(inputChilid[j].type === "button"){
							console.log(inputChilid[j].value);
						}
					}
				}
			}
			
	  }) 

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	