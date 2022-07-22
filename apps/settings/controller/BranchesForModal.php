<?php

class BranchesForModal {
    static public function getAllBranches()
    {
        require_once('../../../settings/model/BranchesForModalMDL.php');
        $allBranches   = BranchesForModalMDL::allBranchesForModal();

        return $allBranches;
    }
}