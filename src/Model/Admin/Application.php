<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

use PHPMentors\Workflower\Persistence\WorkflowSerializableInterface;
use PHPMentors\Workflower\Process\ProcessContextInterface;
use PHPMentors\Workflower\Process\WorkflowContextInterface;
use PHPMentors\Workflower\Workflow\ProcessInstance;

class Application extends Model implements ProcessContextInterface, WorkflowSerializableInterface, WorkflowContextInterface
{
    protected $guarded = [];

    public static $searchField = [
        'name'       => [
            'searchType' => 'like'
        ]
    ];

    public function template(){
        return $this->hasOne('Goodcatch\Modules\Approval\Model\Admin\Template', 'template_id', 'id');
    }

    public function getProcessData()
    {
        // TODO: Implement getProcessData() method.
    }

    public function getProcessInstance()
    {
        // TODO: Implement getProcessInstance() method.
    }

    public function setProcessInstance(ProcessInstance $processInstance)
    {
        // TODO: Implement setProcessInstance() method.
    }

    public function setSerializedWorkflow($serializedWorkflow)
    {
        // TODO: Implement setSerializedWorkflow() method.
    }

    public function getSerializedWorkflow()
    {
        // TODO: Implement getSerializedWorkflow() method.
    }

    public function getWorkflowId()
    {
        $this->load('template');
        return $this->tempate->bpmn_file;
    }
}
