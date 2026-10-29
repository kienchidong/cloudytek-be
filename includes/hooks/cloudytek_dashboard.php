<?php
if(!defined('WHMCS'))exit;
// Format only the news already selected by the native homepage panel.
add_hook('ClientAreaHomepagePanels',40,function($panels){
    $news=$panels->getChild('Recent News');if(!$news)return;
    $children=array();foreach($news->getChildren()as$child){
        $uri=(string)$child->getUri();$id=0;
        if(preg_match('~/announcements/([0-9]+)(?:/|$)~',$uri,$m))$id=(int)$m[1];
        elseif(preg_match('~(?:\?|&)id=([0-9]+)~',$uri,$m))$id=(int)$m[1];
        if($id)$children[$id][]=$child;
    }
    if(!$children)return;
    $rows=WHMCS\Database\Capsule::table('tblannouncements')->whereIn('id',array_keys($children))->get(array('id','date'));
    foreach($rows as$row)foreach($children[$row->id]as$child){
        $title=preg_split('~<br\s*/?>~i',(string)$child->getLabel(),2)[0];
        $title=htmlspecialchars(html_entity_decode(strip_tags($title),ENT_QUOTES,'UTF-8'),ENT_QUOTES,'UTF-8');
        $time=strtotime($row->date);if(!$time)continue;
        $date=Lang::getName()==='vietnamese'?date('d/m/Y',$time):date('M j, Y',$time);
        $child->setLabel('<span class="member-news-copy"><span class="member-news-title">'.$title.'</span><span class="member-news-date"><i class="far fa-calendar-alt" aria-hidden="true"></i><time datetime="'.date('Y-m-d',$time).'">'.$date.'</time></span></span><i class="fas fa-chevron-right member-news-arrow" aria-hidden="true"></i>');
    }
});
