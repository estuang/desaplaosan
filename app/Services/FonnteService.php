<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('FONNTE_API_KEY');
    }

    public function sendMessage($to, $message)
    {
        try {
            Log::info('Sending message:', [
                'to' => $to,
                'message' => $message
            ]);

            $response = $this->client->post('https://api.fonnte.com/send', [
                'headers' => [
                    'Authorization' => $this->apiKey
                ],
                'multipart' => [
                    [
                        'name' => 'target',
                        'contents' => $to
                    ],
                    [
                        'name' => 'message',
                        'contents' => $message
                    ],
                    [
                        'name' => 'countryCode',
                        'contents' => '62'
                    ],
                    [
                        'name' => 'delay',
                        'contents' => '2'
                    ]
                ]
            ]);

            // Get response body as string
            $responseBody = $response->getBody()->getContents();

            // Log the raw response
            Log::info('Fonnte response:', [
                'status' => $response->getStatusCode(),
                'body' => $responseBody
            ]);

            // Only try to decode if response is JSON
            if (
                $response->hasHeader('Content-Type') &&
                strpos($response->getHeader('Content-Type')[0], 'application/json') !== false
            ) {
                $jsonResponse = json_decode($responseBody, true);
                return isset($jsonResponse['status']) && $jsonResponse['status'] === true;
            }

            // If not JSON, check status code
            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            Log::error('Error sending message:', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function sendFile($phone, $filePath, $caption = null)
    {
        try {
            if (!file_exists($filePath)) {
                Log::error('File not found:', ['path' => $filePath]);
                return false;
            }

            Log::info('Sending file:', [
                'to' => $phone,
                'file' => basename($filePath)
            ]);

            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->attach(
                'file',
                file_get_contents($filePath),
                basename($filePath)
            )->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $caption ?? '',
                'countryCode' => '62'
            ]);

            Log::info('Response from Fonnte:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Error sending file:', [
                'error' => $e->getMessage(),
                'file' => $filePath
            ]);
            return false;
        }
    }

    // public function sendFile($phone, $filePath, $caption = null)
    // {
    //     try {
    //         if (!file_exists($filePath)) {
    //             Log::error('File not found:', ['path' => $filePath]);
    //             return false;
    //         }

    //         Log::info('Sending file:', [
    //             'to' => $phone,
    //             'file' => basename($filePath)
    //         ]);

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => 'https://api.fonnte.com/send',
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'POST',
    //             CURLOPT_POSTFIELDS => array(
    //                 'target' => $phone,
    //                 'message' => $caption ?? '',
    //                 'countryCode' => '62',
    //                 'delay' => '2',
    //                 'file' => new \CURLFile($filePath)
    //             ),
    //             CURLOPT_HTTPHEADER => array(
    //                 'Authorization: ' . $this->apiKey
    //             ),
    //         ));

    //         $response = curl_exec($curl);
    //         $error = null;

    //         if (curl_errno($curl)) {
    //             $error = curl_error($curl);
    //             Log::error('Curl error:', ['error' => $error]);
    //         }

    //         curl_close($curl);

    //         if ($error) {
    //             Log::error('Failed to send file:', ['error' => $error]);
    //             return false;
    //         }

    //         Log::info('Fonnte response:', ['response' => $response]);
    //         return true;
    //     } catch (\Exception $e) {
    //         Log::error('Error sending file:', [
    //             'error' => $e->getMessage(),
    //             'file' => $filePath
    //         ]);
    //         return false;
    //     }
    // }
}
