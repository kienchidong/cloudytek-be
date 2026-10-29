<?php
/* Smarty version 3.1.33-p1, created on 2026-10-29 13:37:27
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae2e9a755b759_37138201',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd092d750900cf811941d8e7890e832d8529d158d' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\footer.tpl',
      1 => 1793255745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae2e9a755b759_37138201 (Smarty_Internal_Template $_smarty_tpl) {
?>
                </div><!-- /.main-content -->

            <div class="clearfix"></div>
        </div>
    </div>
</section>

<section id="footer">
    <div class="container-fluid">
        <a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"copyrightFooterNotice",'year'=>$_smarty_tpl->tpl_vars['date_year']->value,'company'=>$_smarty_tpl->tpl_vars['companyname']->value),$_smarty_tpl ) );?>
</p>
    </div>
</section>

</div><!-- /.admin-main-wrapper -->

<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>
</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body panel-body">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['loading'];?>

            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader" role="status" aria-label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['loading'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <i class="fas fa-circle-notch fa-spin"></i>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>

                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['submit'];?>

                </button>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/generate-password.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<?php echo $_smarty_tpl->tpl_vars['footeroutput']->value;?>


</body>
</html>
<?php }
}
