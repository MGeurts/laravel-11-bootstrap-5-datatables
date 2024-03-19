<div class="card mb-2">
    <div class="card-header">
        <div class="row">
            <div class="col">Status <strong>{{ Session::get('APP.YEAR') }}</strong></div>

            <div class="col fs-5 text-end">
                <img src="{{ asset('img/icons/statistics.png') }}" />
                <img src="{{ asset('img/icons/home.png') }}" />
            </div>
        </div>
    </div>

    <div class="card-body p-2">
        <p>
            You could use this card to display all kind of <b>status</b> indicators to get a quick overview of your
            application.
        </p>

        <div class="alert alert-danger p-2" role="alert">
            <p>In this demo project, 3 models are already implemented :</p>
            <ul>
                <li><a href="{{ route('back.customers.index') }}">Customers</a>, available to all logged in users</li>
                <br />
                <li><a href="{{ route('back.users.index') }}">Users</a> and <a
                        href="{{ route('back.userslog.index') }}">Users Log</a>, only available to logged in users with
                    the property
                    <b>Developer</b>
                </li>
            </ul>
            <p>Use their controllers and the corresponding views as a base to create new datatables utilising your own
                project models.</p>
        </div>

        <div class="alert alert-secondary p-2" role="alert">
            <p>This application also has a built-in (only available when the user is <b>Developer</b>) :</p>
            <ul>
                <li><a href="{{ url('/back/developer/log-monitor') }}" target="_blank">Log Viewer</a></li>
                <li><a href="{{ route('back.backups.index') }}">Backup manager</a></li>
            </ul>
        </div>

        <br /><br /><br />
        <p>Open source under MIT License.</p>

        <div class="alert alert-info p-2" role="alert">
            If you like this project, consider giving it a star on <a
                href="https://github.com/MGeurts/laravel-10-bootstrap-5-datatables" target="_blank">GitHub</a>. Thanks.
        </div>

        <p>Happy programming.</p>

        <div class="float-end">
            <table>
                <tr>
                    <td class="text-end">
                        Design &amp; Development by<br />
                        <a href="https://www.kreaweb.be" target="_blank" tabindex="-1">kreaweb.be</a>
                    </td>
                    <td>
                        <a href="https://www.kreaweb.be" title="kreaweb.be" target="_blank" tabindex="-1">
                            <img src="{{ asset('img/logo/kreaweb-035.png') }}" alt="kreaweb.be" />
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <div class="row ">
            <div class="col small">
                <a href="https://www.yourcompany.com" target="_blank">www.yourcompany.com</a>
            </div>

            <div class="col small text-end d-none d-md-block">
                Phone : +1 730 847-416-2143<br />
                Mobile : +1 730 773-672-7009
            </div>

            <div class="col text-end">
                Your Company Name<br />4087 Johnstown Road<br />60606 Chicago</br>Illinois<br />U.S.A
            </div>
        </div>
    </div>
</div>
