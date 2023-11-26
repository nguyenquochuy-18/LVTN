<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Admin;
use App\Repositories\Profile\ProfileRepository;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $profileService;
    protected $profileRepository;


    public function __construct(ProfileService $profileService,ProfileRepository $profileRepository)
    {
        $this->profileService = $profileService;
        $this->profileRepository=$profileRepository;

    }

    public function index($id)
    {


        $profile=$this->profileRepository->getByUser($id);

        return view('admin.pages.profile.index', compact("profile"));
    }



    public function edit()
    {
        // $profile= $this->admin->findUserAdminId($id);

        return view('admin.pages.profile.edit');
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->profileService->update($request, $id);
            DB::commit();

            return redirect()->route('admin.categories.index')->with('message-success', 'cập nhật danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.categories.index')->with('message-failed', 'cập nhật danh mục thất bại!');
        }
    }


}
