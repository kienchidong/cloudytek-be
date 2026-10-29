(function(){
 'use strict';
 function init(){
  if(!document.getElementById('main-body')||document.querySelector('.client-content-loader'))return;
  var vi=document.documentElement.lang==='vi',navigation=false,pending=new Set(),timer,markedRoot=null;
  var overlay=document.createElement('div');overlay.className='client-content-loader';overlay.hidden=true;
  overlay.setAttribute('role','status');overlay.setAttribute('aria-live','polite');overlay.setAttribute('aria-label',vi?'Đang tải':'Loading');
  var spinner=document.createElement('span');spinner.className='client-loading-spinner';spinner.setAttribute('aria-hidden','true');
  overlay.appendChild(spinner);document.body.append(overlay);
  function content(){return document.getElementById('ct-client-content')||document.getElementById('main-body');}
  function position(){var root=content();if(!root)return;var viewport=document.getElementById('ct-client-scroll')||root;var rect=viewport.getBoundingClientRect(),top=Math.max(0,rect.top),bottom=Math.min(innerHeight,rect.bottom),left=Math.max(0,rect.left);overlay.style.left=left+'px';overlay.style.top=top+'px';overlay.style.width=Math.max(0,Math.min(rect.right,innerWidth)-left)+'px';overlay.style.height=Math.max(0,bottom-top)+'px';}
  function sync(){var busy=navigation||pending.size>0,root=content();if(markedRoot&&markedRoot!==root)markedRoot.setAttribute('aria-busy','false');markedRoot=root;if(root)root.setAttribute('aria-busy',String(busy));overlay.hidden=!busy;if(busy){position();if(!timer)timer=setTimeout(reset,30000);}else{clearTimeout(timer);timer=null;}}
  function reset(){navigation=false;pending.clear();sync();}
  // Show feedback before the browser starts waiting for the next document.
  // Read defaultPrevented after application handlers; never change navigation or submission.
  document.addEventListener('click',function(event){
   var link=event.target.closest('a[href]');
   if(!link||event.button!==0||event.ctrlKey||event.metaKey||event.shiftKey||event.altKey||link.download||link.hasAttribute('download')||link.target&&link.target!=='_self'||link.matches('[data-toggle],.submenu-toggle,.dropdown-toggle,[onclick]'))return;
   var url;try{url=new URL(link.href,location.href);}catch(e){return;}
   if(url.origin!==location.origin||url.protocol!=='http:'&&url.protocol!=='https:'||url.pathname===location.pathname&&url.search===location.search&&(url.hash||link.getAttribute('href').startsWith('#'))||/\.(pdf|zip|csv|png|jpg)(?:$)/i.test(url.pathname)||/(?:^|\/)(?:dl|downloads?)(?:\.php)?(?:\/|$)/i.test(url.pathname)||/download|export|attachment/i.test(url.search))return;
   queueMicrotask(function(){if(!event.defaultPrevented){navigation=true;sync();}});
  });
  document.addEventListener('submit',function(event){
   var form=event.target;if(form.target&&form.target!=='_self')return;
   queueMicrotask(function(){if(!event.defaultPrevented){navigation=true;sync();}});
  });
  // Observe native navigation only: no interception, replay or changes to form fields.
  window.addEventListener('beforeunload',function(){navigation=true;sync();});
  window.addEventListener('pageshow',function(event){navigation=false;if(event.persisted)pending.clear();sync();});window.addEventListener('pagehide',reset);
  window.addEventListener('resize',function(){if(!overlay.hidden)position();});window.addEventListener('scroll',function(){if(!overlay.hidden)position();},{passive:true,capture:true});
  if(window.ResizeObserver){var observer=new ResizeObserver(function(){if(!overlay.hidden)position();});observer.observe(document.body);}
  window.addEventListener('cloudytek:content-request',function(event){var detail=event.detail;if(!detail||!detail.id)return;if(detail.active)pending.add(detail.id);else pending.delete(detail.id);sync();});
  if(window.jQuery){
   window.jQuery(document).on('ajaxSend.clientLoading',function(event,xhr,options){
    var url;try{url=new URL(options.url,location.href);}catch(e){return;}
    if(url.origin!==location.origin||!/\/(cart|clientarea|supporttickets|submitticket|domainchecker|index)(?:\.php)?$/.test(url.pathname)||/notification|poll|heartbeat|keepalive/i.test(url.search))return;
    pending.add(xhr);sync();
   }).on('ajaxComplete.clientLoading',function(event,xhr){pending.delete(xhr);sync();});
  }
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
