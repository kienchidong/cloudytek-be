(function(){
    'use strict';
    function init(){
        var data=document.getElementById('product-language-data');
        var description=document.querySelector('textarea[name="description"]');
        if(!data||!description||description.dataset.bilingual)return;
        var config=JSON.parse(data.textContent),form=description.form;
        if(!form)return;
        description.dataset.bilingual='true';
        function pair(field,value,isDescription){
            if(!field)return;
            var grid=document.createElement('div');grid.className='product-language-grid';
            field.insertAdjacentElement('beforebegin',grid);
            var english=document.createElement('label');english.textContent='English';
            english.appendChild(field);
            var vietnamese=document.createElement('label');vietnamese.textContent='Tiếng Việt';
            var translated=document.createElement(isDescription?'textarea':'input');
            translated.className='form-control';translated.name=isDescription?'ctk_product_vi_description':'ctk_product_vi_name';
            translated.value=value||'';translated.disabled=!config.canEdit;
            if(isDescription){field.rows=10;translated.rows=10;}else{translated.type='text';translated.maxLength=255;}
            vietnamese.appendChild(translated);grid.append(english,vietnamese);
            var cell=grid.closest('td');
            if(cell)cell.querySelectorAll('.btn-translate').forEach(function(link){link.remove();});
            if(isDescription && cell){
                var oldColumn=grid.closest('.col-sm-7');
                if(oldColumn){oldColumn.style.width='100%';var help=oldColumn.parentElement.querySelector('.col-sm-5');if(help)help.hidden=true;}
                var hint=document.createElement('p');hint.className='product-language-hint';
                hint.textContent='One specification per line (CPU: 2 Core). Vietnamese fields left blank use the English content. Save using Save Changes below.';
                grid.insertAdjacentElement('afterend',hint);
            }
        }
        pair(form.querySelector('input[name="name"]'),config.name,false);
        pair(description,config.description,true);
        var marker=document.createElement('input');marker.type='hidden';marker.name='ctk_product_i18n';marker.value='1';form.appendChild(marker);
    }
    if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
}());
