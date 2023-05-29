import DataTable from 'datatables.net-bs5';
window.DataTable = DataTable;

import 'datatables.net-select-bs5';
import 'dataTables.net-responsive';
import 'datatables.net-buttons-bs5';
import 'dataTables.net-buttons/js/buttons.colVis.min.mjs';
import 'dataTables.net-buttons/js/buttons.html5.min.mjs';
import 'dataTables.net-buttons/js/buttons.print.min.mjs';

import 'dataTables.mark.js';

import JSZip from 'jszip';
import pdfMake from 'pdfmake';
import * as pdfFonts from "pdfmake/build/vfs_fonts.js";
//pdfMake.vfs = pdfFonts.pdfMake.vfs;
pdfMake.vfs = window.pdfMake.vfs;
/* -------------------------------------------------------------------------------------- */
DataTable.Buttons.jszip(JSZip);
DataTable.Buttons.pdfMake(pdfMake);

$.extend(true, DataTable.Buttons.defaults, {
    dom: {
        buttonLiner: {
            tag: ''
        },
    },
});

$.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
    className: 'btn btn-sm'
})
$.extend(true, $.fn.dataTable.Buttons.defaults.dom.container, {
    className: 'dt-buttons'
})

$.extend(DataTable.ext.classes, {
    sTable: "dataTable table table-striped table-bordered table-hover table-sm",
});

$.extend(true, $.fn.dataTable.defaults, {
    serverSide: true,
    retrieve: true,
    dom: "<'row px-1 mb-1'<'col-sm-12 col-md-8'i><'col-sm-12 col-md-4'f>>" +
        "<'row px-1'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'p>>" +
        "<'row'<'col-sm-12'tr>>",
    processing: true,
    deferRender: true,
    stateSave: true,
    stateDuration: -1,
    responsive: true,
    language: {
        url: "../json/datatables/i18n/en-GB.json",
    },
    lengthMenu: [
        [20, 25, 50, 75, 100, -1],
        [20, 25, 50, 75, 100, "All"]
    ],
    pageLength: 20,
    pagingType: 'full_numbers',
    mark: {
        element: 'span',
        className: 'bg-info'
    },
    select: true,
    order: [],
    buttons: [
        {
            className: 'btn-info',
            text: '<i class="bi bi-question"></i>',
            titleAttr: 'Help',
            action: function (e, dt, node, config) {
                $.ajax({
                    method: 'GET',
                    url: route('back.general.getDatatablesHelp'),
                    success: function (response) {
                        bootbox.dialog({
                            title: "Help",
                            message: response,
                            size: 'xl',
                            onEscape: true,
                            backdrop: true,
                        });
                    }
                });
            }
        },
        {
            extend: 'colvis',
            className: 'btn-outline-dark',
            text: '<i class="bi bi-columns"></i>',
            titleAttr: 'Column visibility',
            postfixButtons: [{
                extend: 'colvisRestore',
                text: 'Show all',
                className: 'bg-info',
            }],
            columns: ':not(.no-visible)'
        },
        {
            extend: 'copyHtml5',
            className: 'btn-outline-dark',
            text: '<i class="bi bi-clipboard"></i>',
            titleAttr: 'Copy to clipboard',
            exportOptions: {
                columns: ':visible:not(.no-export)',
                orthogonal: "myExport",
            }
        },
        {
            extend: 'pdfHtml5',
            className: 'btn-secondary',
            text: '<i class="bi bi-file-earmark-pdf"></i>',
            titleAttr: 'Export to PDF',
            exportOptions: {
                columns: ':visible:not(.no-export)',
                orthogonal: "myExport",
            },
            download: 'open',
            orientation: 'landscape',
            customize: function (doc) {
                doc.pageMargins = [10, 15, 10, 15];
                doc.defaultStyle.fontSize = 9;
            },
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
    ]
});
/* -------------------------------------------------------------------------------------- */
