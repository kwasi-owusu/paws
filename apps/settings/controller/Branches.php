<?php
class Branches
{
    static public function getAllBranches()
    {
        require_once('../../settings/model/BranchesMDL.php');
        $allBranches   = BranchesMDL::allBranches();

        return $allBranches;
    }
}
