<?php

namespace App\Services;

class DefaultPaginateService
{
    public function DefaultPaginate($content, $items)
    {
        return [
            'atualPage'         => $content->currentPage(),
            'totalRegisters'    => $content->total(),
            'totalPages'        => $content->lastPage(),
            'registersPerPage'  => $content->perPage(),
            'items'             => $items
        ];
    }
}