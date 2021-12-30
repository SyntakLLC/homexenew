<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Appointments/Index', [
            'appointments' => Appointment::all(),
            'leads' => $this->fubApiCall('people')->people,
        ]);
    }

    public function edit(Appointment $appointment)
    {
        return Inertia::render('Appointments/Edit', [
            'appointment' => $appointment,
        ]);
    }

    public function show(Appointment $appointment)
    {
        return Inertia::render('Appointments/Show', [
            'appointment' => $appointment,
        ]);
    }

    public function get(Request $request)
    {
        return Appointment::all();
    }

    public function submitAppointment(
        Request $request,
        Appointment $appointment,
    ) {
        $appointment->status = $request->status;
        $appointment->appointment_type = $request->appointmentType;
        $appointment->seller_actually_selling = $request->sellerActuallySelling;
        $appointment->reason_for_selling = $request->reasonForSelling;
        $appointment->house_condition = $request->houseCondition;
        $appointment->timeframe_for_selling = $request->timeframeForSelling;
        $appointment->seller_avatar = $request->sellerAvatar;
        $appointment->odds_of_conversion = $request->oddsOfConversion;
        $appointment->buyer_serious_about_buying =
            $request->buyerSeriousAboutBuying;
        $appointment->buyer_credit = $request->buyerCredit;
        $appointment->seller_asking_price = $request->sellerAskingPrice;
        $appointment->lowest_considered_price = $request->lowestConsideredPrice;
        $appointment->mls_price = $request->mlsPrice;
        $appointment->buying_after_selling = $request->buyingAfterSelling;
        $appointment->preapproved = $request->preapproved;
        $appointment->lender = $request->lender;
        $appointment->top_two_towns = $request->topTwoTowns;
        $appointment->desired_price_point = $request->desiredPricePoint;
        $appointment->sell_before_buy = $request->sellBeforeBuy;

        $appointment->save();

        return Redirect::route('appointment.show', [
            'appointment' => $appointment,
        ]);
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
}
