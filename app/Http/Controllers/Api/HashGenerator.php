<?php


namespace App\Http\Controllers\Api;


use Laravel\Lumen\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class HashGenerator extends Controller
{
    /**
     * Hashes the email address supplied.
     *
     * @param string $email
     *
     * @return string
     */
    public function hashEmail(string $email)
    {
        if (!$email) {
            abort(403, 'Email not supplied');
        }

        return response()->json([
            Crypt::encryptString($email)
        ]);
    }

    public function deHashEmail(string $email)
    {
        if (!$email) {
            abort(403, 'Email not supplied');
        }

        return response()->json(
            [
                Crypt::decryptString($email)
            ]
        );
    }
}
