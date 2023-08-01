<?php

namespace App\Listeners;

use App\Events\ProcessoTramitadoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdicionarProcessoCaixaEntradaListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProcessoTramitadoEvent $event): void
    {
        //
    }
}
