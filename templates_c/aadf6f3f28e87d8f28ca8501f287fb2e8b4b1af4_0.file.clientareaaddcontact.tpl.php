<?php
/* Smarty version 3.1.33-p1, created on 2026-10-15 22:57:13
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareaaddcontact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad0f7d90f2159_02916932',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aadf6f3f28e87d8f28ca8501f287fb2e8b4b1af4' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareaaddcontact.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad0f7d90f2159_02916932 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
}?>

<?php echo '<script'; ?>
>
var stateNotRequired = true;
    jQuery(document).ready(function() {
    WHMCS.form.register();
});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/StatesDropdown.js"><?php echo '</script'; ?>
>

<div class="alert alert-block alert-info">
    <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=contacts">
        <div class="row">
            <label for="inputContactId" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareachoosecontact'];?>
</label>
            <div class="col-sm-6">
                <select name="contactid" id="inputContactId" onchange="submit()" class="form-control">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contacts']->value, 'contact');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['contact']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['contact']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['contact']->value['email'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <option value="new" selected="selected"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavaddcontact'];?>
</option>
                </select>
            </div>
            <div class="col-sm-2 hidden-xs">
                <button type="submit" class="btn btn-default btn-block"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['go'];?>
</button>
            </div>
        </div>
    </form>
</div>

<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=addcontact">
    <input type="hidden" name="submit" value="true" />

    <div class="row">
        <div class="col-sm-6">

            <div class="form-group">
                <label for="inputFirstName" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareafirstname'];?>
</label>
                <input type="text" name="firstname" id="inputFirstName" value="<?php echo $_smarty_tpl->tpl_vars['contactfirstname']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputLastName" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientarealastname'];?>
</label>
                <input type="text" name="lastname" id="inputLastName" value="<?php echo $_smarty_tpl->tpl_vars['contactlastname']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputCompanyName" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacompanyname'];?>
</label>
                <input type="text" name="companyname" id="inputCompanyName" value="<?php echo $_smarty_tpl->tpl_vars['contactcompanyname']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputEmail" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaemail'];?>
</label>
                <input type="email" name="email" id="inputEmail" value="<?php echo $_smarty_tpl->tpl_vars['contactemail']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputPhone" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaphonenumber'];?>
</label>
                <input type="tel" name="phonenumber" id="inputPhone" value="<?php echo $_smarty_tpl->tpl_vars['contactphonenumber']->value;?>
" class="form-control" />
            </div>

            <?php if ($_smarty_tpl->tpl_vars['showTaxIdField']->value) {?>
                <div class="form-group">
                    <label for="inputTaxId" class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>$_smarty_tpl->tpl_vars['taxIdLabel']->value),$_smarty_tpl ) );?>
</label>
                    <input type="text" name="tax_id" id="inputTaxId" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['contactTaxId']->value;?>
" />
                </div>
            <?php }?>

            <div class="form-group">
                <label class="control-label" for="inputSubaccountActivate"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['subaccountactivate'];?>
</label>
                <div class="controls checkbox">
                    <label><input type="checkbox" name="subaccount" id="inputSubaccountActivate"<?php if ($_smarty_tpl->tpl_vars['subaccount']->value) {?> checked<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['subaccountactivatedesc'];?>
</label>
                </div>
            </div>

        </div>
        <div class="col-sm-6 col-xs-12 pull-right">

            <div class="form-group">
                <label for="inputAddress1" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress1'];?>
</label>
                <input type="text" name="address1" id="inputAddress1" value="<?php echo $_smarty_tpl->tpl_vars['contactaddress1']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputAddress2" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaaddress2'];?>
</label>
                <input type="text" name="address2" id="inputAddress2" value="<?php echo $_smarty_tpl->tpl_vars['contactaddress2']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputCity" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacity'];?>
</label>
                <input type="text" name="city" id="inputCity" value="<?php echo $_smarty_tpl->tpl_vars['contactcity']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputState" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareastate'];?>
</label>
                <input type="text" name="state" id="inputState" value="<?php echo $_smarty_tpl->tpl_vars['contactstate']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputPostcode" class="control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapostcode'];?>
</label>
                <input type="text" name="postcode" id="inputPostcode" value="<?php echo $_smarty_tpl->tpl_vars['contactpostcode']->value;?>
" class="form-control" />
            </div>

            <div class="form-group">
                <label class="control-label" for="country"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacountry'];?>
</label>
                <?php echo $_smarty_tpl->tpl_vars['countriesdropdown']->value;?>

            </div>

        </div>
    </div>

    <div id="subacct-container" class="well<?php if (!$_smarty_tpl->tpl_vars['subaccount']->value) {?> hidden<?php }?>">

        <div class="form-group">
            <label class="full control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['subaccountpermissions'];?>
</label>
            <div class="checkbox clearfix" id="contactPermissions">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allPermissions']->value, 'permission');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['permission']->value) {
?>
                    <div class="col-sm-6">
                        <label>
                            <input type="checkbox" name="permissions[]" value="<?php echo $_smarty_tpl->tpl_vars['permission']->value;?>
"<?php if (in_array($_smarty_tpl->tpl_vars['permission']->value,$_smarty_tpl->tpl_vars['permissions']->value)) {?> checked<?php }?> />
                            <span>
                                <?php $_smarty_tpl->_assignInScope('langPermission', ('subaccountperms').($_smarty_tpl->tpl_vars['permission']->value));
echo $_smarty_tpl->tpl_vars['LANG']->value[$_smarty_tpl->tpl_vars['langPermission']->value];?>

                            </span>
                        </label>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-check-all" data-checkbox-container="contactPermissions" data-btn-check-toggle="1" id="btnSelectAll-contactPermissions" data-label-text-select="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'checkAll'),$_smarty_tpl ) );?>
" data-label-text-deselect="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'uncheckAll'),$_smarty_tpl ) );?>
">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'checkAll'),$_smarty_tpl ) );?>

                    </button>
                </div>
            </div>
        </div>
        <fieldset class="form-horizontal">
            <div id="newPassword1" class="form-group has-feedback">
                <label for="inputNewPassword1" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['newpassword'];?>
</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="inputNewPassword1" name="password" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/pwstrength.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('noDisable'=>true), 0, true);
?>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-default generate-password" data-targetfields="inputNewPassword1,inputNewPassword2">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['btnLabel'];?>

                    </button>
                </div>
            </div>
            <div id="newPassword2" class="form-group has-feedback">
                <label for="inputNewPassword2" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['confirmnewpassword'];?>
</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="inputNewPassword2" name="password2" autocomplete="off" />
                    <span class="form-control-feedback glyphicon"></span>
                    <div id="inputNewPassword2Msg">
                    </div>
                </div>
            </div>
        </fieldset>

    </div>

    <div class="form-group">
        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemails'];?>
</h3>
        <div class="controls checkbox">
            <label>
                <input type="checkbox" name="generalemails" id="generalemails" value="1"<?php if ($_smarty_tpl->tpl_vars['generalemails']->value) {?> checked<?php }?> />
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemailsgeneral'];?>

            </label>
            <br />
            <label>
                <input type="checkbox" name="productemails" id="productemails" value="1"<?php if ($_smarty_tpl->tpl_vars['productemails']->value) {?> checked<?php }?> />
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemailsproduct'];?>

            </label>
            <br />
            <label>
                <input type="checkbox" name="domainemails" id="domainemails" value="1"<?php if ($_smarty_tpl->tpl_vars['domainemails']->value) {?> checked<?php }?> />
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemailsdomain'];?>

            </label>
            <br />
            <label>
                <input type="checkbox" name="invoiceemails" id="invoiceemails" value="1"<?php if ($_smarty_tpl->tpl_vars['invoiceemails']->value) {?> checked<?php }?> />
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemailsinvoice'];?>

            </label>
            <br />
            <label>
                <input type="checkbox" name="supportemails" id="supportemails" value="1"<?php if ($_smarty_tpl->tpl_vars['supportemails']->value) {?> checked<?php }?> />
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareacontactsemailssupport'];?>

            </label>
        </div>
    </div>

    <div class="form-group text-center">
        <input class="btn btn-primary" type="submit" name="save" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasavechanges'];?>
" />
        <input class="btn btn-default" type="reset" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['cancel'];?>
" />
    </div>

</form>
<?php }
}
