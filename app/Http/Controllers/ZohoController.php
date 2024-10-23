<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ZohoController extends Controller
{
    //

    public function getChartAccounts(Request $request) {

        $curl = curl_init();

       // $access_token = $this->getAccessToken();    
       $accessToken = '1000.acdc8814e6ff807499aa920e18fc561b.86903198b5b6eefaa2af66c3696f9596';   

       

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.zohoapis.in/books/v3/chartofaccounts?organization_id='.$request->organizationId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '. $accessToken,
            'Cookie: BuildCookie_60033562669=1; JSESSIONID=3F24EC94F4575C4CF92CCCFF3FF5B62D; _zcsr_tmp=34c16ac8-8c6a-45f9-809e-6d25cd044752; zalb_54900d29bf=b447e0b138d49b104d6a72e8d220b103; zbcscook=34c16ac8-8c6a-45f9-809e-6d25cd044752'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        
        return $response;
    }

    public function getContacts(Request $request) {

        $curl = curl_init();

        // $access_token = $this->getAccessToken();
        $accessToken = '1000.acdc8814e6ff807499aa920e18fc561b.86903198b5b6eefaa2af66c3696f9596';

         // Log::info($request);
        // return $request;

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.zohoapis.in/books/v3/contacts?organization_id='.$request->organizationId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '. $accessToken,
            'Cookie: BuildCookie_60033562669=1; JSESSIONID=24CCC65049AB17285A893520B85C5C9C; _zcsr_tmp=34c16ac8-8c6a-45f9-809e-6d25cd044752; zalb_54900d29bf=b447e0b138d49b104d6a72e8d220b103; zbcscook=34c16ac8-8c6a-45f9-809e-6d25cd044752'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

       
        
        return $response;
    }

    public function getReceipts(Request $request) {

        $curl = curl_init();

        // $access_token = $this->getAccessToken();
        $accessToken = '1000.acdc8814e6ff807499aa920e18fc561b.86903198b5b6eefaa2af66c3696f9596';

         // Log::info($request);
        // return $request;

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.zohoapis.in/books/v3/expenses?organization_id='.$request->organizationId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Zoho-oauthtoken '. $accessToken,
            'Cookie: BuildCookie_60033562669=1; JSESSIONID=24CCC65049AB17285A893520B85C5C9C; _zcsr_tmp=34c16ac8-8c6a-45f9-809e-6d25cd044752; zalb_54900d29bf=b447e0b138d49b104d6a72e8d220b103; zbcscook=34c16ac8-8c6a-45f9-809e-6d25cd044752'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        
        
        return $response;
    }


    // 1000.ae5012166939bf37375ef85078c7685e.3377d3c734c8ae68b39d0f8e7af03e56

    function getAccessToken() {    

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://accounts.zoho.in/oauth/v2/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('client_id' => '1000.NP4OCL5SM2UFNLG5Z4VNIXIU5DWSQU','grant_type' => 'refresh_token','client_secret' => 'b240adb5d810d0f592baf8642cf6aae27f77b274b4','refresh_token' => '1000.e9c1750b86bdfec5c53448e1ef9dbf32.82e6aa5612a818f7311e2722086f1396'),
        CURLOPT_HTTPHEADER => array(
            'Cookie: _zcsr_tmp=30d24c0f-d73f-4b28-a405-7ff144aea20f; iamcsr=30d24c0f-d73f-4b28-a405-7ff144aea20f; zalb_6e73717622=cc36c6f8a6790832246efd66c032e512'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response);
        return $token = $res->access_token;
    }

}
