<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private function testInput(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function login(Request $request): JsonResponse
    {
        $rawEmail = (string) $request->post('email', '');
        $password = (string) $request->post('password', '');

        if (empty($rawEmail) || empty($password)) {
            return response()->json(['success' => false, 'message' => 'Լրացրեք բոլոր դաշտերը']);
        }

        $email = $this->testInput($rawEmail);

        $admin = Admin::where('email', $email)->first();

        if ($admin !== null) {
            if (! empty($admin->password) && Hash::check($password, $admin->password)) {
                $request->session()->regenerate();
                $request->session()->put([
                    'User' => $admin->name ?? $admin->email,
                    'user_id' => $admin->id,
                    'username' => $admin->username,
                    'is_admin' => 1,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Մուտք հաջողվեց',
                    'is_admin' => true,
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Սխալ էլ. փոստ կամ գաղտնաբառ']);
        }

        $user = User::where('email', $email)->first();

        if ($user !== null && ! empty($user->password) && Hash::check($password, $user->password)) {
            $request->session()->regenerate();
            $isAdmin = (int) $user->is_admin;
            $request->session()->put([
                'User' => $user->name ?? $user->email,
                'user_id' => $user->id,
                'username' => $user->username,
                'is_admin' => $isAdmin,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Մուտքը հաջողվեց',
                'is_admin' => $isAdmin === 1,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Սխալ էլ. փոստ կամ գաղտնաբառ']);
    }

    public function register(Request $request): JsonResponse
    {
        $rawName = (string) $request->post('name', '');
        $rawUsername = (string) $request->post('username', '');
        $rawEmail = (string) $request->post('email', '');
        $rawPassword = (string) $request->post('password', '');
        $rawConfirmation = (string) $request->post('password_confirmation', '');
        $rawGender = (string) $request->post('gender', '');

        if (empty($rawName)) {
            return response()->json(['success' => false, 'message' => 'Անունը պետքա է լրացվի']);
        }
        $name = $this->testInput($rawName);

        if (empty($rawUsername)) {
            return response()->json(['success' => false, 'message' => 'Օգտատիրոջ անունը պետքա է լրացվի']);
        }
        $username = $this->testInput($rawUsername);

        if (empty($rawEmail)) {
            return response()->json(['success' => false, 'message' => 'Էլ. փոստը պետքա է լրացվի']);
        }
        if (! filter_var($rawEmail, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => 'Էլ. փոստը վավեր չէ']);
        }
        $email = $this->testInput($rawEmail);

        if (empty($rawPassword)) {
            return response()->json(['success' => false, 'message' => 'Գաղտնաբառը պետքա է լրացվի']);
        }
        if (strlen($rawPassword) < 6) {
            return response()->json(['success' => false, 'message' => 'Գաղտնաբառը պետք է լինի առնվազն 6 նիշ']);
        }

        if (empty($rawConfirmation)) {
            return response()->json(['success' => false, 'message' => 'Հաստատման գաղտնաբառը պետքա է լրացվի']);
        }
        if ($rawPassword !== $rawConfirmation) {
            return response()->json(['success' => false, 'message' => 'Գաղտնաբառերը չեն համընկնում']);
        }

        if (empty($rawGender)) {
            return response()->json(['success' => false, 'message' => 'Սեռը պետքա ընտրել']);
        }
        $gender = $this->testInput($rawGender);

        $exists = User::where('email', $email)->orWhere('username', $username)->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Այս էլ. փոստով կամ օգտատիրոջ անունով արդեն գրանցված է']);
        }

        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($rawPassword),
                'gender' => $gender,
            ]);
        } catch (\Throwable) {
            return response()->json(['success' => false, 'message' => 'Գրանցումը չհաջողվեց']);
        }

        return response()->json(['success' => true, 'message' => 'Գրանցումը հաջողվեց']);
    }

    public function showRegister(Request $request)
    {
        if ($request->session()->has('user_id')) {
            return (int) $request->session()->get('is_admin') === 1
                ? redirect()->route('admin.dashboard')
                : redirect()->route('products');
        }

        return view('auth.register');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('auth.logout');
    }

    public function adminLogout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('register');
    }
}
