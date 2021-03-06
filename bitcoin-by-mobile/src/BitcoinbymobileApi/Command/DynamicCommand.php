<?php

namespace BitcoinbymobileApi\Command;

use Guzzle\Service\Command\DynamicCommand as BaseDynamicCommand;

class DynamicCommand extends BaseDynamicCommand
{
    /**
     * Create the result of the command after the request has been completed.
     *
     * Always returns a Response object for consistency (hence the class name)
     */
    protected function process()
    {
        // Uses the response object by default
        $this->result = $this->getRequest()->getResponse();
    }
}
