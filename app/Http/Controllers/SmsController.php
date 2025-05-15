<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    
    private $defaultSender = 'UjumbeSMS'; // Change if you have a registered sender ID

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allSms = Sms::all();

        return view('sms.index', compact('allSms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('sms.create');
    }


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
     {
         // Validate input
         $validated = $request->validate([
             'phone_number' => 'required|string|regex:/^0[0-9]{9}$/',
             'message' => 'required|string|max:1600',
         ]);
     
         try {
             // Format phone number
             $phoneNumber = $this->formatNumbers($validated['phone_number']);
             $message = $validated['message'];
             $sender = $this->defaultSender; // Your default sender ID
     
             // Prepare data payload
             $data = [
                 'data' => [
                     [
                         'message_bag' => [
                             'numbers' => $phoneNumber,
                             'message' => $message,
                             'sender' => $sender
                         ],
                     ],
                 ],
             ];
     
             // Initialize cURL
             $ch = curl_init(env('SMS_ENDPOINT'));
     
             // Set cURL options
             curl_setopt_array($ch, [
                 CURLOPT_CONNECTTIMEOUT => 10,
                 CURLOPT_TIMEOUT => 30, // Increased timeout to 30 seconds
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_SSL_VERIFYPEER => false,
                 CURLOPT_SSL_VERIFYHOST => false,
                 CURLOPT_POST => true,
                 CURLOPT_HTTPHEADER => [
                     'Content-Type: application/json',
                     'X-Authorization: ' . env('SMS_API_KEY'),
                     'email: ' . env('SMS_EMAIL')
                 ],
                 CURLOPT_POSTFIELDS => json_encode($data)
             ]);
     
             // Execute and get response
             $response = curl_exec($ch);
             $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
             $error = curl_error($ch);
             curl_close($ch);
     
             // Handle response
             if ($error) {
                 throw new \Exception("cURL Error: " . $error);
             }
     
             $responseData = json_decode($response, true);
     
             if (!isset($responseData['status']['type'])) {
                 throw new \Exception("Unexpected API response format");
             }
     
             if ($responseData['status']['type'] === 'success') {

                // save to sms table
                // Sms::create($validated);


                 return redirect()->route('sms.index')
                     ->with('success', 'SMS sent successfully!');
             }
     
             throw new \Exception($responseData['status']['description'] ?? 'Failed to send SMS');
     
         } catch (\Exception $e) {
             Log::error('SMS sending failed: ' . $e->getMessage(), [
                 'exception' => $e,
                 'input' => $request->all()
             ]);
             
             return back()
                 ->withInput()
                 ->with('error', 'Failed to send SMS: ' . $e->getMessage());
         }
     }
     
     private function formatNumbers($numbers)
     {
         $numbersArray = explode(',', $numbers);
         $formattedNumbers = [];
     
         foreach ($numbersArray as $number) {
             // Remove all non-digit characters
             $cleanNumber = preg_replace('/[^0-9]/', '', trim($number));
     
             // Convert to 254 format if it starts with 0
             if (str_starts_with($cleanNumber, '0')) {
                 $cleanNumber = '254' . substr($cleanNumber, 1);
             }
     
             $formattedNumbers[] = $cleanNumber;
         }
     
         return implode(',', $formattedNumbers);
     }


     public function allSms()
     {
         //
 
         return view('sms.create');
     }

     public function toAll()
     {
        $clients = Clients::all();

        return view('sms.all', compact('clients'));
     }


     public function sendAll(Request $request)
     {
        $validated = $request->validate([
            'phone_numbers' => 'required|array|min:1',
            'phone_numbers.*' => [
                'required',
                'string',
                'regex:/^\+?[0-9]{7,15}$/',
                Rule::exists('users', 'phone')
            ],
            'message' => 'required|string|max:1600'
        ]);


        try {
           
    
            // Prepare data payload
            $data = [
                'data' => [
                    [
                        'message_bag' => [
                            'numbers' => implode(',', $validated['phone_numbers']),
                            'message' => $validated['message'],
                            'sender' => env('SENDER')
                        ],
                    ],
                ],
            ];
    
            // Initialize cURL
            $ch = curl_init(env('SMS_ENDPOINT', 'https://ujumbesms.co.ke/api/messaging'));
    
            // Set cURL options
            curl_setopt_array($ch, [
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT => 30, // Increased timeout to 30 seconds
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'X-Authorization: ' . env('SMS_API_KEY'),
                    'email: ' . env('SMS_EMAIL')
                ],
                CURLOPT_POSTFIELDS => json_encode($data)
            ]);
    
            // Execute and get response
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
    
            // Handle response
            if ($error) {
                throw new \Exception("cURL Error: " . $error);
            }
    
            $responseData = json_decode($response, true);
    
            if (!isset($responseData['status']['type'])) {
                throw new \Exception("Unexpected API response format");
            }
    
            if ($responseData['status']['type'] === 'success') {

               // save to sms table
            //    Sms::create($validated);


                return redirect()->route('sms.index')
                    ->with('success', 'SMS sent successfully!');
            }
    
            throw new \Exception($responseData['status']['description'] ?? 'Failed to send SMS');
    
        } catch (\Exception $e) {
            Log::error('SMS sending failed: ' . $e->getMessage(), [
                'exception' => $e,
                'input' => $request->all()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Failed to send SMS: ' . $e->getMessage());
        }
     }
 

   
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}