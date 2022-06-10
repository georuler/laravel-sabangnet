<?php
namespace Georuler\Sabangnet\App\Traits;

use Exception;

/**
 * 사방넷 기본정보
 */
trait SabangNetTrait
{
    public $apiUrl = 'https://r.sabangnet.co.kr/RTL_API';
    
    public $searchXmlUrl;
    public $createXmlUrl;

    public $searchApiUrl;
    public $createApiUrl;

    //request data
    public $data = [
        //data 추가하여 사용
    ];

    
    /**
     * 검색 조건 필드 생성
     *
     * @param string $field
     * @return void
     */
    public function defaultFieldCreate($field = 'REG_DATE')
    {
        $ordFields = config('sabangnet.ord_field');
        $defaultFields = [];
        
        foreach($ordFields as $key => $val){
            array_push($defaultFields, $key);
            if($key == $field) {
                break;
            }
        }

        //요청 오류 시 low 함수로 처리
        $res = implode("|", $defaultFields);

        return $res;
    }
}