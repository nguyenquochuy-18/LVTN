<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ContactService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    protected OrderService $orderService;
    protected ProductService $productService;
    protected ContactService $contactService;

    public function __construct(OrderService $orderService, ProductService $productService, ContactService $contactService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        $countProducts = $this->productService->count();
        $countOrders = $this->orderService->count();
        $sales = $this->orderService->getSales();
        $countContacts = $this->contactService->count();
        $email=$request->input("email");
        return view('admin.pages.dashboard.index', compact(
            'countProducts',
            'countOrders',
            'sales',
            'countContacts','email'
        ));
    }
}
