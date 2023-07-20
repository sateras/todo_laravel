<?php

namespace App\Repositories\v1;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

class PaymentRepository
{
    public function getTotalAmount(array $params = [])
    {
        $query = Payment::join('lessons', 'payments.lesson_id', '=', 'lessons.id');
        $query = $this->applyFilter($query, $params);

        return $query->sum('lessons.price');
    }

    public function getTotalLessons(array $params = [])
    {
        $query = Payment::join('lessons', 'payments.lesson_id', '=', 'lessons.id');
        $query = $this->applyFilter($query, $params);

        return $query->get();
    }

    protected function applyFilter(Builder $query, array $params = []) : Builder
    {
        if (isset($params['instructor_id'])) {
            $query->where('payments.instructor_id', $params['instructor_id']);
        }

        if (isset($params['dates'])) {
            $dates = json_decode($params['dates']);
            $query->where('payments.created_at', '>=', $dates->from);
            $query->where('payments.created_at', '<=', $dates->to . ' 23:59:59');
        }

        if (isset($params['from'])) {
            $query->where('payments.created_at', '>=', $params['from']);
        }

        if (isset($params['to'])) {
            $query->where('payments.created_at', '>=', $params['to']);
        }

        return $query;
    }
}
