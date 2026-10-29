(function(){
 function init(){
  function refresh(){document.querySelectorAll('.bootstrap-switch').forEach(function(root){
   var label=root.querySelector('.bootstrap-switch-label'),compact=!!label&&!label.textContent.trim();root.classList.toggle('ui-toggle',compact);
   var input=root.querySelector('input');
   if(compact&&!root.dataset.compactSized&&input&&window.jQuery&&jQuery(input).data('bootstrap-switch')){
    root.dataset.compactSized='true';
    // Use the plugin's own sizing API so clicks, dragging and keyboard controls stay aligned.
    jQuery(input).bootstrapSwitch('handleWidth',20).bootstrapSwitch('labelWidth',26);
   }
  });}
  var queued=false;new MutationObserver(function(){if(queued)return;queued=true;requestAnimationFrame(function(){queued=false;refresh();});}).observe(document.body,{childList:true,subtree:true});refresh();
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
