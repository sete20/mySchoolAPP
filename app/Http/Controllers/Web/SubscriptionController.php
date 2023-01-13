<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\SubscriptionRepository;
use App\Http\Requests\web\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(private $repository = new SubscriptionRepository())
    {
    }

    public function index(Request $r)
    {
        return $this->repository->index($r);
    }

    public function create()
    {
        return $this->repository->create();
    }


    public function store(SubscriptionRequest $request)
    {
        return $this->repository->store($request);
    }


    public function show(Subscription $subscription)
    {
        return $this->repository->show($subscription);
    }

    public function edit(Subscription $subscription)
    {
        return $this->repository->edit($subscription);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        return $this->repository->update($request, $subscription);
    }

    public function destroy(Subscription $subscription)
    {
        return $this->repository->destroy($subscription);
    }
    public function changeSubscriptionStatus(Subscription $subscription)
    {
        return $this->repository->changeSubscriptionStatus($subscription);
    }
}
