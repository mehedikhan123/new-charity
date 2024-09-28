<?php

namespace App\Services;

use App\Models\Cause;
use App\Models\CauseDonation;
use App\Services\Core\BaseModelService;

class CauseDonationService extends BaseModelService
{
    public function model(): string
    {
        return CauseDonation::class;
    }

    public function getCauseDonations(Cause $cause)
    {
        return $this->model()::where('cause_id', $cause->id)->where('payment_status', 'COMPLETED')->get();
    }

    public function getCauseDonation(Cause $cause, CauseDonation $causeDonation)
    {
        return $this->model()::where('cause_id', $cause->id)->where('payment_id', $causeDonation->payment_id)->first();
    }

    public function getAllDonations()
    {
        return $this->model()::where('payment_status', 'COMPLETED')->get();
    }

    public function getDonation(CauseDonation $causeDonation)
    {
        return $this->model()::where('payment_id', $causeDonation->payment_id)->first();
    }
}
