<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactStoreRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    protected ContactService $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return view('user.pages.contact.index');
    }

    public function store(ContactStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->contactService->store($request);
            DB::commit();

            return redirect()->route('home.index')->with('message-success', 'Phản hồi đã được gửi đến admin!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home.index')->with('message-error', 'Đã xảy ra lỗi!');
        }
    }
}
