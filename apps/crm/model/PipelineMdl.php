<?php

require_once '../../model/connection.php';
class PipelineMdl
{
    /*
     sd' => $sourceId,
                    'td' => $targetId,
                    'pd' => $pipelineID
     */
    static public function doPipeline($tbl, $data){
        $stmt   = Connection::connect()->prepare("UPDATE $tbl SET pipeline_status = :st WHERE pipeline_ID = :d");
        $stmt->bindParam('st', $data['td'], PDO::PARAM_STR);
        $stmt->bindParam('d', $data['pd'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}