<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => ['required', 'regex:/^[\pL\s]+$/u'],  // alpha_spaces validation rule
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'regex:/^[0-9]+$/'],    // optional, numeric validation
            'subject' => ['nullable'],
            'message' => ['required']
        ]);

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'sandbox.smtp.mailtrap.io');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME', '3c82afaa7f48ea');
            $mail->Password   = env('MAIL_PASSWORD', 'bea93834c0a1f5');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 2525;

            // Recipients
            $mail->setFrom("support@gaurakshashalas.com", env('MAIL_FROM_NAME', 'Mailer'));
            $mail->addAddress('gaurakshashalas@gmail.com', 'Gaurakshashalas'); // Add recipient
            $mail->addReplyTo($request->email, $request->name); // Reply to user who filled out the form


            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $request->subject ?? 'Contact Form Submission';
            $mail->Body    = "
                <h1>Contact Form Details</h1>
                <p><strong>Name:</strong> {$request->name}</p>
                <p><strong>Email:</strong> {$request->email}</p>
                <p><strong>Phone:</strong> {$request->phone}</p>
                <p><strong>Message:</strong> {$request->message}</p>";
            $mail->AltBody = strip_tags($mail->Body); // Plain text version of the email

            // Send the email
            $mail->send();

            // Return a success response (flash message or redirect)
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}")->withInput();
        }
    }
}
