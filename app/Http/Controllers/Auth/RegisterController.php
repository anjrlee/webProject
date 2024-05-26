<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Psw;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Session;
use function Amp\delay;
use function Amp\async;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function storeData($token){
        $returnMessage='';
        if(Session::get('token', 'hi')===$token){
            $user = User::create([
                'name' => Session::get('name'),
                'email' => Session::get('email'),
                'password' => Session::get('password'),
                'department' => Session::get('department'), // Save department
            ]);
    
            // Save hashed password to psw table
            Psw::create([
                'user_id' => $user->id,
                'password' => Session::get('token', 'password'),
            ]);
            $returnMessage="true";
        }else{
            $returnMessage="false";
        }
        return redirect('/login')->with('message', $returnMessage);
    }
    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
            'department' => 'required|string|max:50', // Validate department
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $mail = new PHPMailer(true);
   
        try {
   
            /* Email SMTP Settings */
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT');  
            $mail->setFrom(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->email); 
            $mail->isHTML(true);
            $token = str_replace(['+', '/', '=','.'], ['-', '_', '',''], Hash::make(time()));
            Session::put('token', $token);
            
            $mail->Subject = "verify";
            $mail->Body    = env('webLink')."/verifyEmail"."/".Session::get('token', '');
            Session::put('name', $request->name);
            Session::put('email', $request->email);
            Session::put('password', Hash::make($request->password));
            Session::put('department', $request->department);
            Session::save();
            if(!$mail->send()) {
                return response()->json(['error' => $mail->ErrorInfo], 400);
            } else {
                //return response()->json(['message' => "請前往信箱並點驗證信連結以完成註冊"], 200);
                //return response()->json(['error' => $mail->Body], 400);
            }
            return response()->json(['message' => "good"], 200);
            
   
        } catch (Exception $e) {
            return response()->json(['errors' => $e], 422);
             //return back()->with('error','Message could not be sent.');
        }

        //return response()->json(['message' => '後端註冊成功'], 201);
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department' => $data['department'], // Save department
        ]);

        // Save hashed password to psw table
        Psw::create([
            'user_id' => $user->id,
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}


