document.addEventListener('DOMContentLoaded',function(){
 var label=document.getElementById('checkoutStateLabel');if(!label)return;
 function sync(){var field=label.parentElement.querySelector('input[name=state],select[name=state]');if(field&&field.id)label.htmlFor=field.id;}
 new MutationObserver(sync).observe(label.parentElement,{childList:true,subtree:true});sync();
});
