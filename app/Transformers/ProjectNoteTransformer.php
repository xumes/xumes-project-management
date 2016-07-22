<?php

namespace App\Transformers;

use App\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{
    public function transform(ProjectNote $note)
    {
        return [
            'id'         => $note->id,
            'project_id' => $note->project_id,
            'title'      => $note->title,
            'note'       => $note->note,
        ];
    }

}