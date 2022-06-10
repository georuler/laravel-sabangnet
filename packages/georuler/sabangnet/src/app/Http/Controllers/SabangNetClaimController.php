<?php
namespace Georuler\Sabangnet\App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Georuler\Sabangnet\App\Traits\SabangNetTrait;

class SabangNetClaimController
{
    use SabangNetTrait;

    public function __construct()
    {
        $this->searchXmlUrl = env('APP_URL').'/api/sabangNets/claim/searchXml';

        $this->searchApiUrl = $this->apiUrl.'/xml_clm_info.html?xml_url='.$this->searchXmlUrl;
    }

    /**
     * 검색
     *
     * @param Request $request
     * @return void
     */
    public function searchXml(Request $request)
    {
        $this->data['CS_ST_DATE'] = $request->CS_ST_DATE ?? date('Ymd');
        $this->data['CS_ED_DATE'] = $request->CS_ED_DATE ?? date('Ymd');
        $this->data['CS_STATUS'] = $request->CS_STATUS ?? '';

        return response()->view('Xml::searchClaim', $this->data)->header('Content-Type', 'text/xml');
    }

    public function index(Request $request)
    {
        try
        {
            $response = Http::get($this->searchApiUrl);
            $resXml = simplexml_load_string($response->body());
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

        return $resXml;
    }

}