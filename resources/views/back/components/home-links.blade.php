<div class="card mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col">Hyperlinks</div>

            <div class="col fs-5 text-end">
                <img src="{{ asset('img/icons/link.png') }}" />
                <img src="{{ asset('img/icons/home.png') }}" />
            </div>
        </div>
    </div>

    <div class="card-body p-2">
        <p>
            You could use this card to display all kind of <b>hyperlinks</b> or buttons to navigate quickly to certain
            parts of your applcation.
        </p>

        <div class="alert alert-secondary p-2" role="alert">
            This application requires at least <a href="https://www.php.net/" target="_blank">PHP 8.2</a> and is built
            using :
            <ul>
                <li><a href="https://laravel.com/" target="_blank">Laravel</a> 11.x (featuring <a
                        href="https://vitejs.dev/" target="_blank">Vite</a>)</li>
                <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap</a> 5.x</li>
                <li><a href="https://datatables.net/" target="_blank">DataTables</a> 2.x</li>
            </ul>
        </div>

        <div class="alert alert-secondary p-2" role="alert">
            <b>Features</b> :
            <ul>
                <li><b>Top button bar</b> to quickly navigate to the main parts of your application</li>
                <li><b>Theme toggle</b> : Light / Dark / System default</li>
                <li><b>Offcanvas menu</b> to access less frequently used parts</li>
                <li><b>Datatables</b>, fully integrated with built-in :</li>
                <ul>
                    <li>Create - Show - Update - Delete (CRUD) with
                        <a href="http://bootboxjs.com/" target="_blank">Bootbox.js</a> dialogs and
                        <a href="https://codeseven.github.io/toastr/" target="_blank">Toastr</a> notifications
                    </li>
                    <li>Copy to clipboard</li>
                    <li>Export to Excel</li>
                    <li>Print function</li>
                    <li>Items per page selector</li>
                    <li>Column visibility selector</li>
                    <li>Search with result highlighting</li>
                    <li>Server-side pagination and filtering</li>
                    <li>Multiple row selection (for mass deletes)</li>
                    <li>Inline boolean field toggleable</li>
                    <li>Help</li>
                </ul>
            </ul>
            <hr />
            <b>Special feature</b> :
            <p>The top menu contains in its center a dropdown selector for the year. This is implemented as a global
                session
                variable <b>[APP].[YEAR]</b> and allows you to easely filter datatable datasets (when needed) to reflect
                the
                data concerning the selected year. This is extreem helpfull if you manage models that depend on the
                year,
                like for instance deliveries, orders, productions, and so on...
            </p>
        </div>
    </div>

    <div class="card-footer">
        <div class="row d-flex align-items-center">
            <div class="col text-danger">
                <h5 id="MyClockTime" onload="showDate();"></h5>
            </div>

            <div class="col text-end">
                <h5 id="MyClockDate" onload="showDate();"></h5>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="module">
        /* -------------------------------------------------------------------------------------------- */
        showTime();
        showDate();

        function showTime() {
            const now = dayjs();

            let h = now.hour();
            let m = now.minute();
            let s = now.second();

            if (h == 0 && m == 0 && s == 0) {
                showDate();
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            const time = h + ":" + m + ":" + s;
            document.getElementById("MyClockTime").textContent = time;

            setTimeout(showTime, 1000);
        }

        function showDate() {
            const now = dayjs();

            let d = now.date();
            let m = now.month() + 1;
            let y = now.year();

            d = (d < 10) ? "0" + d : d;
            m = (m < 10) ? "0" + m : m;

            const date = d + "-" + m + "-" + y;
            document.getElementById("MyClockDate").textContent = date;
        }
        /* -------------------------------------------------------------------------------------------- */
    </script>
@endpush
