<?php

namespace App\Http\Middleware;

use App\Services\Store\CartService;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';
    protected CartService $cartService;

    public function __construct()
    {
        $this->cartService = app(CartService::class);
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => fn() => $request->user()
                ? $request->user()->only('id', 'name')
                : ['id' => 1, 'name' => 'guest'],
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'cartItemCount' => function () use ($request) {
                $userId = $request->user() ? $request->user()->only('id')->first()->id : 1;

                return count($this->cartService->getCartProducts($userId));
            }
        ]);
    }
}
