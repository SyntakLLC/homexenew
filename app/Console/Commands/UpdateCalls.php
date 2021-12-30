<?php

namespace App\Console\Commands;

use App\Models\Call;
use Illuminate\Console\Command;

class UpdateCalls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:calls';
    protected $name = 'update:calls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs the most recent calls and adds them to our database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $calls = $this->fubApiCall('calls')->calls;

        foreach ($calls as $key => $call) {
            $database_call = Call::where('unique_call_id', $call->id)->first();
            if ($database_call === null) {
                $call = Call::create([
                    'unique_call_id' => $call->id,
                    'user_id' => $call->userId,
                    'user_name' => $call->userName,
                    'lead_name' => $call->name,
                    'outcome' => $call->outcome,
                    'duration' => $call->duration,
                    'recording_url' => $call->recordingUrl,
                ]);
            }
        }
        $this->info('Successfully updated the calls.');
    }

    protected function fubApiCall($category)
    {
        //        $fubApiKey = 'a82a6da8a456cd6ff88de95757317c66';
        $fubApiKey = 'fka_02fOpUHSb9aEpSz50NLqN3XuD26nehrtxG';

        // init cURL
        $curl = curl_init('https://api.followupboss.com/v1/' . $category);

        // getting calls
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $fubApiKey . ':');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

        $responseCalls = curl_exec($curl);
        if ($responseCalls === false) {
            exit('cURL error: ' . curl_error($curl) . "\n");
        }
        return json_decode($responseCalls);
    }
    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output)) {
            $output = implode(',', $output);
        }

        echo "<script>dd('Debug Objects: " . $output . "' );</script>";
    }
}
