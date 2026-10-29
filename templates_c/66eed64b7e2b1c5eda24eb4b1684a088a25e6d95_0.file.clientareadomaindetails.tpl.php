<?php
/* Smarty version 3.1.33-p1, created on 2026-10-29 12:00:20
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\clientareadomaindetails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae2d2e411e9a8_09996320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66eed64b7e2b1c5eda24eb4b1684a088a25e6d95' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\clientareadomaindetails.tpl',
      1 => 1791912387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae2d2e411e9a8_09996320 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\DuPham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
if ($_smarty_tpl->tpl_vars['registrarcustombuttonresult']->value == "success") {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['moduleactionsuccess'],'textcenter'=>true), 0, true);
} elseif ($_smarty_tpl->tpl_vars['registrarcustombuttonresult']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['moduleactionfailed'],'textcenter'=>true), 0, true);
}?>

<?php if ($_smarty_tpl->tpl_vars['unpaidInvoice']->value) {?>
    <div class="alert alert-<?php if ($_smarty_tpl->tpl_vars['unpaidInvoiceOverdue']->value) {?>danger<?php } else { ?>warning<?php }?>" id="alert<?php if ($_smarty_tpl->tpl_vars['unpaidInvoiceOverdue']->value) {?>Overdue<?php } else { ?>Unpaid<?php }?>Invoice">
        <div class="pull-right">
            <a href="viewinvoice.php?id=<?php echo $_smarty_tpl->tpl_vars['unpaidInvoice']->value;?>
" class="btn btn-xs btn-default">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'payInvoice'),$_smarty_tpl ) );?>

            </a>
        </div>
        <?php echo $_smarty_tpl->tpl_vars['unpaidInvoiceMessage']->value;?>

    </div>
<?php }?>

<div class="tab-content margin-bottom">
    <div class="tab-pane fade in active" id="tabOverview">

        <?php if ($_smarty_tpl->tpl_vars['alerts']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['alerts']->value, 'alert');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['alert']->value) {
?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>$_smarty_tpl->tpl_vars['alert']->value['type'],'msg'=>"<strong>".((string)$_smarty_tpl->tpl_vars['alert']->value['title'])."</strong><br>".((string)$_smarty_tpl->tpl_vars['alert']->value['description']),'textcenter'=>true), 0, true);
?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['systemStatus']->value != 'Active') {?>
            <div class="alert alert-warning text-center" role="alert">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainCannotBeManagedUnlessActive'];?>

            </div>
        <?php }?>

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['overview'];?>
</h3>

        <?php if ($_smarty_tpl->tpl_vars['lockstatus']->value == "unlocked") {?>
            <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "domainUnlockedMsg", null, null);?><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincurrentlyunlocked'];?>
</strong><br /><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaincurrentlyunlockedexp'];
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'domainUnlockedMsg')), 0, true);
?>
        <?php }?>

        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingdomain'];?>
:</strong></h4> <a href="http://<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
</a>
            </div>
            <div class="col-sm-5">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['firstpaymentamount'];?>
:</strong></h4> <span><?php echo $_smarty_tpl->tpl_vars['firstpaymentamount']->value;?>
</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingregdate'];?>
:</strong></h4> <span><?php echo $_smarty_tpl->tpl_vars['registrationdate']->value;?>
</span>
            </div>
            <div class="col-sm-6">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['recurringamount'];?>
:</strong></h4> <?php echo $_smarty_tpl->tpl_vars['recurringamount']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['every'];?>
 <?php echo $_smarty_tpl->tpl_vars['registrationperiod']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderyears'];?>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareahostingnextduedate'];?>
:</strong></h4> <?php echo $_smarty_tpl->tpl_vars['nextduedate']->value;?>

            </div>
            <div class="col-sm-6">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymentmethod'];?>
:</strong></h4> <?php echo $_smarty_tpl->tpl_vars['paymentmethod']->value;?>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareastatus'];?>
:</strong></h4> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>

            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['sslStatus']->value) {?>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-5<?php if ($_smarty_tpl->tpl_vars['sslStatus']->value->isInactive()) {?> ssl-inactive<?php }?>">
                    <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['sslState']['sslStatus'];?>
</strong></h4> <img src="<?php echo $_smarty_tpl->tpl_vars['sslStatus']->value->getImagePath();?>
" width="16"> <?php echo $_smarty_tpl->tpl_vars['sslStatus']->value->getStatusDisplayLabel();?>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['sslStatus']->value->isActive()) {?>
                    <div class="col-sm-6">
                        <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['sslState']['startDate'];?>
</strong></h4> <?php echo $_smarty_tpl->tpl_vars['sslStatus']->value->startDate->toClientDateFormat();?>

                    </div>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['sslStatus']->value->isActive()) {?>
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-5">
                        <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['sslState']['issuerName'];?>
</strong></h4> <?php echo $_smarty_tpl->tpl_vars['sslStatus']->value->issuerName;?>

                    </div>
                    <div class="col-sm-6">
                        <h4><strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['sslState']['expiryDate'];?>
</strong></h4> <?php echo $_smarty_tpl->tpl_vars['sslStatus']->value->expiryDate->toClientDateFormat();?>

                    </div>
                </div>
            <?php }?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['registrarclientarea']->value) {?>
            <div class="moduleoutput">
                <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['registrarclientarea']->value,'modulebutton','btn');?>

            </div>
        <?php }?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hookOutput']->value, 'output');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
?>
            <div>
                <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <br />

        <?php if ($_smarty_tpl->tpl_vars['canDomainBeManaged']->value && ($_smarty_tpl->tpl_vars['managementoptions']->value['nameservers'] || $_smarty_tpl->tpl_vars['managementoptions']->value['contacts'] || $_smarty_tpl->tpl_vars['managementoptions']->value['locking'] || $_smarty_tpl->tpl_vars['renew']->value)) {?>
                
            <h4><?php echo $_smarty_tpl->tpl_vars['LANG']->value['doToday'];?>
</h4>

            <ul>
                <?php if ($_smarty_tpl->tpl_vars['systemStatus']->value == 'Active' && $_smarty_tpl->tpl_vars['managementoptions']->value['nameservers']) {?>
                    <li>
                        <a class="tabControlLink" data-toggle="tab" href="#tabNameservers">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['changeDomainNS'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['systemStatus']->value == 'Active' && $_smarty_tpl->tpl_vars['managementoptions']->value['contacts']) {?>
                    <li>
                        <a href="clientarea.php?action=domaincontacts&domainid=<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['updateWhoisContact'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['systemStatus']->value == 'Active' && $_smarty_tpl->tpl_vars['managementoptions']->value['locking']) {?>
                    <li>
                        <a class="tabControlLink" data-toggle="tab" href="#tabReglock">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['changeRegLock'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['renew']->value) {?>
                    <li>
                        <a href="<?php echo routePath('domain-renewal',$_smarty_tpl->tpl_vars['domain']->value);?>
">
                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['renewYourDomain'];?>

                        </a>
                    </li>
                <?php }?>
            </ul>

        <?php }?>

    </div>
    <div class="tab-pane fade" id="tabAutorenew">

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenew'];?>
</h3>

        <?php if ($_smarty_tpl->tpl_vars['changeAutoRenewStatusSuccessful']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['changessavedsuccessfully'],'textcenter'=>true), 0, true);
?>
        <?php }?>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['domainrenewexp']), 0, true);
?>

        <br />

        <h2 class="text-center"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainautorenewstatus'];?>
: <span class="label label-<?php if ($_smarty_tpl->tpl_vars['autorenew']->value) {?>success<?php } else { ?>danger<?php }?>"><?php if ($_smarty_tpl->tpl_vars['autorenew']->value) {
echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewenabled'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewdisabled'];
}?></span></h2>

        <br />
        <br />

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=domaindetails#tabAutorenew">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
">
            <input type="hidden" name="sub" value="autorenew" />
            <?php if ($_smarty_tpl->tpl_vars['autorenew']->value) {?>
                <input type="hidden" name="autorenew" value="disable">
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-danger" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewdisable'];?>
" />
                </p>
            <?php } else { ?>
                <input type="hidden" name="autorenew" value="enable">
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-success" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewenable'];?>
" />
                </p>
            <?php }?>
        </form>

    </div>
    <div class="tab-pane fade" id="tabNameservers">

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainnameservers'];?>
</h3>

        <?php if ($_smarty_tpl->tpl_vars['nameservererror']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['nameservererror']->value,'textcenter'=>true), 0, true);
?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['subaction']->value == "savens") {?>
            <?php if ($_smarty_tpl->tpl_vars['updatesuccess']->value) {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['changessavedsuccessfully'],'textcenter'=>true), 0, true);
?>
            <?php } elseif ($_smarty_tpl->tpl_vars['error']->value) {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['error']->value,'textcenter'=>true), 0, true);
?>
            <?php }?>
        <?php }?>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['domainnsexp']), 0, true);
?>

        <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=domaindetails#tabNameservers">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
" />
            <input type="hidden" name="sub" value="savens" />
            <div class="radio">
                <label>
                    <input type="radio" name="nschoice" value="default" onclick="disableFields('domnsinputs',true)"<?php if ($_smarty_tpl->tpl_vars['defaultns']->value) {?> checked<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['nschoicedefault'];?>

                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="nschoice" value="custom" onclick="disableFields('domnsinputs',false)"<?php if (!$_smarty_tpl->tpl_vars['defaultns']->value) {?> checked<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['nschoicecustom'];?>

                </label>
            </div>
            <br />
            <?php
$_smarty_tpl->tpl_vars['num'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['num']->step = 1;$_smarty_tpl->tpl_vars['num']->total = (int) ceil(($_smarty_tpl->tpl_vars['num']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['num']->step));
if ($_smarty_tpl->tpl_vars['num']->total > 0) {
for ($_smarty_tpl->tpl_vars['num']->value = 1, $_smarty_tpl->tpl_vars['num']->iteration = 1;$_smarty_tpl->tpl_vars['num']->iteration <= $_smarty_tpl->tpl_vars['num']->total;$_smarty_tpl->tpl_vars['num']->value += $_smarty_tpl->tpl_vars['num']->step, $_smarty_tpl->tpl_vars['num']->iteration++) {
$_smarty_tpl->tpl_vars['num']->first = $_smarty_tpl->tpl_vars['num']->iteration === 1;$_smarty_tpl->tpl_vars['num']->last = $_smarty_tpl->tpl_vars['num']->iteration === $_smarty_tpl->tpl_vars['num']->total;?>
                <div class="form-group">
                    <label for="inputNs<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanameserver'];?>
 <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</label>
                    <div class="col-sm-7">
                        <input type="text" name="ns<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" class="form-control domnsinputs" id="inputNs<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['nameservers']->value[$_smarty_tpl->tpl_vars['num']->value]['value'];?>
" />
                    </div>
                </div>
            <?php }
}
?>
            <p class="text-center">
                <input type="submit" class="btn btn-primary" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['changenameservers'];?>
" />
            </p>
        </form>

    </div>
    <div class="tab-pane fade" id="tabReglock">

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainregistrarlock'];?>
</h3>

        <?php if ($_smarty_tpl->tpl_vars['subaction']->value == "savereglock") {?>
            <?php if ($_smarty_tpl->tpl_vars['updatesuccess']->value) {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['changessavedsuccessfully'],'textcenter'=>true), 0, true);
?>
            <?php } elseif ($_smarty_tpl->tpl_vars['error']->value) {?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['error']->value,'textcenter'=>true), 0, true);
?>
            <?php }?>
        <?php }?>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['domainlockingexp']), 0, true);
?>

        <br />

        <h2 class="text-center"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreglockstatus'];?>
: <span class="label label-<?php if ($_smarty_tpl->tpl_vars['lockstatus']->value == "locked") {?>success<?php } else { ?>danger<?php }?>"><?php if ($_smarty_tpl->tpl_vars['lockstatus']->value == "locked") {
echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewenabled'];
} else {
echo $_smarty_tpl->tpl_vars['LANG']->value['domainsautorenewdisabled'];
}?></span></h2>

        <br />
        <br />

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=domaindetails#tabReglock">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
">
            <input type="hidden" name="sub" value="savereglock" />
            <?php if ($_smarty_tpl->tpl_vars['lockstatus']->value == "locked") {?>
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-danger" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreglockdisable'];?>
" />
                </p>
            <?php } else { ?>
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-success" name="reglock" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreglockenable'];?>
" />
                </p>
            <?php }?>
        </form>

    </div>
    <div class="tab-pane fade" id="tabRelease">

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainrelease'];?>
</h3>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['domainreleasedescription']), 0, true);
?>

        <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?action=domaindetails">
            <input type="hidden" name="sub" value="releasedomain">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
">

            <div class="form-group">
                <label for="inputReleaseTag" class="col-xs-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainreleasetag'];?>
</label>
                <div class="col-xs-6 col-sm-5">
                    <input type="text" class="form-control" id="inputReleaseTag" name="transtag" />
                </div>
            </div>

            <p class="text-center">
                <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainrelease'];?>
" class="btn btn-primary" />
            </p>
        </form>

    </div>
    <div class="tab-pane fade" id="tabAddons">

        <h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddons'];?>
</h3>

        <p>
            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsinfo'];?>

        </p>

        <?php if ($_smarty_tpl->tpl_vars['addons']->value['idprotection']) {?>
            <div class="row margin-bottom">
                <div class="col-xs-3 col-md-2 text-center">
                    <i class="fas fa-shield-alt fa-3x"></i>
                </div>
                <div class="col-xs-9 col-md-10">
                    <strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainidprotection'];?>
</strong><br />
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsidprotectioninfo'];?>
<br />
                    <form action="clientarea.php?action=domainaddons" method="post">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
"/>
                        <?php if ($_smarty_tpl->tpl_vars['addonstatus']->value['idprotection']) {?>
                            <input type="hidden" name="disable" value="idprotect"/>
                            <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['disable'];?>
" class="btn btn-danger"/>
                        <?php } else { ?>
                            <input type="hidden" name="buy" value="idprotect"/>
                            <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsbuynow'];?>
 <?php echo $_smarty_tpl->tpl_vars['addonspricing']->value['idprotection'];?>
" class="btn btn-success"/>
                        <?php }?>
                    </form>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['addons']->value['dnsmanagement']) {?>
            <div class="row margin-bottom">
                <div class="col-xs-3 col-md-2 text-center">
                    <i class="fas fa-cloud fa-3x"></i>
                </div>
                <div class="col-xs-9 col-md-10">
                    <strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsdnsmanagement'];?>
</strong><br />
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsdnsmanagementinfo'];?>
<br />
                    <form action="clientarea.php?action=domainaddons" method="post">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
"/>
                        <?php if ($_smarty_tpl->tpl_vars['addonstatus']->value['dnsmanagement']) {?>
                            <input type="hidden" name="disable" value="dnsmanagement"/>
                            <a class="btn btn-success" href="clientarea.php?action=domaindns&domainid=<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['manage'];?>
</a> <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['disable'];?>
" class="btn btn-danger"/>
                        <?php } else { ?>
                            <input type="hidden" name="buy" value="dnsmanagement"/>
                            <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsbuynow'];?>
 <?php echo $_smarty_tpl->tpl_vars['addonspricing']->value['dnsmanagement'];?>
" class="btn btn-success"/>
                        <?php }?>
                    </form>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['addons']->value['emailforwarding']) {?>
            <div class="row margin-bottom">
                <div class="col-xs-3 col-md-2 text-center">
                    <i class="fas fa-envelope fa-3x">&nbsp;</i><i class="fas fa-share fa-2x"></i>
                </div>
                <div class="col-xs-9 col-md-10">
                    <strong><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainemailforwarding'];?>
</strong><br />
                    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsemailforwardinginfo'];?>
<br />
                    <form action="clientarea.php?action=domainaddons" method="post">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
"/>
                        <?php if ($_smarty_tpl->tpl_vars['addonstatus']->value['emailforwarding']) {?>
                            <input type="hidden" name="disable" value="emailfwd"/>
                            <a class="btn btn-success" href="clientarea.php?action=domainemailforwarding&domainid=<?php echo $_smarty_tpl->tpl_vars['domainid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['manage'];?>
</a> <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['disable'];?>
" class="btn btn-danger"/>
                        <?php } else { ?>
                            <input type="hidden" name="buy" value="emailfwd"/>
                            <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['domainaddonsbuynow'];?>
 <?php echo $_smarty_tpl->tpl_vars['addonspricing']->value['emailforwarding'];?>
" class="btn btn-success"/>
                        <?php }?>
                    </form>
                </div>
            </div>
        <?php }?>
    </div>
</div>

<?php }
}
