<?php
if (!defined('WHMCS')) { exit; }

function cloudytekProductVietnamese(PDO $db, $id) {
    $q=$db->prepare("SELECT related_type,translation FROM tbldynamic_translations WHERE related_id=? AND language='vietnamese' AND related_type IN ('product.{id}.name','product.{id}.description') ORDER BY id");
    $q->execute(array($id));$result=array('name'=>'','description'=>'');
    foreach($q->fetchAll(PDO::FETCH_ASSOC) as $row)$result[strpos($row['related_type'],'.description')!==false?'description':'name']=$row['translation'];
    return $result;
}

// Native dynamic translations: no shared response cache, no changes to prices or service IDs.
function cloudytekSaveProductLanguages(PDO $db, $id, array $english, array $vietnamese) {
    foreach(array($english,$vietnamese) as $texts){
        foreach(array('name','description') as $field){
            if(!isset($texts[$field])||!is_string($texts[$field]))throw new InvalidArgumentException('Invalid product language fields');
            if(($field==='name' && mb_strlen($texts[$field],'UTF-8')>255)||strlen($texts[$field])>65535)throw new InvalidArgumentException('Product translation is too long');
        }
    }
    $ownsTransaction=!$db->inTransaction();if($ownsTransaction)$db->beginTransaction();
    try{
        $exists=$db->prepare('SELECT id FROM tblproducts WHERE id=?');$exists->execute(array($id));
        if(!$exists->fetchColumn())throw new InvalidArgumentException('Product not found');
        $find=$db->prepare('SELECT id FROM tbldynamic_translations WHERE related_type=? AND related_id=? AND language=? ORDER BY id');
        $delete=$db->prepare('DELETE FROM tbldynamic_translations WHERE related_type=? AND related_id=? AND language=?');
        $insert=$db->prepare('INSERT INTO tbldynamic_translations(related_type,related_id,language,translation,input_type,created_at,updated_at) VALUES(?,?,?,?,?,?,?)');
        $update=$db->prepare('UPDATE tbldynamic_translations SET translation=?,input_type=?,updated_at=? WHERE id=?');
        foreach(array('english'=>$english,'vietnamese'=>$vietnamese) as $language=>$texts){
            foreach(array('name','description') as $field){
                $value=$field==='name'?trim(strip_tags($texts[$field])):str_replace(array("\r\n","\r"),"\n",$texts[$field]);
                $type='product.{id}.'.$field;$key=array($type,(int)$id,$language);
                $find->execute($key);$ids=$find->fetchAll(PDO::FETCH_COLUMN);
                // Missing translations use the native English/base fallback instead of rendering blank.
                if(trim($value)===''){$delete->execute($key);continue;}
                $now=gmdate('Y-m-d H:i:s');$input=$field==='name'?'text':'textarea';
                if($ids){
                    $update->execute(array($value,$input,$now,$ids[0]));
                    if(count($ids)>1){$dedup=$db->prepare('DELETE FROM tbldynamic_translations WHERE related_type=? AND related_id=? AND language=? AND id<>?');$dedup->execute(array_merge($key,array($ids[0])));}
                }else{$insert->execute(array($type,(int)$id,$language,$value,$input,$now,$now));}
            }
        }
        if($ownsTransaction)$db->commit();
    }catch(Throwable $e){if($ownsTransaction && $db->inTransaction())$db->rollBack();throw $e;}
}
