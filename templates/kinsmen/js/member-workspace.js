(function(){
 'use strict';
 function init(){
  var current=new URL(location.href);
  document.querySelectorAll('.member-nav-link,.member-account-tabs>a').forEach(function(link){
   var url=new URL(link.href,location.href);
   var ticketPage=/\/(viewticket|submitticket)\.php$/.test(current.pathname)&&/\/supporttickets\.php$/.test(url.pathname);
   if(ticketPage||(url.pathname===current.pathname&&(url.searchParams.get('action')||'')===(current.searchParams.get('action')||''))){
    if((url.searchParams.get('rp')||'')!==(current.searchParams.get('rp')||''))return;
    link.setAttribute('aria-current','page');
    var more=link.closest('.member-nav-more');if(more)more.open=true;
   }
  });
  document.querySelectorAll('.member-header .dropdown-toggle').forEach(function(button){
   if(window.jQuery)jQuery(button).parent().on('shown.bs.dropdown hidden.bs.dropdown',function(){button.setAttribute('aria-expanded',this.classList.contains('open')?'true':'false');});
  });
  if(window.jQuery)jQuery(function(){
   function tidyPageTools(){
    document.querySelectorAll('.member-page-tools').forEach(function(tools){
     tools.querySelectorAll('.panel').forEach(function(panel){
      var content=panel.querySelectorAll('.panel-body,.list-group,.panel-footer');
      var useful=Array.from(content).some(function(node){return node.textContent.trim()||node.querySelector('input,select,textarea,button,img');});
      if(!useful)panel.remove();
     });
     tools.hidden=!tools.querySelector('.panel');
    });
   }
   tidyPageTools();
   document.querySelectorAll('.dataTables_wrapper').forEach(function(wrapper){
    if(wrapper.querySelector('.member-table-footer'))return;
    var tableNode=wrapper.querySelector('table.dataTable');
    if(!tableNode)return;
    var table=jQuery(tableNode).DataTable();
    if(tableNode.id==='tableDomainsList'){
     var openMenu=null,menuButton=null,menuHome=null;
     function closeRowMenu(restoreFocus){
      if(!openMenu)return;
      openMenu.hidden=true;menuHome.appendChild(openMenu);menuButton.setAttribute('aria-expanded','false');
      if(restoreFocus)menuButton.focus();
      openMenu=null;menuButton=null;menuHome=null;
     }
     function placeRowMenu(){
      if(!openMenu)return;
      var rect=menuButton.getBoundingClientRect(),width=openMenu.offsetWidth,height=openMenu.offsetHeight;
      openMenu.style.left=Math.max(12,Math.min(rect.right-width,window.innerWidth-width-12))+'px';
      var top=rect.bottom+6;
      if(top+height>window.innerHeight-12)top=rect.top-height-6;
      openMenu.style.top=Math.max(12,top)+'px';
     }
     tableNode.addEventListener('click',function(event){
      var button=event.target.closest('.member-row-menu-trigger');if(!button)return;
      event.preventDefault();event.stopPropagation();
      var same=button===menuButton;closeRowMenu(false);if(same)return;
      var menu=document.getElementById(button.getAttribute('aria-controls'));if(!menu)return;
      menuButton=button;openMenu=menu;menuHome=menu.parentNode;
      document.body.appendChild(menu);menu.hidden=false;button.setAttribute('aria-expanded','true');
      placeRowMenu();
      var first=menu.querySelector('a');if(first)first.focus({preventScroll:true});
     },true);
     document.addEventListener('click',function(event){if(openMenu&&!openMenu.contains(event.target)&&!menuButton.contains(event.target))closeRowMenu(false);});
     document.addEventListener('keydown',function(event){
      if(!openMenu)return;
      if(event.key==='Escape'){event.preventDefault();closeRowMenu(true);}
      else if(event.key==='ArrowDown'||event.key==='ArrowUp'){
       var links=Array.from(openMenu.querySelectorAll('a')),index=links.indexOf(document.activeElement);
       event.preventDefault();links[(index+(event.key==='ArrowDown'?1:links.length-1))%links.length].focus();
      }
     });
     document.addEventListener('focusin',function(event){if(openMenu&&!openMenu.contains(event.target)&&event.target!==menuButton)closeRowMenu(false);});
     window.addEventListener('resize',function(){closeRowMenu(false);});
     document.addEventListener('scroll',function(event){if(openMenu&&!openMenu.contains(event.target))placeRowMenu();},true);
     jQuery(tableNode).on('preDraw.dt.memberRowMenu',function(){closeRowMenu(false);});
    }
    var scroll=document.createElement('div');scroll.className='member-table-scroll';
    scroll.setAttribute('role','region');scroll.setAttribute('aria-label',document.documentElement.lang==='vi'?'Bảng dữ liệu':'Data table');scroll.tabIndex=0;
    tableNode.parentNode.insertBefore(scroll,tableNode);scroll.appendChild(tableNode);
    var vi=document.documentElement.lang==='vi';
    var toolbar=document.createElement('div');toolbar.className='member-table-toolbar';
    wrapper.insertBefore(toolbar,wrapper.firstChild);
    var nativeFilter=document.querySelector('.member-page-tools .view-filter-btns');
    if(nativeFilter){
     var panel=nativeFilter.closest('.panel')||nativeFilter;
     var picker=document.createElement('details');picker.className='member-status-filter';
     var summary=document.createElement('summary');
     var filterIcon=document.createElement('i');filterIcon.className='fas fa-sliders-h';filterIcon.setAttribute('aria-hidden','true');
     var filterLabel=document.createElement('span');filterLabel.textContent=vi?'Trạng thái':'Status';
     var caret=document.createElement('i');caret.className='fas fa-chevron-down';caret.setAttribute('aria-hidden','true');
     summary.appendChild(filterIcon);summary.appendChild(filterLabel);summary.appendChild(caret);
     picker.appendChild(summary);picker.appendChild(panel);toolbar.appendChild(picker);
     panel.classList.add('member-status-options');
     function syncFilter(){
      var active=panel.querySelector('a.active');
      if(active){var copy=active.cloneNode(true);copy.querySelectorAll('.badge,i').forEach(function(node){node.remove();});filterLabel.textContent=copy.textContent.trim();}
      else filterLabel.textContent=vi?'Trạng thái':'Status';
      summary.classList.toggle('has-selection',!!active);
     }
     picker.addEventListener('toggle',function(){var container=wrapper.closest('.table-container');if(container)container.classList.toggle('member-filter-open',!!toolbar.querySelector('details[open]'));});
     panel.addEventListener('click',function(event){if(event.target.closest('a'))setTimeout(function(){syncFilter();picker.open=false;summary.focus();},0);});
     document.addEventListener('click',function(event){if(!picker.contains(event.target))picker.open=false;});
     picker.addEventListener('keydown',function(event){if(event.key==='Escape'){picker.open=false;summary.focus();}});
     jQuery(tableNode).on('draw.dt.memberFilter',syncFilter);syncFilter();tidyPageTools();
    }
    var remainingTools=document.querySelector('.member-page-tools:not([hidden])');
    if(remainingTools)remainingTools.remove();
    var filter=wrapper.querySelector('.dataTables_filter');if(filter)toolbar.appendChild(filter);
    if(tableNode.id==='tableTicketsList'){
     var ticketActions=document.querySelector('.member-ticket-actions');if(ticketActions)toolbar.appendChild(ticketActions);
    }
    var controls=document.createElement('div');controls.className='member-table-controls';
    Array.from(toolbar.children).forEach(function(node){if(!node.classList.contains('member-ticket-actions'))controls.appendChild(node);});
    toolbar.insertBefore(controls,toolbar.firstChild);
    var footer=document.createElement('div');footer.className='member-table-footer';
    ['.dataTables_info','.dataTables_length','.dataTables_paginate'].forEach(function(selector){var node=wrapper.querySelector(selector);if(node)footer.appendChild(node);});
    wrapper.appendChild(footer);
    var pageSummary=document.createElement('span');pageSummary.className='member-page-summary';
    var paginate=footer.querySelector('.dataTables_paginate');if(paginate)footer.insertBefore(pageSummary,paginate);
    var search=wrapper.querySelector('.dataTables_filter input');
    if(search){var label=document.documentElement.lang==='vi'?'Tìm kiếm…':'Search…';search.placeholder=label;search.setAttribute('aria-label',label);}
    function updateTable(){
     var info=table.page.info();
     scroll.classList.toggle('member-scroll-empty',info.recordsDisplay===0);
     footer.classList.toggle('member-table-empty',info.recordsTotal===0);
     pageSummary.textContent=(vi?'Trang ':'Page ')+(info.pages?info.page+1:0)+' / '+info.pages;
     wrapper.querySelectorAll('.paginate_button.previous a,.paginate_button.next a,.paginate_button.first a,.paginate_button.last a').forEach(function(link){
      link.setAttribute('aria-label',link.textContent.trim());link.title=link.textContent.trim();
     });
     wrapper.querySelectorAll('td.dataTables_empty').forEach(function(cell){
      var empty=document.createElement('div');empty.className='member-empty-state';
      var icon=document.createElement('i');icon.className='fas fa-inbox';icon.setAttribute('aria-hidden','true');
      var title=document.createElement('strong');title.textContent=info.recordsTotal?(vi?'Không tìm thấy kết quả':'No matching results'):(vi?'Chưa có dữ liệu':'No records yet');
      var hint=document.createElement('span');hint.textContent=info.recordsTotal?(vi?'Thử từ khóa khác hoặc thay đổi bộ lọc.':'Try another search or change your filters.'):(vi?'Danh sách này hiện chưa có bản ghi nào.':'There are no records in this list yet.');
      empty.appendChild(icon);empty.appendChild(title);empty.appendChild(hint);cell.textContent='';cell.appendChild(empty);
     });
    }
    jQuery(tableNode).on('draw.dt.memberTable',updateTable);updateTable();
   });
  });
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
}());
