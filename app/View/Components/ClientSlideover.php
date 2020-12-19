<?php

namespace App\View\Components;

use App\Models\Client;
use Illuminate\View\Component;

class ClientSlideover extends Component
{
    public $clientID;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        //
        $this->clientID = $client;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.client-slideover', ['client' => Client::findOrFail($this->clientID)]);
    }
}
