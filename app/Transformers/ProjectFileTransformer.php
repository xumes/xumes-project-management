<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param \ProjectFile $model
     *
     * @return array
     */
    public function transform(ProjectFile $model)
    {
        return [
            'id'         => (int)$model->id,

            /* place your other model properties here */

            'name'          =>  $model->name,
            'extension'     =>  $model->extension,
            'description'   =>  $model->description
        ];
    }
}