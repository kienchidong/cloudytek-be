<?php
/* Smarty version 3.1.33-p1, created on 2026-10-16 12:27:32
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\admin\templates\cloudlinkd\viewticket.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ad1b5c4c4f3a7_55734637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd46c07fff0322a821577d419a0f390004c3bea4e' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\admin\\templates\\cloudlinkd\\viewticket.tpl',
      1 => 1792128436,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ad1b5c4c4f3a7_55734637 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['infobox']->value;?>


<h2 class="pull-left">
    #<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['subject']->value;?>

    <select name="ticketstatus" id="ticketstatus" class="form-control select-inline">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statuses']->value, 'statusitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['statusitem']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
"<?php if ($_smarty_tpl->tpl_vars['statusitem']->value['title'] == $_smarty_tpl->tpl_vars['status']->value) {?> selected<?php }?> style="color:<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['color'];?>
"><?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
</option>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>
    <a href="supporttickets.php#" onclick="$('#ticketstatus').val('Closed');$('#ticketstatus').trigger('change');return false"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['close'];?>
</a>
    <a href="#ctkTicketComposer" class="btn btn-primary ctk-admin-jump-reply"><i class="fas fa-reply" aria-hidden="true"></i> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addreply'];?>
</a>
</h2>

<span class="ticketlastreply"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['lastreply'];?>
: <?php echo $_smarty_tpl->tpl_vars['lastreply']->value;?>
</span>
<input type="hidden" id="lastReplyId" value="<?php echo $_smarty_tpl->tpl_vars['lastReplyId']->value;?>
" />
<input type="hidden" id="currentSubject" value="<?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
" />
<input type="hidden" id="currentCc" value="<?php echo $_smarty_tpl->tpl_vars['cc']->value;?>
" />
<input type="hidden" id="currentUserId" value="<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
" />
<input type="hidden" id="currentStatus" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
" />

<div class="clearfix"></div>

<div class="client-notes">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientnotes']->value, 'note');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['note']->value) {
?>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <?php echo $_smarty_tpl->tpl_vars['note']->value['adminuser'];?>

                <div class="pull-right">
                    <?php echo $_smarty_tpl->tpl_vars['note']->value['modified'];?>

                    &nbsp;
                    <a href="clientsnotes.php?userid=<?php echo $_smarty_tpl->tpl_vars['note']->value['userid'];?>
&action=edit&id=<?php echo $_smarty_tpl->tpl_vars['note']->value['id'];?>
" class="btn btn-default btn-xs">
                        <i class="fas fa-pencil-alt"></i>
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['edit'];?>

                    </a>
                </div>
            </div>
            <div class="panel-body">
                <?php echo $_smarty_tpl->tpl_vars['note']->value['note'];?>

            </div>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons_html']->value, 'addon_html');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['addon_html']->value) {
?>
    <div class="addon-html-output-container">
        <?php echo $_smarty_tpl->tpl_vars['addon_html']->value;?>

    </div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<div class="alert alert-info text-center<?php if (!$_smarty_tpl->tpl_vars['replyingadmin']->value) {?> hidden<?php }?>" role="alert" id="replyingAdminMsg">
    <?php echo $_smarty_tpl->tpl_vars['replyingadmin']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['viewedandstarted'];?>
 @ <?php echo $_smarty_tpl->tpl_vars['replyingadmin']->value['time'];?>

</div>

<?php if ($_smarty_tpl->tpl_vars['relatedservices']->value) {?>
    <div class="tablebg">
        <table class="datatable" id="relatedservicestbl" width="100%" border="0" cellspacing="1" cellpadding="3">
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['product'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['amount'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['billingcycle'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['signupdate'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['nextduedate'];?>
</th>
                <th><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['relatedservices']->value, 'relatedservice');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['relatedservice']->value) {
?>
                <tr<?php if ($_smarty_tpl->tpl_vars['relatedservice']->value['selected']) {?> class="rowhighlight"<?php }?>>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['amount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['billingcycle'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['regdate'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['nextduedate'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['relatedservice']->value['status'];?>
</td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['relatedservicesexpand']->value) {?>
        <div id="relatedservicesexpand">
            <a href="#" onclick="expandRelServices();return false" class="btn btn-default btn-xs">
                <i class="fas fa-plus"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['expand'];?>

            </a>
        </div>
    <?php }
} else { ?>
    <br />
<?php }?>

<form method="post" action="supporttickets.php" id="ticketreplies">
    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" />
    <input type="hidden" name="action" value="split" />

    <div id="ticketreplies" class="ctk-support-thread ctk-admin-thread">

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['replies']->value, 'reply');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['reply']->value) {
?>
            <div class="reply <?php if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?> note<?php } elseif ($_smarty_tpl->tpl_vars['reply']->value['admin']) {?> staff<?php }?>">
                <div class="leftcol">
                    <div class="submitter">
                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['admin']) {?>
                            <div class="name"><?php echo $_smarty_tpl->tpl_vars['reply']->value['admin'];?>
</div>
                            <div class="title">
                                <?php if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['privateNote'];?>

                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['staff'];?>

                                <?php }?>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['reply']->value['rating']) {?>
                                <br /><?php echo $_smarty_tpl->tpl_vars['reply']->value['rating'];?>
<br /><br />
                            <?php }?>
                        <?php } else { ?>
                            <div class="name"><?php echo $_smarty_tpl->tpl_vars['reply']->value['clientname'];?>
</div>
                            <div class="title">
                                <?php if ($_smarty_tpl->tpl_vars['reply']->value['contactid']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['contact'];?>

                                <?php } elseif ($_smarty_tpl->tpl_vars['reply']->value['userid']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['client'];?>

                                <?php } else { ?>
                                    <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['reply']->value['clientemail'];?>
"><?php echo $_smarty_tpl->tpl_vars['reply']->value['clientemail'];?>
</a>
                                <?php }?>
                            </div>
                            <?php if (!$_smarty_tpl->tpl_vars['reply']->value['userid'] && !$_smarty_tpl->tpl_vars['reply']->value['contactid']) {?>
                                <a href="supporttickets.php?action=viewticket&amp;id=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
&amp;blocksender=true&amp;token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
" class="btn btn-xs btn-small"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['blocksender'];?>
</a>
                            <?php }?>
                        <?php }?>
                    </div>
                    <div class="tools">
                        <div class="editbtns<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>">
                            <img src="../assets/img/spinner.gif" width="16" height="16" class="saveSpinner" style="display: none" />
                            <?php if (!$_smarty_tpl->tpl_vars['reply']->value['note']) {?>
                                <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['edit'];?>
" onclick="editTicket('<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>')" class="btn btn-xs btn-small btn-default" />
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['deleteperm']->value) {?>
                                <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['delete'];?>
" onclick="<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {
if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?>doDeleteNote('<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
');<?php } else { ?>doDeleteReply('<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
');<?php }
} else { ?>doDeleteTicket();<?php }?>" class="btn btn-xs btn-small btn-danger" />
                            <?php }?>
                        </div>
                        <div class="editbtns<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>" style="display:none">
                            <img src="../assets/img/spinner.gif" width="16" height="16" class="saveSpinner" style="display: none" />
                            <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['save'];?>
" onclick="editTicketSave('<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>')" class="btn btn-xs btn-small btn-success" />
                            <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['cancel'];?>
" onclick="editTicketCancel('<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>')" class="btn btn-xs btn-small btn-default" />
                        </div>
                    </div>
                </div>
                <div class="rightcol">
                    <?php if (!$_smarty_tpl->tpl_vars['reply']->value['note']) {?>
                        <div class="quoteicon">
                            <a href="#" onClick="quoteTicket('<?php if (!$_smarty_tpl->tpl_vars['reply']->value['id']) {
echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>','<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {
echo $_smarty_tpl->tpl_vars['reply']->value['id'];
}?>'); return false;"><img src="images/icons/quote.png" border="0" /></a>
                            <?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>
                                <input type="checkbox" name="rids[]" value="<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];?>
" />
                            <?php }?>
                        </div>
                    <?php }?>
                    <div class="postedon">
                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?>
                            <?php echo $_smarty_tpl->tpl_vars['reply']->value['admin'];?>
 <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['postedANote'];?>

                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['posted'];?>

                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['friendlydate']) {?>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['on'];?>
 <?php echo $_smarty_tpl->tpl_vars['reply']->value['friendlydate'];?>

                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['today'];?>

                        <?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['at'];?>
 <?php echo $_smarty_tpl->tpl_vars['reply']->value['friendlytime'];?>

                    </div>
                    <div class="msgwrap" id="content<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>">
                        <div class="message markdown-content">
                            <?php echo $_smarty_tpl->tpl_vars['reply']->value['message'];?>

                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['reply']->value['numattachments'] && !$_smarty_tpl->tpl_vars['reply']->value['attachments_removed']) {?>
                            <br />
                            <strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['attachments'];?>
</strong>
                            <br /><br />
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reply']->value['attachments'], 'attachment', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['attachment']->value) {
?>
                                <?php if ($_smarty_tpl->tpl_vars['thumbnails']->value) {?>
                                    <div class="ticketattachmentcontainer">
                                        <a href="../<?php echo $_smarty_tpl->tpl_vars['attachment']->value['dllink'];?>
"<?php if ($_smarty_tpl->tpl_vars['attachment']->value['isImage']) {?> data-lightbox="image-<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {
if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?>n<?php } else { ?>r<?php }
echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>"<?php }?>>
                                            <span class="ticketattachmentthumbcontainer">
                                                <img src="../includes/thumbnail.php?<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {
if ($_smarty_tpl->tpl_vars['reply']->value['note']) {?>nid=<?php } else { ?>rid=<?php }
echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>tid=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>&amp;i=<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" class="ticketattachmentthumb" />
                                            </span>
                                            <span class="ticketattachmentinfo">
                                                <img src="images/icons/attachment.png" align="top" />
                                                <?php echo $_smarty_tpl->tpl_vars['attachment']->value['filename'];?>

                                            </span>
                                        </a>
                                        <div class="ticketattachmentlinks">
                                            <small>
                                                <?php if ($_smarty_tpl->tpl_vars['attachment']->value['isImage']) {?>
                                                    <a href="../<?php echo $_smarty_tpl->tpl_vars['attachment']->value['dllink'];?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.download'),$_smarty_tpl ) );?>
</a> |
                                                <?php }?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['attachment']->value['deletelink'];?>
" onclick="return confirm('<?php echo strtr($_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['delattachment'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
')" style="color:#cc0000">
                                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['remove'];?>

                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <a href="../<?php echo $_smarty_tpl->tpl_vars['attachment']->value['dllink'];?>
"<?php if ($_smarty_tpl->tpl_vars['attachment']->value['isImage']) {?> data-lightbox="image-<?php if ($_smarty_tpl->tpl_vars['reply']->value['id']) {?>r<?php echo $_smarty_tpl->tpl_vars['reply']->value['id'];
} else { ?>t<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;
}?>"<?php }?>>
                                        <img src="images/icons/attachment.png" align="absmiddle" />
                                        <?php echo $_smarty_tpl->tpl_vars['attachment']->value['filename'];?>

                                    </a>
                                    <small>
                                        <?php if ($_smarty_tpl->tpl_vars['attachment']->value['isImage']) {?>
                                            <a href="../<?php echo $_smarty_tpl->tpl_vars['attachment']->value['dllink'];?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.download'),$_smarty_tpl ) );?>
</a> |
                                        <?php }?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['attachment']->value['deletelink'];?>
" onclick="return confirm('<?php echo strtr($_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['delattachment'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
')" style="color:#cc0000">
                                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['remove'];?>

                                        </a>
                                    </small>
                                    <br />
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <div class="clear"></div>
                        <?php } elseif ($_smarty_tpl->tpl_vars['reply']->value['numattachments'] && $_smarty_tpl->tpl_vars['reply']->value['attachments_removed']) {?>
                            <br />
                            <strong>
                                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['attachments'];?>

                            </strong>
                            (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.attachmentsRemoved'),$_smarty_tpl ) );?>
)
                            <br /><br />
                            <ul>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reply']->value['attachments'], 'attachment', false, 'num');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['attachment']->value) {
?>
                                    <li>
                                        <?php echo $_smarty_tpl->tpl_vars['attachment']->value['filename'];?>

                                    </li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        <?php }?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>

    <a href="supportticketsprint.php?id=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" target="_blank" class="btn btn-default btn-xs">
        <i class="fas fa-print"></i>
        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['viewprintable'];?>

    </a>
    <?php if ($_smarty_tpl->tpl_vars['repliescount']->value > 1) {?>
        <span style="float:right;">
            <input type="button" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['splitticketdialogbutton'];?>
" onclick="$('#modalsplitTicket').modal('show')" class="btn btn-xs" />
        </span>
    <?php }?>

    <?php echo $_smarty_tpl->tpl_vars['splitticketdialog']->value;?>


    <input type="hidden" name="splitdeptid" id="splitdeptid" />
    <input type="hidden" name="splitsubject" id="splitsubject" />
    <input type="hidden" name="splitpriority" id="splitpriority" />
    <input type="hidden" name="splitnotifyclient" id="splitnotifyclient" />
</form>

<section class="ctk-admin-composer" id="ctkTicketComposer">
<ul class="nav nav-tabs admin-tabs" role="tablist">
    <li class="active"><a href="#tab0" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addreply'];?>
</a></li>
    <li><a href="#tab1" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addnote'];?>
</a></li>
    <li><a href="#tab2" role="tab" data-toggle="tab" onclick="loadTab(2, 'customfields', 0)"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['customfields'];?>
</a></li>
    <li><a href="#tab3" role="tab" data-toggle="tab" onclick="loadTab(3, 'tickets', 0)"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['clienttickets'];?>
</a></li>
    <li><a href="#tab4" role="tab" data-toggle="tab" onclick="loadTab(4, 'clientlog', 0)"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['clientlog'];?>
</a></li>
    <li><a href="#tab5" role="tab" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['options'];?>
</a></li>
    <li><a href="#tab6" role="tab" data-toggle="tab" onclick="loadTab(6, 'ticketlog', 0)"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['ticketlog'];?>
</a></li>
</ul>
<div class="tab-content admin-tabs">
  <div class="tab-pane active" id="tab0">

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=viewticket&id=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" enctype="multipart/form-data" name="replyfrm" id="frmAddTicketReply" data-no-clear="true">
        <input type="hidden" name="postreply" value="1" />

        <textarea name="message" id="replymessage" rows="14" class="form-control bottom-margin-10"><?php if ($_smarty_tpl->tpl_vars['signature']->value) {?>



<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}?></textarea>

        <div class="row ticket-reply-edit-options">
            <div class="col-sm-3">
                <select name="deptid" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setDepartment'];?>
 -</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="flagto" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setAssignment'];?>
 -</option>
                    <option value="0"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['none'];?>
</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staff']->value, 'staffmember');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['staffmember']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['staffmember']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['staffmember']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="priority" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setPriority'];?>
 -</option>
                    <option value="High"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['high'];?>
</option>
                    <option value="Medium"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['medium'];?>
</option>
                    <option value="Low"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['low'];?>
</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="status" class="form-control selectize-select" data-value-field="id">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statuses']->value, 'statusitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['statusitem']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
" style="color:<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['color'];?>
"<?php if ($_smarty_tpl->tpl_vars['statusitem']->value['title'] == "Answered") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>
        <div class="ticket-reply-submit-options clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default btns-padded" id="btnAttachFiles">
                    <i class="far fa-file"></i>
                    &nbsp;
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['attachFiles'];?>

                </button>
                <button type="button" class="btn btn-default btns-padded" id="insertpredef">
                    <i class="fas fa-pencil-alt"></i>
                    &nbsp;
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['insertpredef'];?>

                </button>
                <div class="dropdown btns-padded">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMoreOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-cog"></i>
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['moreOptions'];?>

                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMoreOptions">
                        <li><a href="#" id="btnInsertKbArticle"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['insertkblink'];?>
</a></li>
                        <li><a href="#" id="btnAddBillingEntry"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addbilling'];?>
</a></li>
                    </ul>
                </div>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right" name="postreply" id="btnPostReply" value="true">
                    <i class="fas fa-reply"></i>
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['reply'];?>

                </button>
                <div class="return-to-ticket-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="returntolist" value="1"<?php if ($_smarty_tpl->tpl_vars['returnToList']->value == true) {?> checked<?php }?> />
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['returnToTicketList'];?>

                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="ticketPredefinedReplies" class="inner-container">
                <div class="predefined-replies-search">
                    <input type="text" id="predefq" size="25" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['search'];?>
" onfocus="this.value=(this.value=='<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['search'];?>
') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['search'];?>
' : this.value;" />
                </div>
                <div id="prerepliescontent">
                    <?php echo $_smarty_tpl->tpl_vars['predefinedreplies']->value;?>

                </div>
            </div>
            <div id="ticketReplyAttachments" class="inner-container">
                <div class="row">
                    <div class="col-sm-9">
                        <input type="file" name="attachments[]" class="form-control" />
                        <div id="fileuploads"></div>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" id="add-file-upload" class="btn btn-success btn-block add-file-upload" data-more-id="fileuploads"><i class="fas fa-plus"></i> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addmore'];?>
</a>
                    </div>
                </div>
            </div>
            <div id="ticketReplyBillingEntry" class="inner-container">
                <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
                    <tr>
                        <td class="fieldlabel">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addbilling'];?>

                        </td>
                        <td class="fieldarea">
                            <div class="form-inline">
                                <input type="text" name="billingdescription" size="50" placeholder="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['toinvoicedes'];?>
" class="form-control" /> @ <input type="text" name="billingamount" size="10" placeholder="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['amount'];?>
" class="form-control" />
                                <select name="billingaction" class="form-control select-inline">
                                    <option value="3" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['invoiceimmediately'];?>
</option>
                                    <option value="0" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['dontinvoicefornow'];?>
</option>
                                    <option value="1" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['invoicenextcronrun'];?>
</option>
                                    <option value="2" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['addnextinvoice'];?>
</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </form>

  </div>
  <div class="tab-pane" id="tab1">

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=viewticket&id=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" enctype="multipart/form-data" id="frmAddTicketNote" data-no-clear="false">
        <input type="hidden" name="postaction" value="note" />

        <textarea name="message" id="replynote" rows="14" class="form-control"></textarea>

        <div class="row ticket-reply-edit-options">
            <div class="col-sm-3">
                <select name="deptid" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setDepartment'];?>
 -</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="flagto" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setAssignment'];?>
 -</option>
                    <option value="0"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['none'];?>
</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staff']->value, 'staffmember');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['staffmember']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['staffmember']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['staffmember']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="priority" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setPriority'];?>
 -</option>
                    <option value="High"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['high'];?>
</option>
                    <option value="Medium"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['medium'];?>
</option>
                    <option value="Low"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['low'];?>
</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select name="status" class="form-control selectize-select" data-value-field="id">
                    <option value="nochange" selected>- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setStatus'];?>
 -</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statuses']->value, 'statusitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['statusitem']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
" style="color:<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['color'];?>
"><?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>
        <div class="ticket-reply-submit-options clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-default btns-padded" id="btnNoteAttachFiles">
                    <i class="far fa-file"></i>
                    &nbsp;
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['attachFiles'];?>

                </button>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary pull-right" name="postreply" id="btnAddNote">
                    <i class="fas fa-reply"></i>
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addnote'];?>

                </button>
                <div class="return-to-ticket-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="returntolist" value="1"<?php if ($_smarty_tpl->tpl_vars['returnToList']->value == true) {?> checked<?php }?> />
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['returnToTicketList'];?>

                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="ticketNoteAttachments" class="inner-container">
                <div class="row">
                    <div class="col-sm-9">
                        <input type="file" name="attachments[]" class="form-control" />
                        <div id="note-file-uploads"></div>
                    </div>
                    <div class="col-sm-3">
                        <a href="#" id="add-note-file-upload" class="btn btn-success btn-block add-file-upload" data-more-id="note-file-uploads">
                            <i class="fas fa-plus"></i>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['addmore'];?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

  </div>
  <div class="tab-pane" id="tab2">

    <img src="images/loading.gif" align="top" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>


  </div>
  <div class="tab-pane" id="tab3">

    <img src="images/loading.gif" align="top" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>


  </div>
  <div class="tab-pane" id="tab4">

    <img src="images/loading.gif" align="top" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>


  </div>
  <div class="tab-pane" id="tab5">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=viewticket&id=<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" id="frmTicketOptions">
        <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tr>
                <td width="15%" class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['department'];?>

                </td>
                <td class="fieldarea">
                    <select name="deptid" class="form-control select-inline">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['department']->value['id'] == $_smarty_tpl->tpl_vars['deptid']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </td>
                <td width="15%" class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['clientname'];?>

                </td>
                <td class="fieldarea">
                    <?php echo $_smarty_tpl->tpl_vars['userSearchDropdown']->value;?>

                </td>
            </tr>
            <tr>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['subject'];?>

                </td>
                <td class="fieldarea">
                    <input type="text" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
" class="form-control input-400">
                </td>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['flag'];?>

                </td>
                <td class="fieldarea">
                    <select name="flagto" class="form-control select-inline">
                        <option value="0"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['none'];?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staff']->value, 'staffmember');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['staffmember']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['staffmember']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['staffmember']->value['id'] == $_smarty_tpl->tpl_vars['flag']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['staffmember']->value['name'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>

                </td>
                <td class="fieldarea">
                    <select name="status" class="form-control select-inline">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statuses']->value, 'statusitem');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['statusitem']->value) {
?>
                            <option<?php if ($_smarty_tpl->tpl_vars['statusitem']->value['title'] == $_smarty_tpl->tpl_vars['status']->value) {?> selected<?php }?> style="color:<?php echo $_smarty_tpl->tpl_vars['statusitem']->value['color'];?>
"><?php echo $_smarty_tpl->tpl_vars['statusitem']->value['title'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </td>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['priority'];?>

                </td>
                <td class="fieldarea">
                    <select name="priority" class="form-control select-inline">
                        <option value="High"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "High") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['high'];?>
</option>
                        <option value="Medium"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "Medium") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['medium'];?>
</option>
                        <option value="Low"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "Low") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['low'];?>
</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['ccrecipients'];?>

                </td>
                <td class="fieldarea">
                    <input type="text" id="inputTicketCc" name="cc" value="<?php echo $_smarty_tpl->tpl_vars['cc']->value;?>
" class="form-control selectize-tags" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.none"),$_smarty_tpl ) );?>
">
                </td>
                <td class="fieldlabel">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['mergeticket'];?>

                </td>
                <td class="fieldarea">
                    <input type="text" name="mergetid"  class="form-control input-150 input-inline"> (<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['notocombine'];?>
)
                </td>
            </tr>
        </table>
        <div class="btn-container">
            <button id="btnSaveChanges" type="submit" class="btn btn-primary" value="save">
                <i class="fas fa-save"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.savechanges'),$_smarty_tpl ) );?>

            </button>
            <input type="reset" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['cancelchanges'];?>
" class="btn btn-default" />
        </div>
    </form>
  </div>
  <div class="tab-pane" id="tab6">

    <img src="images/loading.gif" align="top" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>


  </div>
</div>


</section>
<?php echo '<script'; ?>
 src="../assets/js/lightbox.js"><?php echo '</script'; ?>
>
<?php }
}
