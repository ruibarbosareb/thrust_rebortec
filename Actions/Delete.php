<?php

namespace Rebortec\Thrust\Actions;

use Rebortec\Thrust\ResourceGate;
use Illuminate\Support\Collection;

class Delete extends Action
{
    public $needsConfirmation = true;
    public $icon              = 'trash';
//    public $main = true;
    public $main = false;

    public function handle(Collection $objects)
    {
        $gate = app(ResourceGate::class);
        $objects->each(function ($object) use($gate) {
            if ($gate->can($this->resource, 'delete', $object)) {
                $this->resource->delete($object);
            }
        });
    }
}
