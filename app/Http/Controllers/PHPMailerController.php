<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
  
class PHPMailerController extends Controller
{   
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        return view('sendEmail');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $mail = new PHPMailer(true);
   
        try {
   
            /* Email SMTP Settings */
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'web616561@gmail.com';                     //SMTP username
            $mail->Password   = 'argefhnkvwirvano';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;  
            $mail->setFrom('web616561@gmail.com', 'Mailer');
            $mail->addAddress($request->email); 
            
            /*
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');  
   
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->email);   
            */
            $mail->isHTML(true);
   
            $mail->Subject = $request->subject;
            $mail->Body    = $request->body;
   
            if( !$mail->send() ) {
                return back()->with("error", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
              
            else {
                return back()->with("success", "Email has been sent.");
            }
   
        } catch (Exception $e) {
             echo $e;
             //return back()->with('error','Message could not be sent.');
        }
    }
}