<?php
/* Smarty version 3.1.33-p1, created on 2026-10-30 14:31:41
  from 'C:\Users\Du Pham\Desktop\plan\cloudytek\templates\kinsmen\clientareahome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae447ddec2756_16895446',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9986c04dedf3bf27d964ac8070f042651264d70' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates\\kinsmen\\clientareahome.tpl',
      1 => 1792174672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae447ddec2756_16895446 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'outputHomePanels' => 
  array (
    'compiled_filepath' => 'C:\\Users\\Du Pham\\Desktop\\plan\\cloudytek\\templates_c\\a9986c04dedf3bf27d964ac8070f042651264d70_0.file.clientareahome.tpl.php',
    'uid' => 'a9986c04dedf3bf27d964ac8070f042651264d70',
    'call_name' => 'smarty_template_function_outputHomePanels_10389802046ae447dde558e8_79862178',
  ),
));
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/member-dashboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<div class="tiles clearfix">
    <div class="row">
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=services'">
            <a href="clientarea.php?action=services">
                <div class="icon"><i class="fas fa-cube"></i></div>
                <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['productsnumactive'];?>
</div>
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navservices'];?>
</div>
                <div class="highlight bg-color-blue"></div>
            </a>
        </div>
        <?php if (in_array('domains',$_smarty_tpl->tpl_vars['contactpermissions']->value)) {?>
            <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=domains'">
                <a href="clientarea.php?action=domains"><div class="icon"><i class="fas fa-globe"></i></div><div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivedomains'];?>
</div><div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navdomains'];?>
</div><div class="highlight bg-color-green"></div></a>
            </div>
        <?php } else { ?>
            <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=quotes'"><a href="clientarea.php?action=quotes"><div class="icon"><i class="far fa-file-alt"></i></div><div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numquotes'];?>
</div><div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['quotes'];?>
</div></a></div>
        <?php }?>
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='supporttickets.php'">
            <a href="supporttickets.php">
                <div class="icon"><i class="fas fa-comments"></i></div>
                <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numactivetickets'];?>
</div>
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navtickets'];?>
</div>
                <div class="highlight bg-color-red"></div>
            </a>
        </div>
        <div class="col-sm-3 col-xs-6 tile" onclick="window.location='clientarea.php?action=invoices'">
            <a href="clientarea.php?action=invoices">
                <div class="icon"><i class="fas fa-credit-card"></i></div>
                <div class="stat"><?php echo $_smarty_tpl->tpl_vars['clientsstats']->value['numunpaidinvoices'];?>
</div>
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['navinvoices'];?>
</div>
                <div class="highlight bg-color-gold"></div>
            </a>
        </div>
    </div>
</div>

<form class="member-help-search" role="search" method="post" action="clientarea.php?action=kbsearch">
    <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
    <div class="member-help-search-copy">
        <span class="member-help-search-icon"><i class="fas fa-book-open" aria-hidden="true"></i></span>
        <div><h2><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Bạn cần tìm hướng dẫn?<?php } else { ?>Looking for a guide?<?php }?></h2><p><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Tìm nhanh câu trả lời cho dịch vụ của bạn.<?php } else { ?>Find answers for your services.<?php }?></p></div>
    </div>
    <div class="home-kb-search">
        <label class="sr-only" for="member-kb-query"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
</label>
        <i class="fas fa-search" aria-hidden="true"></i>
        <input id="member-kb-query" type="search" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
" />
        <button type="submit" class="btn btn-primary"><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Tìm kiếm<?php } else { ?>Search<?php }?></button>
    </div>
</form>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons_html']->value, 'addon_html');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['addon_html']->value) {
?>
    <div>
        <?php echo $_smarty_tpl->tpl_vars['addon_html']->value;?>

    </div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<div class="client-home-panels">
            

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panels']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'outputHomePanels', array(), true);?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
/* smarty_template_function_outputHomePanels_10389802046ae447dde558e8_79862178 */
if (!function_exists('smarty_template_function_outputHomePanels_10389802046ae447dde558e8_79862178')) {
function smarty_template_function_outputHomePanels_10389802046ae447dde558e8_79862178(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

                <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['item']->value->getName();?>
" class="panel panel-default member-home-panel panel-accent-<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('color');
if (!$_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?> member-home-panel-empty<?php }
if ($_smarty_tpl->tpl_vars['item']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getClass();
}?>"<?php if ($_smarty_tpl->tpl_vars['item']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['item']->value->getAttribute('id');?>
"<?php }?>>
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link') && $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text')) {?>
                                <div class="pull-right">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-link');?>
" class="btn btn-default bg-color-<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('color');?>
 btn-xs">
                                        <?php if ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Active Products/Services' || $_smarty_tpl->tpl_vars['item']->value->getName() == 'Recent News') {?>
                                            <?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text');?>
<i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        <?php } else { ?>
                                            <?php if ($_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon')) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-icon');?>
" aria-hidden="true"></i><?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['item']->value->getName() == 'Recent Support Tickets') {
if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Gửi yêu cầu<?php } else { ?>New ticket<?php }
} else {
echo $_smarty_tpl->tpl_vars['item']->value->getExtra('btn-text');
}?>
                                        <?php }?>
                                    </a>
                                </div>
                            <?php }?>
                            <span class="member-panel-heading-copy">
                                <?php if ($_smarty_tpl->tpl_vars['item']->value->hasIcon()) {?><span class="member-panel-icon"><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value->getIcon();?>
" aria-hidden="true"></i></span><?php }?>
                                <span class="member-panel-label"><?php echo $_smarty_tpl->tpl_vars['item']->value->getLabel();?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['item']->value->hasBadge()) {?><span class="badge"><?php echo $_smarty_tpl->tpl_vars['item']->value->getBadge();?>
</span><?php }?>
                            </span>
                        </h3>
                    </div>
                    <?php if (!$_smarty_tpl->tpl_vars['item']->value->hasChildren() && $_smarty_tpl->tpl_vars['item']->value->getName() == 'Active Products/Services') {?>
                        <div class="panel-body member-dashboard-empty">
                            <span class="member-dashboard-empty-icon"><i class="fas fa-cube" aria-hidden="true"></i></span>
                            <h4><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Chưa có dịch vụ đang hoạt động<?php } else { ?>No active services yet<?php }?></h4>
                            <p><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Chọn dịch vụ phù hợp để bắt đầu sử dụng.<?php } else { ?>Choose a service to get started.<?php }?></p>
                            <a class="member-empty-action" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php"><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Đăng ký dịch vụ<?php } else { ?>Explore services<?php }?><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    <?php } elseif (!$_smarty_tpl->tpl_vars['item']->value->hasChildren() && $_smarty_tpl->tpl_vars['item']->value->getName() == 'Recent Support Tickets') {?>
                        <div class="panel-body member-dashboard-empty">
                            <span class="member-dashboard-empty-icon"><i class="far fa-comments" aria-hidden="true"></i></span>
                            <h4><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Chưa có yêu cầu hỗ trợ<?php } else { ?>No recent support tickets<?php }?></h4>
                            <p><?php if ($_smarty_tpl->tpl_vars['portalLanguage']->value == 'vietnamese') {?>Khi cần trợ giúp, hãy gửi yêu cầu cho chúng tôi.<?php } else { ?>Send us a ticket whenever you need a hand.<?php }?></p>
                        </div>
                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value->hasBodyHtml()) {?>
                        <div class="panel-body">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value->getBodyHtml();?>

                        </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasChildren()) {?>
                        <div class="list-group<?php if ($_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value->getChildrenAttribute('class');
}?>">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item']->value->getChildren(), 'childItem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['childItem']->value) {
?>
                                <?php if ($_smarty_tpl->tpl_vars['childItem']->value->getUri()) {?>
                                    <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getUri();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['childItem']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                                    </a>
                                <?php } else { ?>
                                    <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getName();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['childItem']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getId();?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasIcon()) {?><i class="<?php echo $_smarty_tpl->tpl_vars['childItem']->value->getIcon();?>
"></i>&nbsp;<?php }?>
                                        <?php echo $_smarty_tpl->tpl_vars['childItem']->value->getLabel();?>

                                        <?php if ($_smarty_tpl->tpl_vars['childItem']->value->hasBadge()) {?>&nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['childItem']->value->getBadge();?>
</span><?php }?>
                                    </div>
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value->hasFooterHtml()) {?>
                        <div class="panel-footer">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value->getFooterHtml();?>

                        </div>
                    <?php }?>
                </div>
            <?php
}}
/*/ smarty_template_function_outputHomePanels_10389802046ae447dde558e8_79862178 */
}
