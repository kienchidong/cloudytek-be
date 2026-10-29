<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 12:21:26
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\viewticket.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad1b456602546_02850478',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0360d769f5a963a2755c93d0abc41452fab48c57' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\viewticket.tpl',
      1 => 1792128076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad1b456602546_02850478 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['invalidTicketId']->value) {?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"danger",'title'=>$_smarty_tpl->tpl_vars['LANG']->value['thereisaproblem'],'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['supportticketinvalid'],'textcenter'=>true), 0, true);
?>

<?php } else { ?>

    <?php if ($_smarty_tpl->tpl_vars['closedticket']->value) {?>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['supportticketclosedmsg'],'textcenter'=>true), 0, true);
?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
?>
    <?php }?>

<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['invalidTicketId']->value) {?>

    <header class="ctk-ticket-summary">
        <a class="ctk-ticket-back" href="supporttickets.php"><i class="fas fa-arrow-left" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavsupporttickets'];?>
</a>
        <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subject']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2>
        <div><span class="status"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['status']->value);?>
</span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketid'];?>
: #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tid']->value, ENT_QUOTES, 'UTF-8', true);?>
</span><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['department']->value, ENT_QUOTES, 'UTF-8', true);?>
</span><span><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketspriority'];?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urgency']->value, ENT_QUOTES, 'UTF-8', true);?>
</span></div>
    </header>

    <div class="panel panel-info visible-print-block">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ticketinfo'];?>

            </h3>
        </div>
        <div class="panel-body container-fluid">
            <div class="row">
                <div class="col-md-2 col-xs-6">
                    <b><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketid'];?>
</b><br /><?php echo $_smarty_tpl->tpl_vars['tid']->value;?>

                </div>
                <div class="col-md-4 col-xs-6">
                    <b><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubject'];?>
</b><br /><?php echo $_smarty_tpl->tpl_vars['subject']->value;?>

                </div>
                <div class="col-md-2 col-xs-6">
                    <b><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketspriority'];?>
</b><br /><?php echo $_smarty_tpl->tpl_vars['urgency']->value;?>

                </div>
                <div class="col-md-4 col-xs-6">
                    <b><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsdepartment'];?>
</b><br /><?php echo $_smarty_tpl->tpl_vars['department']->value;?>

                </div>
            </div>
        </div>
    </div>

    <section class="ctk-support-thread">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ascreplies']->value, 'reply', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['reply']->value) {
?>
        <div class="ticket-reply markdown-content<?php if ($_smarty_tpl->tpl_vars['reply']->value['admin']) {?> staff<?php }?>">
            <div class="date">
                <?php echo $_smarty_tpl->tpl_vars['reply']->value['date'];?>

            </div>
            <div class="user">
                <i class="fas fa-user"></i>
                <span class="name">
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['reply']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                </span>
                <span class="type">
                    <?php if ($_smarty_tpl->tpl_vars['reply']->value['admin']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsstaff'];?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['reply']->value['contactid']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketscontact'];?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['reply']->value['userid']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclient'];?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['reply']->value['email'];?>

                    <?php }?>
                </span>
            </div>
            <div class="message">
                <?php echo $_smarty_tpl->tpl_vars['reply']->value['message'];?>

                <?php if ($_smarty_tpl->tpl_vars['reply']->value['id'] && $_smarty_tpl->tpl_vars['reply']->value['admin'] && $_smarty_tpl->tpl_vars['ratingenabled']->value) {?>
                    <div class="clearfix">
                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['rating']) {?>
                            <div class="rating-done">
                                <?php
$_smarty_tpl->tpl_vars['rating'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['rating']->step = 1;$_smarty_tpl->tpl_vars['rating']->total = (int) ceil(($_smarty_tpl->tpl_vars['rating']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['rating']->step));
if ($_smarty_tpl->tpl_vars['rating']->total > 0) {
for ($_smarty_tpl->tpl_vars['rating']->value = 1, $_smarty_tpl->tpl_vars['rating']->iteration = 1;$_smarty_tpl->tpl_vars['rating']->iteration <= $_smarty_tpl->tpl_vars['rating']->total;$_smarty_tpl->tpl_vars['rating']->value += $_smarty_tpl->tpl_vars['rating']->step, $_smarty_tpl->tpl_vars['rating']->iteration++) {
$_smarty_tpl->tpl_vars['rating']->first = $_smarty_tpl->tpl_vars['rating']->iteration === 1;$_smarty_tpl->tpl_vars['rating']->last = $_smarty_tpl->tpl_vars['rating']->iteration === $_smarty_tpl->tpl_vars['rating']->total;?>
                                    <span class="star<?php if ((5-$_smarty_tpl->tpl_vars['reply']->value['rating']) < $_smarty_tpl->tpl_vars['rating']->value) {?> active<?php }?>"></span>
                                <?php }
}
?>
                                <div class="rated"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ticketreatinggiven'];?>
</div>
                            </div>
                        <?php } else { ?>
                            <div class="rating" ticketid="<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
" ticketkey="<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" ticketreplyid="<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
">
                                <span class="star" rate="5"></span>
                                <span class="star" rate="4"></span>
                                <span class="star" rate="3"></span>
                                <span class="star" rate="2"></span>
                                <span class="star" rate="1"></span>
                            </div>
                        <?php }?>
                    </div>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['reply']->value['attachments']) {?>
                <div class="attachments">
                    <strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketattachments'];?>
 (<?php echo count($_smarty_tpl->tpl_vars['reply']->value['attachments']);?>
)</strong>
                    <?php if ($_smarty_tpl->tpl_vars['reply']->value['attachments_removed']) {?>(<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.attachmentsRemoved'),$_smarty_tpl ) );?>
)<?php }?>
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reply']->value['attachments'], 'attachment', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['attachment']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['reply']->value['attachments_removed']) {?>
                                <li>
                                    <i class="far fa-file-minus"></i>
                                    <?php echo $_smarty_tpl->tpl_vars['attachment']->value;?>

                                </li>
                            <?php } else { ?>
                                <li>
                                    <i class="far fa-file"></i>
                                    <a href="dl.php?type=<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>ar&id=<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>a&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>&i=<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
">
                                        <?php echo $_smarty_tpl->tpl_vars['attachment']->value;?>

                                    </a>
                                </li>
                            <?php }?>

                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>
            <?php }?>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </section>
    <div class="panel panel-info ctk-ticket-composer hidden-print">
        <div class="panel-heading" id="ticketReply">
            <h3 class="panel-title">
                <i class="fas fa-pencil-alt"></i> &nbsp; <?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsreply'];?>

            </h3>
        </div>
        <div class="panel-body">

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?tid=<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
&amp;postreply=true" enctype="multipart/form-data" role="form" id="frmReply">

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="inputName"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientname'];?>
</label>
                        <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
                            <input class="form-control disabled" type="text" id="inputName" value="<?php echo $_smarty_tpl->tpl_vars['clientname']->value;?>
" disabled="disabled" /><?php } else { ?><input class="form-control" type="text" name="replyname" id="inputName" value="<?php echo $_smarty_tpl->tpl_vars['replyname']->value;?>
" />
                        <?php }?>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsclientemail'];?>
</label>
                        <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
                            <input class="form-control disabled" type="text" id="inputEmail" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" disabled="disabled" /><?php } else { ?><input class="form-control" type="text" name="replyemail" id="inputEmail" value="<?php echo $_smarty_tpl->tpl_vars['replyemail']->value;?>
" />
                        <?php }?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputMessage"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['contactmessage'];?>
</label>
                    <textarea name="replymessage" id="inputMessage" rows="5" class="form-control markdown-editor" data-auto-save-name="client_ticket_reply_<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['replymessage']->value;?>
</textarea>
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

                <div class="form-group text-center">
                    <input class="btn btn-primary" type="submit" name="save" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['supportticketsticketsubmit'];?>
" />
                    <input class="btn btn-default" type="reset" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['cancel'];?>
" />
                </div>

            </form>

        </div>
    </div>
<?php }
}
}
