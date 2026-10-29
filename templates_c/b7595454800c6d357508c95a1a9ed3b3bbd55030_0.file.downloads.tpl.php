<?php
/* Smarty version 3.1.33-p1, created on 2026-10-14 07:49:59
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\downloads.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6aced1b75ab749_56434132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7595454800c6d357508c95a1a9ed3b3bbd55030' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\downloads.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6aced1b75ab749_56434132 (Smarty_Internal_Template $_smarty_tpl) {
if (empty($_smarty_tpl->tpl_vars['dlcats']->value)) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'],'textcenter'=>true), 0, true);
} else { ?>
    <form role="form" method="post" action="<?php echo routePath('download-search');?>
">
        <div class="input-group input-group-lg kb-search margin-bottom">
            <input type="text" name="search" id="inputDownloadsSearch" class="form-control" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadssearch'];?>
" />
            <span class="input-group-btn">
                <input type="submit" id="btnDownloadsSearch" class="btn btn-primary btn-input-padded-responsive" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['search'];?>
" />
            </span>
        </div>
    </form>

    <p><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsintrotext'];?>
</p>

    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadscategories'];?>
</h2>

    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dlcats']->value, 'dlcat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dlcat']->value) {
?>
            <div class="col-sm-6">
                <a href="<?php echo routePath('download-by-cat',$_smarty_tpl->tpl_vars['dlcat']->value['id'],$_smarty_tpl->tpl_vars['dlcat']->value['urlfriendlyname']);?>
">
                    <i class="far fa-folder-open"></i>
                    <strong><?php echo $_smarty_tpl->tpl_vars['dlcat']->value['name'];?>
</strong>
                </a>
                (<?php echo $_smarty_tpl->tpl_vars['dlcat']->value['numarticles'];?>
)
                <br>
                <?php echo $_smarty_tpl->tpl_vars['dlcat']->value['description'];?>

            </div>
        <?php
}
} else {
?>
            <div class="col-sm-12">
                <p class="text-center fontsize3"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'];?>
</p>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadspopular'];?>
</h2>

    <div class="list-group">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mostdownloads']->value, 'download');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['download']->value) {
?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['download']->value['link'];?>
" class="list-group-item">
                <strong>
                    <i class="fas fa-download"></i>
                    <?php echo $_smarty_tpl->tpl_vars['download']->value['title'];?>

                    <?php if ($_smarty_tpl->tpl_vars['download']->value['clientsonly']) {?>
                        <i class="fas fa-lock text-muted"></i>
                    <?php }?>
                </strong>
                <br>
                <?php echo $_smarty_tpl->tpl_vars['download']->value['description'];?>

                <br>
                <small><?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsfilesize'];?>
: <?php echo $_smarty_tpl->tpl_vars['download']->value['filesize'];?>
</small>
            </a>
        <?php
}
} else {
?>
            <span class="list-group-item text-center">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['downloadsnone'];?>

            </span>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php }
}
}
