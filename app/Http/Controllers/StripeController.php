<?php

namespace App\Http\Controllers;

use App\Models\PricingPackage;
use App\Models\Reservation;
use App\Models\TrainingSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as LaravelSession; // Rename Laravel's Session
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession; // Rename Stripe's Session
use Stripe\FinancialConnections\Session;

class StripeController extends Controller
{

    /*
    public function stripe($id)
    {
        $userId = DB::select("select user_id from training_session_user where training_session_id = $id");

    //    $user = User::find($userId);

        $trainingSession = TrainingSession::findorfail($id);
        return view('PaymentPackage.stripe', ['trainingSession' => $trainingSession]);
    }
 */

    public function stripe($id)
    {
        $trainingSession = TrainingSession::find($id);
        return view('PaymentPackage.stripe', ['trainingSession' => $trainingSession]);
    }


    public function stripePost(Request $request)
    {


        $packageInfo = explode('|', $request->package_id);

        $training_session_id = $packageInfo[0];

        $todayDay = Carbon::now();



        $dateTimestamp1 = strtotime($todayDay->toDateString());
        $dateTimestamp2 = strtotime($request->subscription_end);


        if ($dateTimestamp1 > $dateTimestamp2)

            return back()->withErrors("please renew your subscription");

        Reservation::create([
            'reservation_at' => Carbon::now(),
            'user_id' => Auth::user()->id,
            'training_session_id' =>    $request->session_id,

        ]);


        Session::flash('success', 'Payment successful!');

        return redirect()->route('reservation');
    }

    public function index()
    {
        $revenues = Revenue::all();
        return view('PaymentPackage.purchase_history', [
            'revenues' => $revenues,
        ]);
    }

    public function createCheckoutSession(PricingPackage $package)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jod',
                        'product_data' => [
                            'name' => $package->duration . ' Package',
                        ],
                        'unit_amount' => $package->price * 1000, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
                'cancel_url' => route('checkout.cancel'),
                'metadata' => [
                    'package_id' => $package->id,
                    'user_id' => auth()->id()
                ]
            ]);

            return redirect()->away($session->url);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
