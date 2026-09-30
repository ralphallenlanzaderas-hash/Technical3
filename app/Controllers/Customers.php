<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
{
    $data = [
        'title'     => 'Customer Directory',
        'customers' => $this->customerModel->findAll(),
    ];

    return view('customers/index', $data);
}

    public function new()
{
    $data = [
        'title'      => 'Add New Customer',
        'validation' => \Config\Services::validation(),
    ];

    return view('customers/new', $data);
}

    public function create()
    {
        $postData = $this->request->getPost();

        if (! $this->customerModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->customerModel->errors());
        }

        return redirect()->to(base_url('customers'))->with('success', 'Customer successfully added!');
    }

    public function edit($id = null)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound("Customer with ID #{$id} was not found.");
        }

        $data = [
            'title'      => 'Edit Customer',
            'customer'   => $customer,
            'validation' => \Config\Services::validation(),
        ];

        return view('customers/edit', $data);
    }

    public function update($id = null)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound("Customer with ID #{$id} was not found.");
        }

        $postData = $this->request->getPost();
        $postData['id'] = $id;

        if (! $this->customerModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->customerModel->errors());
        }

        return redirect()->to(base_url('customers'))->with('success', 'Customer record updated successfully!');
    }

    public function delete($id = null)
    {
        $customer = $this->customerModel->find($id);

        if ($customer) {
            $this->customerModel->delete($id);
            return redirect()->to(base_url('customers'))->with('success', 'Customer deleted successfully.');
        }

        return redirect()->to(base_url('customers'))->with('error', 'Customer not found.');
    }
}