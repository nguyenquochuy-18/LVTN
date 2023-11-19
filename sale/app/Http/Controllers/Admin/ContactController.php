<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactStoreRequest;
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
        $contacts = $this->contactService->paginate();
        return view('admin.pages.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = $this->contactService->find($id);
        return view('admin.pages.contact.show', compact('contact'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->contactService->delete($id);
            DB::commit();

            return response()->json([
                'message' => 'thành công!!',
                'status' => Response::HTTP_OK
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'thất bại!!',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
