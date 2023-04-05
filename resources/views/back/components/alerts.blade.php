<!-- notification toastr -->
@if (session('notification'))
    <script type="module">
        showToast({
            type: "{{ Session::get('notification')['type'] }}",
            title: "{{ Session::get('notification')['title'] }}",
            message: "{{ Session::get('notification')['message'] }}"
        });
    </script>
@endif
