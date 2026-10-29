/* Move existing list metadata only; native forms and pagination handlers stay intact. */
document.addEventListener('DOMContentLoaded', function () {
    var content = document.getElementById('contentarea');
    if (!content) return;
    content.querySelectorAll('form#frmRecordsFound').forEach(function (form) {
        var row = form.querySelector('.row');
        if (!row || row.children.length < 2) return;
        var summary = row.children[0];
        var table = Array.from(content.querySelectorAll('table.datatable')).find(function (candidate) {
            return form.compareDocumentPosition(candidate) & Node.DOCUMENT_POSITION_FOLLOWING;
        });
        if (!table || summary.querySelector('input,select,button')) return;
        var pagination = Array.from(content.querySelectorAll('ul.pagination')).find(function (candidate) {
            return table.compareDocumentPosition(candidate) & Node.DOCUMENT_POSITION_FOLLOWING;
        });
        var paginationBox = pagination && pagination.parentElement;
        var footer = document.createElement('div');
        footer.className = 'workspace-list-footer';
        summary.className = 'workspace-record-summary';
        footer.appendChild(summary);
        if (paginationBox) {
            paginationBox.parentNode.insertBefore(footer, paginationBox);
            footer.appendChild(paginationBox);
        } else {
            var anchor = table.closest('form') || table.closest('.tablebg') || table;
            anchor.insertAdjacentElement('afterend', footer);
        }
        form.classList.add('workspace-list-controls');
        if (row.children[0]) {
            row.children[0].classList.remove('col-md-6');
            row.children[0].classList.add('col-md-12');
        }
    });
});
