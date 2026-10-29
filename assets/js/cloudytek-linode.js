document.addEventListener('DOMContentLoaded', function () {
    var account = document.getElementById('ctk-account-form');
    if (account) account.elements.api_version.addEventListener('change', function () {
        account.elements.api_url.value = 'https://api.linode.com/' + this.value;
    });
    var select = document.getElementById('ctk-operation');
    if (!select) return;
    var catalog = window.ctkLinodeCatalog, form = document.getElementById('ctk-api-form');
    var options = Array.prototype.map.call(select.options, function(o) { return {value:o.value,text:o.text}; });
    function update() {
        var op = catalog[select.value]; if (!op) return;
        var path = {};
        (op.path.match(/\{([^}]+)\}/g) || []).forEach(function(p) {
            var name = p.slice(1,-1); if (name !== 'apiVersion') path[name] = '';
        });
        form.elements.path.value = JSON.stringify(path,null,2);
        var encodings=Object.keys(op.body.content || {});
        form.elements.encoding.value=encodings.indexOf('application/json')!==-1?'application/json':(encodings[0]||'application/json');
        document.querySelector('.ctk-operation-help').textContent = op.id + ' · ' + op.tags.join(', ') + (op.deprecated ? ' · Deprecated' : '') + ' · Provider permissions apply';
        document.getElementById('ctk-schema').textContent = JSON.stringify({parameters:op.parameters,requestBody:op.body,security:op.security},null,2);
        form.elements.confirm.value = '';
    }
    document.getElementById('ctk-operation-filter').addEventListener('input',function() {
        var value=this.value.toLowerCase(); select.textContent='';
        options.filter(function(o){return (o.text+' '+o.value).toLowerCase().indexOf(value)!==-1;}).forEach(function(o){select.add(new Option(o.text,o.value));}); update();
    });
    select.addEventListener('change',update); update();
});
