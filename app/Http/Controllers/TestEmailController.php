<?php
namespace App\Http\Controllers;
use App\Services\Sendgrid;
use App\User;
class TestEmailController extends Controller
{
    public function testBulkEmails()
    {
        $users = User::whereIn('id', [8,9])->get();
        // dd($users);
        $subject = 'Testing bulk Emails';
        // $sendgridPersonalization = [
        //     // [
        //     //     'to' => [[ 'email' => "iqbalkisas6@gmail.com"]],
        //     //     'substitutions' => [
        //     //         '%first_name%' => "iqbal"
        //     //     ]
        //     // ],

        //     // [
        //     //     'to' => [[ 'email' => "iqballokalmunchies@gmail.com"]],
        //     //     'substitutions' => [
        //     //         '%first_name%' => "iqbal lokal"
        //     //     ]
        //     // ]
        // ];
        $sendgridPersonalization = [];

        foreach ($users as $user) {
            array_push(
                $sendgridPersonalization,
                [
                    'to' => [ 'email' => $user->email ],
                    'substitutions' => [
                        '%first_name%' => $user->name
                    ]
                ]
            );
        }

        

        // Send bulk emails through sendgrid API
        $resultBulkEmail = Sendgrid::sendBulkEmail(
            $subject,
            $sendgridPersonalization,
            view('emails.test')->render()
        );
        if(!$resultBulkEmail['status']) {
            return redirect()->back()->withErrors('Email sending failed!');
        }
        return redirect()->back()->with('success', 'Email sending ');
    }
}