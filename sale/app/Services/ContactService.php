<?php

namespace App\Services;

use App\Repositories\Contact\ContactRepositoryInterface;

class ContactService
{
    protected ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function paginate($perPage = 10)
    {
        return $this->contactRepository->paginate($perPage);
    }

    public function find($id)
    {
        return $this->contactRepository->find($id);
    }

    public function delete($id)
    {
        $contact = $this->contactRepository->find($id);
        $contact->delete();

        return $contact;
    }

    public function store($request)
    {
        $data = $request->all();
        return $this->contactRepository->create($data);
    }

    public function count()
    {
        return $this->contactRepository->count();
    }
}
