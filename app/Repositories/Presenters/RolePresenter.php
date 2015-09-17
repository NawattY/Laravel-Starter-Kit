<?php

namespace App\Repositories\Presenters;

use App\Transformers\RoleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RolePresenter
 *
 * @package namespace App\Repositories\Presenters;
 */
class RolePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleTransformer();
    }
}
