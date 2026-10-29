(function () {
 'use strict';
 function init() {
  var counter=0, errors=new WeakMap(), focusPending=false;
  var config={errors:[]};
  try {config=JSON.parse(document.getElementById('cloudytek-validation-config').textContent);} catch (_) {}
  var vi=config.language==='vietnamese'||document.documentElement.lang==='vi';
  var copy=vi?{required:'Vui lòng điền thông tin này.',email:'Vui lòng nhập địa chỉ email hợp lệ.',match:'Mật khẩu xác nhận không khớp.',check:'Vui lòng chọn mục này.',invalid:'Thông tin chưa hợp lệ.'}:
   {required:'Please fill out this field.',email:'Please enter a valid email address.',match:'The password confirmation does not match.',check:'Please select this option.',invalid:'Please enter a valid value.'};
  function normal(value){return value.replace(/\s+/g,' ').trim();}
  function visible(field){return !field.disabled&&field.type!=='hidden'&&field.getClientRects().length>0&&!!field.closest('form');}
  function controls(form){return Array.from(form.elements).filter(function(f){return /^(INPUT|SELECT|TEXTAREA)$/.test(f.tagName)&&visible(f)&&!['submit','button','reset','image'].includes(f.type);});}
  function findField(name,source){
   var aliases={password2:['password2','confirmpw','newpw2'],password:['password','newpw'],email:['email','username'],code:['code','captcha']};
   var names=aliases[name]||[name];
   var scope=source&&source.closest('form,.registration-form-card,.portal-signin,.support-form-card,#order-standard_cart,.main-content');
   var candidates=Array.from((scope||document).querySelectorAll('input,select,textarea')).filter(function(f){return names.includes(f.name)&&visible(f);});
   return candidates[0]||null;
  }
  function anchor(field){return field.closest('.intl-tel-input,.input-group,.portal-input-field,.input-password-wrapper')||field;}
  function show(field,message,server){
   if(!visible(field)||!message)return false;
   var record=errors.get(field),target=anchor(field);
   if(!record){
    var node=document.createElement('div');
    node.id='ctk-field-error-'+(++counter);node.className='ctk-field-error';node.setAttribute('role','status');node.setAttribute('aria-live','polite');
    target.insertAdjacentElement('afterend',node);
    record={node:node,anchor:target};errors.set(field,record);
    var descriptions=(field.getAttribute('aria-describedby')||'').split(/\s+/).filter(Boolean);
    descriptions.push(node.id);field.setAttribute('aria-describedby',descriptions.join(' '));
   }
   if(record.node.textContent!==message)record.node.textContent=message;
   record.server=!!server;record.value=field.value;
   field.classList.add('ctk-field-invalid');field.setAttribute('aria-invalid','true');record.anchor.classList.add('ctk-invalid-wrap');
   return true;
  }
  function clear(field){
   var record=errors.get(field);if(!record)return;
   var ids=(field.getAttribute('aria-describedby')||'').split(/\s+/).filter(function(id){return id&&id!==record.node.id;});
   if(ids.length)field.setAttribute('aria-describedby',ids.join(' '));else field.removeAttribute('aria-describedby');
   field.removeAttribute('aria-invalid');field.classList.remove('ctk-field-invalid');record.anchor.classList.remove('ctk-invalid-wrap');
   record.node.remove();errors.delete(field);
  }
  function message(field){
   if(field.required&&((field.type==='checkbox'||field.type==='radio')?!field.checked:!field.value.trim())) {
    if(field.type==='radio'&&Array.from(field.form.elements).some(function(f){return f.name===field.name&&f.checked;}))return '';
    return field.type==='checkbox'||field.type==='radio'?copy.check:copy.required;
   }
   if(field.validity&&!field.validity.valid){if(field.validity.typeMismatch&&field.type==='email')return copy.email;return field.validationMessage||copy.invalid;}
   if(['password2','confirmpw','newpw2'].includes(field.name)&&field.value){
    var first=Array.from(field.form.elements).find(function(f){return ['password','newpw','newpw1'].includes(f.name)&&visible(f);});
    if(first&&field.value!==first.value)return copy.match;
   }
   return '';
  }
  function validate(field){var text=message(field);if(text){show(field,text,false);return false;}clear(field);return true;}
  function focusFirst(form){
   if(focusPending)return;focusPending=true;
   requestAnimationFrame(function(){focusPending=false;var first=controls(form).find(function(f){return errors.has(f);});if(first)first.focus();});
  }
  document.addEventListener('invalid',function(event){var field=event.target;if(!visible(field))return;event.preventDefault();show(field,message(field)||copy.invalid,false);focusFirst(field.form);},true);
  document.addEventListener('submit',function(event){
   var form=event.target;if(!(form instanceof HTMLFormElement)||form.hasAttribute('data-skip-inline-validation'))return;
   // Validation does not submit/replay forms; existing CSRF, AJAX and server validation still run.
   var invalid=false;controls(form).forEach(function(f){if(!validate(f))invalid=true;});
   if(invalid){event.preventDefault();event.stopImmediatePropagation();focusFirst(form);}
  },true);
  document.addEventListener('blur',function(event){var field=event.target;if(!/^(INPUT|SELECT|TEXTAREA)$/.test(field.tagName)||!visible(field))return;
   var record=errors.get(field);if(record&&record.server&&record.value===field.value)return;
   if(field.value||errors.has(field))validate(field);
  },true);
  function edited(event){var field=event.target;if(!visible(field))return;if(errors.has(field))validate(field);
   if(['password','newpw','newpw1'].includes(field.name))controls(field.form).forEach(function(other){if(['password2','confirmpw','newpw2'].includes(other.name)&&errors.has(other))validate(other);});
  }
  document.addEventListener('input',edited);document.addEventListener('change',edited);
  document.addEventListener('reset',function(event){setTimeout(function(){controls(event.target).forEach(clear);},0);});
  function placeServerErrors(){
   document.querySelectorAll('[data-validation-fields],[data-validation-field],.alert-danger li,.alert-danger').forEach(function(source){
    if(source.hidden||source.closest('.ctk-field-error')||source.querySelector('li'))return;
    var text=normal(source.textContent);if(!text)return;
    var names=[];
    try{names=JSON.parse(source.dataset.validationFields||'[]');}catch(_){}
    if(source.dataset.validationField)names.push(source.dataset.validationField);
    if(!names.length){var item=config.errors.find(function(item){return normal(item.message)===text;});if(item)names.push(item.field);}
    if(!names.length)return;
    var placed=false;
    names.forEach(function(name){var field=findField(name,source);if(field){
     var old=errors.get(field),combined=old&&old.server&&old.node.textContent!==text?old.node.textContent+' '+text:text;
     placed=show(field,combined,true)||placed;
    }});
    if(placed){source.hidden=true;source.dataset.inlineErrorMoved='true';}
   });
   document.querySelectorAll('.alert-danger').forEach(function(box){var items=Array.from(box.querySelectorAll('li'));if(items.length&&items.every(function(li){return li.hidden;}))box.hidden=true;});
  }
  var scheduled=false;
  new MutationObserver(function(){if(scheduled)return;scheduled=true;requestAnimationFrame(function(){scheduled=false;placeServerErrors();});}).observe(document.body,{childList:true,subtree:true});
  placeServerErrors();
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
