document.addEventListener('DOMContentLoaded',function(){
 var label=document.getElementById('registrationStateLabel');if(!label)return;
 function sync(){var control=label.parentElement.querySelector('select[name=state],input[name=state]');if(control)label.htmlFor=control.id;}
 new MutationObserver(sync).observe(label.parentElement,{childList:true,subtree:true,attributes:true,attributeFilter:['id','name']});sync();
});
