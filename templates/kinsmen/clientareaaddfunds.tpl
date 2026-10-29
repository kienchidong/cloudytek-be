{if $ctkWallet}<div class="alert alert-info ctk-wallet-topup-note">{if $portalLanguage=='vietnamese'}Nạp vào <strong>tài khoản chính</strong>. Số tiền bạn nhập có đơn vị <strong>{$walletInputCode|default:$ctkWallet.code|escape}</strong>; số dư chỉ tăng sau khi hóa đơn nạp được thanh toán thành công.{else}Top up your <strong>main balance</strong>. Enter an amount in <strong>{$walletInputCode|default:$ctkWallet.code|escape}</strong>. Your invoice is recorded in {$ctkWallet.code|escape}; funds are credited only after successful payment.{/if}</div>{/if}
{if !$gateways}<div class="alert alert-warning">Chưa có phương thức nạp tiền khả dụng. Vui lòng liên hệ hỗ trợ hoặc chờ admin cấu hình cổng thanh toán.</div>{/if}
{if $addfundsdisabled}
    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.clientareaaddfundsdisabled textcenter=true}
{elseif $notallowed}
    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.clientareaaddfundsnotallowed textcenter=true}
{elseif $errormessage}
    {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage textcenter=true}
{/if}

{if !$addfundsdisabled}

    <div class="row">

        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td class="textright"><strong>{$LANG.addfundsminimum}</strong></td>
                        <td>{$minimumamount}</td>
                    </tr>
                    <tr>
                        <td class="textright"><strong>{$LANG.addfundsmaximum}</strong></td>
                        <td>{$maximumamount}</td>
                    </tr>
                    <tr>
                        <td class="textright"><strong>{$LANG.addfundsmaximumbalance}</strong></td>
                        <td>{$maximumbalance}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="{$smarty.server.PHP_SELF}?action=addfunds">
                        <input type="hidden" name="token" value="{$token}">
                        <fieldset>
                            <div class="form-group">
                                <label for="amount" class="control-label">{$LANG.addfundsamount}:</label>
                                <input type="text" name="amount" id="amount"
                                       value="{$amount}" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="paymentmethod" class="control-label">{$LANG.orderpaymentmethod}:</label><br/>
                                <select name="paymentmethod" id="paymentmethod" class="form-control">
                                    {foreach from=$gateways item=gateway}
                                        <option value="{$gateway.sysname}">{$gateway.name}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="{$LANG.addfunds}" class="btn btn-primary btn-block" {if !$gateways || $notallowed}disabled{/if} />
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer">
                    {$LANG.addfundsnonrefundable}
                </div>
            </div>
        </div>

    </div>

{/if}
