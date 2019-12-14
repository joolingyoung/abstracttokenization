<?php

namespace App\Http\Controllers;

use BoxAU;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class BoxController extends Controller
{
    public function generateAccessToken()
    {
        $config_path = storage_path('app/box/config.json');
        $json = file_get_contents($config_path);
        $config = json_decode($json);

        $private_key = $config->boxAppSettings->appAuth->privateKey;
        $passphrase = $config->boxAppSettings->appAuth->passphrase;
        $key = openssl_pkey_get_private($private_key, $passphrase);

        $authenticationUrl = 'https://api.box.com/oauth2/token';

        $claims = [
            'iss' => $config->boxAppSettings->clientID,
            'sub' => $config->enterpriseID,
            'box_sub_type' => 'enterprise',
            'aud' => $authenticationUrl,
            // This is an identifier that helps protect against
            // replay attacks
            'jti' => base64_encode(random_bytes(64)),
            // We give the assertion a lifetime of 45 seconds
            // before it expires
            'exp' => time() + 45,
            'kid' => $config->boxAppSettings->appAuth->publicKeyID,
        ];

        // The API support "RS256", "RS384", and "RS512" encryption
        $assertion = JWT::encode($claims, $key, 'RS512');

        $params = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $assertion,
            'client_id' => $config->boxAppSettings->clientID,
            'client_secret' => $config->boxAppSettings->clientSecret,
        ];

        // Make the request
        $client = new Client();
        $response = $client->request('POST', $authenticationUrl, [
            'form_params' => $params,
        ]);

        // Parse the JSON and extract the access token
        $data = $response->getBody()->getContents();
        $access_token = json_decode($data)->access_token;

        return $this->createUser($access_token, $config, $authenticationUrl, $key);
        return response()->json([
            'response' => $access_token,
        ]);
    }

    public function createUser($access_token, $config, $authenticationUrl, $key)
    {

        // Make the request
        $userUrl = 'https://api.box.com/2.0/users';

        $params = array(
            'name' => 'Abstract Box Bots',
            'is_platform_access_only' => true,
        );

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $access_token,
            ],
        ]);
        $response = $client->post($userUrl, [
            'body' => json_encode($params),
        ]);

        $user = json_decode($response->getBody()->getContents());

        $claims = [
            'iss' => $config->boxAppSettings->clientID,
            'sub' => $user->id,
            'box_sub_type' => 'user',
            'aud' => $authenticationUrl,
            // This is an identifier that helps protect against
            // replay attacks
            'jti' => base64_encode(random_bytes(64)),
            // We give the assertion a lifetime of 45 seconds
            // before it expires
            'exp' => time() + 45,
            'kid' => $config->boxAppSettings->appAuth->publicKeyID,
        ];

        // The API support "RS256", "RS384", and "RS512" encryption
        $assertion = JWT::encode($claims, $key, 'RS512');

        $params = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $assertion,
            'client_id' => $config->boxAppSettings->clientID,
            'client_secret' => $config->boxAppSettings->clientSecret,
        ];

        // Make the request
        $client = new Client();
        $response = $client->request('POST', $authenticationUrl, [
            'form_params' => $params,
        ]);

        // Parse the JSON and extract the access token
        $data = $response->getBody()->getContents();
        $token = json_decode($data)->access_token;

        return response()->json([
            'response' => $token,
        ]);
    }

    public function rootFolder()
    {
        return response()->json([
            'response' => json_decode(BoxAU::getFolderInfo('0', true)),
        ]);
    }

    public function getFolderItems(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::getFolderItems($id, true)),
        ]);
    }

    public function createFolder(Request $request)
    {
        $name = $request->get('name');
        $parent = $request->get('parent');
        return response()->json([
            'response' => json_decode(BoxAU::createFolder($name, $parent, true)),
        ]);
    }

    public function updateFolder(Request $request)
    {
        $name = $request->get('name');
        $id = $request->get('id');
        return response()->json([
            'response' => json_decode(BoxAU::updateFolder($id, $name, true)),
        ]);
    }

    public function deleteFolder(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::deleteFolder($id, true)),
        ]);
    }

    public function permanentDeleteFolder(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::permanentDelete($id, true)),
        ]);
    }

    public function copyFolder(Request $request)
    {
        $id = $request->get('id');
        $destination = $request->get('destination');
        return response()->json([
            'response' => json_decode(BoxAU::copyFolder($id, $destination, true)),
        ]);
    }

    public function getFileInfo(Request $request, $id)
    {
        $destination = $request->get('destination');
        return response()->json([
            'response' => json_decode(BoxAU::getFileInfo($id, true)),
        ]);
    }

    public function updateFileInfo(Request $request)
    {
        $name = $request->get('name');
        $id = $request->get('id');
        return response()->json([
            'response' => json_decode(BoxAU::updateFileInfo($id, $name, true)),
        ]);
    }

    public function downloadFile(Request $request, $id)
    {
        return BoxAU::downloadFile($id);
    }

    public function uploadFile(Request $request)
    {
        $files = $request->file('files');
        $parent = $request->get('parent');
        $name = $request->get('name');
        $res = array();
        foreach ($files as $key => $file) {
            $a = BoxAU::uploadFile($file, $parent, $name, true);
            array_push($res, json_decode($a));
        }
        return response()->json([
            'response' => $res
        ]);
    }

    public function deleteFile(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::deleteFile($id, true)),
        ]);
    }

    public function updateFile(Request $request)
    {
        $name = $request->get('name');
        $id = $request->get('id');
        return response()->json([
            'response' => json_decode(BoxAU::updateFile($name, $id, true)),
        ]);
    }

    public function copyFile(Request $request)
    {
        $id = $request->get('id');
        $destination = $request->get('destination');
        return response()->json([
            'response' => json_decode(BoxAU::copyFile($id, $destination, true)),
        ]);
    }

    public function getEmbedLink(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::getEmbedLink($id, true)),
        ]);
    }

    public function getThumbnail(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::getThumbnail($id, true)),
        ]);
    }

    public function getShareFile(Request $request, $id)
    {
        $resp = BoxAU::createShareLink($id, true);
        \Log::info($id);
        \Log::info($resp);
        return response()->json([
            'response' => json_decode($resp),
        ]);
    }

    public function getShareFolder(Request $request, $id)
    {
        return response()->json([
            'response' => json_decode(BoxAU::createSharedLinkFolder($id, true)),
        ]);
    }
}
