<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencySearchRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Inertia\Inertia;

class CurrencyController extends Controller
{
    protected CurrencyRepository $repository;

    /**
     * CurrencyController constructor.
     * @param CurrencyRepository $repository
     */
    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CurrencySearchRequest $request
     * @return \Inertia\Response
     */
    public function dashboard(CurrencySearchRequest $request)
    {
        return Inertia::render('Dashboard', [
            'currencies' => $this->repository->getAll(
                $request->validated(),
                $request->getPerPage()
            ),
        ]);
    }

    /**
     * @param CurrencySearchRequest $request
     * @param string $currency
     * @return \Inertia\Response
     */
    public function history(CurrencySearchRequest $request, string $currency)
    {
        return Inertia::render('History', [
            'currency' => $currency,
            'currencies' => $this->repository->get(
                $currency,
                $request->validated(),
                $request->getPerPage()
            ),
            'params' => $request->validated()
                ?: [
                    'page' => 1,
                    'per_page' => 15,
                ],
        ]);
    }

    /**
     * @param CurrencySearchRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CurrencySearchRequest $request)
    {
        return CurrencyResource::collection(
            $this->repository->getAll(
                $request->validated(),
                $request->getPerPage()
            )
        );
    }

    /**
     * @param CurrencySearchRequest $request
     * @param string $currency
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get(CurrencySearchRequest $request, string $currency)
    {
        return CurrencyResource::collection(
            $this->repository->get(
                $currency,
                $request->validated(),
                $request->getPerPage()
            ),
        );
    }
}
