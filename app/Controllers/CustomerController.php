<?php namespace App\Controllers;

use CodeIgniter\Controller;
Use App\Models\CustomerModel;
 
class CustomerController extends Controller
{

	protected $customer;
    protected $request;
	public function __construct()
	{
         $this->customer = new CustomerModel();
         $this->request = \Config\Services::request();
	}

	public function index()
	{
		return view('customer');
	}

	public function test()
	{
		$data = $this->customer->findAll();
		return json_encode($data);
    }
    
    
    public function list()
    {
      try {
        $data = $this->customer->findAll();
        $response['data'] = $data;
        $response['success'] = true;
        $response['message'] = "Successful load";
        return json_encode($response);
      } catch (\Exception $e) {
        $response['success'] = false;
        $response['message'] = $e->getMessage();
        return json_encode($response);
      }
    }


    public function create()
  {
    try {
      $json = $this->request->getJSON();
      // create data
      $insert['name'] = $json->name;
      $insert['email'] = $json->email;
      $insert['phone'] = $json->phone;
      $insert['address'] = $json->address;
      $res = $this->customer->insert($insert);
      $response['success'] = true;
      $response['message'] = "Successful save";
      return json_encode($response);
    }
    catch (\Exception $e)
    {
      $response['success'] = false;
      $response['message'] = $e->getMessage();
      return json_encode($response);
    }
  }

  public function get($id)
  {
    try {
      $data = $this->customer->find($id);
      if ($data) {
        $response['data'] = $data;
        $response['success'] = true;
        $response['message'] = "Successful load";
      }
      else { 
        $response['success'] = false;
        $response['message'] = "Not found data";
      }
      return json_encode($response);
    } catch (\Exception $e) {
      $response['success'] = false;
      $response['message'] = $e->getMessage();
      return json_encode($response);
    }
  }

  public function update($id)
  {
      try {
        $json = $this->request->getJSON();
        $update['name'] = $json->name;
        $update['email'] = $json->email;
        $update['phone'] = $json->phone;
        $update['address'] = $json->address;
        $res = $this->customer->update($id,$update);
        $response['success'] = true;
        $response['message'] = "Successful update";
        return json_encode($response);
      } catch (\Exception $e) {
        $response['success'] = false;
        $response['message'] = $e->getMessage();
        return json_encode($response);
      }
  }

  public function delete($id)
  {
    try {
      // $res = $this->customer->where("id",$id)->delete();
      $res = $this->customer->delete($id);
  		$response['res'] = $res;
  		$response['success'] = true;
  		$response['message'] = "Successful delete";
  		return json_encode($response);
    }
    catch (\Exception $e) {
      $response['success'] = false;
      $response['message'] = $e->getMessage();
      return json_encode($response);
    } 
  }
}

