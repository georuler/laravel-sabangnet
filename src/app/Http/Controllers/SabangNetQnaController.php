<?php
namespace Georuler\Sabangnet\App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Georuler\Sabangnet\App\Traits\SabangNetTrait;

class SabangNetQnaController
{
    use SabangNetTrait;

    public function __construct()
    {
        $this->searchXmlUrl = env('APP_URL').'/api/sabangNets/qna/searchXml';
        $this->createXmlUrl = env('APP_URL').'/api/sabangNets/qna/createXml';

        $this->searchApiUrl = $this->apiUrl.'/xml_cs_info.html?xml_url='.$this->searchXmlUrl;
        $this->createApiUrl = $this->apiUrl.'/xml_cs_ans.html?xml_url='.$this->createXmlUrl;
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

        return response()->view('Xml::searchQna', $this->data)->header('Content-Type', 'text/xml');
    }

    /**
     * 등록
     *
     * @param Request $request
     * @return void
     */
    public function createXml(Request $request)
    {
        $this->data['NUM'] = $request->NUM ?? '';
        $this->data['CS_RE_CONTENT'] = $request->CS_RE_CONTENT ?? '';

        return response()->view('Xml::createQna', $this->data)->header('Content-Type', 'text/xml');
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