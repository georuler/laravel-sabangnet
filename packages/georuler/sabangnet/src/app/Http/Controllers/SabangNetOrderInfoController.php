<?php
namespace Georuler\Sabangnet\App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Georuler\Sabangnet\App\Traits\SabangNetTrait;

class SabangNetOrderInfoController
{
    use SabangNetTrait;

    public function __construct()
    {
        $this->searchXmlUrl = env('APP_URL').'/api/sabangNets/claim/searchXml';

        $this->searchApiUrl = $this->apiUrl.'/xml_order_info.html?xml_url='.$this->searchXmlUrl;
    }

    /**
     * 주문 검색 xm;
     *
     * @param Request $request
     * @return void
     */
    public function searchXml(Request $request)
    {
        //필수
        $this->data['ORD_ST_DATE'] = $request->ORD_ST_DATE ?? date('Ymd');
        $this->data['ORD_ED_DATE'] = $request->ORD_ED_DATE ?? date('Ymd');
        $this->data['ORD_FIELD'] = $request->ORD_FIELD ?? $this->defaultFieldCreate();

        //선택
        $this->data['JUNG_CHK_YN2'] = $request->JUNG_CHK_YN2 ?? '';
        $this->data['ORDER_ID'] = $request->ORDER_ID ?? '';
        $this->data['MALL_ID'] = $request->MALL_ID ?? '';
        $this->data['ORDER_STATUS'] = $request->ORDER_STATUS ?? '';
        $this->data['LANG'] = $request->LANG ?? '';
        $this->data['PARTNER_ID'] = $request->PARTNER_ID ?? '';
        $this->data['MALL_USER_ID'] = $request->MALL_USER_ID ?? '';
        $this->data['DPARTNER_ID'] = $request->DPARTNER_ID ?? '';

        return response()->view('Xml::searchOrderInfo', $this->data)->header('Content-Type', 'text/xml');
    }

    /**
     * 주문 검색 호출 및 데이터 저장
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        try
        {
            $response = Http::get($this->searchApiUrl);
            $resXml = simplexml_load_string($response->body());

            //@todo res data db insert
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

        return $resXml;
    }

}