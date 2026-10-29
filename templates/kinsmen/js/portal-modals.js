(function(){
 'use strict';
 function init(){
  if(!window.jQuery||!jQuery.fn.modal)return;
  var count=0,origins=new WeakMap();
  function enhance(modal){
   modal.classList.add('ctk-client-modal');
   modal.classList.toggle('fade',!window.matchMedia('(prefers-reduced-motion: reduce)').matches);
   modal.setAttribute('role','dialog');
   if(!modal.hasAttribute('tabindex'))modal.tabIndex=-1;
   var title=modal.querySelector('.modal-title');
   if(title){
    if(!title.id)title.id='ctk-modal-title-'+(++count);
    modal.setAttribute('aria-labelledby',title.id);
   }
   modal.querySelectorAll('.modal-header>.close').forEach(function(button){
    if(!button.getAttribute('aria-label'))button.setAttribute('aria-label',document.documentElement.lang==='vi'?'Đóng':'Close');
   });
  }
  document.querySelectorAll('.modal').forEach(enhance);
  new MutationObserver(function(records){
   records.forEach(function(record){record.addedNodes.forEach(function(node){
    if(node.nodeType!==1)return;
    if(node.matches('.modal'))enhance(node);
    node.querySelectorAll('.modal').forEach(enhance);
    if(node.matches('.modal-backdrop'))node.classList.add('ctk-client-backdrop');
   });});
  }).observe(document.body,{childList:true,subtree:true});
  jQuery(document).on('show.bs.modal.ctkClient','.modal',function(event){
   enhance(this);
   this.setAttribute('aria-modal','true');
   var origin=event.relatedTarget||document.activeElement;
   if(origin&&origin!==document.body&&!this.contains(origin))origins.set(this,origin);
  }).on('hidden.bs.modal.ctkClient','.modal',function(){
   this.removeAttribute('aria-modal');
   var origin=origins.get(this);origins.delete(this);
   if(origin&&origin.isConnected&&origin.getClientRects().length&&!document.querySelector('.modal.in'))origin.focus({preventScroll:true});
  });
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
}());
