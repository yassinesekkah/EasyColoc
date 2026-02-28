<?php

namespace App\Services;

use Illuminate\Support\Collection;

class SettlementService
{
    public function calculate(Collection $members)
    {
        $creditors = [];
        $deptors = [];
        $settlements = [];
        
        foreach ($members as $member) {

            ///nfiltriw l members l creditors w deptors
            if ($member->balance > 0) {
                $creditors[] = [
                    'user' => $member,
                    'amount' => $member->balance
                ];
            }

            if ($member->balance < 0) {
                $deptors[] = [
                    'user' => $member,
                    'amount' => abs($member->balance)
                ];
            }
        }

        $i = 0;
        $j = 0;

        while ($i < count($creditors) && $j < count($deptors)) {
            ///njabdo amount sghir bin creditors w deptors
            $amount = min($creditors[$i]['amount'], $deptors[$j]['amount']);
            
            ///nsafiwha binathoum 
            $settlements[] = [
                'from' => $deptors[$j]['user'],
                'to' => $creditors[$i]['user'],
                'amount' => $amount
            ];

            //na9sso l amount mn balance dyalhoum
            $creditors[$i]['amount'] -= $amount;
            $deptors[$j]['amount'] -= $amount;

            //ila sfa chi wahed fihoum doz lel member limorah
            if ($creditors[$i]['amount'] <= 0) $i++;
            if ($deptors[$j]['amount'] <= 0) $j++;
        }
        
        return collect($settlements);
    }
}
