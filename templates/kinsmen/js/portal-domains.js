(function(){
 'use strict';
 function init(){
  var root=document.querySelector('.ctk-domain-store');if(!root)return;
  var form=document.getElementById('ctkDomainSearch'),input=document.getElementById('ctkDomainInput'),button=form.querySelector('button[type=submit]'),copy=JSON.parse(document.getElementById('ctkDomainCopy').textContent),results=document.getElementById('ctkDomainResults'),error=document.getElementById('ctkDomainError'),progress=document.getElementById('ctkDomainProgress'),more=document.getElementById('ctkDomainMore'),grid=document.getElementById('ctkDomainSuggestions'),offset=0,last='',pending=false;
  function element(tag,cls,text){var el=document.createElement(tag);if(cls)el.className=cls;if(text)el.textContent=text;return el;}
  function card(item,primary){
   var status=item.status,node=element('article',primary?'ctk-domain-result':'ctk-domain-card');node.dataset.status=status;
   var info=element('div','ctk-domain-result-info'),icon=element('i','fas '+(status==='registered'||status==='reserved'?'fa-lock':status==='unknown'?'fa-question-circle':'fa-check-circle'));
   icon.setAttribute('aria-hidden','true');info.appendChild(icon);
   var title=element('div','ctk-domain-result-copy');title.appendChild(element('strong','',item.domain));title.appendChild(element('span','ctk-domain-status',copy[status]||copy.unknown));info.appendChild(title);node.appendChild(info);
   var actions=element('div','ctk-domain-result-actions');
   if(item.price){var price=element('span','ctk-domain-price',item.price);price.appendChild(element('small','',copy.year));actions.appendChild(price);}
   var disabled=status==='registered'||status==='reserved'||status==='unknown';
   // Registered names can be discussed for transfer, but are never offered as new registrations.
   if(root.dataset.mode==='transfer'&&status==='registered')disabled=false;
   if(!disabled){
    var orderable=item.orderable&&root.dataset.mode!=='transfer';
    var link=element('a','ctk-domain-action',orderable?copy.register:root.dataset.mode==='transfer'?copy.transferContact:copy.contact);
    var url=new URL(orderable?root.dataset.cart:root.dataset.contact,location.href);
    if(orderable){url.searchParams.set('a','add');url.searchParams.set('domain','register');url.searchParams.set('query',item.domain);}
    else url.searchParams.set('subject',(root.dataset.mode==='transfer'?copy.transferContact:copy.contact)+': '+item.domain);
    link.href=url.toString();actions.appendChild(link);
   }
   node.appendChild(actions);return node;
  }
  function busy(state,append){pending=state;button.disabled=state;more.disabled=state;root.setAttribute('aria-busy',String(state));progress.hidden=!state;button.querySelector('span').textContent=copy.check;if(append){more.querySelector('span').textContent=copy.more;more.querySelector('i').className='fas fa-chevron-down';more.setAttribute('aria-busy',String(state));}}
  async function search(append){
   if(pending)return;error.hidden=true;input.removeAttribute('aria-invalid');
   if(!input.value.trim()){error.textContent=copy.invalid;error.hidden=false;input.setAttribute('aria-invalid','true');input.focus();return;}
   var submitted=append?last:input.value.trim();if(!append){offset=0;results.hidden=true;grid.replaceChildren();}
   busy(true,append);
   try{
    var body=new URLSearchParams();body.set('token',form.querySelector('[name=token]').value);body.set('domain',submitted);body.set('offset',String(append?offset:0));
    var response=await fetch(form.action,{method:'POST',body:body,credentials:'same-origin',headers:{'Accept':'application/json'}}),data=await response.json();
    if(!response.ok)throw new Error(data.error||'lookup_unavailable');
    last=data.primary.domain;input.value=last;
    if(!append)document.getElementById('ctkDomainPrimary').replaceChildren(card(data.primary,true));
    data.suggestions.forEach(function(item){grid.appendChild(card(item,false));});
    offset=data.nextOffset;more.hidden=!data.hasMore;results.hidden=false;
   }catch(e){var key=e.message==='invalid_domain'?'invalid':e.message==='rate_limit'?'rate':e.message==='csrf'?'session':'failed';error.textContent=copy[key];error.hidden=false;if(key==='invalid'){input.setAttribute('aria-invalid','true');input.focus();}}
   finally{busy(false,append);}
  }
  form.addEventListener('submit',function(event){event.preventDefault();search(false);});more.addEventListener('click',function(){search(true);});
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
}());
