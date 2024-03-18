import DataTable from 'datatables.net-bs5';
window.DataTable = DataTable;

import 'dataTables.net-responsive';
import 'datatables.net-select-bs5';
import 'datatables.net-buttons-bs5';
import 'dataTables.net-buttons/js/buttons.colVis.min.mjs';
import 'dataTables.net-buttons/js/buttons.html5.min.mjs';
import 'dataTables.net-buttons/js/buttons.print.min.mjs';

import 'dataTables.mark.js';

import JSZip from 'jszip';
/* -------------------------------------------------------------------------------------- */
DataTable.Buttons.jszip(JSZip);

$.extend(true, $.fn.dataTable.Buttons.defaults.dom.container, {
    className: 'dt-buttons'
})
$.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
    className: 'btn btn-sm'
})

$.extend(true, $.fn.dataTable.defaults, {
    serverSide: true,
    retrieve: true,
    processing: true,
    stateSave: true,
    stateDuration: -1,
    responsive: true,
    language: {
        url: "../json/datatables/i18n/en-GB.json",
    },
    pageLength: 20,
    mark: {
        element: 'span',
        className: 'bg-info'
    },
    select: true,
    order: [],
    buttons: [
        // {
        //     className: 'btn-info',
        //     text: '<i class="bi bi-question"></i>',
        //     titleAttr: 'Help',
        //     action: function (e, dt, node, config) {
        //         $.ajax({
        //             method: 'GET',
        //             url: route('back.general.getDatatablesHelp'),
        //             success: function (response) {
        //                 bootbox.dialog({
        //                     title: "Help",
        //                     message: response,
        //                     size: 'xl',
        //                     onEscape: true,
        //                     backdrop: true,
        //                 });
        //             }
        //         });
        //     }
        // },
        {
            extend: 'copyHtml5',
            className: 'btn-outline-secondary',
            text: '<i class="bi bi-clipboard"></i>',
            titleAttr: 'Copy to clipboard',
            exportOptions: {
                columns: ':visible:not(.no-export)',
                orthogonal: "myExport",
            }
        },
        {
            extend: 'excelHtml5',
            className: 'btn-secondary',
            text: '<i class="bi bi-file-earmark-excel"></i>',
            titleAttr: 'Export to spreadsheet',
            exportOptions: {
                columns: ':visible:not(.no-export)',
                orthogonal: "myExport",
            },
            autoFilter: true,
        },
        {
            extend: 'print',
            className: 'btn-secondary',
            text: '<i class="bi bi-printer"></i>',
            titleAttr: 'Print',
            exportOptions: {
                columns: ':visible:not(.no-export)',
                orthogonal: "myExport",
            },
            //autoPrint: false,
            orientation: 'landscape',
            customize: function (win) {
                // ------------------------------------------------ //
                // print in landscape mode, because it seems        //
                // orientation: 'landscape'                         //
                // is not working on the print button               //
                // ------------------------------------------------ //
                let css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');

                style.type = 'text/css';
                style.media = 'print';

                if (style.styleSheet) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(win.document.createTextNode(css));
                }

                head.appendChild(style);
                // ------------------------------------------------ //
                // formatting                                       //
                // ------------------------------------------------ //
                $(win.document.body).css('padding-top', '0.5rem');
                $(win.document.body).find('h1').css('font-size', '12px');
                $(win.document.body).find('table')
                    .addClass('display')
                    .addClass('compact')
                    .css('font-size', '10px');
                // ------------------------------------------------ //
            },
        },
        {
            extend: 'selectNone',
            className: 'btn-info',
            text: '<i class="bi bi-x"></i>',
            titleAttr: 'Deselect all',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'selectAll',
            className: 'btn-info',
            text: '<i class="bi bi-check"></i>',
            titleAttr: 'Select all',
            exportOptions: {
                columns: ':visible'
            },
            action: function (e, dt, node, config) {
                dt.rows({
                    search: 'applied',
                    page: 'current'
                }).select()
            }
        },
    ],
    layout: {
        top2Start: {
            info: {},
        },
        topStart: {
            pageLength: {
                menu: [10, 20, 25, 50, 75, 100, { label: 'All', value: -1 }]
            },
        },
        top2End: {
            search: {},
        },
        topEnd: {
            paging: {},
        },
        bottomStart: {
            buttons: [
                {
                    extend: 'colvis',
                        postfixButtons: [{
                        extend: 'colvisRestore',
                        text: 'Show all',
                        className: 'table-primary',
                    }],
                    columnText: function (dt, idx, title) {
                        return idx + 1 + ': ' + title;
                    },
                    columns: ':not(.no-visible)',
                }
            ],
        },
        bottomEnd: null,
    },
});
/* -------------------------------------------------------------------------------------- */
