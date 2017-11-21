<?php 
namespace App;
use Mail;
class User extends Authenticatable
{
  public static function generatePassword()
    {
      // Generate random string and encrypt it. 
      return bcrypt(str_random(35));
    }
    public static function sendWelcomeEmail($user)
    {
      // Generate a new reset password token
      $token = app('auth.password.broker')->createToken($user);
      
      // Send email
      Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
        $m->from('hello@appsite.com', 'Your App Name');
        $m->to($user->email, $user->name)->subject('Welcome to APP');
      });
    }
}
?>