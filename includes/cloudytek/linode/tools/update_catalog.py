"""Refresh the Linode catalogue from the official OpenAPI repository."""
import hashlib, json, os, pathlib, urllib.request
from datetime import datetime, timezone

root = pathlib.Path(__file__).resolve().parents[1] / 'resources'
url = 'https://raw.githubusercontent.com/linode/linode-api-openapi/main/openapi.json'
raw = urllib.request.urlopen(url, timeout=45).read(40_000_001)
if len(raw)>40_000_000:
    raise ValueError('OpenAPI snapshot exceeds 40 MB')
spec = json.loads(raw)

def trim(value):
    if isinstance(value, list): return [trim(v) for v in value]
    if isinstance(value, dict):
        return {k:trim(v) for k,v in value.items() if not k.startswith('x-') and k not in ('description','example','examples','externalDocs')}
    return value

operations = {}
for path,item in spec['paths'].items():
    for method,op in item.items():
        if method not in ('get','post','put','patch','delete','head','options'): continue
        oid=op['operationId']
        if oid in operations: raise ValueError('Duplicate operation ID')
        if not path.startswith('/{apiVersion}/'): raise ValueError('Unexpected API base path')
        operations[oid]={'id':oid,'method':method.upper(),'path':path,'title':op.get('summary',oid),
            'tags':op.get('tags',[]),'deprecated':op.get('deprecated',False),
            'parameters':trim(item.get('parameters',[])+op.get('parameters',[])),
            'body':trim(op.get('requestBody',{})),'security':op.get('security',[])}
catalog={'version':spec['info']['version'],'operations':operations,'components':trim(spec['components'])}
metadata={'url':url,'downloaded':datetime.now(timezone.utc).isoformat(),'sha256':hashlib.sha256(raw).hexdigest(),'info':spec['info'],'servers':spec['servers']}
for name,value in [('openapi.json',raw),('catalog.json',json.dumps(catalog,ensure_ascii=False,separators=(',',':')).encode()),('OPENAPI-SOURCE.json',json.dumps(metadata,indent=2).encode())]:
    temp=root/(name+'.tmp'); temp.write_bytes(value); os.replace(temp,root/name)
print(f"Installed {len(operations)} operations from API {catalog['version']}. Run regression tests before release.")
