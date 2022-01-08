const open=document.querySelector('.open');
const modal=document.querySelector('#to_open');
const close=document.querySelectorAll('.close');

open.addEventListener('click',function(){
	modal.style.display='flex';
})

close.forEach(function(btn){
    
    btn.addEventListener('click',function(){
    	modal.style.display='none';
    })
})

