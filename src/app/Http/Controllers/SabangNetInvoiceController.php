<?php
namespace Georuler\Sabangnet\App\Http\Controllers;

use App\Models\SalesOrders\SalesOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Georuler\Sabangnet\App\Traits\SabangNetTrait;

class SabangNetInvoiceController
{
    use SabangNetTrait;

    public $model;

    public function __construct()
    {
        $this->model = new SalesOrder;
        $this->createXmlUrl = env('APP_URL').'/api/sabangNets/invoice/createXml';

        $this->createApiUrl = $this->apiUrl.'/xml_order_invoice.html?xml_url='.$this->createXmlUrl;
    }

    /**
     * 등록
     *
     * @param Request $request
     * @return void
     */
    public function createXml(Request $request)
    {
        $request->whereInfield = [1, 2, 3];
        $this->data['NUM'] = $request->NUM ?? '';
        $this->data['CS_RE_CONTENT'] = $request->CS_RE_CONTENT ?? '';
        $this->data['rows'] = $this->model->whereIn($this->model->primaryKey, $request->whereInfield)->get();

        return response()->view('Xml::createInvoice', $this->data)->header('Content-Type', 'text/xml');
    }

    public function store(Request $request)
    {
        try
        {
            $response = Http::post($this->createApiUrl);
            $resXml = simplexml_load_string($response->body());
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

        return $resXml;
    }
}