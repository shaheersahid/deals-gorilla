<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\DataTableService;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class UserController extends Controller
{
    protected $dataTableService;

    public function __construct(DataTableService $dataTableService)
    {
        $this->dataTableService = $dataTableService;
    }

    /**
     * Display a listing of the resource (customers).
     * 
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $customers = User::where('is_admin', 0);
            return $this->dataTableService->customersTable($customers);
        }

        return view('admin.content.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('admin.content.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreCustomerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->is_active = $request->has('is_active');
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param User $customer
     * @return View
     */
    public function show(User $customer): View
    {
        return view('admin.content.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param User $customer
     * @return View
     */
    public function edit(User $customer): View
    {
        return view('admin.content.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateCustomerRequest $request
     * @param User $customer
     * @return RedirectResponse
     */
    public function update(UpdateCustomerRequest $request, User $customer): RedirectResponse
    {
        $validated = $request->validated();

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        if (!empty($validated['password'])) {
            $customer->password = Hash::make($validated['password']);
        }
        $customer->is_active = $request->has('is_active');
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param User $customer
     * @return RedirectResponse
     */
    public function destroy(User $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
