<?php


namespace App\Sitri\Repositories\Payment;


interface PaymentRepositoryInterface
{
    /**
     * @param array $with
     *
     * @return array
     */
    public function all(array $with = []);

    /**
     * @param int   $id
     * @param array $with
     *
     * @return array
     */
    public function find($id, array $with = []);

    /**
     * @param array $request
     * @param array $with
     *
     * @return array
     */
    public function getByRequest(array $request, array $with = []);

    /**
     * @return string
     */
    public function generateNoPayment();
}
