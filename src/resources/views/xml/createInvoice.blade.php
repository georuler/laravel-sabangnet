<?xml version="1.0" encoding="EUC-KR"?>
<SABANG_INV_REGI>		
	<HEADER>	
		<SEND_COMPAYNY_ID>{{config('sabangnet.SEND_COMPAYNY_ID')}}</SEND_COMPAYNY_ID>
		<SEND_AUTH_KEY>{{config('sabangnet.SEND_AUTH_KEY')}}</SEND_AUTH_KEY>
		<SEND_DATE>{{config('sabangnet.SEND_DATE')}}</SEND_DATE>
		<SEND_INV_EDIT_YN>N</SEND_INV_EDIT_YN>
	</HEADER>
	
	@foreach ($rows as $row)
	<DATA>
		<SABANGNET_IDX><![CDATA[{{$row->order_seq}}]]></SABANGNET_IDX>
		<TAK_CODE><![CDATA[001]]></TAK_CODE>
		<TAK_INVOICE><![CDATA[7778881111]]></TAK_INVOICE>
		<DELV_HOPE_DATE><![CDATA[20100701]]></DELV_HOPE_DATE>
	</DATA>	
	@endforeach
	
</SABANG_INV_REGI>		
