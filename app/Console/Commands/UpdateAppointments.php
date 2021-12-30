<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:appointments';
    protected $name = 'update:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grabs the most recent appointments and adds them to our database.';

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
        $appointments = $this->fubApiCall('appointments')->appointments;
        $users = $this->fubApiCall('users')->users;

        foreach ($appointments as $key => $appointment) {
            $database_appointment = Appointment::where(
                'unique_appt_id',
                $appointment->id,
            )->first();
            $userName = null;
            foreach ($users as &$user) {
                if ($user->id === $appointment->createdById) {
                    $userName = $user->name;
                }
            }
            if ($database_appointment === null) {
                $appointment = Appointment::create([
                    'unique_appt_id' => $appointment->id,
                    'user_id' => $appointment->createdById,
                    'lead_name' => $this->getLeadId($appointment),
                    'user_name' => $userName,
                    'outcome' => $appointment->outcome,
                    'start' => $appointment->start,
                    'end' => $appointment->end,
                    'title' => $appointment->title,
                    'description' => $appointment->description,
                    'location' => $appointment->location,
                ]);
            }
        }
        $this->info('Successfully updated the appointments.');
    }

    protected function fubApiCall($category)
    {
        //        $fubApiKey = 'a82a6da8a456cd6ff88de95757317c66';
        $fubApiKey = 'fka_02fOpUHSb9aEpSz50NLqN3XuD26nehrtxG';

        // init cURL
        $curl = curl_init('https://api.followupboss.com/v1/' . $category);

        // getting appointments
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $fubApiKey . ':');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($curl);
        if ($response === false) {
            exit('cURL error: ' . curl_error($curl) . "\n");
        }
        return json_decode($response);
    }
    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output)) {
            $output = implode(',', $output);
        }

        echo "<script>dd('Debug Objects: " . $output . "' );</script>";
    }
    protected function getLeadId($appointment)
    {
        $invitees = $appointment->invitees;
        $filteredInvitees = array_filter($invitees, function ($var) {
            $userNames = User::all()->map(function ($item, $key) {
                return $item->name;
            });
            return $userNames->contains(function ($value, $key) use ($var) {
                return $value !== $var->name;
            });
        });

        $lead_name = 0;
        foreach ($filteredInvitees as &$invitee) {
            if ($invitee->personId !== null) {
                $lead_name = $invitee->name;
            }
        }
        return $lead_name;
    }
}
