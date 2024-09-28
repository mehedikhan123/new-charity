<?php

namespace App\Services;

use App\Models\Program;
use App\Models\ProgramTicket;
use App\Models\User;
use App\Services\Core\BaseModelService;

class ProgramTicketService extends BaseModelService
{
    public function model(): string
    {
        return ProgramTicket::class;
    }

    public function getProgramTickets(Program $program)
    {
        return $this->model()::orderBy('id', 'desc')->where('program_id', $program->id)->where('payment_status', 'COMPLETED')->get();
    }

    public function getProgramTicketByUser(Program $program, User $user)
    {
        return $this->model()::orderBy('id', 'desc')->where('program_id', $program->id)->where('user_id', $user->id)->where('payment_status', 'COMPLETED')->first();
    }

    // public function getProgramTicket(Program $program)
    // {
    //     return $program->load(['program', 'user']);
    // }

    public function getProgramTicket(Program $program, ProgramTicket $programTicket)
    {
        return $this->model()::orderBy('id', 'desc')->where('program_id', $program->id)->where('payment_id', $programTicket->payment_id)->first();
    }
}
