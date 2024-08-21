import $ from 'jquery';
import './bootstrap';

import Swal from "sweetalert2";
window.Swal = Swal;

import 'bootstrap';

import bootstrap from "bootstrap/dist/js/bootstrap.min";
window.bootstrap = bootstrap;

import 'bootstrap/dist/css/bootstrap.min.css';
import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.min.css';
import 'remixicon/fonts/remixicon.css';
import 'select2/dist/css/select2.css';
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css';

import './script';

import 'popper.js';

$(document).ready( function () {
    const fileTable = $('#fileTable').DataTable({
        dom: "lrtip",
        stateSave: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1
        },
        scrollCollapse: true,
        scrollX: true,
        paging: false
    });

    $("#customsearch").on("keyup", function () {
        fileTable.search($(this).val()).draw();
    });
    $("#category").on("change", function () {
        fileTable.search($(this).val()).draw();
    });

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );

    // Popovers
    const popoverTriggerList = document.querySelectorAll(
        '[data-bs-toggle="popover"]'
    );
    const popoverList = [...popoverTriggerList].map(
        (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
    );
    
});