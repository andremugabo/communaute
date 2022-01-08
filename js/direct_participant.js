function getStatus(Telephone){
           
           if (window.XMLHttpRequest) { //check the browsers version

           	    request= new XMLHttpRequest(); //check the browsers version(modern browsers)
           }else{
           	request= new ActiveXObject("microsft.XMLHTTP");//check the browsers version(old browsers)
           }

           request.onreadystatechange = function(){ //check the resquest has been successfuly
           			// let i=false;

           	if (this.readyState == 4 && this.status == 200) {
           		document.getElementById('Telephone').innerHTML = this.responseText;
           		document.getElementById('names').innerHTML = this.responseText;
				// i=true;
				// if (i) {
				// let initial_value=document.getElementById('upp').value;
    //    			console.log(initial_value);
    //        	    getBuyingPrice(initial_value);
    //        	    }
           	}

           }
           request.open("GET","get_participant.php?pat="+Telephone+"&tel="+names,true);
           request.send();

           
          

	}


	function getPhone(names){
           
           if (window.XMLHttpRequest) { //check the browsers version

           	    request= new XMLHttpRequest(); //check the browsers version(modern browsers)
           }else{
           	request= new ActiveXObject("microsft.XMLHTTP");//check the browsers version(old browsers)
           }

           request.onreadystatechange = function(){ //check the resquest has been successfuly
           			// let i=false;

           	if (this.readyState == 4 && this.status == 200) {
           		document.getElementById('names').innerHTML = this.responseText;
				// i=true;
				// if (i) {
				// let initial_value=document.getElementById('upp').value;
    //    			console.log(initial_value);
    //        	    getBuyingPrice(initial_value);
    //        	    }
           	}

           }
           request.open("GET","get_participant.php?tel="+names,true);
           request.send();

           
          

	}
	
	async function getNames(productid){
		let response=await fetch("get_participant.php?pid="+productid);
		let buyingprice=await response.text();
		// console.log(buyingprice);
		document.getElementById('id').value=buyingprice;
	}
 