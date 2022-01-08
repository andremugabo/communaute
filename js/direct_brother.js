
   function getParish(parish){
           
           if (window.XMLHttpRequest) { //check the browsers version

                request= new XMLHttpRequest(); //check the browsers version(modern browsers)
           }else{
            request= new ActiveXObject("microsft.XMLHTTP");//check the browsers version(old browsers)
           }

           request.onreadystatechange = function(){ //check the resquest has been successfuly
                  // let i=false;

            if (this.readyState == 4 && this.status == 200) {
               document.getElementById('parish').innerHTML = this.responseText;
            
            }

           }
           request.open("GET","get_brother.php?cat="+parish,true);
           request.send();

           
          

   }
    function getCommunity(community){
           
           if (window.XMLHttpRequest) { //check the browsers version

                request= new XMLHttpRequest(); //check the browsers version(modern browsers)
           }else{
            request= new ActiveXObject("microsft.XMLHTTP");//check the browsers version(old browsers)
           }

           request.onreadystatechange = function(){ //check the resquest has been successfuly
                  // let i=false;

            if (this.readyState == 4 && this.status == 200) {
               document.getElementById('community').innerHTML = this.responseText;
            
            }

           }
           request.open("GET","get_brother.php?com="+community,true);
           request.send();

           
          

   }
    