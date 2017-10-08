<?php

namespace App\Http\Middleware;

use App\Sessions\Customer\Customer;
use Closure;

/**
 * Class RequireCompanyMiddleware
 * @package App\Http\Middleware
 */
class RequireCompanyMiddleware
{
    /**
     * @var Customer
     */
    protected $customerSession;


    /**
     * RequireCompanyMiddleware constructor.
     * @param Customer $customer
     */
    function __construct(Customer $customer)
    {
        $this->customerSession = $customer;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->hasCompany() ? $next($request) : $this->redirect();
    }

    /**
     *
     */
    protected function hasCompany()
    {
        return $this->customerSession->get('company') ? true : false;
    }

    protected function redirect()
    {
        return redirect(route('companies.new.byOwner', ['owner' => sha1(time())]));
    }

}
