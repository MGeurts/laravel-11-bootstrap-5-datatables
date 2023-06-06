<p align="center">
    <img src="https://www.kreaweb.be/wp-content/uploads/2023/03/laravel-10-bootstrap-datatables-04.webp" width="800">
</p>

## About this project

This application requires at least PHP 8.1 and is built using :
<ul>
    <li><a href="https://laravel.com/" target="_blank">Laravel 10</a> (featuring <a href="https://vitejs.dev/" target="_blank">Vite</a>)</li>
    <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap 5.3</a></li>
    <li><a href="https://datatables.net/" target="_blank">DataTables</a></li>
</ul>

## Features

<ul>
    <li><b>Top button bar</b> to quickly navigate to the main parts of your application</li>
    <li><b>Theme toggle</b> Light / Dark / System default</li>
    <li><b>Offcanvas menu</b> to access less frequently used parts</li>
    <li><b>Datatables</b>, fully integrated with built-in :</li>
    <ul>
        <li>Create - Show - Update - Delete (CRUD) with
            <a href="http://bootboxjs.com/" target="_blank">Bootbox.js</a> dialogs and
            <a href="https://codeseven.github.io/toastr/" target="_blank">Toastr</a> notifications
        </li>
        <li>Copy to clipboard</li>
        <li>Export to PDF and Excel</li>
        <li>Print function</li>
        <li>Items per page selector</li>
        <li>Column visibility selector</li>
        <li>Search with result highlighting</li>
        <li>Server-side pagination and filtering</li>
        <li>Multiple row selection (for mass deletes)</li>
        <li>Inline boolean toggable</li>
        <li>Help</li>
        <li>Datatables are fully responsive on smaller screens</li>
    </ul>
</ul>

## Special features

<p>The top menu contains in its center a dropdown selector for the year. This is implemented as a global session variable <b>[APP].[YEAR]</b> and allows you to easely filter datatable datasets (when needed) to reflect the data concerning the selected year. This is extreem helpfull if you manage models that depend on the year, like for instance deliveries, orders, productions, and so on ...</p>

<p>This application has a built-on <b>Backup manager</b> :
    <ul>
        <li>Backups can be initiated and managed manually</li>
        <li>Backups can be scheludeld by issuing a cron job on your development server</li>
   </ul>
</p>

<p>This application has a built-on <b>Log Viewer</b> showing :
    <ul>
        <li>All errors (ERROR)</li>
        <li>All scheduled backups (INFO)</li>
         <li>All executed database queries, but only in development mode (DEBUG)</li>
   </ul>
</p>

## Models implemented

In this demo project, 3 models are already implemented :
<ul>
    <li><b>Customers</b>, available to all logged in users</li><br />
    <li><b>Users</b> and <b>Users Log</b>, only available to logged in users with the property <b>Developer</b>
    </li>
</ul>
You can use their controllers and the corresponding views as a base to create new datatables utilising your own project models.

## Documentation

<a href="https://www.kreaweb.be/laravel-10-bootstrap-5-datatables/" target="_blank">https://www.kreaweb.be/laravel-10-bootstrap-5-datatables/</a>

## Online demo

<a href="https://demo.kreaweb.be/" target="_blank">https://demo.kreaweb.be/</a>

## Credentials

<p>Name : <b>admin@admin.com</b></p>
<p>Password : <b>password</b></p>

## PHP

<b>Be aware you need at least PHP 8.1 to use this project!</b>

## License

This demo Larevel project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Screenshots

<p align="center">
    <img src="https://www.kreaweb.be/wp-content/uploads/2023/03/laravel-10-bootstrap-datatables-02.webp"/>
</p>

<p align="center">
    <img src="https://www.kreaweb.be/wp-content/uploads/2023/03/laravel-10-bootstrap-datatables-03.webp"/>
</p>

<p align="center">
    <img src="https://www.kreaweb.be/wp-content/uploads/2023/03/laravel-10-bootstrap-datatables-04.webp"/>
</p>
