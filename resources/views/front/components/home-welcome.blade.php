<div class="card mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col">Welcome ...</div>
            <div class="col fs-5 text-end">
                <i class="bi bi-house-fill"></i>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <img src="{{ asset('img/administration.jpg') }}" alt="administration" class="d-block w-100" />
    </div>

    <div class="card-footer">
        <div class="row">
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
