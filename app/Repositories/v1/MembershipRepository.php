<?php

namespace App\Repositories\v1;

use App\Models\Membership;
use App\Repositories\BaseRepository;

class MembershipRepository
{
    public function index(array $params = [])
    {
        $query = Membership::with('affiliate');
        $query = $this->queryApplyFilter($query, $params);
        
        return $query->get();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['affiliate_id'])) {
            $query->where('affiliate_id', $params['affiliate_id']);
        }

        return $query;
    }
}