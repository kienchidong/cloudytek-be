
                </div><!-- /.main-content -->

            <div class="clearfix"></div>
        </div>
    </div>
</section>

<section id="footer">
    <div class="container-fluid">
        <a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>
        <p>{lang key="copyrightFooterNotice" year=$date_year company=$companyname}</p>
    </div>
</section>

</div><!-- /.admin-main-wrapper -->

<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">{$LANG.close}</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body panel-body">
                {$LANG.loading}
            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader" role="status" aria-label="{$LANG.loading|escape}">
                    <i class="fas fa-circle-notch fa-spin"></i>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {$LANG.close}
                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    {$LANG.submit}
                </button>
            </div>
        </div>
    </div>
</div>

{include file="$template/includes/generate-password.tpl"}

{$footeroutput}

</body>
</html>
