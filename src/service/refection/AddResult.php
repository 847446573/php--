<?php
namespace Src\Service\Refection;
use Src\Service\Refection\Action;


class AddResult extends Action {

    public function getResult()
    {
        // TODO: Implement getResult() method.
        return ($this->a)+($this->b);
    }

}