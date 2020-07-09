<?php

namespace App\Services\Logs;

use Monolog\Processor\ProcessorInterface;

class LogProcessor implements ProcessorInterface {
     /**
     * @return array The processed record
     */
     public function __invoke(array $record) {
        $record['extra']['origin'] = request()->headers->get('origin');
        $record['extra']['ip'] = request()->server('REMOTE_ADDR');
        $record['extra']['user_agent'] = request()->server('HTTP_USER_AGENT');
         
        return $record;
     }
}