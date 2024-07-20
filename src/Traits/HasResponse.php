<?php

namespace Elegant\Admin\Traits;

use Elegant\Admin\Actions\Response;

trait HasResponse
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @param bool $swal
     * @return Response
     */
    public function response($swal = true)
    {
        if (is_null($this->response)) {
            $this->response = new Response();
        }

        if ($swal || method_exists($this, 'dialog')) {
            $this->response->swal();
        } else {
            $this->response->toastr();
        }

        return $this->response;
    }
}
