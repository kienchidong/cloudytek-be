<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 12:21:24
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\supportticketsubmit-steptwo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad1b4546f3228_76821747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3a8fd7c015831ba7470e6985dd807dbdc9b06ae' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\supportticketsubmit-steptwo.tpl',
      1 => 1792128076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad1b4546f3228_76821747 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
}?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?step=3" enctype="multipart/form-data" role="form" class="ctk-ticket-create">

    <a class="ctk-ticket-back" href="supporttickets.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavsupporttickets'];?>
</a>
    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalTicketRequester'];?>
</h2>

    <div class="row">
        <div class="form-group col-sm-6">
            <label for="inputName"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientname'];?>
</label>
            <input type="text" name="name" id="inputName" value="<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {
echo $_smarty_tpl->tpl_vars['clientname']->value;
} else {
echo $_smarty_tpl->tpl_vars['name']->value;
}?>" class="form-control<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled<?php }?>"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled="disabled"<?php }?> />
        </div>
        <div class="form-group col-sm-6">
            <label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientemail'];?>
</label>
            <input type="email" name="email" id="inputEmail" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" class="form-control<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled<?php }?>"<?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> disabled="disabled"<?php }?> />
        </div>
    </div>
    <h2><?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalTicketDetails'];?>
</h2>
    <div class="row">
        <div class="form-group col-sm-12">
            <label for="inputSubject"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubject'];?>
</label>
            <input type="text" name="subject" id="inputSubject" value="<?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
" class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="form-group <?php if ($_smarty_tpl->tpl_vars['relatedservices']->value) {?>col-sm-4<?php } else { ?>col-sm-6<?php }?>">
            <label for="inputDepartment"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsdepartment'];?>
</label>
            <select name="deptid" id="inputDepartment" class="form-control" onchange="refreshCustomFields(this)">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['department']->value['id'] == $_smarty_tpl->tpl_vars['deptid']->value) {?> selected="selected"<?php }?>>
                        <?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>

                    </option>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['relatedservices']->value) {?>
            <div class="form-group col-sm-4">
                <label for="inputRelatedService"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['relatedservice'];?>
</label>
                <select name="relatedservice" id="inputRelatedService" class="form-control">
                    <option value=""><?php echo $_smarty_tpl->tpl_vars['LANG']->value['none'];?>
</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['relatedservices']->value, 'relatedservice');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['relatedservice']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['id'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['status'];?>
)
                        </option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        <?php }?>
        <div class="form-group <?php if ($_smarty_tpl->tpl_vars['relatedservices']->value) {?>col-sm-4<?php } else { ?>col-sm-6<?php }?>">
            <label for="inputPriority"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketspriority'];?>
</label>
            <select name="urgency" id="inputPriority" class="form-control">
                <option value="High"<?php if ($_smarty_tpl->tpl_vars['urgency']->value == "High") {?> selected="selected"<?php }?>>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketurgencyhigh'];?>

                </option>
                <option value="Medium"<?php if ($_smarty_tpl->tpl_vars['urgency']->value == "Medium" || !$_smarty_tpl->tpl_vars['urgency']->value) {?> selected="selected"<?php }?>>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketurgencymedium'];?>

                </option>
                <option value="Low"<?php if ($_smarty_tpl->tpl_vars['urgency']->value == "Low") {?> selected="selected"<?php }?>>
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketurgencylow'];?>

                </option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputMessage"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactmessage'];?>
</label>
        <textarea name="message" id="inputMessage" rows="12" class="form-control markdown-editor" data-auto-save-name="client_ticket_open"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</textarea>
    </div>

    <div class="ctk-ticket-help"><i class="fas fa-paperclip" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['portalTicketAttachmentHint'];?>
</div>
    <div class="row form-group">
        <div class="col-sm-12">
            <label for="inputAttachments"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketattachments'];?>
</label>
        </div>
        <div class="col-sm-9">
            <input type="file" name="attachments[]" id="inputAttachments" class="form-control" />
            <div id="fileUploadsContainer"></div>
        </div>
        <div class="col-sm-3">
            <button type="button" class="btn btn-default btn-block" onclick="extraTicketAttachment()">
                <i class="fas fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['addmore'];?>

            </button>
        </div>
        <div class="col-xs-12 ticket-attachments-message text-muted">
            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsallowedextensions'];?>
: <?php echo $_smarty_tpl->tpl_vars['allowedfiletypes']->value;?>

        </div>
    </div>

    <div id="customFieldsContainer">
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/supportticketsubmit-customfields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>

    <div id="autoAnswerSuggestions" class="well hidden"></div>

    <div class="text-center margin-bottom">
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>

    <p class="text-center">
        <input type="submit" id="openTicketSubmit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubmit'];?>
" class="btn btn-primary<?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" />
        <a href="supporttickets.php" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['cancel'];?>
</a>
    </p>

</form>

<?php if ($_smarty_tpl->tpl_vars['kbsuggestions']->value) {?>
    <?php echo '<script'; ?>
>
        jQuery(document).ready(function() {
            getTicketSuggestions();
        });
    <?php echo '</script'; ?>
>
<?php }
}
}
