import './bootstrap';
import $ from 'jquery';

import Swal from "sweetalert2";
window.Swal = Swal;

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.min.css';
import 'fontawesome';

import './script';

$(document).ready( function () {
    $('#sopTable').DataTable({
        scrollCollapse: true,
        scrollX: true,
        paging: false
    });
} );