<?php
namespace App\Repositories;
use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Models\User;
use App\Models\Memo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class AccountRepository implements AccountRepositoryInterface
{
    public function index()
    {
        $accounts  = User::with('memos')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return response()->json($accounts, 200);
    }

    public function store(array $data)
    {
        $id = $data['id'] ?? Str::uuid()->toString();

        $fillable = ['name', 'username', 'phone', 'email'];

        $userData = array_filter(
            array_intersect_key($data, array_flip($fillable)),
            fn ($value) => $value !== null
        );

        $userData['id'] = $id;
        $userData['password'] = Hash::make($data['password']);
        $userData['email_verified_at'] = now();
        $userData['remember_token'] = Str::random(10);

        $user = User::create($userData);
        if (!empty($data['memo']) && $user && $user->id) {
            Memo::create([
                'user_id' => $userData['id'],
                'recipient_id' => $data['memo']['recipient_id'] ?? null,
                'content' => $data['memo']['content'],
            ]);
        }

        return response()->json([
            'message' => 'Account created successfully',
            'user' => $user->load('memos'),
        ], 201);
    }

}
