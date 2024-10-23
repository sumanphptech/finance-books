<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ZohoAuthController extends Controller
{
    public function redirect()
    {
        $clientId = env('ZOHO_CLIENT_ID');
        $redirectUri = env('ZOHO_REDIRECT_URI');
      
        $scope = 'ZohoBooks.fullaccess.create,ZohoBooks.fullaccess.read,ZohoBooks.fullaccess.update';
        
        $authUrl = "https://accounts.zoho.in/oauth/v2/auth?response_type=code&client_id={$clientId}&scope={$scope}&redirect_uri={$redirectUri}&prompt=consent&access_type=offline";

        return redirect($authUrl);
    }

    public function callback(Request $request)
    {

        // Log::info(HIiii);

        $code = $request->query('code');
        $client = new Client();

        try {
        
            $response = $client->post('https://accounts.zoho.in/oauth/v2/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => env('ZOHO_CLIENT_ID'),
                    'client_secret' => env('ZOHO_CLIENT_SECRET'),
                    'redirect_uri' => env('ZOHO_REDIRECT_URI'),
                    'code' => $code,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            // Extract tokens
            $accessToken = $data['access_token'] ?? null;
            $refreshToken = $data['refresh_token'] ?? null;          

            // $accessToken = '1000.739cf5a0a5d8f5bd77a5070cd41b6e0b.85de6f899973d96e537fa85635209aa8';
            // $refreshToken = '1000.1ba18ebd0f8163485ca92017c0f8374a.0215bc2c1072ac2ddfc9ef786fe4be90';

            Log::info($accessToken);
            Log::info($refreshToken);

            // Get Organization
            $organizationsResponse = $client->get('https://www.zohoapis.in/books/v3/organizations',[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken, 
                ]
            ]);

            $getOrganizations = json_decode($organizationsResponse->getBody(), true);

            if(isset($getOrganizations['organizations']) && count($getOrganizations['organizations']) > 0) {
                    $organizationId = $getOrganizations['organizations'][0]['organization_id'] ?? null;
                
            } 

            // Redirect to React frontend with tokens as query parameters
            return redirect()->away('http://localhost:3000?refresh_token=' . $refreshToken . '&access_token=' . $accessToken . '&organization_id=' . $organizationId);

        } catch (\Exception $e) {
            // Log::error('Error exchanging code for tokens: ' . $e->getMessage());
            return response()->json(['error' => 'Authentication failed'], 500);
        }

    }
}