@foreach ($customers as $customer)
    <a href="{{ route('back.customers.edit', [$customer->id]) }}">{!! $customer->CustomerFullBold !!}</a><br />
@endforeach
