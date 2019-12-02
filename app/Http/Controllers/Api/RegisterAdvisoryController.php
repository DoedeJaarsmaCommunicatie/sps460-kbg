<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\Registers\Advisory;
use App\Http\Controllers\Controller;

class RegisterAdvisoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validateAdvisoryRequest($request);
        if ($this->doesUserExist($request)) {
            $this->failIfUserExists($request);

            $id = DB::table('users')
                    ->where('email', '=', $request->input('email'))
                    ->first('id');
        } else {
            $id = DB::table('users')->insertGetId($request->only([
                'firstName', 'lastName', 'email', 'houseNumber', 'postalCode'
            ]));
        }

        DB::table('signups')->insert([
            'user_id'   => $id,
            'type'      => 'advisory',
        ]);


        $data = $request->only([
            'firstName', 'lastName', 'email', 'houseNumber', 'postalCode'
        ]);

        event(new Advisory($id));

        $data['fullName']  = $request->input('firstName') . ' ' . $request->input('lastName');

        return response()->json([
            'status'    => 'success',
            'data'      => $data
        ]);
    }

    private function doesUserExist(Request $request): bool
    {
        return DB::table('users')
                 ->where('email', '=', $request->input('email'))
                 ->exists();
    }

    private function failIfUserExists(Request $request)
    {
        if ($this->doesUserExistAsAdvisory($request)) {
            abort(400, __('errors.duplicate.advisor'));
        }
    }

    private function doesUserExistAsAdvisory(Request $request)
    {
        $user = DB::table('users')
                  ->where('email', '=', $request->input('email'))
                  ->first();

        return DB::table('signups')
            ->where('user_id', '=', $user->id)
            ->where('type', '=', 'advisory')
            ->exists();
    }

    private function validateAdvisoryRequest(Request $request): void
    {
        if (!$request->has('firstName')) {
            abort(400, __('errors.firstName.notSupplied'));
        }

        if (!$request->has('lastName')) {
            abort(400, __('errors.lastName.notSupplied'));
        }

        if (!$request->has('email')) {
            abort(400, __('errors.email.notSupplied'));
        }

        if (!$request->has('houseNumber')) {
            abort(400, __('errors.houseNumber.notSupplied'));
        }

        if (!$request->has('postalCode')) {
            abort(400, __('errors.postalCode.notSupplied'));
        }
    }
}
