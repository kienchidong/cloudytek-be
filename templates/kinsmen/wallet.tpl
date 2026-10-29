<div class="ctk-wallet-page">
{if $walletError}<div class="alert alert-warning">{$walletError|escape}</div>{else}
<div class="ctk-wallet-cards">
<section><span><i class="fas fa-wallet" aria-hidden="true"></i> Tài khoản chính</span><strong>{$walletBalances.main_formatted}</strong><p>Số dư nạp tiền và các khoản được cộng vào tài khoản chính.</p><a class="btn btn-primary" href="{$WEB_ROOT}/clientarea.php?action=addfunds">Nạp tiền vào tài khoản chính</a></section>
<section class="ctk-wallet-promo"><span><i class="fas fa-gift" aria-hidden="true"></i> Tài khoản khuyến mãi</span><strong>{$walletBalances.promo_formatted}</strong><p>Được ưu tiên sử dụng trước khi trừ tài khoản chính. Tiền khuyến mãi do admin cộng.</p></section>
</div>
<p class="alert alert-info">Số dư được ghi sổ bằng <strong>{$walletBalances.code|escape}</strong>. Khi thanh toán dịch vụ, hệ thống trừ khuyến mãi trước, sau đó mới đến tài khoản chính. Nạp tiền chỉ được ghi nhận khi hóa đơn nạp tiền đã thanh toán thành công.</p>
<section class="ctk-wallet-history"><h3>Lịch sử số dư gần đây</h3><div class="table-responsive"><table class="table"><thead><tr><th>Ngày</th><th>Nội dung</th><th>Số tiền</th></tr></thead><tbody>{foreach $walletHistory as $entry}<tr><td>{$entry.date|escape}</td><td>{$entry.description|escape}</td><td>{$entry.amount}</td></tr>{foreachelse}<tr><td colspan="3">Chưa có giao dịch.</td></tr>{/foreach}</tbody></table></div></section>
{/if}
</div>
