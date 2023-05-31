<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::select(sprintf('%s.*', (new Customer)->getTable()));

            return DataTables::of($customers)
                ->addColumn('DT_RowId', function ($row) {
                    return $row->id;
                })
                ->editColumn('address_street', function ($row) {
                    return $row->address;
                })
                ->editColumn('address_place', function ($row) {
                    return $row->place;
                })
                ->filterColumn('customer_last_name', function ($query, $keyword) {
                    $sql = "CONCAT(customers.customer_last_name, ' ', customers.customer_first_name) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn('address_street', function ($query, $keyword) {
                    $sql = "CONCAT(customers.address_street, ' ', customers.address_number) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->filterColumn('address_place', function ($query, $keyword) {
                    $sql = "CONCAT(customers.address_postal_code, ' ', customers.address_place) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->toJson();
        }

        return view('back.customers.index');
    }

    public function create()
    {
        $countries = Country::orderBy('name', 'asc')->get();

        return view('back.customers.create')->with(compact('countries'));
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->all());

        $notification = [
            'type' => 'success',
            'title' => 'Add ...',
            'message' => 'Item added.',
        ];

        return redirect()->route('back.customers.index')->with('notification', $notification);
    }

    public function show(Customer $customer)
    {
        $countries = Country::where('is_eu', 1)->orderBy('name', 'asc')->get();

        return view('back.customers.show', compact('customer'))->with(compact('countries'));
    }

    public function edit(Customer $customer)
    {
        $countries = Country::orderBy('name', 'asc')->get();

        return view('back.customers.edit', compact('customer'))->with(compact('countries'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        $notification = [
            'type' => 'success',
            'title' => 'Edit ...',
            'message' => 'Item updated.',
        ];

        return redirect()->route('back.customers.index')->with('notification', $notification);
    }

    public function massDestroy(Request $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function getAlikes(Request $request)
    {
        $customer_last_name = $request->customer_last_name;
        $customer_first_name = $request->customer_first_name;
        $company_name = $request->company_name;

        $customers = Customer::when($customer_last_name, function ($query, $customer_last_name) {
            return $query->where('customer_last_name', 'like', '%' . $customer_last_name . '%');
        })->when($customer_first_name, function ($query, $customer_first_name) {
            return $query->where('customer_first_name', 'like', '%' . $customer_first_name . '%');
        })->when($company_name, function ($query, $company_name) {
            return $query->where('company_name', 'like', '%' . $company_name . '%');
        })->orderBy('customer_last_name')->orderBy('customer_first_name')->orderBy('company_name')->get();

        return view('back.customers.get-alikes', compact('customers'))->render();
    }
}
