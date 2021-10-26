<?php

namespace Goodcatch\Modules\Approval\Repositories;

use Goodcatch\Modules\Approval\Workflow\Exceptions\UnsupportedMethodException;
use Goodcatch\Modules\Approval\Workflow\Exceptions\WorkflowException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PHPMentors\Workflower\Definition\Bpmn2Reader;
use PHPMentors\Workflower\Workflow\ProcessInstance;
use PHPMentors\Workflower\Workflow\WorkflowRepositoryInterface;

class WorkflowRepository implements WorkflowRepositoryInterface
{
    private $bpmnReader;

    public function __construct()
    {
        $this->bpmnReader = new Bpmn2Reader();
    }

    public function findById($file_path): ?ProcessInstance
    {
        try {
            $this->filePath = $file_path;
            return $this->readFileWithBpmReaderAndReturnWorkflow();
        } catch (\Exception $e) {
            Log::error($e);
            throw new WorkflowException("Error en la lectural del archivo en workflower", 1);
        }
    }


    private function readFileWithBpmReaderAndReturnWorkflow()
    {
        return $this->bpmnReader->read($this->getStorageFilePath());
    }

    private function getRelativeFilePath()
    {
        return config('approval.bpmn_path') . "/{$this->filePath}";
    }

    private function getStorageFilePath()
    {
        return Storage::path(
            $this->getRelativeFilePath()
        );
    }

    public function add($workflow) : void
    {
        throw new UnsupportedMethodException("Metodo no necesario para la implementacion", 1);
    }

    public function remove($workflow): void
    {
        throw new UnsupportedMethodException("Metodo no necesario para la implementacion", 1);
    }
}
