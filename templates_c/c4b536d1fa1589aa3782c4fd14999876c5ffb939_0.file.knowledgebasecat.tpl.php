<?php
/* Smarty version 3.1.33-p1, created on 2026-10-17 01:18:38
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\knowledgebasecat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad26a7eb39d63_52351028',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4b536d1fa1589aa3782c4fd14999876c5ffb939' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\knowledgebasecat.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad26a7eb39d63_52351028 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\DuPham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<form role="form" method="post" action="<?php echo routePath('knowledgebase-search');?>
">
    <div class="input-group input-group-lg kb-search">
        <input type="text"  id="inputKnowledgebaseSearch" name="search" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientHomeSearchKb'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['searchterm']->value;?>
" />
        <span class="input-group-btn">
            <input type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
" />
        </span>
    </div>
</form>

<?php if ($_smarty_tpl->tpl_vars['kbcats']->value) {?>
    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasecategories'];?>
</h2>

    <div class="row kbcategories">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbcats']->value, 'kbcat', false, NULL, 'kbasecats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbcat']->value) {
?>
            <div class="col-sm-4">
                <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['kbcat']->value['id'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['kbcat']->value['urlfriendlyname'];
$_prefixVariable2 = ob_get_clean();
echo routePath('knowledgebase-category-view',$_prefixVariable1,$_prefixVariable2);?>
">
                    <span class="glyphicon glyphicon-folder-close"></span> <?php echo $_smarty_tpl->tpl_vars['kbcat']->value['name'];?>
 <span class="badge badge-info"><?php echo $_smarty_tpl->tpl_vars['kbcat']->value['numarticles'];?>
</span>
                </a>
                <?php if ($_smarty_tpl->tpl_vars['kbcat']->value['editLink']) {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['kbcat']->value['editLink'];?>
" class="admin-inline-edit">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                    </a>
                <?php }?>
                <p><?php echo $_smarty_tpl->tpl_vars['kbcat']->value['description'];?>
</p>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['kbarticles']->value || !$_smarty_tpl->tpl_vars['kbcats']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['tag']->value) {?>
        <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['kbviewingarticlestagged'];?>
 '<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
'</h2>
    <?php } else { ?>
        <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['knowledgebasearticles'];?>
</h2>
    <?php }?>

    <div class="kbarticles">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbarticles']->value, 'kbarticle');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbarticle']->value) {
?>
            <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];
$_prefixVariable3 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['urlfriendlytitle'];
$_prefixVariable4 = ob_get_clean();
echo routePath('knowledgebase-article-view',$_prefixVariable3,$_prefixVariable4);?>
">
                <span class="glyphicon glyphicon-file"></span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['title'];?>

            </a>
            <?php if ($_smarty_tpl->tpl_vars['kbarticle']->value['editLink']) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['editLink'];?>
" class="admin-inline-edit">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['edit'];?>

                </a>
            <?php }?>
            <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['kbarticle']->value['article'],100,"...");?>
</p>
        <?php
}
} else {
?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['knowledgebasenoarticles'],'textcenter'=>true), 0, true);
?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php }
}
}
