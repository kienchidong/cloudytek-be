<?php
/* Smarty version 3.1.33-p1, created on 2026-10-29 13:38:41
  from 'C:\Users\Du Pham\Desktop\plan\WHMCS-7.8.0-decoded\templates\kinsmen\includes\tablelist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-p1',
  'unifunc' => 'content_6ae2e9f1e9b516_72514491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef2a9d4f25fd16b49fad4063763274957b0ae066' => 
    array (
      0 => 'C:\\Users\\Du Pham\\Desktop\\plan\\WHMCS-7.8.0-decoded\\templates\\kinsmen\\includes\\tablelist.tpl',
      1 => 1793255915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ae2e9f1e9b516_72514491 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_CSS']->value;?>
/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_CSS']->value;?>
/dataTables.responsive.css">
<?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/dataTables.responsive.min.js"><?php echo '</script'; ?>
>

<?php if (isset($_smarty_tpl->tpl_vars['filterColumn']->value) && $_smarty_tpl->tpl_vars['filterColumn']->value) {
echo '<script'; ?>
 type="text/javascript">

if (typeof(buildFilterRegex) !== "function") {
    function buildFilterRegex(filterValue) {

        if (filterValue.indexOf('&') === -1) {
            return '[~>]\\s*' + jQuery.fn.dataTable.util.escapeRegex(filterValue) + '\\s*[<~]';
        } else {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = filterValue;

            return '\\s*' + jQuery.fn.dataTable.util.escapeRegex(tempDiv.innerText) + '\\s*';
        }
    }
}
jQuery(document).ready(function () {
    jQuery(".view-filter-btns a").click(function(e) {
        var filterValue = jQuery(this).find("span").not('.badge').html().trim();
        var dataTable = jQuery('#table<?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
').DataTable();
        var filterValueRegex;
        if (jQuery(this).hasClass('active')) {
            <?php if (!isset($_smarty_tpl->tpl_vars['dontControlActiveClass']->value) || !$_smarty_tpl->tpl_vars['dontControlActiveClass']->value) {?>
                jQuery(this).removeClass('active');
                jQuery(this).find("i.far.fa-dot-circle").removeClass('fa-dot-circle').addClass('fa-circle');
            <?php }?>
            dataTable.column(<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
).search('').draw();
        } else {
            <?php if (!isset($_smarty_tpl->tpl_vars['dontControlActiveClass']->value) || !$_smarty_tpl->tpl_vars['dontControlActiveClass']->value) {?>
                jQuery('.view-filter-btns .list-group-item').removeClass('active');
                jQuery('i.far.fa-dot-circle').removeClass('fa-dot-circle').addClass('fa-circle');
                jQuery(this).addClass('active');
                jQuery(this).find(jQuery("i.far.fa-circle")).removeClass('fa-circle').addClass('fa-dot-circle');
            <?php }?>
            filterValueRegex = buildFilterRegex(filterValue);
            dataTable.column(<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
)
                .search(filterValueRegex, true, false, false)
                .draw();
        }

        // Prevent jumping to the top of the page
        // when no matching tag is found.
        e.preventDefault();
    });
});
<?php echo '</script'; ?>
>
<?php }?>

<?php echo '<script'; ?>
 type="text/javascript">
var alreadyReady = false; // The ready function is being called twice on page load.
jQuery(document).ready( function () {
    var table = jQuery("#table<?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
").DataTable({
        "dom": '<"listtable"fit>pl',<?php if (isset($_smarty_tpl->tpl_vars['noPagination']->value) && $_smarty_tpl->tpl_vars['noPagination']->value) {?>
        "paging": false,<?php }
if (isset($_smarty_tpl->tpl_vars['noInfo']->value) && $_smarty_tpl->tpl_vars['noInfo']->value) {?>
        "info": false,<?php }
if (isset($_smarty_tpl->tpl_vars['noSearch']->value) && $_smarty_tpl->tpl_vars['noSearch']->value) {?>
        "filter": false,<?php }
if (isset($_smarty_tpl->tpl_vars['noOrdering']->value) && $_smarty_tpl->tpl_vars['noOrdering']->value) {?>
        "ordering": false,<?php }?>
        "responsive": <?php if (!empty($_smarty_tpl->tpl_vars['disableResponsive']->value)) {?>false<?php } else { ?>true<?php }?>,
        "oLanguage": {
            "sEmptyTable":     "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['norecordsfound'];?>
",
            "sInfo":           "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tableshowing'];?>
",
            "sInfoEmpty":      "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tableempty'];?>
",
            "sInfoFiltered":   "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablefiltered'];?>
",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablelength'];?>
",
            "sLoadingRecords": "<span role='status' aria-label='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['loading'], ENT_QUOTES, 'UTF-8', true);?>
'><i class='fas fa-circle-notch fa-spin' aria-hidden='true'></i></span>",
            "sProcessing":     "<span role='status' aria-label='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['LANG']->value['loading'], ENT_QUOTES, 'UTF-8', true);?>
'><i class='fas fa-circle-notch fa-spin' aria-hidden='true'></i></span>",
            "sSearch":         "",
            "sZeroRecords":    "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['norecordsfound'];?>
",
            "oPaginate": {
                "sFirst":    "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablepagesfirst'];?>
",
                "sLast":     "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablepageslast'];?>
",
                "sNext":     "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablepagesnext'];?>
",
                "sPrevious": "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tablepagesprevious'];?>
"
            }
        },
        "pageLength": 10,
        "order": [
            [ <?php if (isset($_smarty_tpl->tpl_vars['startOrderCol']->value) && $_smarty_tpl->tpl_vars['startOrderCol']->value) {
echo $_smarty_tpl->tpl_vars['startOrderCol']->value;
} else { ?>0<?php }?>, "asc" ]
        ],
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['tableviewall'];?>
"]
        ],
        "aoColumnDefs": [
            {
                "bSortable": false,
                "aTargets": [ <?php if (isset($_smarty_tpl->tpl_vars['noSortColumns']->value) && $_smarty_tpl->tpl_vars['noSortColumns']->value !== '') {
echo $_smarty_tpl->tpl_vars['noSortColumns']->value;
}?> ]
            },
            {
                "sType": "string",
                "aTargets": [ <?php if (isset($_smarty_tpl->tpl_vars['filterColumn']->value) && $_smarty_tpl->tpl_vars['filterColumn']->value) {
echo $_smarty_tpl->tpl_vars['filterColumn']->value;
}?> ]
            }
        ],
        "stateSave": true
    });

    <?php if (isset($_smarty_tpl->tpl_vars['filterColumn']->value) && $_smarty_tpl->tpl_vars['filterColumn']->value) {?>
    // highlight remembered filter on page re-load
    var rememberedFilterTerm = table.state().columns[<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
].search.search;
    if (rememberedFilterTerm && !alreadyReady) {
        // This should only run on the first "ready" event.
        jQuery(".view-filter-btns a span").each(function(index) {
            if (buildFilterRegex(jQuery(this).text().trim()) == rememberedFilterTerm) {
                jQuery(this).parent('a').addClass('active');
                jQuery(this).parent('a').find('i').removeClass('fa-circle').addClass('fa-dot-circle');
            }
        });
    }
    <?php }?>
alreadyReady = true;
} );
<?php echo '</script'; ?>
>
<?php }
}
